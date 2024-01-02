import os
from hashlib import md5
import sys
import boto3
import botocore
import mimetypes
from pathlib import Path

def getS3Path(input_file, local_path_prefix):
    """
    Get the S3 path of a file.

    Args:
        input_file (str): The file path.
        local_path_prefix (str): The absolute file path of the current dir.

    Returns:
        str: The S3 path of the file.
    """
    # Get the absolute file path
    s3_path = os.path.abspath(input_file)
    # Replace the local path prefix with the S3 path prefix
    final_s3_path = s3_path.replace(local_path_prefix, "")
    return final_s3_path


def upload_file(s3, bucket_name, input_file, object_key):
    """
    Upload a file to an S3 bucket.

    Args:
        s3 (boto3.client): An S3 client.
        bucket_name (str): The name of the bucket to upload the file to.
        input_file (str): The path of the file to be uploaded.
        object_key (str): The key to use when uploading the object.

    Returns:
        bool: True if the file was uploaded successfully.
    """
    file_mime_type, _ = mimetypes.guess_type(input_file)
    s3.upload_file(input_file, bucket_name, object_key, ExtraArgs={'ContentType': file_mime_type})
    return True


def check_if_file_exists_in_s3(s3, bucket_name, object_key):
    """
    Check if a file exists in an S3 bucket.

    Args:
        s3 (boto3.client): An S3 client.
        bucket_name (str): The name of the bucket to check.
        object_key (str): The key of the object to check.

    Returns:
        bool: True if the object exists, False otherwise.
    """
    try:
        # Try to retrieve the object's metadata
        s3.head_object(Bucket=bucket_name, Key=object_key)
        return True
    except botocore.exceptions.ClientError as e:
        # If a "404 Not Found" error is returned, the object does not exist
        # if e.response['Error']['Code'] == "404":
            # print(f'{object_key} does not exist in {bucket_name}')
        return False


def get_etag(s3, bucket_name, object_key):
    """
    Get the ETag of an object in an S3 bucket.

    Args:
        s3 (boto3.client): An S3 client.
        bucket_name (str): The name of the bucket containing the object.
        object_key (str): The key of the object.

    Returns:
        str: The ETag of the object.
    """
    # Retrieve the object's metadata
    response = s3.head_object(Bucket=bucket_name, Key=object_key)
    etag = response['ETag']
    # Remove quotes from the ETag
    return etag[1:-1]


# see https://docs.aws.amazon.com/cli/latest/topic/s3-config.html
# for default multipart_threshold and multipart_chunksize

def md5sum(file_like, multipart_threshold=8 * 1024 * 1024, multipart_chunksize=8 * 1024 * 1024):
    """
    Compute the md5 hash of a file-like object.

    Args:
        file_like (file-like object): The file-like object to compute the md5 hash of.
        multipart_threshold (int): Threshold for when to compute a multipart md5.
        multipart_chunksize (int): Chunk size for multipart md5.

    Returns:
        str: The md5 hash of the file-like object.
    """
    md5hash = md5()
    # Seek to the beginning of the file
    file_like.seek(0)
    filesize = 0
    block_count = 0
    md5string = b""
    # Iterate over the file in blocks
    for block in iter(lambda: file_like.read(multipart_chunksize), b""):
        md5hash = md5()
        md5hash.update(block)
        md5string += md5hash.digest()
        filesize += len(block)
        block_count += 1

    # If the file is larger than the multipart threshold, compute a multipart md5 hash
    if filesize > multipart_threshold:
        md5hash = md5()
        md5hash.update(md5string)
        md5hash = md5hash.hexdigest() + "-" + str(block_count)
    else:
        md5hash = md5hash.hexdigest()

    # Seek to the beginning of the file
    file_like.seek(0)
    return md5hash


def compare_etag(s3, bucket_name, input_file, files_uploaded, files_failed_to_upload, files_not_in_s3, files_not_needing_update):
    """
    Compare the ETag of a file in S3 with the calculated ETag of the same file on the local file system.

    Args:
        :param s3: (boto3.client): An S3 client.
        :param bucket_name: (str) The name of the bucket containing the file.
        :param input_file: (str) The file path.
        :param files_uploaded: (list) files uploaded to s3 bucket.
        :param files_failed_to_upload: (list)  files that failed to upload to s3 bucket.
        :param files_not_in_s3: (list)  files that are available locally, but not in s3.
        :param files_not_needing_update: (list) files that have matching etags and do not need to be updated in s3.

    Returns:
        lists of files uploaded, files that failed to upload, files not in s3, files not needing to be updated

    """
    # Get the S3 path of the file
    current_absolute_path = str(Path().absolute()) + "/"
    object_key = getS3Path(input_file, current_absolute_path)
    returnCode = True
    # Check if the file exists in S3
    if check_if_file_exists_in_s3(s3, bucket_name, object_key):
        # Get the ETag of the file in S3
        input_etag = get_etag(s3, bucket_name, object_key)
        # Open the file on the local file system in binary mode
        with open(input_file, mode="rb") as f:
            # Calculate the md5 hash of the file
            calculated_etag = md5sum(f)
        # Compare the ETag of the file in S3 with the calculated ETag
        if input_etag != calculated_etag:
            # If the ETags do not match, upload the file to S3
            returnCode = upload_file(s3, bucket_name, input_file, object_key)
            if returnCode:
                print("Uploaded: {}".format(object_key))
                files_uploaded.append(object_key)
            else:
                print("Failed to upload: {}".format(input_file))
                files_failed_to_upload.append(input_file)
        else:
            # ETags matched
            files_not_needing_update.append(input_file)
    else:
        files_not_in_s3.append(input_file)

    return files_uploaded, files_failed_to_upload, files_not_in_s3, files_not_needing_update


def main():
    root_dir = '.'
    s3 = boto3.client('s3')
    count = 0
    stop = False
    files_not_in_s3 = []
    files_uploaded = []
    files_failed_to_upload = []
    files_not_needing_update = []
    bucket_name = 'sunjaydhama.com'
    for dirpath, dirnames, filenames in os.walk(root_dir):
        if stop:
            break
        for filename in filenames:
            if filename.endswith(('.html', '.js', '.css', '.png', '.jpg', '.jpeg', '.gif')):
                count = count + 1
                file_path = os.path.join(dirpath, filename)
                files_uploaded, files_failed_to_upload, files_not_in_s3, files_not_needing_update = compare_etag(s3,
                                                                                                                 bucket_name,
                                                                                                                 file_path,
                                                                                                                 files_uploaded,
                                                                                                                 files_failed_to_upload,
                                                                                                                 files_not_in_s3,
                                                                                                                 files_not_needing_update)
                if count != 0 and count % 20 == 0:
                    print("Count of HTML, JS, and CSS files checked: {}".format(count))
                if len(files_uploaded) > 0 and len(files_uploaded) % 10 == 0:
                    print("Number of files uploaded: {}".format(len(files_uploaded)))
                if len(files_uploaded) > 20:
                    stop = True
                    break
    print("Total number of files checks: {}".format(count))

    print("Failed to upload: {}".format(len(files_failed_to_upload)))
    if len(files_failed_to_upload) != 0:
        print(*files_failed_to_upload, sep='\n ')
    print("Successfully uploaded: {}".format(len(files_uploaded)))
    if len(files_uploaded) != 0:
        print(*files_uploaded, sep='\n ')
    # print("Files not in s3: {}".format(len(files_not_in_s3)))
    # if len(files_not_in_s3) != 0:
    #    print(*files_not_in_s3, sep='\n ')

    print("Files not needing update (etag matched):{}".format(len(files_not_needing_update)))
    # if len(files_not_needing_update) != 0:
    #    print(*files_not_needing_update, sep='\n ')


if __name__ == "__main__":
    main()
