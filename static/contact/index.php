<?php
 include('../../include/session.php');
 
 
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8" />
<title>Gool School</title>
<meta name="keywords" content="Gool School" />
<meta name="description" content="Gool School" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php $session->commonCSS();?>

</head>
<body>
<div class="preloader">
   <div class="loader-inner ball-scale-ripple-multiple">
      <div></div>
      <div></div>
      <div></div>
   </div>
</div>
<section class="wrapper">
    <!--header-->
   <?php $session->commonHeader(); ?>
  
   <section class="big_block description">
      <div class="container">
         <div class="col-xs-12">
            <h2>UNDER <strong>Development</strong></h2>
            <p>We are working hard to get this feature live. Thanks for your patience!!</p>
         </div>
      </div>
   </section>
    
     
    
    
    
    <?php  $session->commonFooter();?>

    
</section>
<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
 
<?php $session->commonJS();?> 
 
<script src="<?php echo JS_PATH;?>custom_jquery.js"></script>
</body>
</html>
