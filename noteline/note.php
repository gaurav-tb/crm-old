<html><head><script id="twitter-wjs" src="../scripts/widgets.js"></script>
  <title>gitspective</title>
  <link href="http://zmoazeni.github.com/gitspective/css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css">
  <link href="http://zmoazeni.github.com/gitspective/css/site.css?2" media="all" rel="stylesheet" type="text/css">
<style>
</style></head>
<body data-twttr-rendered="true">
  <a href="https://github.com/zmoazeni/gitspective"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png" alt="Fork me on GitHub"></a>

  <div class="container span12">
    <div id="messages" class="span12 offset2 row"></div>

    <div id="content" class="row span12"><header class="page-header well row">
  <div class="span1 offset3"><img src="https://secure.gravatar.com/avatar/0e3fefba6ade90874b69c2bb37e5a36e?d=https://a248.e.akamai.net/assets.github.com%2Fimages%2Fgravatars%2Fgravatar-user-420.png" alt="image of "></div>
  <div class="span5">
    <h1> <a href="https://github.com/ricky">ricky</a></h1>
    <ul>


        <li>Joined: May 2, 2008</li>
    </ul>
  </div>

  <iframe allowtransparency="true" frameborder="0" scrolling="no" src="http://platform.twitter.com/widgets/tweet_button.1347008535.html#_=1351458390972&amp;count=none&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fzmoazeni.github.com%2Fgitspective%2F%23%2Ftimeline%2Fricky&amp;size=m&amp;text=My%20gitspective%3A%20&amp;url=http%3A%2F%2Fzmoazeni.github.com%2Fgitspective%2F%23%2Ftimeline%2Fricky" class="twitter-share-button twitter-count-none" style="width: 59px; height: 20px; " title="Twitter Tweet Button" data-twttr-rendered="true"></iframe>
  
</header>

<div class"row"="">
  <ul class="nav nav-pills">
    <li class="active"><a href="#" data-type="push">Push</a></li>
    <li class="active"><a href="#" data-type="fork">Fork</a></li>
    <li class="active"><a href="#" data-type="gist">Gist</a></li>
    <li class="active"><a href="#" data-type="branch">Branch</a></li>
    <li class="active"><a href="#" data-type="watch">Follow</a></li>
    <li class="active"><a href="#" data-type="comment">Comment</a></li>
    <li class="active"><a href="#" data-type="issue">Issue</a></li>
    <li class="active"><a href="#" data-type="item">Unstyled</a></li>
  </ul>
</div>

<div id="timeline-container" class="row offset1">
  <div id="timeline-line">
  </div>

  <ol id="timeline" style="position: relative; height: 710px; " class="masonry">
  <li class="item masonry-brick" data-id="1614208587" data-type="watch" style="position: absolute; top: 0px; left: 0px; " data-align="l">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/gitlabhq/gitlabhq">gitlabhq/gitlabhq</a></h1>
  <span class="date">Oct 19, 2012</span>
</li><li class="item masonry-brick" data-id="1585246196" data-type="watch" style="position: absolute; top: 0px; left: 430px; " data-align="r">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/treeder/logitech_unifier">treeder/logitech_unifier</a></h1>
  <span class="date">Aug 14, 2012</span>
</li><li class="item masonry-brick" data-id="1555632077" data-type="issue" style="position: absolute; top: 92px; left: 0px; " data-align="l">
  <span class="corner"></span>
  <h1>Opened an <a href="https://github.com/bevry/docpad-extras/issues/4">issue</a> on <a href="https://github.com/bevry/docpad-extras">bevry/docpad-extras</a></h1>
  <blockquote>PHP Plugin Doesn't pass document headers</blockquote>
  <blockquote>As described in the wiki, layouts should have access to variables set in both documents and the layout itself. This is true, for example, of `eco` templates. The php plugin appears to discard most of `templateData`, saving only file metadata (i.e. the layout itself) to the `$document` variable.

A naive patch is include below, mostly for illustrative purposes. I'll admit to not having sufficiently examined docpad's source to be able to offer a more elegant solution yet.

```patch
index db5a3ae..b513c65 100644
--- a/plugins/php/php.plugin.coffee
+++ b/plugins/php/php.plugin.coffee
@@ -30,6 +30,16 @@ module.exports = (BasePlugin) -&gt;
                                        #{data}
                                        EOF;
                                        $document = json_decode($document,true);
+                                       
+                                       $templateHeader = &lt;&lt;&lt;EOF
+                                       #{templateData.document.header}
+                                       EOF;
+                                       $templateHeader = explode("\n", trim($te
+                                       foreach ($templateHeader as $header)
+                                       {
+                                               $headerline = explode(":", $head
+                                               $document[trim($headerline[0])] 
+                                       }
                                        ?&gt;

                                        #{content}
```</blockquote>
  <span class="date">May 24, 2012</span>
</li><li class="item masonry-brick" data-id="1552916902" data-type="watch" style="position: absolute; top: 92px; left: 430px; " data-align="r">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/square/cube">square/cube</a></h1>
  <span class="date">May 16, 2012</span>
</li><li class="item masonry-brick" data-id="1523356700" data-type="watch" style="position: absolute; top: 184px; left: 430px; " data-align="r">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/flatiron/plates">flatiron/plates</a></h1>
  <span class="date">Feb 24, 2012</span>
</li><li class="item masonry-brick" data-id="1523015890" data-type="watch" style="position: absolute; top: 276px; left: 430px; " data-align="r">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/geisbruch/HadoopCryptoCompressor">geisbruch/HadoopCryptoCompressor</a></h1>
  <span class="date">Feb 24, 2012</span>
</li><li class="item masonry-brick" data-id="1520947068" data-type="watch" style="position: absolute; top: 368px; left: 430px; " data-align="r">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/NaturalNode/natural">NaturalNode/natural</a></h1>
  <span class="date">Feb 18, 2012</span>
</li><li class="item masonry-brick" data-id="1505188221" data-type="watch" style="position: absolute; top: 460px; left: 430px; " data-align="r">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/oldmanuk/makemkv">oldmanuk/makemkv</a></h1>
  <span class="date">Dec 13, 2011</span>
</li><li class="item masonry-brick" data-id="1504026436" data-type="watch" style="position: absolute; top: 518px; left: 0px; " data-align="l">
  <span class="corner"></span>
  <h1>Began watching <a href="https://github.com/tsmith/node-control">tsmith/node-control</a></h1>
  <span class="date">Dec 8, 2011</span>
</li><li id="joined" class="prominent masonry-brick" style="position: absolute; top: 610px; left: 0px; "><div class="well">Joined: May 2, 2008</div></li></ol>
</div></div>

    <footer class="well offset1">
      Built by <a href="https://twitter.com/zmoazeni">Zach Moazeni</a>
    </footer>
  </div>

  <script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/date.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/spin.min.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/jquery.min.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/jquery.masonry.min.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/jquery.waypoints.min.js" type="text/javascript"></scri  <script src="js-lib/bootstrap.min.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/spine/spine.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/spine/route.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js-lib/mustache.js" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js/views.js?12" type="text/javascript"></script>
  <script src="http://zmoazeni.github.com/gitspective/js/site.js?13" type="text/javascript"></script>

  <!-- footer to try and trick gh-pages fork -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31570261-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</body></html>