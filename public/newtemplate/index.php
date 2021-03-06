<?php echo $this->doctype() . "\n"; ?>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php echo $this->headTitle() . "\n"; ?>
<meta name="description" content="WinsAndWants is a goal setting and sharing service that allows you to create daily goals and share them with friends.">
<meta name="author" content="Capstone Capital Pte Ltd">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo $this->baseUrl(); ?>/favicon.ico">
<link rel="apple-touch-icon" href="<?php echo $this->baseUrl(); ?>/apple-touch-icon.png">
<?php 
$this->headLink()->appendFile($this->baseUrl() . '/css/style.css');
$this->headLink()->appendFile($this->baseUrl() . '/css/baseline.type.css');
$this->headLink()->appendFile($this->baseUrl() . '/css/baseline.table.css');
$this->headLink()->appendFile($this->baseUrl() . '/css/baseline.form.css');

echo $this->headLink() . "\n";
?>
<?php 
$this->headScript()->appendFile($this->baseUrl() . '/js/modernizr-2.0.6.min.js');

echo $this->headScript() . "\n";
?>
</head>
<body>
<div id="header-container"> <?php echo $this->render('header.phtml') ?> </div>
<!-- end #header-container --> 
<?php echo $this->render('nav.phtml') ?>
<div id="main-container">
  <div id="main" class="wrapper">
    <div id="content"> <?php echo $this->layout()->content; ?> </div>
    <!-- end #content -->
    <aside> <?php echo $this->render('sidebar.phtml') ?> </aside>
  </div>
  <!-- end #main --> 
</div>
<!-- end #main-container -->
<div id="footer-container"> <?php echo $this->render('footer.phtml') ?> </div>
<!-- end #footer-container --> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script> 
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo $this->baseUrl(); ?>/js/jquery-1.6.2.min.js"%3E%3C/script%3E'))</script> 
<script src="<?php echo $this->baseUrl(); ?>/js/script.js"></script> 
<!--[if lt IE 7 ]>
<script src="<?php echo $this->baseUrl(); ?>js/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg');</script>
<![endif]-->
</body>
</html>
