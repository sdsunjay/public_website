#include "lab1.h"

//kernel call
__global__ void   mmKernel(TYPE *Md, TYPE *Nd, TYPE *Pd, int mrows, int width, int ncols)
{
   __shared__ TYPE Melem[TILE_WIDTH][TILE_WIDTH];
   __shared__ TYPE Nelem[TILE_WIDTH][TILE_WIDTH];

   //Calculate the row index of the Pd element and M
   int Row = blockIdx.y * blockDim.y + threadIdx.y;
   // Calculate the column idenx of Pd and N
   int Col = blockIdx.x * blockDim.x + threadIdx.x;

   TYPE Pvalue = 0.0;

   int runs = 0;
   if (width % TILE_WIDTH > 0)
   {     
       runs++;
   }

   for (int m = 0; m < (width/TILE_WIDTH) + runs; m++)
   {
      //Row is the row index in P (resultant) and in Md matrices
      if ((Row < mrows) && ((m * TILE_WIDTH + threadIdx.x) < width))
         Melem[threadIdx.y][threadIdx.x] = Md[Row * width + (m * TILE_WIDTH + threadIdx.x)];
      else
      {
         Melem[threadIdx.y][threadIdx.x] = 0.0;
      }

      //Col is the column index in P (resultant) and in Nd matrices
      if ((Col < ncols) && ((m * TILE_WIDTH + threadIdx.y) < width))
         Nelem[threadIdx.y][threadIdx.x] = Nd[Col + ncols * (m * TILE_WIDTH + threadIdx.y)];
      else 
      {
         Nelem[threadIdx.y][threadIdx.x] = 0.0;
      }
      __syncthreads();
 
      for (int k = 0; k < TILE_WIDTH; k++) 
         Pvalue += Melem[threadIdx.y][k] * Nelem[k][threadIdx.x];

      __syncthreads();
   }

   if ((Row < mrows) && (Col < ncols))
      Pd[(Row * ncols) + Col] = Pvalue;
}

matrix_t MMonDevice(matrix_t matrix1, matrix_t matrix2) {

   //number of blocks
   int blocksx, blocksy;

   matrix_t retMatrix;

   TYPE *Md, *Nd, *Pd, *P;
   P = (TYPE *) malloc(matrix1.rows * matrix2.cols * sizeof(TYPE));

   dim3 dimBlock;

   cudaMalloc(&Md, matrix1.rows * matrix1.cols * sizeof(TYPE));
   cudaMemcpy(Md, matrix1.array, matrix1.rows * matrix1.cols * sizeof(TYPE), cudaMemcpyHostToDevice);

   cudaMalloc(&Nd, matrix2.rows * matrix2.cols * sizeof(TYPE));
   cudaMemcpy(Nd, matrix2.array, matrix2.rows * matrix2.cols * sizeof(TYPE), cudaMemcpyHostToDevice);

   cudaMalloc(&Pd, matrix1.rows * matrix2.cols * sizeof(TYPE));

   blocksx = matrix2.cols / TILE_WIDTH;
   if (matrix2.cols % TILE_WIDTH > 0)
   {
      blocksx++;
   }
   blocksy = matrix1.rows / TILE_WIDTH;
   if(matrix1.rows % TILE_WIDTH)
   {
      blocksy++;
   }
   printf("Number of x blocks is: %d\n",blocksx); 
   printf("Number of y blocks is: %d\n",blocksy); 

   //invoke kernel
   dim3 dimGrid(blocksx, blocksy);

   //incase resulting matrix is less than 1024
  // if (matrix1.rows * matrix2.cols < TILE_WIDTH * TILE_WIDTH) {
   //   dimBlock.x = matrix2.cols;
    //  dimBlock.y = matrix1.rows;
  // }
  // else {
      dimBlock.x = TILE_WIDTH;
      dimBlock.y = TILE_WIDTH;
  // }

   printf("Launching mrows: %d width: %d ncols: %d\n", matrix1.rows, matrix1.cols, matrix2.cols);

   int runs = 0;
   if (matrix1.cols % TILE_WIDTH > 0)
      runs++;
   printf("Number of tiles will be %d\n", matrix1.cols / TILE_WIDTH + runs);
   mmKernel<<<dimGrid, dimBlock>>>(Md, Nd, Pd, matrix1.rows, matrix1.cols, matrix2.cols);

   //copy back
   cudaMemcpy(P, Pd, matrix1.rows * matrix2.cols * sizeof(TYPE), cudaMemcpyDeviceToHost);

   cudaFree(Md);
   cudaFree(Nd);
   cudaFree(Pd);

   retMatrix.array = P;
   retMatrix.rows = matrix1.rows;
   retMatrix.cols = matrix2.cols;

   return retMatrix;
}

int main(int argc, char* argv[])
{
   matrix_t matrix1, matrix2, matrix3;

   matrix1 = matrix_read(argv[1]);   
   matrix2 = matrix_read(argv[2]);   

   matrix3 = MMonDevice(matrix1, matrix2);
   print_matrix(matrix3);

   free(matrix1.array);
   free(matrix2.array);
   free(matrix3.array);
   return 0;
}

//reads and parses the matrix
//could we return a pointer to the newly allocated matrix?
//might be faster
matrix_t matrix_read(char* filename)
{

   //stat struct for size of file
   struct stat sb;
   //mmap pointer
   char* file_memory;

   /*matrix we return*/
   matrix_t matrix;

   //file descriptor
   int fd;

   //loop counters
   int j;
   int i;

   //open file for reading
   fd = open (filename, O_RDONLY);
   if(fd==-1)
   {
      fprintf(stderr,"error opening file. exitting\n");
      exit(-1);
   }
   // figure out the size
   if(fstat(fd, &sb)==-1)
   {
      fprintf(stderr,"error fstating file. exitting\n");
      exit(-1);

   }
   //add extra space for the null byte
   file_memory = (char*) mmap(0, sb.st_size+1, PROT_READ | PROT_WRITE, MAP_PRIVATE, fd, 0);
   if(file_memory==MAP_FAILED)
   {

      close (fd);
      fprintf(stderr,"mmap failed. Exitting\n");
      exit(-1);
   }
   //close file descriptor
   close (fd);
   //set null byte
   file_memory[sb.st_size+1]='\0';

   i=0;
   matrix.rows=0;
   matrix.cols=0;

   //count the number of rows and columns in the matrix
   while(file_memory[i]!='\0')
   {
      if ((matrix.rows==0) && file_memory[i]==' ' )
      {
         matrix.cols++;
      }
      if(file_memory[i]=='\n')
      {
         matrix.rows++;
      }
      if(file_memory[i]=='\0')
         break;
      i++;
   }
   //printf("rows: %d ",matrix.rows);
   //printf("columns: %d\n",matrix.cols);

   //malloc for matrix
   matrix.array = (TYPE *)malloc(sizeof(TYPE) * (matrix.rows*matrix.rows));

   if (matrix.array == NULL)
   {
      perror("No space to allocate matrix.");
      exit(1);
   }

   for(i=0;i<matrix.rows;i++)
   {
      for(j=0;j<matrix.rows;j++)
      {
#ifdef DOUBLE
         //copy number into matrix
         matrix.array[i*matrix.rows+j]=strtod(file_memory,&file_memory);
#else 
         matrix.array[i*matrix.rows+j]=strtof(file_memory,&file_memory);
#endif

      }
   }
   //we no longer need mmapped memory
   munmap(file_memory, sb.st_size+1);

   return matrix;

}


//print result matrix to 'result.out'
void print_matrix(matrix_t matrix) {
   int i,j;
   FILE *fp;

   fp = fopen("result.out", "w");

   for (i = 0; i < matrix.rows; i++) {
      for (j = 0; j < matrix.cols; j++) {
#ifdef DOUBLE
         fprintf(fp, "%.2lf ", matrix.array[i * matrix.cols + j]);
#else
         fprintf(fp, "%.2f ", matrix.array[i * matrix.cols + j]);
#endif
      }
      fprintf(fp, "\n");
   }
   fclose(fp);
}

