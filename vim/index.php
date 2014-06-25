<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title>Vim</title>
<meta charset="utf-8"/>
<!--<link rel=stylesheet href="../doc/docs.css">-->
<!-- JQuery so we can $.post! -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<link rel="stylesheet" href="editor/lib/codemirror.css">
<link rel="stylesheet" href="editor/demo/half.css">
<link rel="stylesheet" href="editor/demo/fullscreen.css">
<link rel="stylesheet" href="editor/addon/dialog/dialog.css">
<link rel="stylesheet" href="editor/theme/night.css">

<script src="editor/lib/codemirror.js"></script>
<script src="editor/addon/dialog/dialog.js"></script>
<script src="editor/demo/fullscreen.js"></script>
<script src="editor/demo/half.js"></script>
<script src="editor/addon/search/searchcursor.js"></script>
<script src="editor/mode/clike/clike.js"></script>
<script src="editor/keymap/vim.js"></script>
<script src="editor/addon/edit/matchbrackets.js"></script>
<style type="text/css">
      .CodeMirror {border-top: 0px margin-top:0 margin-left:0 margin-right:0 margin-bottom:0 solid #eee; border-bottom: 0px solid #eee;}
   </style>
   <article>
<!--<textarea id="temp" name ="temp"</textarea>-->
<form ><textarea id="code" name="code" >
</textarea></form>
<div id="command-display" style="width: 100px; height: 30px;"></div>
    <form><textarea id="code2" name="code2" style="font-weight:bold" >
</textarea></form>
<!--<p>The vim keybindings are enabled by
including <a href="../keymap/vim.js">keymap/vim.js</a> and setting
the <code>keyMap</code> option to <code>"vim"</code>. Because
CodeMirror's internal API is quite different from Vim, they are only
a loose approximation of actual vim bindings, though.</p>
-->
<!--Sunjay commented the stuff below out because I do not want to override default save,
which has been modified to actually save. -->
<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
   lineNumbers: true,
      mode: "text/x-csrc",
      setValue: "An Error has occurred.",
      setOption: "halfScreen",
      vimMode: true,
      showCursorWhenSelecting: true,
      extraKeys: {
         "Ctrl-U": function(cm) {
            cm.setOption("fullScreen", !cm.getOption("fullScreen"));
         }
      }
});
var editor2 = CodeMirror.fromTextArea(document.getElementById("code2"), {
   lineNumbers: true,
      mode: "text/x-csrc",
      setValue: "test",
      setOption: "halfScreen",
      vimMode: true,
      showCursorWhenSelecting: true,
      extraKeys: {
         "Ctrl-U": function(cm) {
            cm.setOption("fullScreen", !cm.getOption("fullScreen"));
         }
      }
});
//var applyMapContainerHeight = function() {
var height = $(window).height();
//      $("CodeMirror").height(height);
//  document.getElementsByTagName('body')[0].style.height =height+"px";
//$("body").height(height);
// };

//document.getElementsByTagName('html')[0].style.height =2*height+"px";

//GOOD
document.getElementsByTagName('body')[0].style.height =height+"px";           
document.getElementsByTagName('article')[0].style.height = height+"px";
//document.getElementsByTagName('article')[1].style.height = (height/2)+"px";
document.getElementsByTagName('form')[0].style.height = (height/2)+"px";
document.getElementsByTagName('form')[1].style.height = (height/2)+"px";
document.getElementById('code').style.height = (height/2)+"px";
document.getElementById('code2').style.height = (height/2)+"px";
var wrap = editor.getWrapperElement();
//cm.state.fullScreenRestore = {scrollTop: window.pageYOffset, scrollLeft: window.pageXOffset,width: wrap.style.width, height: wra    +++ \p.style.height};
wrap.style.width = wrap.style.height = "";
wrap.className += " CodeMirror-halfscreen";
//document.documentElement.style.height=height/2;
document.documentElement.style.overflow = "hidden";
//cm.refresh();
//document.getElementById('CodeMirror-gutters').style.height = (height/2)+"px";
//document.getElementsByTagName('CodeMirror-scroll').style.height = (height/2)+"px";
//CHANGE cm-s-default.cm-keymap-fat-cursor
//document.getElementById('CodeMirror.cm-s-default.cm-keymap-fat-cursor').style.height = (height/2)+"px";

//document.ready(function() {
//    applyMapContainerHeight();
// });

// $(window).resize(function() {
//    applyMapContainerHeight();
// });

<?php
/*
 * XSS Protective Measures 
 */
require_once '../../security/htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($_GET['name']);
?>
//$.get("editor/demo/load/load.php?name=<?php echo $_GET['name'] ?>", function( data ) {
$.get("editor/demo/load/load.php?name=<?php echo $clean_html?>", function( data ) {
   editor.setValue(data);
   editor.setNameOfFile('<?php echo $clean_html ?>');
//   alert( "Data Loaded: " + data);
});
$.get("editor/demo/load/load.php?name=code.c", function( data ) {
   editor2.setValue(data);

   //alert( "Data Loaded: " + data );
});
//var name=<?php  echo $_GET['name'] ?>;
//var wrap = editor2.getWrapperElement();
//cm.state.fullScreenRestore = {scrollTop: window.pageYOffset, scrollLeft: window.pageXOffset,width: wrap.style.width, height: wra    +++ \p.style.height};
//var height = $(window).height();
//wrap.style.width = wrap.style.height = "";
//wrap.className += " CodeMirror-halfscreen";
//document.documentElement.style.height=height/2;
//document.documentElement.style.overflow = "hidden";
//NEW Friday
var wrap1 = editor2.getWrapperElement();
wrap1.style.width = wrap.style.height = "";
/*wrap1.className += " CodeMirror-halfscreen";*/
document.documentElement.style.height=height;
document.documentElement.style.overflow = "hidden";
//editor.setNameOfFile('eric');

</script>
  </article>
</html
