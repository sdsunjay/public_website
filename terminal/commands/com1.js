// Copyright 2014 Sunjay Dhama with permission from Clark Duvall
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     https://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

var COMMANDS = COMMANDS || {};
COMMANDS.cat =  function(argv, cb) {
   var filenames = this._terminal.ParseArgs(argv).filenames;
   var temp = 1;
   this._terminal.Scroll();
   if (!filenames.length) {
      this._terminal.ReturnHandler = function() {
         var stdout = this.Stdout();
         if (!stdout)
            return;
         stdout.innerHTML += '<br>' + stdout.innerHTML + '<br>';
         this.Scroll();
         this.NewStdout();
      }.bind(this._terminal);
      return;
   }
   filenames.forEach(function(filename, i) {
      if(filename.charAt(0)=='|'){
         temp = 0;
         this._terminal.ReturnHandler = function() {
            var stdout = this.Stdout();
            if (!stdout)
               return;
            stdout.innerHTML += '<br>' + stdout.innerHTML + '<br>';
            this.Scroll();
            this.NewStdout();
         }.bind(this._terminal);
         return;
      }
   }, this);
   if(temp)
      filenames.forEach(function(filename, i) {
         var entry = this._terminal.GetEntry(filename);
         if (!entry)
            this._terminal.Write('cat: ' + filename + ': No such file or directory');
         else if (entry.type == 'dir')
            this._terminal.Write('cat: ' + filename + ': Is a directory.');
         else
            this._terminal.Write(entry.contents);
         if (i != filenames.length - 1)
            this._terminal.Write('<br>');
      }, this);
      cb();
}
COMMANDS.cd = function(argv, cb) {
   var filename = this._terminal.ParseArgs(argv).filenames[0];
   if (!filename)
      filename = '~';
   var entry = this._terminal.GetEntry(filename);
   if (!entry)
      this._terminal.Write('bash: cd: ' + filename + ': No such file or directory');
   else if (entry.type != 'dir')
      this._terminal.Write('bash: cd: ' + filename + ': Not a directory.');
   else
      this._terminal.cwd = entry;
   cb();

   /* NEW CLARK */
   /*   
        var filename = this._terminal.parseArgs(argv).filenames[0],
        entry;

        if (!filename)
        filename = '~';
        entry = this._terminal.getEntry(filename);
        if (!entry)
        this._terminal.write('bash: cd: ' + filename + ': No such file or directory');
        else if (entry.type !== 'dir')
        this._terminal.write('bash: cd: ' + filename + ': Not a directory.');
        else
        this._terminal.cwd = entry;
        cb();
        */
}



COMMANDS.clear = function(argv, cb) {
   this._terminal.div.innerHTML = '';
   cb();
}

COMMANDS.echo = function(argv, cb) {
   var output = this._terminal.ParseArgs(argv).filenames;
   if (!output)
      {
         output = '<br>';
         this._terminal.Write(output);
      }
      else
         {
            output.forEach(function(filename, i) {
               if (!filename)
                  {
                     this._terminal.Write('No such file or directory');
                  }
                  else
                     {
                        this._terminal.Write(filename);
                        this._terminal.Write(' ');
                     }
            }, this);
         }
         cb();
}

COMMANDS.gimp = function(argv, cb) {
   var filename = this._terminal.ParseArgs(argv).filenames[0];
   if (!filename) {
      this._terminal.Write('gimp: please specify an image file.');
      cb();
      return;
   }
   var entry = this._terminal.GetEntry(filename);
   if (!entry || entry.type != 'img') {
      this._terminal.Write('gimp: file ' + filename + ' is not an image file.');
   } else {
      var temp = entry.contents.split("/");
      this._terminal.Write('<a class="fancybox" rel="group" href="' + temp[0]+ temp[1] +'/large/'+ temp[2] + '"><img src="' + temp[0] + temp[1] + '/' + temp[2] +'"></a>');
      var imgs = this._terminal.div.getElementsByTagName('img');
      imgs[imgs.length - 1].onload = function() {
         this.Scroll();
      }.bind(this._terminal);	
      if ('caption' in entry)
         this._terminal.Write('<br/>' + entry.caption);
   }
   cb();
}
/**
*
* This is a hidden command
*/
COMMANDS.grep = function(argv, cb) {

   var match = this._terminal.ParseArgs(argv).filenames[0];
   //read input from somewhere
   var n=input.match("Not");
   this._terminal.Write(n);
   //See! I told you it was in development!
   this._terminal.Write(
      ' yet implemented. In Development.<br>');
      this._terminal.Write('Commands are:<br>');
      for (c in this._terminal.commands) {
         if (this._terminal.commands.hasOwnProperty(c) && !c.startswith('_'))
            this._terminal.Write(c + '  ');
      }
      cb();
}

COMMANDS.help = function(argv, cb) {
   this._terminal.Write(
      'Don\'t let the command line intimidate you.<br>You can navigate either by clicking on anything that ' +
      '<a href="javascript:void(0)">underlines</a> when you put your mouse ' +
      'over it, or by typing commands in the terminal. Type the name of a ' +
      '<a href=\"https://www.google.com/#q=link\" target=\"_blank\" title=\"Link\"><span class=\"exec\">link</span></a></span> to view it. Use "cd" to change into a ' +	
      '<span class="dir"><a href=\"./gui/directory.html\" target=\"_blank\" title=\"directory\">directory</span></a></span>, or use "ls" to list the contents ' +
         'of that directory. The contents of a <span class="text">file</span> ' +
         'can be viewed using "cat". <span class="img">Images</span> are ' +
         'displayed using "gimp".<br><br>If there is a command you want to get ' +
         'out of, press Ctrl+C or Ctrl+D.<br><br>');
      this._terminal.Write('Commands are:<br>');
      for (var c in this._terminal.commands) {
         if (this._terminal.commands.hasOwnProperty(c) && !c.startswith('_'))
            {
               // We don't want all these commands being shown to the user
               if(c == 'startx' || c == 'emacs' || c == 'sublime' || c == 'exit' || c == 'show' || c == 'whoami' || c == 'pwd' || c == 'grep' || c == 'hacker')
                  {
            
                  }
                  else
                     {
                        this._terminal.Write(c + '  ');
                     }
            }
      }
      this._terminal.Write('<br><br>If you would like more info' +
                           ' about a command, type "man" and then the name of' +
                           ' the command.<br>');
      cb();
}
/*
COMMANDS.hacker =  function(argv, cb) {

      this._terminal.NewStdout();
      this._terminal.Scroll();
      cb();
      }
      */
COMMANDS.man =  function(argv, cb) {
   var validCommands = ["cat",
      "cd",
      "clear",
      "echo",
      "gimp",
      "help",
      "man",
      "mkdir",
      "ls",
      "passwd",
      "sudo",
      "login",
      "tree",
      "useradd",
      "vim"];

      function isInArray(validCommands, com) {
         return validCommands.indexOf(com.toLowerCase()) > -1;
      }
      var term = this._terminal;
      var filenames = this._terminal.ParseArgs(argv).filenames;
      if (!filenames.length) {
         this._terminal.Write('What manual page do you want? <br>');
         this._terminal.NewStdout();
         this._terminal.Scroll();
         cb();
      }
      else
         {
            filenames.forEach(function(filename, i) {
               newName = filename.replace(/\W/g, '');
               // Makes sure the command is one we have a man page for.
               if (this._terminal.commands.hasOwnProperty(newName) && !newName.startswith('_') && isInArray(validCommands, newName)){ 
                     //file exists
                     var txtFile = new XMLHttpRequest();
                     //do NOT edit this path!
                     txtFile.open("GET","json/manPages/"+newName, true);
                     txtFile.onreadystatechange = function() {
                        if (txtFile.readyState === 4) {  // Makes sure the document is ready to parse.
                           if (txtFile.status === 200) {  // Makes sure it's found the file.
                              //var allText = txtFile.responseText; 	
                              if(i!=0)
                                 term.Write('<br>');
                              term.Write(txtFile.responseText + '<br>');
                              term.DefaultReturnHandler();
                              term._Prompt();
                           }
                           else
                              {
                                 term.Write('No manual entry for ' + newName);
                                 //term.NewStdout();
                                 term.DefaultReturnHandler();
                                 term._Prompt();
                                 //return;
                              }
                        }

                     }
                     term.Scroll();
                     txtFile.send();
               }
               else
                  {

                     term.Write('No manual entry for ' + newName);
                     term.DefaultReturnHandler();
                     term._Prompt();
                  }

            }, this);
         }
      //this._terminal.NewStdout();
      //this._terminal.Scroll();
      cb();
}
/**
 * mkdir - create a new directory in the filesystem
 */
COMMANDS.mkdir = function(argv, cb){
   /*
    * Recursively searches the filesystem until we reach location to create the new directory.
    * @param fs is the current unmodified filesystem. 
    * @param loc loc is the location where we want to create the new directory.
    * @param new_obj is the directory we want to add to the filesystem
    */
   function myFunction(fs,loc,new_obj)
   { 
      //if array
      if(fs.constructor === Array)
         {
            //console.log('fs is array!');
            //console.log(fs);
            //console.log(fs.length);
            //this does not work, i think it is because it does not go all the way through all of the objects
            //length is reported at 8 and real length is 10.
            //loop through objects
            for (var i=0; i<fs.length; i++) {
               //  console.log(fs[i].name);
               //console.log(fs[i].type);
               handleStuff(fs[i],loc,new_obj);
            }
            /*   if(notFound)
                 {
                 myFunction(fs[i]."contents"],loc,new_obj);
                 }*/
         }
         else
            {
               //console.log('fs is not array!');
               handleStuff(fs,loc,new_obj);
            }
            //else not array or finished loop
            // else
            //{
            // }
   }
   function handleStuff(fs,current_loc,new_obj)
   {
      //console.log("name we are searching for");
      //console.log(current_loc[0]);
      //console.log("name of current directory");
      //console.log(fs.name);
      if( (fs.type == "dir") && (fs.name == current_loc[0]))
         {
            fs["contents"].push(new_obj);
            // console.log("success");
            //  console.log(fs);
         }
         else if (fs.type == "dir")
            {
               myFunction(fs["contents"],current_loc,new_obj);

            }

   }
   var dirName = this._terminal.ParseArgs(argv).filenames;
   // The user must specify the name of the directory they want to create
   if (!dirName.length) {
      this._terminal.Write('usage: mkdir [-pv] [-m mode] directory ...<br>');
      this._terminal.NewStdout();
      this._terminal.Scroll();
      cb();
   }
   else
      {
         //get our current location
         var loc = this._terminal.GetCWD();

         loc = new String(/[^/]*$/.exec(loc)[0]);
         //this is the current location of where the user is in the directory tree
         loc=[loc];
         //console.log('loc');
         //console.log(loc);

         //get the JSON
         var jsonStr = this._terminal.GetFS('/projects/terminal/json/filesystem.json', function() {                                    
            cb();                                                             
         }.bind(this._terminal));   
      }
      //create new object
      var new_obj = {"name": dirName[0],"type": "dir","description":"","contents":[]};
      //call the function
      //console.log('this._terminal.fs');
      //console.log(this._terminal.fs);
      //myFunction(this._terminal.fs,JSON.stringify(loc),new_obj);
      myFunction(this._terminal.fs,loc,new_obj);

      // write (see below) 
      //pass file or string to loadFS
      // create a new JSON file or string with the appropriate directory added

      //Write new directory to JSON in alphabetically correct spot
      //this will probably be helpful later on
      //https://stackoverflow.com/questions/6213012/proper-way-to-create-json-data-with-php-mysql
      //it matters where we put the new directory


      //   parse the new json
      //   show user the new filesystem
      //   delete json file when user leaves site
      //figure out where the user create the directory

      this._terminal.LoadFSFromString(this._terminal.fs, function() {                                    
         this.cwd = this.fs;                                                           
         cb();                                                                         
      }.bind(this._terminal));   
}

/**
 * login - allows a user to login to their account
 *
 */
COMMANDS.login = function(argv, cb) {

   var term = this._terminal;
   var tern;
   var name = this._terminal.ParseArgs(argv).filenames;
   if(!name.length)
      {        
         this._terminal.ReturnHandler = function() {
            var username = term.Stdout().innerHTML;
            if (username)
               {
                  name[0] = username; 
                  term.config.username = username;
               }      
               term.Write('<br>Password: ');
               term.Scroll()
               //term.Write('<span class = "hidden">');
               passwordFlag=true;
               document.getElementById("jsterm_id").parentNode.style.marginBottom="20px";
               //term.Scroll();
               term.ReturnHandler = function() { 
                  //term.Write('</span>');
                  passwordFlag=false; 
                  passwords.push(words);
                  words = "";
                  if(term.config.username =="sunjay")
                     {

                        term.Init(CONFIG, 'json/filesystem.json', COMMANDS, function() {
                           term.Enqueue('cat README');
                           if(checkCookie() == false)
                              {
                                 term.Enqueue('help');

                                 term.Enqueue('cd projects');
                                 term.Enqueue('ls -l');
                                 term.Enqueue('cd ..');
                              }
                              term.Enqueue('tree');
                              term.Enqueue('ls');
                              term.Begin();
                        });
                     }
                     else
                        {
                           term.Init(CONFIG, 'json/anonFilesystem.json', COMMANDS, function() {
                              term.Enqueue('cat README');
                              if(checkCookie() == false)
                                 {
                                    term.Enqueue('help');
                                 }
                                 term.Enqueue('tree');
                                 term.Enqueue('ls');
                                 term.Begin();
                           });
                        }
               }
         }.bind(tern);
         this._terminal.Write('Username: ');
         this._terminal.NewStdout();
         this._terminal.Scroll();        
      }
      else
         {

            term.ReturnHandler = function() {
               if(term.config.username =="sunjay")
                  {

                     term.Init(CONFIG, 'json/filesystem.json', COMMANDS, function() {
                        passwordFlag=false;
                        passwords.push(words);
                        words = "";
                        term.Enqueue('cat README');
                        //if you have been here in the passed 30 mins, don't show some stuff
                        if(checkCookie()==false)
                           {
                              term.Enqueue('help');
                              term.Enqueue('cd projects');
                              term.Enqueue('ls -l');
                              term.Enqueue('cd ..');
                           }
                           term.Enqueue('tree');
                           term.Enqueue('ls');
                           term.Begin();
                     });
                  }
                  else
                     {
                        term.Init(CONFIG, 'json/anonFilesystem.json', COMMANDS, function() {
                           passwordFlag=false;
                           passwords.push(words);
                           words = "";
                           term.Enqueue('cat README');
                           term.Enqueue('help');
                           term.Enqueue('tree');
                           term.Enqueue('ls');
                           term.Begin();
                        });
                     }
            }.bind(tern);
            term.config.username = name[0];
            term.Write('Password: ');        
            //term.Write('<span class = "hidden">');
            passwordFlag=true;
            term.NewStdout();
            term.Scroll();
            term.config.username = name[0];
            //this is causing problems
            // term.ReturnHandler = function() {
            // }.bind(term);
         }
}
/**
 * ls - show the contents of a directory
 *
 */
COMMANDS.ls = function(argv, cb) {
   var result = this._terminal.ParseArgs(argv);
   var args = result.args;
   var filename = result.filenames[0];
   var entry = filename ? this._terminal.GetEntry(filename) : this._terminal.cwd;
   var WriteEntry = function (e, str) {
      this.WriteLink(e, str);
      if (args.indexOf('l') > -1) {
         if ('description' in e)
            this.Write(' - ' + e.description);
         this.Write('<br>');
      } else {
         this.Write('  ');
      }
   }.bind(this._terminal);

   if (!entry)
      this._terminal.Write('ls: cannot access ' + filename + ': No such file or directory');
   else if (entry.type == 'dir') {
      var dirStr = this._terminal.DirString(entry);
      for (var i in entry.contents) {
         var e = entry.contents[i];
         if (args.indexOf('a') > -1 || e.name[0] != '.')
            WriteEntry(e, dirStr + '/' + e.name);
      }
   } else {
      WriteEntry(entry, filename);
   }
   cb();
}

/* NEW CLARK */

/*
   COMMANDS.ls = function(argv, cb) {
   var result = this._terminal.parseArgs(argv),
   args = result.args,
   filename = result.filenames[0],
   entry = filename ? this._terminal.getEntry(filename) : this._terminal.cwd,
   maxLen = 0,
   writeEntry;

   writeEntry = function(e, str) {
   this.writeLink(e, str);
   if (args.indexOf('l') > -1) {
   if ('description' in e)
   this.write(' - ' + e.description);
   this.write('<br>');
   } else {
// Make all entries the same width like real ls. End with a normal
// space so the line breaks only after entries.
this.write(Array(maxLen - e.name.length + 2).join('&nbsp') + ' ');
}
}.bind(this._terminal);

if (!entry)
this._terminal.write('ls: cannot access ' + filename + ': No such file or directory');
else if (entry.type === 'dir') {
var dirStr = this._terminal.dirString(entry);
maxLen = entry.contents.reduce(function(prev, cur) {
return Math.max(prev, cur.name.length);
}, 0);

for (var i in entry.contents) {
var e = entry.contents[i];
if (args.indexOf('a') > -1 || e.name[0] !== '.')
writeEntry(e, dirStr + '/' + e.name);
}
} else {
maxLen = entry.name.length;
writeEntry(entry, filename);
}
cb();
}*/

/**
* rm - deletes a file or directory from the user's filesystem
*/
COMMANDS.rm = function(argv, cb){

   var del_name = this._terminal.ParseArgs(argv).filenames;
   // The user must specify the name of the directory they want to create
   if (!del_name.length) 
      {
         this._terminal.Write('usage: rm [file or directory name] ...<br>');
         this._terminal.NewStdout();
         this._terminal.Scroll();
         cb();
      }
      else
         {
            //get our current location
            var loc = this._terminal.GetCWD();

            loc = new String(/[^/]*$/.exec(loc)[0]);
            //this is the current location of where the user is in the directory tree
            loc=[loc];
         }
         /*
            *
            * Find the name of the file to delete and remove it
            */
         function findAndRemove(fs,del_name)
         {

                  for (var i=0; i<fs.length; i++) 
                  {
                     if(fs[i].name == del_name[0])
                        {
                          //console.log("found!"); 
                           fs.splice(i, 1);

                        }
                     //  console.log(fs[i].name);
                     //console.log(fs[i].type);
                  }
         }
         /*
          * Recursively searches the filesystem until we reach location to create the new directory.
          * @param fs is the current unmodified filesystem. 
          * @param loc loc is the location where we want to create the new directory.
          * @param del_name is the name of the object we want to delete.
          */
         function myFunction(fs,loc,del_name)
         { 
            //if array
            if(fs.constructor === Array)
               {
                  //loop through objects
                  for (var i=0; i<fs.length; i++) 
                  {
                     //  console.log(fs[i].name);
                     //console.log(fs[i].type);
                     handleStuff(fs[i],loc,del_name);
                  }
               }
               else
                  {
                     //console.log('fs is not array!');
                     handleStuff(fs,loc,del_name);
                  }
         }
         function handleStuff(fs,current_loc,del_name)
         {
            if (fs.type == "dir" && fs.name != del_name[0])
            {
               myFunction(fs["contents"],current_loc,del_name);
            }
            if (fs.name == current_loc[0])
               {
                  //we need to find the object by the name and remove it
                  findAndRemove(fs["contents"],del_name);
               }
         } //close function
        
         myFunction(this._terminal.fs,loc,del_name);
      
      this._terminal.LoadFSFromString(this._terminal.fs, function() {                                    
         this.cwd = this.fs;                                                           
         cb();                                                                         
      }.bind(this._terminal));   
}

COMMANDS.passwd = function(argv, cb) {

   var term = this._terminal;
   var cheat = this;
   var tern;
   var username = this._terminal.ParseArgs(argv).filenames;

   if (!username.length) {
      this._terminal.Write('Which user do you want? <br>');
      this._terminal.NewStdout();
      this._terminal.Scroll();
      cb();
   }
   else if(username[0].length > 64 || username[0].length < 3 )
      {
         this._terminal.Write('Username must be between 3 and 64 characters. <br>');
         this._terminal.NewStdout();
         this._terminal.Scroll();
         cb();
      }
      else
         {
            //does username already exist
            $.ajax({
               type: "POST",
               url: "commands/addUser.php",
               data: {
                  username:username[0],
                  submit:true
               },  
               success: function(data) {
                  //already exists
                  if(data.indexOf("Already exists") > -1)
                     {
                        cheat._terminal.ReturnHandler = function() {
                           passwordFlag=false;
                           password = words;
                           words = "";
                           //this.Write('You entered: '+password);
                           // var current = term.Stdout().innerHTML;
                           // current = current.split(" ").pop(); 
                           //check if this password matches for the username

                           $.ajax({
                              type: "POST",
                              url: "projects/accounts/check.php",
                              data: {
                                 password:password,
                                 username:username[0],
                                 submit:true
                              },  
                              success: function(data) {
                                 if(data.indexOf("Yes") > -1)
                                    {
                                       //    alert("correct password");

                                       ChangePassword(password); 
                                       //this.write("In development.<br>");
                                       //this.write("passwd: password updated successfully");
                                       //this.scroll();
                                       //cb();
                                    }   
                                    else
                                       {

                                          //reprompt
                                          alert("Incorrect Password");
                                          // this.write("Error: Not added.");
                                          term.Scroll();
                                          cb();
                                          term.NewStdout();
                                       }   
                              },
                              error: function (jqXHR, textStatus, errorThrown){
                                 alert("error checking password");
                                 term.Scroll();
                                 cb();
                                 term.NewStdout();
                              }
                           });
                           //alert(current);
                        }
                        cheat._terminal.Write('(Current) UNIX password: ');
                        passwordFlag=true;
                        //just need the closing bracking to be somewhere else
                        //cheat._terminal.Write('<span class = "hidden">');
                        cheat._terminal.Scroll();
                        //cheat._terminal.WriteHidden();

                     }
                     //does not already exist
                     else if(data.indexOf("Yes") > -1)
                        {
                           ChangePassword(); 
                        }   
                        //error
                        else
                           {
                              alert("Unknown Error!");
                              //not sure how to output
                              //alert("TEST");
                           }   
               },
               error: function (jqXHR, textStatus, errorThrown){
                  //this._terminal.Write('<br>Fatal Error.');
                  alert(errorThrown);
                  //  this.Scroll();
                  //  cb();
               }
            });


            //alert("test is a test");
            /* else
               {
               if(username[0].length < 33)
               {
            //var stdout = this.Stdout();
            //if (!stdout)
            //return;
            this._terminal.Write('Changing password for '+username[0]+ '<br>');
            //if user already exists
            //in development
            // this._terminal.Write('(Current) UNIX password: ';
            //we assume you are doing this for a new brand new user
            this._terminal.Write('Enter new UNIX password: ');
            this._terminal.NewStdout();
            this._terminal.Scroll();
            //this._terminal.NewStdout();
            // this._terminal.Scroll();
            //this._terminal.NewStdout();

            this._terminal.returnHandler = function() {

            var password = term.Stdout().innerHTML;
            term.Stdout().innerHTML = '';
            //                  this._terminal.NewStdout();
            //                this._terminal.Scroll();
            //              cb();
            //    term.write(password);
            // if(password)
            //  {
            term.ReturnHandler = function() {
            term.write('Retype new UNIX password: ');
            var password1 = term.Stdout().innerHTML;
            if(password1.localeCompare( password) == 0 )
            {
            $.ajax({
type: "POST",
url: "commands/passwd.php",
data: {
password:password,
password1:password1,
username:filenames[0],
submit:true
},  
success: function(data) {
if(data.indexOf("Yes") > -1)
{
this.write("In development.<br>");
this.write("passwd: password updated successfully");
this.scroll();
cb();
}   
else
{
this.write("Error: Not added.");
this.scroll();
cb();
}   
},
error: function (jqXHR, textStatus, errorThrown){
this.Write("Error.");
this.Scroll();
cb();
}
});
}
else
{
this.Write("Passwords do not match.");
this.Scroll();
cb();
}
// term.scroll();
// term.newStdout();
}.bind(term);
return;
// }
}.bind(this._terminal);
return; 
}
else
{
   term.Write("Error: Too long.");
   cb();
}
//close else statement for there being args for passwd
}*/
            var ChangePassword = function(old_password)
            {

               /* WE KNOW THE BELOW WORKS */
               cheat._terminal.ReturnHandler = function() {
                  passwordFlag=false;
                  var password = words;
                  // term.Write('You entered: '+password);
                  words = "";
                  //old
                  // var password = term.Stdout().innerHTML;
                  // password = password.split(" ").pop(); 


                  //term.Write('<br>');
                  //term.Write('You entered: '+password);
                  // term.Write('<br>');
                  term.Scroll();
                  //  cb();
                  term.NewStdout();
                  term.Write('<br>Password: ');
                  passwordFlag=true;
                  //term.Write('<span class = "hidden">');
                  term.Scroll();
                  // cb();
                  //document.getElementById("test").style.color="black";
                  //term.Scroll();
                  term.ReturnHandler = function() { 
                     passwordFlag=false;
                     password1 = words;
                     words = "";
                     //term.Write('You entered: '+password1);
                     //  password1 = this.Stdout().innerHTML;
                     // var password1 = password1.split(" ").pop(); 
                     if(password1.localeCompare(password) == 0 )
                        {
                           //ensure password has an uppercase and lowercase letter and a numeric character 
                           if(password.match(/[a-z]/) && password.match(/[A-Z]/) && password.match(/\d+/g))
                              {
                                 $.ajax({
                                    type: "POST",
                                    url: "commands/passwd.php",
                                    data: {
                                       old_password:old_password,
                                       password:password,
                                       password1:password1,
                                       username:username[0],
                                       submit:true
                                    },  
                                    success: function(data) {
                                       if(data.indexOf("Yes") > -1)
                                          {
                                             this.Write("<br");
                                             this.Write(data);
                                             //         alert(data);
                                             //this.Write("<br>passwd: password updated successfully <br> ");
                                             // this._terminal.Write(data);
                                             //not sure how to output
                                             //tern.Write(data);
                                             // this.scroll();
                                             // cb();
                                          }   
                                          else
                                             {
                                                //this._terminal.Write(data);
                                                //not sure how to output
                                                //          alert(data);
                                                this.Write("<br");
                                                this.Write(data);

                                                //           <br>Passwords must contain atleast one uppercase and one lowercase letter and one numeric character. <br");
                                                //term.Write(data);
                                                // tern.Write(data);
                                                //this.Write("<br>Error: Not added. <br> ");
                                                //this.scroll();
                                                //cb();
                                             }   
                                    },
                                    error: function (jqXHR, textStatus, errorThrown){
                                       alert(errorThrown);
                                       //this._terminal.Write('<br>Fatal Error.');
                                       //alert(errorThrown);
                                    }
                                 });
                              }
                              else
                                 {
                                    this.Write("<br>Passwords must contain atleast one uppercase and one lowercase letter and one numeric character. <br");
                                 }
                        }
                        else
                           {
                              this.Write("<br>Passwords do not match. <br>");
                              //Most users probably don't want to see their password printed to screen
                              //this.Write("password: "+password+"<br>password conf: "+password1);
                              this.Write("<br>");
                              this.Scroll();
                              cb();
                           }
                           this.NewStdout();
                           this.Scroll();        
                           cb();
                           // this.NewStdout();
                  }.bind(term);
               }.bind(tern);

               cheat._terminal.Scroll();
               cheat._terminal.Write('Changing password for '+username[0]+ '<br>');
               //    alert("this is a final test");
               //if user already exists
               //in development
               // this._terminal.Write('(Current) UNIX password: ';
               //we assume you are doing this for a new brand new user
               cheat._terminal.Scroll();
               cheat._terminal.Write('Enter new UNIX password: ');
               cheat._terminal.Scroll();
               passwordFlag=true;
            }
         }
         // }
         //  this._terminal.NewStdout();
         //  this._terminal.Scroll();        
         //  cb();
         //alert("this is outside everything");
}
COMMANDS.sudo = function(argv, cb) {

   var term = this._terminal;
   var filenames = this._terminal.ParseArgs(argv).filenames;
   if (!filenames.length) 
      {
         this._terminal.Write('usage: sudo -h | -K | -k | -L | -V <br>usage: sudo -v [-AknS] [-p prompt] <br>');
         this._terminal.NewStdout();
         this._terminal.Scroll();
         cb();
      }
      else if (filenames[0] =='useradd')
         {
            if(filenames[1])
               {
                  if(filenames[1].length < 33 && filenames[1].length > 2)
                     {
                        //actually add the user to the database
                        $.ajax({
                           type: "POST",
                           url: "commands/addUser.php",
                           data: {
                              username:filenames[1],
                              submit:true
                           },  
                           success: function(data) {
                              if (data === "Yes") {
                                 createCookie("username",filenames[1],100);
                                 //window.alert("success");
                                 //this._terminal.Write("Yes");
                                 term.Write(filenames[1] + ' added.');
                                 cb();
                                 term.Scroll();
                                 cb();
                              }   
                              else {
                                 //window.alert(data);
                                 term.Write("Error: "+ filenames[1] + ' not added.');
                                 term._terminal.Scroll();
                                 cb();
                              }   
                           },
                           error: function (jqXHR, textStatus, errorThrown)
                           {
                              term.Write("Error.");
                              term._terminal.Scroll();
                              cb();
                              // window.alert("error");

                           }
                        });
                     }
                     else
                        {
                           term.Write("Error: Usernames may only be up to 32 characters long");
                           cb();
                           this._terminal.NewStdout();
                           this._terminal.Scroll();
                        }
               }
               else
                  {
                     term.Write("Usage: useradd [options] LOGIN");
                     cb();
                     this._terminal.NewStdout();
                     this._terminal.Scroll();
                  }
         }	
         else
            {
               var count = 0;
               this._terminal.ReturnHandler = function() {
                  if (++count < 3) {
                     this.Write('<br/>Sorry, try again.<br/>');
                     this.Write('[sudo] password for ' + this.config.username + ': ');
                     passwordFlag=true;
                     this.Scroll();
                  } else {
                     this.Write('<br/>sudo: 3 incorrect password attempts');
                     cb();
                  }
               }.bind(this._terminal);
               this._terminal.Write('[sudo] password for ' + this._terminal.config.username + ': ');
               passwordFlag=true;
               this._terminal.Scroll();
            }
}

/**
 * show - Loads a new JSON without a refresh or new div.
 * This is a hidden command. It will not be displayed by the 'help' command.
 */
COMMANDS.show = function(argv, cb) {
   //this._terminal.LoadFS(,cb);
   //this._terminal.Begin();
   var filename = this._terminal.ParseArgs(argv).filenames[0];                      
   this._terminal.LoadFS('/projects/terminal/json/new_filesystem.json', function() {                                    
      this.cwd = this.fs;                                                           
      cb();                                                                         
   }.bind(this._terminal));   
      this._terminal.NewStdout();
      this._terminal.Scroll();
      cb();
}

/**
 * whoami -  Displays the username to the terminal.
 * This is a hidden command. It will not be displayed by the 'help' command.
 */
COMMANDS.whoami = function(argv, cb) {

   //var output = this._terminal.ParseArgs(argv).filenames;
   this._terminal.Write(this._terminal.config.username);
   this._terminal.Write('<br>');
   this._terminal.Scroll();
   cb();
}
/**
 * exit - Closes the windows.
 * This is a hidden command. It will not be displayed by the 'help' command.
 */
COMMANDS.exit = function(argv, cb) {
   window.close(); 
}
/**
 * Startx - Directs to the Graphical User Interface.
 * This is a hidden command. It will not be displayed by the 'help' command.
 */
COMMANDS.startx = function(argv, cb) {
   window.location = "https://www.sunjaydhama.com/new/gui/index.html";
   this._terminal.NewStdout();
   this._terminal.Scroll();
   cb();
}

/**
 * Tree - Print the directory structure
 *
 */

COMMANDS.tree = function(argv, cb) {
   var term = this._terminal;
   function Tree(dir, level) {
      dir.contents.forEach(function(entry) {
         if (entry.name.startswith('.'))
            return;
         var str = '';
         for (var i = 0; i < level; i++)
         str += '|  ';
         str += '|&mdash;&mdash;';
         term.Write(str);
         term.WriteLink(entry, term.DirString(dir) + '/' + entry.name);
         term.Write('<br>');
         if (entry.type == 'dir')
            Tree(entry, level + 1);
      });
   };
   var home = this._terminal.GetEntry('~');
   this._terminal.WriteLink(home, '~');
   this._terminal.Write('<br>');
   Tree(home, 0);
   cb();
}
/**
 *
 *
 */
COMMANDS.useradd = function(argv, cb)
{
   var filenames = this._terminal.ParseArgs(argv).filenames;
   if (!filenames.length || filenames.length > 1) {
      this._terminal.Write('Usage: useradd [options] LOGIN <br>');
   }
   else
      {
         this._terminal.Write('useradd: cannot lock /etc/passwd; try again later.');
         this._terminal.Write('(Hint: Try with sudo)');
      }
      this._terminal.NewStdout();
      this._terminal.Scroll();
      cb();
}
/**
 * vim - Directs the user to a vim text editor, where they can edit, save, and load a file of their choosing. 
 * 
 */
COMMANDS.vim = function(argv, cb) {

   var name = this._terminal.ParseArgs(argv).filenames;

   if (!name.length) {
      //this doesn't work
      name = ["VE0u6HQvH4YaPQMxRPWkZ"]; 

   }
   var location1 ='https://www.sunjaydhama.com/projects/vim/index.php?name=';
   var temp = location1 + name[0];
   window.open(temp,'_blank');
   this._terminal.NewStdout();
   this._terminal.Scroll();
   cb();
}
/**
 * Emacs - Directs to the user to an Emacs editor.
 * This is a hidden command. It will not be displayed by the 'help' command.
 */

COMMANDS.emacs = function(argv, cb) {

   //var name = this._terminal.ParseArgs(argv).filenames;
   loc ='https://www.sunjaydhama.com/projects/vim/emacs.html';
   window.open(loc,'_blank');
   this._terminal.NewStdout();
   this._terminal.Scroll();
   cb();
}
/**
 * Sublime - Directs to the user to an Sublime editor.
 * This is a hidden command. It will not be displayed by the 'help' command.
 */
COMMANDS.sublime = function(argv, cb) {

   //var name = this._terminal.ParseArgs(argv).filenames;
   loc ='https://www.sunjaydhama.com/projects/vim/sublime.html';
   window.open(loc,'_blank');
   this._terminal.NewStdout();
   this._terminal.Scroll();
   cb();
}

/**
 * pwd - Show the current directory. 
 * This is a hidden command. It will not be displayed by the 'help' command.
 */
COMMANDS.pwd = function(argv, cb) {
   this._terminal.Write(this._terminal.GetCWD());
   cb();
}
