
(function() {
  "use strict";

  CodeMirror.defineOption("halfScreen", false, function(cm, val, old) {
    if (old == CodeMirror.Init) old = false;
    if (!old == !val) return;
    if (val) setHalfscreen(cm);
    //else setNormal(cm);
  });

  function setHalfscreen(cm) {
      var wrap = cm.getWrapperElement();
      cm.state.fullScreenRestore = {scrollTop: window.pageYOffset, scrollLeft: window.pageXOffset,width: wrap.style.width, height: wrap.style.height};
      var height = $(window).height();
      wrap.style.width = wrap.style.height = "";
      wrap.className += " CodeMirror-halfscreen";
   //   document.documentElement.style.height=height/2;
      document.documentElement.style.overflow = "hidden";
      cm.refresh();
  }
 /* function setNormal(cm) {
      var wrap = cm.getWrapperElement();
      wrap.className = wrap.className.replace(/\s*CodeMirror-fullscreen\b/, "");
      document.documentElement.style.overflow = "";
      var info = cm.state.fullScreenRestore;
      wrap.style.width = info.width; wrap.style.height = info.height;
      window.scrollTo(info.scrollLeft, info.scrollTop);
      cm.refresh();
  }*/

})();
