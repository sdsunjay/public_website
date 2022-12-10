// Copyright 2013 Sunjay Dhama
// with permission from Clark Duvall
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
/*
COMMANDS.man = function(argv, cb) {



	var commandName = this._terminal.ParseArgs(argv).filenames[0];

	var output='';


	if (commandName=='jk')
	{
		filename = '/commands/cd.txt';


			new BufferedReader (fileName, { encoding: "utf8" })
			.on ("error", function (error){
			console.log ("error: " + error);
			})
			.on ("line", function (line){
			console.log ("line: " + line);
			this._terminal.Write(line);;
			})
			.on ("end", function (){
			console.log ("EOF");
			})
			.read ();

		// Read the file and print its contents.
		var fs = require('fs');
		fs.readFile(filename, 'utf8', function(err, data) {
				if (err) throw err;
				console.log('OK: ' + filename);
				console.log(data)
				});
		this._terminal.Write(data);

		this.get(fileName, function(data) {
		  output = data;
		  });
		  this._terminal.Write(output);
			fh = fopen(fileName, 0); // Open the file for reading.
			if(fh!=-1) // Check if the file has been successfully opened.
			{
			length = flength(fh); // Get the length of the file.
			str = fread(fh, length); // Read in the entire file.
			fclose(fh); // Close the file.

		// Display the contents of the file.
		//write(str);
		this._terminal.Write('bash: cd: ' + commandName + ': str');
		this._terminal.Write(str);
		}
	}   
	else
	{

		this._terminal.Write(
				'Not yet implemented. In Development <br>');
		this._terminal.Write('Commands are:<br>');
		for (c in this._terminal.commands) {
			if (this._terminal.commands.hasOwnProperty(c) && !c.startswith('_'))
				this._terminal.Write(c + '  ');
		}
	}
	cb();
}*/

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
           //this._terminal.Write('</a>');
           if ('caption' in entry)
              this._terminal.Write('<br/>' + entry.caption);
        }
        cb();
}

COMMANDS.grep = function(argv, cb) {

   var match = this._terminal.ParseArgs(argv).filenames[0];
   //read input from somewhere
   var input= "Not yet"
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
				this._terminal.Write(c + '  ');
		}
	//	this._terminal.Write('<br><br>If you would like more info' +
	//			' about a command, type "man" and then the name of' +
	//			' the command.<br>');
		cb();
}
/*
   COMMANDS.test = function(argv, cb) {
   var term = this._terminal;
   term.div.innerHTML = '';
   term.Init(CONFIG, '/json/anonFilesystem.json', COMMANDS, function() {
   term.Enqueue('login');
   term.Enqueue('sunjay');
   term.Enqueue('********');
   term.Enqueue('cat README');
   term.Enqueue('help');
   term.Enqueue('ls -l');
   term.Enqueue('tree');
   term.Enqueue('ls');
   term.Begin();
   });
   }*/

COMMANDS.man =  function(argv, cb) {
   var term = this._terminal;
   var filenames = this._terminal.ParseArgs(argv).filenames;
   if (!filenames.length) {
      this._terminal.Write('What manual page do you want? <br>');
      this._terminal.NewStdout();
      this._terminal.Scroll();
      cb();
      /*	this._terminal.ReturnHandler = function() {
                var stdout = this.Stdout();
                stdout.innerHTML = '<br> What manual page do you want? <br>';
                this.Scroll();
      //this.NewStdout();
      return;
      }.bind(this._terminal);*/
      //return;
   }

   else
   {
      filenames.forEach(function(filename, i) {
	filename = filename.replace(/\W/g, '');
            var txtFile = new XMLHttpRequest();
            txtFile.open("GET","/usr/share/nginx/html/json/manPages/"+filename, true);
            txtFile.onreadystatechange = function() {
            if (txtFile.readyState === 4) {  // Makes sure the document is ready to parse.
            if (txtFile.status === 200) {  // Makes sure it's found the file.
            //var allText = txtFile.responseText; 	
            if(i!=0)
            term.Write('<br>');
            term.Write(txtFile.responseText + '<br>');
            //term.NewStdout();
            term.DefaultReturnHandler();
            term._Prompt();
            //txtFile.send();
            //return;
            }
            else
            {
            term.Write('No manual entry for ' + filename);
            //term.NewStdout();
            term.DefaultReturnHandler();
            term._Prompt();
            //return;
            }
            }

            }
            term.Scroll();
            txtFile.send();

            //if (i != filenames.length - 1)
            //	this._terminal.Write('<br>');
      }, this);
   }
   //cb();
}

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
      for (i in entry.contents) {
         var e = entry.contents[i];
         if (args.indexOf('a') > -1 || e.name[0] != '.')
            WriteEntry(e, dirStr + '/' + e.name);
      }
   } else {
      WriteEntry(entry, filename);
   }
   cb();
}
//plans to implement this in the future
//the filesystem.json would need to be changed and then re-parsed
//it'd be tricky, but doable.
/*
   COMMANDS.mkdir = function(argv, sb){

   this._terminal.AddDirs("Im, parentDir);
   }*/

COMMANDS.sudo = function(argv, cb) {

   var term = this._terminal;
   var filenames = this._terminal.ParseArgs(argv).filenames;
   if (!filenames.length) {
      this._terminal.Write('usage: sudo -h | -K | -k | -L | -V <br>usage: sudo -v [-AknS] [-p prompt] <br>usage: sudo -l[l] [-AknS] [-g groupname|#gid] [-p prompt] [-U username] [-u username|#uid] [-g groupname|#gid] [command] <br>usage: sudo [-AbEHknPS] [-r role] [-t type] [-C fd] [-g groupname|#gid] [-p prompt] [-u username|#uid] [-g groupname|#gid] [VAR=value] [-i|-s] [<command>] <br> usage: sudo -e [-AknS] [-r role] [-t type] [-C fd] [-g groupname|#gid] [-p prompt] [-u username|#uid] file ...');
      this._terminal.NewStdout();
      this._terminal.Scroll();
      cb();
   }
   else if (filenames[0]=='login')
   {
      if(filenames[1])
      {
         term.div.innerHTML = '';
         if(filenames[1]=="sunjay")
         {
            term.Init(CONFIG, '/usr/share/nginx/html/json/mobile_filesystem.json', COMMANDS, function() {
                  term.Enqueue('login');
                  term.Enqueue('sunjay');
                  term.Enqueue('********');
                  term.Enqueue('cat README');
                  term.Enqueue('help');
                  // term.Enqueue('cd Projects');
                  //term.Enqueue('ls -l');
                  //term.Enqueue('cd ..');
                  term.Enqueue('tree');
                  term.Enqueue('ls');
                  term.Begin();
                  });
         }
         else
         {
            term.Init(CONFIG, '/usr/share/nginx/html/json/anonFilesystem.json', COMMANDS, function() {
                  term.Enqueue('login');
                  term.Enqueue(filenames[1]);
                  term.Enqueue('********');
                  //term.Enqueue('cat README');
                  term.Enqueue('help');
                  // term.Enqueue('ls -l');
                  term.Enqueue('tree');
                  term.Enqueue('ls');
                  term.Begin();
                  });
         }
      }
   }
   else if (filenames[0] =='useradd')
   {
      if(filenames[1])
      {
         term.Write(filenames[1] + ' added. ');
         cb();
      }
   }	
   else
   {
      var count = 0;
      this._terminal.ReturnHandler = function() {
         if (++count < 3) {
            this.Write('<br/>Sorry, try again.<br/>');
            this.Write('[sudo] password for ' + this.config.username + ': ');
            this.Scroll();
         } else {
            this.Write('<br/>sudo: 3 incorrect password attempts');
            cb();
         }
      }.bind(this._terminal);
      this._terminal.Write('[sudo] password for ' + this._terminal.config.username + ': ');
      this._terminal.Scroll();
   }
}

COMMANDS.login = function(argv, cb) {

   var term = this._terminal;
   var name = this._terminal.ParseArgs(argv).filenames;
   if(!name.length)
   {
      this._terminal.ReturnHandler = function() {
         this.Scroll();
         var username = this.Stdout().innerHTML;
         if (username)
         {
            name[0] = username; 
            this.config.username = username;
         }      
         this.Write('<br>Password: ');
         this.Scroll();
         this.ReturnHandler = function() { cb(); }
      }.bind(this._terminal);
      this._terminal.Write('Username: ');
      this._terminal.NewStdout();
      //this._terminal.Scroll();
   }
   else
   {

      term.ReturnHandler = function() {
      }.bind(term);
      term.config.username = name[0];
      term.Write('Password: ');
      term.NewStdout();
      term.Scroll();
      term.ReturnHandler = function() { 
         term.div.innerHTML = '';
         if(name[0]=="sunjay")
         {
            term.Init(CONFIG, '/usr/share/nginx/html/json/filesystem.json', COMMANDS, function() {
                  term.Enqueue('cat README');
                  term.Enqueue('help');
                  term.Enqueue('cd Projects');
                  term.Enqueue('ls -l');
                  term.Enqueue('cd ..');
                  term.Enqueue('tree');
                  term.Enqueue('ls');
                  term.Begin();
                  });
         }
         else
         {
            term.Init(CONFIG, '/usr/share/nginx/html/json/anonFilesystem.json', COMMANDS, function() {
                  term.Enqueue('login');
                  term.Enqueue(name[0]);
                  term.Enqueue('********');
                  //term.Enqueue('cat README');
                  term.Enqueue('help');
                  // term.Enqueue('ls -l');
                  term.Enqueue('tree');
                  term.Enqueue('ls');
                  term.Begin();
                  });
         }
      }
   }
}
COMMANDS.startx = function(argv, cb) {
   window.location = "https://www.sunjaydhama.com/gui/mobile-gui.html";
   this._terminal.NewStdout();
   this._terminal.Scroll();
   cb();
}

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
COMMANDS.vim = function(argv, cb) {
   var name = this._terminal.ParseArgs(argv).filenames;
   var location1 ='https://www.sunjaydhama.com/projects/vim/index.php?name=';
   var temp = location1 + name[0];
   window.open(temp,'_blank');
   this._terminal.NewStdout();
   this._terminal.Scroll();
   cb();
}
//print stars instead of the letters
/*process.stdin.on('data', function (char) {
  char = char + ""

  switch (char) {
  case "\n": case "\r": case "\u0004":
// They've finished typing their password
tty.setRawMode(false)
console.log("\nyou entered: "+password)
stdin.pause()
break
case "\u0003":
// Ctrl C
console.log('Cancelled')
process.exit()
break
default:
// More passsword characters
process.stdout.write('*')
password += char
break
}*/
//this.Write('<br>Type \'sudo login <name>\' for more excitement');
