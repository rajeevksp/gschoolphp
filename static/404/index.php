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
  
   <section class="big_block four_o_four_error_bg">
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 four_o_four_error text-center">
               <ul class="four_o_four_error appear-animation" data-appear-animation="flash">
                  <li class="no">4</li>
                  <li><i class="fa fa-chain-broken"></i></li>
                  <li class="no">4</li>
               </ul>
               <div class="clearfix"></div>
               <h1>Error</h1>
               <h3>OOPS! THE PAGE YOU WERE LOOKING FOR, COULDN'T BE FOUND</h3>
               <p>We're sorry, but the page you were looking for doesn't exist. Here are some useful links</p>
               <div class="tags"> <a href="index.html">Home</a> <a href="about_layout_1.html">About</a><a href="services_layout_1.html">Services</a><a href="portfolio_full_width.html">Porfolio</a><a href="blog_col_1_right_sidebar.html">Blog</a><a href="contact_layout_1.html">Contact</a> </div>
            </div>
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
