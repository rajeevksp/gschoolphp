<?php
 include('include/session.php');
 
 
 /*if(isset($_REQUEST['as_values_location'])){
	  $post = $session->cleanInput($_REQUEST);
 
	 $search_url = 'gschooldev/search/'.$post['entity_type'].'/'.$post['as_values_location'];
	 
	 header('location: '.$search_url);
 }
*/
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
<body >
<!--preloader-->
<div class="preloader">
   <div class="loader-inner ball-scale-ripple-multiple">
      <div></div>
      <div></div>
      <div></div>
   </div>
</div>
<!--wrapper-->
<section class="wrapper"> 
   <!--header-->
   <?php $session->commonHeader(); ?>
   
   
   <!--slider-->
   <section class="slider">
      <div class="banner">
         <div class="banner_bg"><img class="img-responsive" src="<?php echo SECURE_PATH;?>photos/home_bcg.jpg" alt=""/></div>
         <div class="bann_caption">
            <div class="container">
            <div class="basic_search">
            
            <!-- Textfield with Floating Label -->

            <form class="bs-component" action="search/" method="get">
           
                
           <div class="input-group">
               
               <div class="col-sm-4 col-xs-6">
                   <div class="radio  radio-primary">
  <label>
      <input type="radio"  name="entity_type" checked="checked" onclick="$('#entity').val($(this).val());$('#school_entity').val($(this).val());initAutocomplete();" value="school" />
   School
  </label>
</div>
                  
               </div>    
               <div class="col-sm-4  col-xs-6">
                    <div class="radio  radio-primary">
  <label>
      <input type="radio"   name="entity_type" value="nursery" onclick="$('#entity').val($(this).val());$('#school_entity').val($(this).val());initAutocomplete();"/>
   Nursery
  </label>
</div>
                      
               </div>
               <div class="col-sm-4  col-xs-12"></div>
               
    </div>       
                
<div class="input-group">

  
     
 
<div class="form-control-wrapper autosuggest">
<input id="focusedInput"  class="form-control"   type="text" />

</div>
    <input type="hidden" id="prefill" value="" />    
    

    <span class="input-group-btn"><button type="submit" class="btn btn-info btn-raised" ><i class="fa fa-search"></i> Search</button>
    
    </span>
</div>


        
</form>
               <input type="hidden" name="entity" class="entity_type"  id="entity" value="school" />
 

</div>


<br />
<br />
<br />
<br />
<h4>Want more options? Try our <strong>Personalized Search</strong></h4>
<a   href="#personalized_search_anchor" class="page_scroll"><i class="fa fa-3x fa-chevron-down"></i></a>
               
               
               
               </div>
         </div>
      </div>
   </section>
   
   
   
   
   <!--description-->
   
   <!--features-->
   
   <!--home block 1-->
   <section class="searchForm"  >
      <div class="container-fluid">
       
        <div class="container">
        
          
         <div id="personalized_search_anchor" class="shortcode_anchor"></div>
         
         
         <div class="col-md-12 col-sm-12 ">
       
          
           
            <div id="personalized_search_head" class="personalized_search">
             <h2>Search Parameters</h2>
            <p>Search and find best school which suits your requirement.</p>
          
            </div>
          </div>
          </div>
          </div>
          </section>
   
   <section class="home_block_1 "  >
      <div class="container-fluid">
       
        <div class="container">
        
          <div  class="shortcode_anchor"></div>
          
         <div class="col-md-12 col-sm-12 ">
       
               <form class="bs-component" action="search/" id="personalised_search" > 
           
            <div  id="personalized_search1" class="personalized_search">
           
                 <input type="hidden" name="personalized" value="1" />
                <input type="hidden" name="entity_type" id="school_entity" value="school"/>
<div class="form-group">

    <div class="form-control-wrapper userLoc" data-content="Please fill your Location details" data-trigger="focus" onclick="$('.userLoc').popover('hide');">
<input id="userLocation" class="form-control "  type="text" />

 
</div>

</div>
<div class="row">

<div class="col-md-6 col-xs-12">

<div class="form-group">
            

<select class="selectpicker form-control" name="target_class" data-style="btn-primary">
<option value="">Class/Standard</option>
<option value="0"   >Kindergarten</option>
<option value="1"   >Class 1</option>
<option value="2"  >Class 2</option>
<option value="3"  >Class 3</option>
<option value="4"  >Class 4</option>
<option value="5" >Class 5</option>
<option value="6"   >Class 6</option>
<option value="7"  >Class 7</option>
<option value="8"  >Class 8</option>
<option value="9"   >Class 9</option>
<option value="10" >Class 10</option>

</select>
        
   
</div>
</div>


<div class="col-md-6 col-xs-12">

<div class="form-group">
    <select class="selectpicker form-control" name="board" data-style="btn-primary">
<option value="">School Board</option>
 <option value="CBSE" >CBSE</option>
<option value="ICSE"  >ICSE</option>
<option value="IB" >IB</option>
<option value="State" >State</option>
 
</select> 
</div>

</div>

</div>


<div class="form-group" style="text-align:left;">
            
            <label for="inputSalaryF" class=" control-label" >Fee Range (Yearly)</label>
           <br />
            <div class="col-sm-12 col-xs-12">
          <b class="rangeTxtLow"  >12000</b>
           
          <input type="text" id="fee_range" name="fee_range"        data-slider-min="12000" data-slider-max="120000" data-slider-step="2000" data-slider-value="[24000,48000]" data-slider-orientation="horizontal" />
          
             <b  class=" rangeTxtHigh"  > &gt; 120000</b> 
             </div>
        </div>
<div class="row">





<div class="col-md-4 col-xs-12">
 <div class="radio radio-primary">
                                                <label>
                                                    <input type="radio" checked="checked" value="3"   name="school_type"  /> 
                                                    Co-Education
                                                </label>
                                            </div>
</div>
<div class="col-md-4 col-xs-12">
 <div class="radio radio-primary">
                                                <label>
                                                    <input type="radio"  value="2"     name="school_type" /> 
                                                    Boys School
                                                </label>
                                            </div>
</div>
<div class="col-md-4 col-xs-12">
 <div class="radio radio-primary">
                                                <label>
                                                    <input type="radio"  value="1"   name="school_type" /> 
                                                    Girls School
                                                </label>
                                            </div>
</div>

     

</div>



       
       <div class="form-group">
       
        <a class="btn btn-warning btn-raised btn-lg" onClick="if($('#as-values-userLocation').val().length > 1){formNav('next');}else{$('.userLoc').popover('show');}">Next <i class="fa fa-arrow-right"></i></a>
       
       </div> 

               
               
           </div>
            
           <div id="personalized_search2" class="item personalized_search">
            
            
    <fieldset>
     
        <div class="form-group full_name" data-content="Please fill your full name" data-trigger="focus" onclick="$(this).popover('hide');">
           
            <input class="form-control  floating-label" placeholder="Your Full Name" name="full_name"   />
                
           
        </div>
        <div class="form-group ">
         
        <div class="col-sm-7 email" data-content="Please Enter a valid email id" data-trigger="focus" onclick="$(this).popover('hide');">
            <input class="form-control floating-label" name="user_email" id="inputEmail" placeholder="Email" type="email"   />
           
        </div>
         <div class="col-sm-1">
               
             </div>
          <div class="col-sm-4 mobile" data-content="Please Enter a valid mobile number" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label" name="user_mobile"   placeholder="Mobile" type="phone"   />
            
        </div>
        </div>
        
        
           <div class="form-group">
           <div style="height:30px;"></div>
            <label for="inputSalaryF" class=" control-label">Select Salary Range </label>
           <br />
            <div class="col-sm-12 col-xs-12">
          <b class="rangeTxtLow"  >8000</b>
           
          <input type="text" id="salary_range" name="salary_range"      data-slider-min="8000" data-slider-max="60000" data-slider-step="2000" data-slider-value="[20000,40000]" data-slider-orientation="horizontal" />
          
             <b  class=" rangeTxtHigh"  > &gt; 60000</b> 
             </div>
        </div>
                
        
  
  
        <div class="form-group">
            <label class=" control-label">Do You have another Child studying in School?</label>
          
                <div class="radio radio-primary">
                    <label>
                        <input name="anotherChild"   value="1" onClick="if($(this).is(':checked')){ $('#sibling_school').slideDown('slow');}"  type="radio" />
                        Yes
                    </label>
                
                    <label>
                        <input name="anotherChild"   checked="" value="0" onClick="if($(this).is(':checked')){ $('#sibling_school').slideUp('slow');}" type="radio" />
                        No
                    </label>
                </div>
                
                <div style="display:none;" id="sibling_school">
            
                    <input class="form-control floating-label" id="inputSchool" name="sibling_school" placeholder="School Name"    type="text" />
            
        
            </div>
        </div>
        
          <div class="form-group">
          
              <div class=" col-sm-12 check">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="form-control" name="transportation"   value="true" />
                        <span class="checkbox-material">
                           <span class="check"></span>
                        </span>
                          Transportation
                    </label>
                </div>
                </div>
                <div class="col-sm-1">
                
                </div>
               
                <div style="clear:both"></div>
            </div>
       
           <div class="form-group">
              
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked="checked" name="job_transferable"  value="true"   class="form-control" /> 
                         <span class="checkbox-material" >
                           <span class="check" />
                        </span>
                         My Job is Transferable
                    </label>
                </div>
             
         
        </div>
        <div class="form-group">
              
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked="checked"  class="form-control"   name="accept_terms"  value="true" />  
                          <span class="checkbox-material" >
                           <span class="check" />
                        </span>
                          I agree the <a href="#">Terms &amp; Conditions</a> and read the <a href="#">Privacy Policy</a>
                    </label>
                </div>
                <br />
                
         
        </div>
        <div class="form-group" style="text-align:center">
                <a class="btn btn-default btn-raised btn-lg" onClick="formNav('back')">Back</a>
                <a  class="btn btn-primary btn-raised btn-lg" onclick="if(validateUser()){$('#personalised_search').submit()}" >Submit</a>
            
        </div>
        
        <div id="errVal" style="display:none;">
            
        </div>
    </fieldset>

               
               
           </div>
    
      </form>    
          
         
         
          
         </div>
         </div>
      </div>
   </section>
  
  
   <!--counters-->
   <section class="counters">
      <div class="container">
         <h2>Ultimate <strong>10 Years</strong> Results <i class="fa fa-smile-o"></i></h2>
         <div class="col-sm-3 appear-animation" data-appear-animation="fadeInUpDown"> <span class="counter">10</span>
            <h3>Basic Searches</h3>
         </div>
         <div class="col-sm-3 appear-animation delay_1" data-appear-animation="fadeInUpDown"> <span class="counter">1,234</span>
            <h3>Listed Schools</h3>
         </div>
         <div class="col-sm-3 appear-animation delay_2" data-appear-animation="fadeInUpDown"> <span class="counter">567</span>
            <h3>Unique Users</h3>
         </div>
         <div class="col-sm-3 appear-animation delay_3" data-appear-animation="fadeInUpDown"> <span class="counter">89</span>
            <h3>Cities Covered</h3>
         </div>
      </div>
   </section>
   <!--services-->
   <section class="service_bg">
      <div class="container-fluid">
         <div class="col-lg-8 col-md-12 col-sm-12 services">
            <div class="col-md-4 col-sm-4"> <a href="#">
               <div class="appear-animation" data-appear-animation="fadeInUp"><i class="fa fa-language"></i>
                  <h3>Inventive Design</h3>
                  <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
               </div>
               </a> </div>
            <div class="col-md-4 col-sm-4"> <a href="#">
               <div class="appear-animation delay_1" data-appear-animation="fadeInUp"><i class="fa fa-newspaper-o"></i>
                  <h3>Easy Customize</h3>
                  <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
               </div>
               </a> </div>
            <div class="col-md-4 col-sm-4"> <a href="#">
               <div class="appear-animation delay_2" data-appear-animation="fadeInUp"><i class="fa fa-clone"></i>
                  <h3>Responsive</h3>
                  <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
               </div>
               </a> </div>
            <div class="col-md-4 col-sm-4"> <a href="#">
               <div class="appear-animation " data-appear-animation="fadeInUp"><i class="fa fa-tachometer"></i>
                  <h3>High Preformance</h3>
                  <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
               </div>
               </a> </div>
            <div class="col-md-4 col-sm-4"> <a href="#">
               <div class="appear-animation delay_1" data-appear-animation="fadeInUp"><i class="fa fa-paint-brush"></i>
                  <h3>Color Options</h3>
                  <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
               </div>
               </a> </div>
            <div class="col-md-4 col-sm-4"> <a href="#">
               <div class="appear-animation delay_2" data-appear-animation="fadeInUp"><i class="fa fa-user-secret"></i>
                  <h3>Free Support</h3>
                  <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
               </div>
               </a> </div>
         </div>
         <div class="col-lg-4 col-md-12 col-sm-12 services_title">
            <h2>elegant <strong>services</strong>  <i class="fa fa-globe"></i></h2>
            <p>Lorem Ipsum is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english.Proin porta erat ligula, bibendum dapibus odio tempus sed is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english.Proin porta erat ligula, bibendum dapibus odio tempus sed.</p>
            <p>Lorem Ipsum is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english.Proin porta erat ligula, bibendum dapibus odio tempus sed.</p>
         </div>
      </div>
   </section>
   <!--workprocess-->
   <section class="workprocess">
      <div class="big_block">
         <div class="container">
            <h2 class="text-center">Work <strong>Process</strong></h2>
            <div class="row">
               <div class="col-md-3 col-sm-6"><a href="#">
                  <div class="block">
                     <div class="icon first"><i class="fa fa-bullseye"></i></div>
                     <h3>Unique Concept</h3>
                     <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
                  </div>
                  </a></div>
               <div class="col-md-3 col-sm-6"><a href="#">
                  <div class="block">
                     <div class="icon"><i class="fa fa-code"></i></div>
                     <h3>Design &amp; Coding</h3>
                     <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
                  </div>
                  </a></div>
               <div class="col-md-3 col-sm-6"><a href="#">
                  <div class="block">
                     <div class="icon"><i class="fa fa-eye"></i></div>
                     <h3>Testing</h3>
                     <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
                  </div>
                  </a></div>
               <div class="col-md-3 col-sm-6"><a href="#">
                  <div class="block">
                     <div class="icon last"><i class="fa fa-upload"></i></div>
                     <h3>Launch</h3>
                     <p>Lorem Ipsum is that has ai more normal content the making looke readable english.</p>
                  </div>
                  </a></div>
            </div>
         </div>
      </div>
   </section>
   <!--gallery-->
   
   
   <!--news-->
   <section class="big_block news">
      <div class="container">
         <div class="row">
            <h2 class="text-center">Latest <strong>News</strong></h2>
            <div class="col-sm-4">
               <div class="block style_1 appear-animation" data-appear-animation="fadeInUp">
                  <h3>HTML<strong>5</strong></h3>
                  <div class="pic"><a href="#"><img class="img-responsive" src="images/blogpic_1.jpg" alt=""/></a></div>
                  <em>January 1,2015 By : Franklin</em>
                  <p>Lorem Ipsum is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english.</p>
                  <button type="button" class="btn btn-default style_2">Learn More</button>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="block style_1 appear-animation delay_1" data-appear-animation="fadeInUp">
                  <h3>CSS<strong>3</strong></h3>
                  <div class="pic"><a href="#"><img class="img-responsive" src="images/blogpic_2.jpg" alt=""/></a></div>
                  <em>January 2,2015 By : Franklin</em>
                  <p>Lorem Ipsum is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english.</p>
                  <button type="button" class="btn btn-default style_2">Learn More</button>
                  <div class="clearfix"></div>
               </div>
            </div>
            <div class="col-sm-4">
               <div class="block style_1 appear-animation delay_2" data-appear-animation="fadeInUp">
                  <h3>word<strong>press</strong></h3>
                  <div class="pic"><a href="#"><img class="img-responsive" src="images/blogpic_3.jpg" alt=""/></a></div>
                  <em>January 3,2015 By : Franklin</em>
                  <p>Lorem Ipsum is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english.</p>
                  <button type="button" class="btn btn-default style_2">Learn More</button>
                  <div class="clearfix"></div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--testimonials-->
   <section class="testimonials big_block">
      <div class="container">
         <div class="col-sm-12 col-md-10 col-md-offset-1">
            <h2 class="style_2 text-center">thankfull <strong>Comments</strong>  <i class="fa fa-comments-o"></i> </h2>
            <div id="test_carousel" class="owl-carousel owl-theme">
               <div class="item">
                  <div class="details">
                     <p><span>&#8220;</span> Proin porta erat ligula, bibendum dapibus odio tempus sed. Ut tincidunt tincidunt erat. Ut id nisl quis enim dignissim sagittis porta erat ligula, bibendum dapibus odio tempus sed. <span>&#8221;</span></p>
                     <img src="images/comment.jpg" width="80" height="80" alt=""/>
                     <h4>George Clinton, Ui Designer</h4>
                  </div>
               </div>
               <div class="item">
                  <div class="about">
                     <p><span>&#8220;</span> Lorem Ipsum is that has ai more normal distribution of letters opposed to using content here, content the making looke readable english is that has ai more normal distribution content here. <span>&#8221;</span></p>
                     <img src="images/comment.jpg" width="80" height="80" alt=""/>
                     <h4>George Clinton, Ui Designer</h4>
                  </div>
               </div>
               <div class="item">
                  <p><span>&#8220;</span> Lorem Ipsum letters opposed to using content here, content the making looke readable english is that has ai more normal distribution of letters opposed to using content here. <span>&#8221;</span></p>
                  <img src="images/comment.jpg" width="80" height="80" alt=""/>
                  <h4>George Clinton, Ui Designer</h4>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--team-->
   <section class="team big_block">
      <div class="container">
         <h2 class="text-center">Family like a <strong>TEAM</strong></h2>
         <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12 block appear-animation" data-appear-animation="fadeIn">
               <div>
                  <div class="team-social">
                     <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                     </ul>
                  </div>
                  <img class="img-responsive" src="images/team_1.jpg" alt=""/> </div>
               <div class="details">
                  <h3>James Andreson</h3>
                  <h4>Team Lead</h4>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 block appear-animation delay_1" data-appear-animation="fadeIn">
               <div>
                  <div class="team-social">
                     <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                     </ul>
                  </div>
                  <img class="img-responsive" src="images/team_2.jpg" alt=""/> </div>
               <div class="details">
                  <h3>Lisa Rachel</h3>
                  <h4>Web Developer</h4>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 block appear-animation delay_2" data-appear-animation="fadeIn">
               <div>
                  <div class="team-social">
                     <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                     </ul>
                  </div>
                  <img class="img-responsive" src="images/team_3.jpg" alt=""/> </div>
               <div class="details">
                  <h3>Michael Jhonson</h3>
                  <h4>UI Designer</h4>
               </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 block appear-animation delay_3" data-appear-animation="fadeIn">
               <div>
                  <div class="team-social">
                     <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                     </ul>
                  </div>
                  <img class="img-responsive" src="images/team_4.jpg" alt=""/> </div>
               <div class="details">
                  <h3>witherspoon</h3>
                  <h4>UI Developer</h4>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--subscribe-->
   <section class="subscribe big_block">
      <div class="container">
         <div class="pull-left appear-animation" data-appear-animation="fadeInLeft">
            <h2 class="style_2">Subscribe Regular <strong>updates</strong></h2>
         </div>
         <div class="pull-right appear-animation" data-appear-animation="fadeInRight">
            <form class="form-inline">
               <div class="form-group">
                  <input type="email" placeholder="Enter Your Mail id here" id="" class="form-control floating-label" />
               </div>
               <a class="btn btn-raised btn-info" href="#">Subscribe</a>
            </form>
         </div>
      </div>
   </section>
   <!--clients-->
   <section class="clients big_block">
      <div class="container">
         <div id="clients_carousel" class="owl-carousel owl-theme">
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/1.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/2.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/3.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/4.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/1.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/2.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/3.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/4.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/1.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/2.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/3.png" alt=""/></a></div>
            <div class="item"><a href="#"><img class="img-responsive" src="images/carousel/4.png" alt=""/></a></div>
         </div>
      </div>
   </section>



<?php  $session->commonFooter();?>

</section>
 
<!--go-top link--> 
<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a> 
 
 
<?php $session->commonJS();?> 
 
<script src="<?php echo JS_PATH;?>custom_jquery.js"></script>
</body>
</html>