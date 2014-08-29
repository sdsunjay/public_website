<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html><head><title>matrix.js source</title>
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dokv=abba2f56bd/"},atok:"0d0169b228cd5f6222bc43243c5743f7",petok:"745e11e2680d81d315573f428c7482cafa2c516a-1404618900-1800",zone:"ltdev.im",rocket:"0",apps:{"ga_key":{"ua":"UA-23469607-6","ga_bs":"2"},"abetterbrowser":{"ie":"10"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dokv=97fb4d042e/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<style type="text/css"><!--
body { background-color: #ffffff; color: #000000; }
pre { font-family: "Courier New",Courier,monospace; font-size: 12px; color: #000000; }
span.comment { color: #989898; font-style: italic; }
span.oper { color: #00478d; font-weight: bold; }
span.var { color: #0000AB; font-weight: normal; }
span.func { color: #4682b4; font-weight: bold; }
span.string { color: #3366cc; font-weight: bold; }
span.num { color: #da70d6; font-weight: bold; }
span.reg { color: #3366cc; font-weight: bold; }
--></style><script type="text/javascript">
/* <![CDATA[ */
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-23469607-6']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

(function(b){(function(a){"__CF"in b&&"DJS"in b.__CF?b.__CF.DJS.push(a):"addEventListener"in b?b.addEventListener("load",a,!1):b.attachEvent("onload",a)})(function(){"FB"in b&&"Event"in FB&&"subscribe"in FB.Event&&(FB.Event.subscribe("edge.create",function(a){_gaq.push(["_trackSocial","facebook","like",a])}),FB.Event.subscribe("edge.remove",function(a){_gaq.push(["_trackSocial","facebook","unlike",a])}),FB.Event.subscribe("message.send",function(a){_gaq.push(["_trackSocial","facebook","send",a])}));"twttr"in b&&"events"in twttr&&"bind"in twttr.events&&twttr.events.bind("tweet",function(a){if(a){var b;if(a.target&&a.target.nodeName=="IFRAME")a:{if(a=a.target.src){a=a.split("#")[0].match(/[^?=&]+=([^&]*)?/g);b=0;for(var c;c=a[b];++b)if(c.indexOf("url")===0){b=unescape(c.split("=")[1]);break a}}b=void 0}_gaq.push(["_trackSocial","twitter","tweet",b])}})})})(window);
/* ]]> */
</script>
</head><body><script type="text/javascript">//<![CDATA[try{(function(a){var b="http://",c="fb.ltdev.im",d="/cdn-cgi/cl/",e="img.gif",f=new a;f.src=[b,c,d,e].join("")})(Image)}catch(e){}//]]></script>
<pre><span class="oper">function</span> <span class="func">Matrix</span> (<span class="var">opts</span>) {
         <span class="var">opts</span> <span class="oper">=</span> <span class="var">opts</span><span class="oper">|</span><span class="oper">|</span>{};
         <span class="var">opts</span>.<span class="var">font</span> <span class="oper">=</span> <span class="var">opts</span>.<span class="var">font</span><span class="oper">|</span><span class="oper">|</span>{};
         <span class="var">this</span>.<span class="var">cid</span> <span class="oper">=</span> <span class="var">opts</span>.<span class="var">cid</span><span class="oper">|</span><span class="oper">|</span>'<span class="string">matrix</span>';
         <span class="var">this</span>.<span class="var">font</span> <span class="oper">=</span> {};
         <span class="var">this</span>.<span class="var">font</span>.<span class="var">link</span> <span class="oper">=</span> <span class="var">opts</span>.<span class="var">font</span>.<span class="var">link</span><span class="oper">|</span><span class="oper">|</span>'<span class="string">fonts/mCode15.ttf</span>';
         <span class="var">this</span>.<span class="var">font</span>.<span class="var">format</span> <span class="oper">=</span> <span class="var">opts</span>.<span class="var">font</span>.<span class="var">format</span><span class="oper">|</span><span class="oper">|</span>'<span class="string">truetype</span>';
         <span class="var">this</span>.<span class="var">font</span>.<span class="var">family</span> <span class="oper">=</span> <span class="var">opts</span>.<span class="var">font</span>.<span class="var">family</span><span class="oper">|</span><span class="oper">|</span>'<span class="string">matrix</span>';
         <span class="var">this</span>.<span class="var">font</span>.<span class="var">size</span> <span class="oper">=</span> <span class="var">opts</span>.<span class="var">font</span>.<span class="var">size</span><span class="oper">|</span><span class="oper">|</span>'<span class="string">7px</span>';
         <span class="var">this</span>.<span class="func">genStyle</span>(<span class="var">this</span>.<span class="var">cid</span>,<span class="var">this</span>.<span class="var">font</span>);
         <span class="var">this</span>.<span class="func">preload</span>();
         <span class="oper">if</span> ($(<span class="var">this</span>.<span class="var">cid</span>)) {
            <span class="var">this</span>.<span class="var">can</span> <span class="oper">=</span> $(<span class="var">this</span>.<span class="var">cid</span>);
            <span class="var">this</span>.<span class="var">ctx</span> <span class="oper">=</span> <span class="var">this</span>.<span class="var">can</span>.<span class="func">getContext</span>('<span class="string">2d</span>');
            <span class="var">this</span>.<span class="var">count</span> <span class="oper">=</span> <span class="var">opts</span>.<span class="var">count</span><span class="oper">|</span><span class="oper">|</span><span class="num">300</span>;
            <span class="var">this</span>.<span class="var">interval</span> <span class="oper">=</span> <span class="num">false</span>;
            <span class="var">this</span>.<span class="var">paused</span> <span class="oper">=</span> <span class="num">false</span>;
            <span class="var">this</span>.<span class="func">setSize</span>();
            <span class="var">this</span>.<span class="func">genStrings</span>();
            <span class="oper">if</span> (<span class="var">opts</span>.<span class="var">auto</span>) {
               <span class="func">setTimeout</span>(<span class="oper">function</span>(){<span class="var">this</span>.<span class="func">init</span>();}.<span class="func">bind</span>(<span class="var">this</span>),<span class="num">1000</span>);
            }
          } <span class="oper">else</span> {
            <span class="func">alert</span>('<span class="string">No canvas available!</span>');
         }
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">init</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="oper">if</span> (<span class="var">this</span>.<span class="var">interval</span>) { <span class="oper">return</span> <span class="num">false</span>; }
         <span class="var">this</span>.<span class="var">paused</span> <span class="oper">=</span> <span class="num">false</span>;
         <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">font</span> <span class="oper">=</span> <span class="var">this</span>.<span class="var">font</span>.<span class="var">size</span><span class="oper">+</span>'<span class="string"> &quot;</span>'<span class="oper">+</span><span class="var">this</span>.<span class="var">font</span>.<span class="var">family</span><span class="oper">+</span>'<span class="string">&quot;</span>';
         <span class="var">this</span>.<span class="var">interval</span> <span class="oper">=</span> <span class="func">setInterval</span>(<span class="oper">function</span>() {
              <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">fillStyle</span> <span class="oper">=</span> &quot;<span class="string">#000000</span>&quot;;
              <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">globalAlpha</span> <span class="oper">=</span> <span class="num">0.4</span>;
              <span class="var">this</span>.<span class="var">ctx</span>.<span class="func">fillRect</span>(<span class="num">0</span>,<span class="num">0</span>,<span class="var">this</span>.<span class="var">can</span>.<span class="var">width</span>,<span class="var">this</span>.<span class="var">can</span>.<span class="var">height</span>);
              <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">globalAlpha</span> <span class="oper">=</span> <span class="num">1</span>;
              <span class="oper">for</span> (<span class="oper">var</span> <span class="var">i</span> <span class="oper">=</span> <span class="num">0</span>; <span class="var">i</span> <span class="oper">&lt;</span> <span class="var">this</span>.<span class="var">count</span>; <span class="var">i</span><span class="oper">+</span><span class="oper">+</span>) {
                  <span class="oper">var</span> <span class="var">string</span> <span class="oper">=</span> <span class="var">this</span>.<span class="var">strings</span>[<span class="var">i</span>];
                  <span class="oper">if</span> (<span class="var">string</span>.<span class="var">c</span> <span class="oper">!=</span><span class="oper">=</span> <span class="var">undefined</span>) {
                     <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">fillStyle</span> <span class="oper">=</span> &quot;<span class="string">#e1e1e1</span>&quot;
                  }
                  <span class="var">this</span>.<span class="var">ctx</span>.<span class="func">fillText</span>(<span class="var">this</span>.<span class="func">randletter</span>(), <span class="var">string</span>.<span class="var">x</span>, <span class="var">string</span>.<span class="var">y</span>);
                  <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">fillStyle</span> <span class="oper">=</span> &quot;<span class="string">lime</span>&quot;;
                  <span class="oper">for</span> (<span class="oper">var</span> <span class="var">x</span> <span class="oper">=</span> <span class="num">1</span>; <span class="var">x</span> <span class="oper">&lt;</span> <span class="var">string</span>.<span class="var">t</span>; <span class="var">x</span><span class="oper">+</span><span class="oper">+</span>) {
                      <span class="var">this</span>.<span class="var">ctx</span>.<span class="func">fillText</span>(<span class="var">this</span>.<span class="func">randletter</span>(), <span class="var">string</span>.<span class="var">x</span>, <span class="var">string</span>.<span class="var">y</span><span class="oper">-</span>(<span class="var">x</span><span class="oper">*</span><span class="num">20</span>));
                  }
                  <span class="var">string</span>.<span class="var">y</span> <span class="oper">+</span><span class="oper">=</span> <span class="var">string</span>.<span class="var">s</span>;
                  <span class="oper">if</span> (<span class="var">string</span>.<span class="var">y</span> <span class="oper">&gt;</span> <span class="var">this</span>.<span class="var">can</span>.<span class="var">height</span><span class="oper">+</span><span class="num">100</span>) {
                     <span class="var">this</span>.<span class="var">strings</span>[<span class="var">i</span>] <span class="oper">=</span> <span class="var">this</span>.<span class="func">createString</span>();
                  }
              }
         }.<span class="func">bind</span>(<span class="var">this</span>),<span class="num">100</span>);
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">genStrings</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="var">this</span>.<span class="var">strings</span> <span class="oper">=</span> [];
         <span class="oper">for</span> (<span class="oper">var</span> <span class="var">i</span> <span class="oper">=</span> <span class="num">0</span>; <span class="var">i</span> <span class="oper">&lt;</span> <span class="var">this</span>.<span class="var">count</span>; <span class="var">i</span><span class="oper">+</span><span class="oper">+</span>) {
             <span class="var">this</span>.<span class="var">strings</span>.<span class="func">push</span>(<span class="var">this</span>.<span class="func">createString</span>());
         }
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">createString</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="oper">var</span> <span class="var">string</span> <span class="oper">=</span> {};
         <span class="var">string</span>.<span class="var">x</span> <span class="oper">=</span> <span class="var">Math</span>.<span class="func">floor</span>(<span class="var">Math</span>.<span class="func">random</span>()<span class="oper">*</span><span class="var">this</span>.<span class="var">can</span>.<span class="var">width</span>);
         <span class="var">string</span>.<span class="var">y</span> <span class="oper">=</span> <span class="var">Math</span>.<span class="func">floor</span>(<span class="var">Math</span>.<span class="func">random</span>()<span class="oper">*</span><span class="var">this</span>.<span class="var">can</span>.<span class="var">height</span>)<span class="oper">-</span><span class="var">Math</span>.<span class="func">floor</span>(<span class="var">Math</span>.<span class="func">random</span>()<span class="oper">*</span><span class="num">400</span>);
         <span class="var">string</span>.<span class="var">t</span> <span class="oper">=</span> <span class="var">Math</span>.<span class="func">floor</span>(<span class="var">Math</span>.<span class="func">random</span>()<span class="oper">*</span><span class="num">10</span>)<span class="oper">+</span><span class="num">4</span>;
         <span class="oper">if</span> (<span class="var">Math</span>.<span class="func">random</span>() <span class="oper">&lt;</span> .<span class="num">2</span>) {
            <span class="var">string</span>.<span class="var">c</span> <span class="oper">=</span> <span class="num">true</span>;
         }
         <span class="var">string</span>.<span class="var">s</span> <span class="oper">=</span> <span class="var">Math</span>.<span class="func">floor</span>(<span class="var">Math</span>.<span class="func">random</span>()<span class="oper">*</span><span class="num">10</span>)<span class="oper">+</span><span class="num">3</span>;
         <span class="oper">return</span> <span class="var">string</span>;
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">randletter</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="oper">return</span> <span class="var">String</span>.<span class="func">fromCharCode</span>(<span class="num">97</span><span class="oper">+</span><span class="var">Math</span>.<span class="func">round</span>(<span class="var">Math</span>.<span class="func">random</span>()<span class="oper">*</span><span class="num">25</span>));
}
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">stop</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="oper">if</span> (<span class="var">this</span>.<span class="var">interval</span>) {
            <span class="func">clearInterval</span>(<span class="var">this</span>.<span class="var">interval</span>);
            <span class="var">this</span>.<span class="var">interval</span> <span class="oper">=</span> <span class="num">false</span>;
            <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">fillStyle</span> <span class="oper">=</span> &quot;<span class="string">#000000</span>&quot;;
            <span class="var">this</span>.<span class="var">ctx</span>.<span class="func">fillRect</span>(<span class="num">0</span>,<span class="num">0</span>,<span class="var">this</span>.<span class="var">can</span>.<span class="var">width</span>,<span class="var">this</span>.<span class="var">can</span>.<span class="var">height</span>);
            <span class="var">this</span>.<span class="func">genStrings</span>();
         }
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">pause</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="oper">if</span> (<span class="var">this</span>.<span class="var">interval</span>) {
            <span class="func">clearInterval</span>(<span class="var">this</span>.<span class="var">interval</span>);
            <span class="var">this</span>.<span class="var">interval</span> <span class="oper">=</span> <span class="num">false</span>;
            <span class="var">this</span>.<span class="var">paused</span> <span class="oper">=</span> <span class="num">true</span>;
         }
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">setSize</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="oper">var</span> <span class="var">e</span> <span class="oper">=</span> <span class="var">window</span>, <span class="var">a</span> <span class="oper">=</span> '<span class="string">inner</span>';
         <span class="oper">if</span> (<span class="oper">!</span>('<span class="string">innerWidth</span>' <span class="oper">in</span> <span class="var">window</span>)) {
            <span class="var">a</span> <span class="oper">=</span> '<span class="string">client</span>';
            <span class="var">e</span> <span class="oper">=</span> <span class="var">document</span>.<span class="var">documentElement</span> <span class="oper">|</span><span class="oper">|</span> <span class="var">document</span>.<span class="var">body</span>;
         }
         <span class="oper">var</span> <span class="var">sizes</span> <span class="oper">=</span> {<span class="var">width</span><span class="oper">:</span><span class="var">e</span>[<span class="var">a</span><span class="oper">+</span>'<span class="string">Width</span>'],<span class="var">height</span><span class="oper">:</span><span class="var">e</span>[<span class="var">a</span><span class="oper">+</span>'<span class="string">Height</span>']};
         <span class="var">this</span>.<span class="var">can</span>.<span class="var">width</span> <span class="oper">=</span> <span class="var">sizes</span>.<span class="var">width</span>;
         <span class="var">this</span>.<span class="var">can</span>.<span class="var">height</span> <span class="oper">=</span> <span class="var">sizes</span>.<span class="var">height</span>;
         <span class="var">this</span>.<span class="var">ctx</span>.<span class="var">font</span> <span class="oper">=</span> <span class="var">this</span>.<span class="var">font</span>.<span class="var">size</span><span class="oper">+</span>'<span class="string"> &quot;</span>'<span class="oper">+</span><span class="var">this</span>.<span class="var">font</span>.<span class="var">family</span><span class="oper">+</span>'<span class="string">&quot;</span>';
         <span class="var">window</span>.<span class="var">onresize</span> <span class="oper">=</span> <span class="oper">function</span> () {
             <span class="var">this</span>.<span class="func">setSize</span>();
         }.<span class="func">bind</span>(<span class="var">this</span>);
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">genStyle</span> <span class="oper">=</span> <span class="oper">function</span> (<span class="var">cid</span>,<span class="var">font</span>) {
        <span class="oper">var</span> <span class="var">style</span> <span class="oper">=</span> $('<span class="string">style</span>',<span class="num">1</span>);
        <span class="var">style</span>.<span class="var">type</span> <span class="oper">=</span> &quot;<span class="string">text/css</span>&quot;;
        <span class="var">document</span>.<span class="func">getElementsByTagName</span>('<span class="string">head</span>')[<span class="num">0</span>].<span class="func">appendChild</span>(<span class="var">style</span>);
        <span class="oper">var</span> <span class="var">cont</span> <span class="oper">=</span> '<span class="string">@font-face{font-family:&quot;</span>'<span class="oper">+</span><span class="var">font</span>.<span class="var">family</span><span class="oper">+</span>'<span class="string">&quot;;src:url(&quot;</span>'<span class="oper">+</span><span class="var">font</span>.<span class="var">link</span><span class="oper">+</span>'<span class="string">&quot;) format(&quot;</span>'<span class="oper">+</span><span class="var">font</span>.<span class="var">format</span><span class="oper">+</span>'<span class="string">&quot;);};</span>';
        <span class="oper">if</span> (<span class="var">cid</span> <span class="oper">!=</span><span class="oper">=</span> '<span class="string">matrix</span>') {
           <span class="var">cont</span> <span class="oper">+</span><span class="oper">=</span> '<span class="string">#</span>'<span class="oper">+</span><span class="var">cid</span><span class="oper">+</span>'<span class="string">{position:fixed;top:0px;left:0px;z-index:-1;};</span>';
        };
        <span class="oper">if</span> (<span class="oper">!</span><span class="oper">!</span>(<span class="var">window</span>.<span class="var">attachEvent</span> <span class="oper">&amp;</span><span class="oper">&amp;</span> <span class="oper">!</span><span class="var">window</span>.<span class="var">opera</span>)) {
           <span class="var">style</span>.<span class="var">styleSheet</span>.<span class="var">cssText</span> <span class="oper">=</span> <span class="var">cont</span>;
         } <span class="oper">else</span> {
           <span class="var">style</span>.<span class="func">appendChild</span>(<span class="var">document</span>.<span class="func">createTextNode</span>(<span class="var">cont</span>));
        }
};
<span class="var">Matrix</span>.<span class="var">prototype</span>.<span class="var">preload</span> <span class="oper">=</span> <span class="oper">function</span> () {
         <span class="oper">if</span> (<span class="oper">!</span>$(<span class="var">this</span>.<span class="var">cid</span>)) {
            <span class="oper">var</span> <span class="var">can</span> <span class="oper">=</span> $('<span class="string">canvas</span>',<span class="num">1</span>);
            <span class="var">can</span>.<span class="func">setAttribute</span>('<span class="string">id</span>',<span class="var">this</span>.<span class="var">cid</span>);
            <span class="var">can</span>.<span class="func">setAttribute</span>('<span class="string">style</span>','<span class="string">position:fixed;top:0px;left:0px;z-index:-1;</span>');
            <span class="var">document</span>.<span class="var">body</span>.<span class="func">appendChild</span>(<span class="var">can</span>);
         }
         <span class="oper">if</span> (<span class="oper">!</span>$('<span class="string">matrix-preload</span>')) {
            <span class="oper">var</span> <span class="var">preload</span> <span class="oper">=</span> $('<span class="string">div</span>',<span class="num">1</span>);
            <span class="var">preload</span>.<span class="func">setAttribute</span>('<span class="string">id</span>','<span class="string">matrix-preload</span>');
            <span class="var">preload</span>.<span class="func">setAttribute</span>('<span class="string">style</span>','<span class="string">font-family:&quot;</span>'<span class="oper">+</span><span class="var">this</span>.<span class="var">font</span>.<span class="var">family</span><span class="oper">+</span>'<span class="string">&quot;;font-size:0px;</span>');
            <span class="var">preload</span>.<span class="var">textContent</span> <span class="oper">=</span> &quot;<span class="string">preload</span>&quot;;
            <span class="var">document</span>.<span class="var">body</span>.<span class="func">appendChild</span>(<span class="var">preload</span>);
         }
};
<span class="oper">function</span> $ (<span class="var">id</span>,<span class="var">x</span>) {
         <span class="oper">return</span> (<span class="var">x</span><span class="oper">=</span><span class="oper">=</span><span class="num">null</span><span class="oper">?</span><span class="var">document</span>.<span class="func">getElementById</span>(<span class="var">id</span>)<span class="oper">:</span><span class="var">document</span>.<span class="func">createElement</span>(<span class="var">id</span>));
}
</pre></body></html>