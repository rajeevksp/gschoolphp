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
  
 <section class="big_block">
      <div class="container">
         <div class="row">
            <div class="col-sm-8">
               <h2>Recent <strong>posts</strong></h2>
            </div>
            <div class="col-sm-4">
                
            </div>
         </div>
         <div class="blog_items style_2">
            <div class="block appear-animation" data-appear-animation="fadeIn">
               <div class="row">
                  <div class="col-md-2 col-sm-2 col-xs-12">
                     <ul class="date style_2">
                        <li>25</li>
                        <li>january</li>
                        <li>2016</li>
                        <li class="clearfix"></li>
                     </ul>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                    
                    
                     <div class="pic"><a href="<?php echo SECURE_PATH;?>photos/blog/board-413157_1920.jpg"><img class="img-responsive" src="<?php echo SECURE_PATH;?>photos/blog/board-413157_1920.jpg" alt=""/> </a>
                        <div class="popup-gallery"><a href="<?php echo SECURE_PATH;?>photos/blog/board-413157_1920.jpg" title="Continuous and Comprehensive Evaluation"><i class="fa fa-expand"></i></a></div>
                     </div>
                     <h3>Continuous and Comprehensive Evaluation <strong>(CCE)</strong></h3>
                      
                     <p>Continuous and Comprehensive Evaluation (CCE) system was introduced by the Central Board of Secondary Education (CBSE) in India to assess all aspects of a student's development on a continuous basis throughout the year. The assessment covers both scholastic subjects as well as co-scholastic areas such as performance in sports, art, music, dance, drama, and other cultural activities and social qualities.</p>
                     
                      <button type="button" class="btn btn-default style_2" onClick="window.location = '<?php echo SECURE_PATH;?>static/blog/continuous_and_comprehensive_evaluation_(CCE).php'">Learn More</button>
                     <div class="clearfix"></div>
                  </div>
               </div>
            </div>
            <div class="block appear-animation" data-appear-animation="fadeIn">
               <div class="row">
                  <div class="col-md-2 col-sm-3 col-xs-12">
                     <ul class="date style_2">
                        <li>27</li>
                        <li>january</li>
                        <li>2016</li>
                        <li class="clearfix"></li>
                     </ul>
                  </div>
                  <div class="col-md-10 col-sm-9 col-xs-12">
                  
                      <div class="pic"><a href="<?php echo SECURE_PATH;?>photos/blog/balloon-912804_1920.png"><img class="img-responsive" src="<?php echo SECURE_PATH;?>photos/blog/balloon-912804_1920.png" alt=""/> </a>
                        <div class="popup-gallery"><a href="<?php echo SECURE_PATH;?>photos/blog/balloon-912804_1920.png" title="Choosing a right School for your child"><i class="fa fa-expand"></i></a></div>
                     </div>
                     <h3>Choosing a right School for your child</h3>
                     <p>It's my daughters third birthday !! As  Parents our next responsibility is to choose right school for our child. School time seems like a lifetime away for kids, but for the next few months, parents will be flooded with information about school admissions, open enrollment and school lotteries. </p>
                    
                     <button type="button" class="btn btn-default style_2" onClick="window.location = '<?php echo SECURE_PATH;?>static/blog/choosing_a_school_for_your_child.php'">Learn More</button>
                     <div class="clearfix"></div>
                  </div>
               </div>
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
