// Copyright 2015 Sunjay Dhama with permission from Clark Duvall
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
var words = "";
var passwords=[];
var passwordFlag=false;
var firstFlag = false;
(function() {
   if (typeof Object.create !== 'function') {
      Object.create = function (o) {
         function F() {}
         F.prototype = o;
         return new F();
      };
   }

   if (!Function.prototype.bind) {
      Function.prototype.bind = function (oThis) {
         if (typeof this !== "function") {
            // closest thing possible to the ECMAScript 5 internal IsCallable function
            throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
         }

         var aArgs = Array.prototype.slice.call(arguments, 1),
            fToBind = this,
            fNOP = function () {},
            fBound = function () {
               return fToBind.apply(this instanceof fNOP && oThis
                                      ? this
                                      : oThis,
                                    aArgs.concat(Array.prototype.slice.call(arguments)));
            };

         fNOP.prototype = this.prototype;
         fBound.prototype = new fNOP();

         return fBound;
      };
   }

   function _Ajax(name, cb) {
      var ajax = new XMLHttpRequest();
      //if you set this to false, (original) show() works
      ajax.open("GET",name, true);
      ajax.onreadystatechange = function() {
         if (ajax.readyState == 4) {  // Makes sure the document is ready to parse.
            if (ajax.status === 200) {  // Makes sure it's found the file.
                        cb(ajax.responseText);
            }
         }
         /**Specifically so firefox does not complain **/
         //var $this = $(this);
         //e.preventDefault();
         /****************/
      };
         ajax.send();
   };
   var Terminal = {
      Init: function(config, fs, commands, cb) {
         this._queue = [];
         // this._blinker;
         this._history = [];
         this._historyIndex = -1;
         //document.getElementById("jsterm").style.color = "yellow";
         //hack by Sunjay to add 'login'
         this._history.unshift("login");
         try 
         {
            //another hack to remove blink from end
            if(this._blinker)
               this._blinker.parentNode.removeChild(this._blinker);
         }
         catch(e)
         {
         }
         this.LoadConfig(config);
         if (commands)
            this.LoadCommands(commands);
         if (fs)
            this.LoadFS(fs, cb);
         else if (cb)
            cb();
      },
      GetFS: function(name,cb){
         _Ajax(name, function(responseText) {
            return JSON.parse(responseText);
         }.bind(this));
      },
      LoadFS: function(name, cb) {
         _Ajax(name, function(responseText) {
            this.fs = JSON.parse(responseText);
            this._AddDirs(this.fs, this.fs);
            if (cb) cb();
         }.bind(this));
      },
      LoadFSFromString: function(responseText,cb) {
        // _Ajax(name, function(responseText) {
      //      this.fs = JSON.parse(responseText);
            this._AddDirs(this.fs, this.fs);
            if (cb) cb();
         //}.bind(this));
      },

      LoadCommands: function(commands) {
         this.commands = commands;
         this.commands._terminal = this;
      },

      LoadConfig: function(config) {
         this.config = config;
      },
      Begin: function(element) {
         //  var e = document.body;
         // e.parentNode.removeChild(e);
         //  document.body.parentNode.appendChild(document.body);
         var parentElement = element || document.body;
         this.div = document.createElement('div');
         this.div.classList.add('jsterm');
         this.div.id ="jsterm_id";
         //document.getElementById("jsterm_id").style.color = "blue";
         parentElement.appendChild(this.div);
         if(firstFlag)
            {
               this.div.style.marginBottom="0px";
            }
            //this.div.style.color="blue";

            /*window.onkeydown = function(e) {
              var key = (e.which) ? e.which : e.keyCode;
              if (key == 8 || key == 9 || key == 13 || key == 46 || key == 38 ||
              key == 40 || key == 222 || key == 221 || key == 219 || e.ctrlKey || e.altKey )
              e.preventDefault();
              this._HandleSpecialKey(key, e);
              }.bind(this);*/
         window.onkeydown = function(e) {
            var key = (e.which) ? e.which : e.keyCode;
            if (key == 8 || key == 9 || key == 13 || key == 46 || key == 38 ||
                  key == 40 || e.ctrlKey)
               e.preventDefault();
            this._HandleSpecialKey(key, e);
         }.bind(this);
         window.onkeypress = function(e) {
            this._TypeKey((e.which) ? e.which : e.keyCode);
         }.bind(this);

         this.ReturnHandler = this._Execute;
         this.cwd = this.fs;
         this._Prompt();
         this._ToggleBlinker(600);
         this._Dequeue();
             },

GetCWD: function() {
           return this.DirString(this.cwd);
        },

DirString: function(d) {
              var dir = d;
              var dirStr = '';
              while (this._DirNamed('..', dir.contents).contents !== dir.contents) {
                 dirStr = '/' + dir.name + dirStr;
                 dir = this._DirNamed('..', dir.contents);
              }
              return '~' + dirStr;
           },

GetEntry: function(path) {
             if (!path)
                return null;
             path = path.replace(/^\s+/, '').replace(/\s+$/, '');
             if (!path.length)
                return null;
             var entry = this.cwd;
             if (path[0] == '~') {
                entry = this.fs;
                path = path.substring(1, path.length);
             }
             var parts = path.split('/').filter(function(x) {return x;});
             for (var i in parts) {
                entry = this._DirNamed(parts[i], entry.contents);
                if (!entry)
                   return null;
             }
             return entry;
          },

Write: function(text) {
          var output = this.Stdout();
          if (!output)
             return;
          output.innerHTML += text;
       },

DefaultReturnHandler: function() {
                         this.ReturnHandler = this._Execute;
                      },

TypeCommand: function(command, cb) {
                var that = this;
                (function type(i) {
                 if (i == command.length) {
                 that._HandleSpecialKey(13);
                 if (cb) cb();
                 } else {
                 that._TypeKey(command.charCodeAt(i));
                 setTimeout(function() {
                    type(i + 1);
                    }, 100);
                 }
                 })(0);
             },

TabComplete: function(text) {
                var parts = text.replace(/^\s+/, '').split(' ');
                if (!parts.length)
                   return [];
                var matches = [];
                if (parts.length == 1) {
                   // TODO: Combine with below.
                   var pathParts = parts[0].replace(/[\/]+/, '/').split('/');
                   var last = pathParts.pop();
                   var dir = (pathParts.length > 0) ? this.GetEntry(pathParts.join('/')) : this.cwd;
                   if (dir) {
                      for (var i in dir.contents) {
                         var n = dir.contents[i].name;
                         if (n.startswith(last) && !n.startswith('.') && n != last) {
                            if (dir.contents[i].type == 'exec')
                               matches.push(n + ' ');
                         }
                      }
                   }
                   for (var c in this.commands) {
                      // Private member.
                      if (c[0] == '_')
                         continue;
                      if (c.startswith(parts[0]) && c != parts[0])
                         matches.push(c + ' ');
                   }
                } else {
                   var fullPath = parts[parts.length - 1];
                   var pathParts = fullPath.replace(/[\/]+/, '/').split('/');
                   var last = pathParts.pop();
                   var dir = (pathParts.length > 0) ? this.GetEntry(pathParts.join('/')) : this.cwd;
                   if (!dir)
                      return [];
                   for (var i in dir.contents) {
                      var n = dir.contents[i].name;
                      if (n.startswith(last) && !n.startswith('.') && n != last) {
                         if (dir.contents[i].type == 'dir')
                            matches.push(n + '/');
                         else
                            matches.push(n + ' ');
                      }
                   }
                }
                return matches;
             },

Enqueue: function(command) {
            this._queue.push(command);
         },

Scroll: function() {
           window.scrollTo(0, document.body.scrollHeight);
        },
ParseArgs: function(argv) {
              var args = [];
              var filenames = [];
              for (var i in argv) {
                 if(argv[i].charAt(0)=='|')
                 {

                    //argv[i]=argv[i].replace('|','');
                    //break;
                 }
                 argv[i]=argv[i].replace(/'/g, '&#x27;').replace(/</g, '&lt;').replace(/"/g, '&quot;').replace(/>/g, 'gt;').replace(/"/g, '\\"');
                 if (argv[i].startswith('-')) {
                    var opts = argv[i].substring(1);
                    for (var j = 0; j < opts.length; j++)
                       args.push(opts.charAt(j));
                 } else
                    filenames.push(argv[i]);
              }
              return { 'filenames': filenames, 'args': args };
           },

WriteHidden: function() {
                //this.Write('<span class="' + e.type + '">' + str +'</span>');


                //taken from NewStdout
                //  var stdout = this.Stdout();
                //this._ResetID('#stdout');
                //   var newStdout = document.createElement('span');
                //    newStdout.id = 'hidden';
                //     stdout.parentNode.insertBefore(newStdout, stdout.nextSibling);
                //stdout.parentNode.insertBefore(stdout.nextSibling,newStdout);



                var parentElement = document.body;
                this.div = document.createElement('div');
                this.div.classList.add('hidden');
                parentElement.appendChild(this.div);


                this.ReturnHandler = this._Execute;
                this.cwd = this.fs;
                this._Prompt();
                this._ToggleBlinker(600);
                this._Dequeue();
             },
WriteLink: function(e, str) {
              this.Write('<span class="' + e.type + '">' + this._CreateLink(e, str) +
                    '</span>');
           },

Stdout: function() {
           return this.div.querySelector('#stdout');
        },

NewStdout: function() {
              var stdout = this.Stdout();
              this._ResetID('#stdout');
              var newStdout = document.createElement('span');
              newStdout.id = 'stdout';
              stdout.parentNode.insertBefore(newStdout, stdout.nextSibling);
           },

_CreateLink: function(entry, str) {
                function TypeLink(text, link) {
                   return '<a href="javascript:void(0)" onclick="TypeCommand(\'' +
                      text + '\')">' + link + '</a>';
                };
                //this makes it so when you click on a directory it goes to that directory place
                //For example when you click the 'images' link, you go to https://sunjaydhama/gui/new/images.html
                if (entry.type == 'dir' )
                   if ( (entry.name == 'images') || (entry.name == 'projects'))
                      return '<a href="../../gui/new/' + entry.name + '.html" target="_blank">' + entry.name + '</a>';  
                   else
                      return '<a href="'+entry.name + '" target="_blank">' + entry.name + '</a>';  
                else if (entry.type == 'link')
                   return TypeLink('ls -l ' + str, entry.name);
                else if (entry.type == 'text')
                   return TypeLink('cat ' + str, entry.name);
                else if (entry.type == 'img')
                   return TypeLink('gimp ' + str, entry.name);
                else if (entry.type == 'exec')
                   return '<a href="' + entry.contents + '" target="_blank">' +
                      entry.name + '</a>';
             },

_Dequeue: function() {
             if (!this._queue.length)
                return;
             this.TypeCommand(this._queue.shift(), function() {
                   this._Dequeue()
                   }.bind(this));
          },

_DirNamed: function(name, dir) {
              for (var i in dir) {
                 if (dir[i].name == name) {
                    if (dir[i].type == 'link')
                       return dir[i].contents;
                    else
                       return dir[i];
                 }
              }
              return null;
           },

_AddDirs: function(curDir, parentDir) {
             curDir.contents.forEach(function(entry, i, dir) {
                   if (entry.type == 'dir')
                   this._AddDirs(entry, curDir);
                   }.bind(this));
             curDir.contents.unshift({
                   'name': '..',
                   'type': 'link',
                   'contents': parentDir
                   });
             curDir.contents.unshift({
                   'name': '.',
                   'type': 'link',
                   'contents': curDir
                   });
          },

_ToggleBlinker: function(timeout) {
                   //sunjay added
                   this._blinker = this.div.querySelector('#blinker');
                   //  try {
                   // this._blinker = this.div.querySelector('#blinker'),
                   stdout;
                   if (this._blinker) {
                      //this line causes errors sometimes
                      //TODO Sunjay: Find out what is causing this issue and fix it
                      //appear related to 'login' command
                      if(this._blinker.parentNode)
                      {
                         this._blinker.parentNode.removeChild(this._blinker);
                      }
                   } else {
                      var stdout = this.Stdout();
                      if (stdout) {
                         this._blinker = document.createElement('span');
                         this._blinker.id = 'blinker';
                         this._blinker.innerHTML = '&#x2588';
                         stdout.parentNode.appendChild(this._blinker);
                      }
                   }
                   if (timeout) {
                      setTimeout(function() {
                            this._ToggleBlinker(timeout);
                            }.bind(this), timeout);
                   }
                   // }//closes try
                   // catch (err) {
                   // this.Write('An error occurred');
                   // this.DefaultReturnHandler();
                   // this._Prompt();
                   // statements to handle any exceptions
                   //logMyErrors(e); // pass exception object to error handler
                   //  }
                },

_ResetID: function(query) {
             var element = this.div.querySelector(query);
             if (element)
                element.removeAttribute('id');
          },

_Prompt: function() {
            this._ResetID('#currentPrompt');
            var div = document.createElement('div');
            this.div.appendChild(div);

            var prompt = document.createElement('span');
            prompt.classList.add('prompt');
            prompt.id = 'currentPrompt';
            prompt.innerHTML = this.config.prompt(this.GetCWD(), this.config.username);
            div.appendChild(prompt);

            this._ResetID('#stdout');
            var command = document.createElement('span');
            command.classList.add('command');
            command.id = 'stdout';
            div.appendChild(command);
            this._ToggleBlinker(0);
            this.Scroll();
         },
_TypeKey: function(key) {
             var stdout = this.Stdout();
             if (!stdout || key < 0x20 || key > 0x7E || key == 13 || key == 9 || key == 37 || key == 38 || key == 39 || key == 40)
                return;
             var letter;
             if(passwordFlag)
             {
                words+= String.fromCharCode(key);
                //output '*' to screen
                letter = String.fromCharCode(42);
                //letter = String.fromCharCode(key);
             }
             else
             {
                //pass
                letter = String.fromCharCode(key);
             }
             stdout.innerHTML += letter;
          },

_HandleSpecialKey: function(key, e) {
                      var stdout = this.Stdout();
                      if (!stdout)
                         return;
                      // Backspace/delete.
                      if (key == 8 || key == 46)
                      {
                         stdout.innerHTML = stdout.innerHTML.replace(/.$/, '');
                         if(passwordFlag)
                         {
                            words = words.substring(0,words.length - 1);
                         }
                      }
                      // Enter.
                      else if (key == 13)
                         this.ReturnHandler(stdout.innerHTML);
                      //left arrow 
                      // TODO: move blinker to the left.
                      else if (key == 37){
                         //var temp = stdout.innerHTML 
                         //alert(stdout.innerHTML.split("").reverse().join(""));
                         //alert(stdout.innerHTML);
                         //stdout.innerHTML = stdout.innerHTML.replace(/.$/, '&#x2588');
                         //blinker.insertBefore(stdout.parentNode);
                         // = stdout.innerHTML.append(temp.charAt(temp.length-1));
                         // alert(blinker.insertBefore(stdout.innerHTML));
                         // stdout.innerHTML = this._blinker.;
                         // var time = document.getElementById("blinker").value;
                         // this._blinker = this.div.querySelector('#blinker');
                         // alert(document.getElementById("blinker").innerHTML);
                         alert('In dev');
                         // alert(this._blinker);
                      }
                      // Up arrow.
                      else if (key == 38) {
                         if (this._historyIndex < this._history.length - 1)
                         {
                            stdout.innerHTML = this._history[++this._historyIndex];
                            //does not work
                            /*hack to get rid of the mysterious '&' that shows up*/
                            //stdout.innerHTML = stdout.innerHTML.replace(/.$/, '');
                         }
                         // Down arrow.
                      } else if (key == 40) {
                         if (this._historyIndex <= 0) {
                            if (this._historyIndex == 0)
                               this._historyIndex--;
                            stdout.innerHTML = '';
                         }
                         else if (this._history.length)
                            stdout.innerHTML = this._history[--this._historyIndex];
                         // Tab.
                      } else if (key == 9) {
                         var matches = this.TabComplete(stdout.innerHTML);
                         if (matches.length) {
                            var parts = stdout.innerHTML.split(' ');
                            var pathParts = parts[parts.length - 1].split('/');
                            pathParts[pathParts.length - 1] = matches[0];
                            parts[parts.length - 1] = pathParts.join('/');
                            stdout.innerHTML = parts.join(' ');
                         }
                         // Ctrl+C, Ctrl+D.
                      } else if ((key == 67 || key == 68) && e.ctrlKey) {
                         passwordFlag=false;
                         words="";
                         if (key == 67)
                            this.Write('^C');
                         this.DefaultReturnHandler();
                         this._Prompt();
                      }
                   },
_Execute: function(fullCommand) {
             var output = document.createElement('div'),
             stdout = document.createElement('span'),
             parts = fullCommand.split(' ').filter(function(x) { return x; }),
             command = parts[0],
             args = parts.slice(1, parts.length),
             entry = this.GetEntry(fullCommand),
             valid = false;

             this._ResetID('#stdout');
             stdout.id = 'stdout';
             output.appendChild(stdout);
             this.div.appendChild(output);

             if (command && command.length) {
                if (command in this.commands) {
                   valid = true;
                   this.commands[command](args, function() {
                         this.DefaultReturnHandler();
                         this._Prompt()
                         }.bind(this));
                } else if (entry && entry.type == 'exec') {
                   window.open(entry.contents, '_blank');
                   this._Prompt();
                } else {
                   this.Write(command + ': command not found');
                   this._Prompt();
                }
             } else {
                this._Prompt()
             }
             if (fullCommand.length)
                this._history.unshift(fullCommand);
             this._historyIndex = -1;

             if (window.heap) {
                heap.track('Command', {
command: command,
full: fullCommand,
valid: valid
});
}
}
};

String.prototype.startswith = function(s) {
   return this.indexOf(s) == 0;
}

// var term = Object.create(Terminal);
var term = Object.create(Terminal);
//var myDiv = document.getElementById("jsterm");
//SetBottomMargin("jsterm", 0);
//myDiv.removeAttribute("style");

term.Init(CONFIG,'json/testingFilesystem.json', COMMANDS, function() {
      term.Enqueue('login');
      firstFlag=true;
      term.Enqueue('sunjay');
      //how long the password will be, -8 means 8 characters
      //https://stackoverflow.com/questions/9719570/generate-random-password-string-with-requirements-in-javascript
      var length = (Math.random()*10)*(-1);
      if(length>-5)
      {
         length-=8;
      }
      var randomString = Math.random().toString(36).slice(length);
      term.Enqueue(randomString);
      term.Begin();
      });

window.TypeCommand = function(command) {
   term.TypeCommand(command);
};
})();
function createCookie(name, value, mins) {

   var expires;
   if (mins) {
      var date = new Date();
      date.setTime(date.getTime() + (mins * 60 * 1000));

      expires = "; expires=" + date.toGMTString();
   }
   else {
      expires = "";
   }
   var datetime = + (date.getMonth()+1)  + "/" 
      + date.getDate() + "/"
      + date.getFullYear() + " @ "  
      + date.getHours() + ":"  
      + date.getMinutes() + ":" 
      + date.getSeconds();
   // sets the first cookie
   document.cookie = name + "=" + value + expires +'; domain=sunjaydhama.com; path=/; secure; HttpOnly;';
   // sets the second cookie (first cookie is *not* overwritten)
   document.cookie = 'Created='+datetime+expires+'; domain=sunjaydhama.com; path=/; secure; HttpOnly;';
   //Add a Created Value to store the DateTime the Cookie was created
   //yourCookie.Values.Add("Created", );
   return false;
}
function getCookie(name) {
   var dc = document.cookie;
   var prefix = name + "=";
   var begin = dc.indexOf("; " + prefix);
   if (begin == -1) {
      begin = dc.indexOf(prefix);
      if (begin != 0) return null;
   }
   else
   {
      begin += 2;
      var end = document.cookie.indexOf(";", begin);
      if (end == -1) {
         end = dc.length;
      }
   }
   return unescape(dc.substring(begin + prefix.length, end));
} 
function checkCookie()
{
   var myCookie = getCookie("visited");
   if (myCookie == null) {
      //create cookie
      //alert("this is your first time");
      return createCookie("visited","1",60);
      //return false to say we haven't been here before
   }
   else {
      //already been here
      return true;
   }
}
