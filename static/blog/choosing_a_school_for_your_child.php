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
  
    <section class="breadcrumb_bg">
      <h2>Choosing a right School for your child</h2>
      <ol class="breadcrumb">
         <li><a href="<?php echo SECURE_PATH;?>">Home</a></li>
         <li><a href="<?php echo SECURE_PATH;?>static/blog/">Blog</a></li>
         <li class="active">Choosing a right School for your child</li>
      </ol>
   </section>
    
    
    <section class="big_block">
      <div class="container">
          
         <div class="blog_items style_2">
            <div class="block style_1 appear-animation" data-appear-animation="fadeIn">
               <div class="row">
                  <div class="col-md-2 col-sm-2 col-xs-12">
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
                    <p>Still, the search for the right school is rarely easy.</p>
<p>&quot;Everybody I talk to is freaking out about it,&quot; said Geetha, whose daughter will enter kindergarten in this year. &quot;It isn't university, it isn't rocket science, but if you don't start with a solid foundation, you can't do much.&quot;</p>
<p>&quot;I didn't really know all the right questions to ask at the time,&quot; Ram said. &quot;My kids definitely need structure and discipline. The best way is to talk to the parents, talk to the kids. See what they like or don't like. Understand their methods, how they discipline.&quot; Said Mugdha.</p>
<p>Some said they aren't sure what their options are or what criteria will help them find the best school for their child. Some reported that they felt like they were too late---Missed the admission dates or  making up for slow progress at a school that didn't meet their child's needs.</p>
<p>Here are some of the tips that I followed in my School search journey</p>
                      <p><strong>Define your ideal school</strong></p>
                      <p>Refine your search parameters depending on the curriculum, extracurricular activities, communication skills, facilities available, Fee structure.. Define the qualities of an ideal school for your child.</p>
<p><strong>Consider all the possibilities</strong></p>
                      <p>Check for all the options available like nearby schools, Top schools where you can send your child,..etc. Filter on your definition of ideal school.</p>
<p><strong>Check the numbers, but don't let them dictate your decision</strong></p>
                      <p>Do some research on the reports of school, number of students, teacher student ratio, the extracurricular events they attend. Do not depend on the numbers but also talk to the students/parents consider their advice.</p>
<p><strong>Visit before you decide</strong></p>
                      <p>Sometimes visiting school makes decision Final. The way Principal talks and check what he expects from the students, check if it matches with your child needs. Even a girls wash room could tell their attitude.</p>
<p><strong>Ask the right questions</strong></p>
                      <p>Go to your definition of ideal school and ask questions accordingly. Always check if the school meets your child expectations.</p>
<p>Few questions how are communication skills taught to the child?</p>
                      <p> Is there a practical implementation of concepts?</p>
                      <p><strong>Don't make assumptions</strong></p>
                      <p>Word of mouth is helpful, but could be biased. Having a school nearby might seem like a deal breaker, but there might be transportation or child-care help for a different school that's a better fit. Sometimes a school with 50yrs of experience might not be a good one. Schools have changed dramatically. Never make assumptions.</p>
<p><strong>Know how to apply, and when</strong></p>
                      <p>Have a check list for every school, with application cutoff dates, selection dates, interaction dates, lottery dates etc.. Keep your paper work ready. Have remainders set on some electronic device so that you don't miss.</p>
<p><strong>Have a backup plan</strong></p>
                      <p>You may not get in lottery or not get in an interaction session. Or your dream school might be full. Have backup for the second or third choice of schools.</p>
                    <!--<h4>Share this <strong>POST</strong></h4>
<div class="social_icons"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-google-plus"></i></a> </div>-->
                    <div class="clearfix"></div>
                  </div>
               </div>
            </div>
            <!--<nav>
               <ul class="pager">
                  <li class="previous"><a href="#"><span aria-hidden="true">←</span> Older</a></li>
                  <li class="next"><a href="#">Newer <span aria-hidden="true">→</span></a></li>
               </ul>
            </nav>-->
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
