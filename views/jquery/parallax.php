<?php $this->setLayoutVar('title', 'parallax') ?>
<?php 
    $this->setLayoutVar('head', array(
    '<link href="/css/parallax.css" rel="stylesheet">',
    '<script type="text/javascript" src="/js/jquery.scrollTo-1.4.3.1-min.js" charset="utf-8"></script>',
    '<script type="text/javascript" src="/js/parallax.js" charset="utf-8"></script>'
    )) 
  ?>
<h2>パララックス</h2>
<div id="bg"></div>
<div id="eof"></div>