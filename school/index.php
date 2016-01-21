<?php
include('../include/session.php');

if(!isset($_REQUEST['school_code']) && !isset($_REQUEST['sc']))
header('location: '.$session->referrer);

else if(isset($_REQUEST['sc']))
$_REQUEST['school_code'] = $_REQUEST['sc'];




$address = '';
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
<body  >
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
   
   
   <!--header-->
   
   
   
       <section class="schoolResults big_block">
        <div style="height:60px;"></div>
      <div class="container-fluid">
      
         
         <div class="">
          <?php
			 //// Main Table ///
			 $query = $database->query("SELECT * FROM `school_search_info` where school_code='".$_REQUEST['school_code']."'");  
			 $data = mysqli_fetch_array($query);
			 
			 
			 			 $_SERVER['QUERY_STRING'] = 'entity_type='.$data['entity_type'].'&as_values_location='.$data['location'];

			 
			 if($data['entity_type']==0)
			 {
				 $query1 = $database->query("SELECT * FROM `school_main_info` where school_code='".$_REQUEST['school_code']."'");  
			 $data1 = mysqli_fetch_array($query1);
			 
			 if($data1['cce']!=0)
			 {
				 $cce=1;
			 }
			 else
			 {
				 				 $cce=0;

		     }
			 
			 if($data1['smc_present']==1)
			 {
				 $smc_sum=$data1['smc_parent_m']+$data1['smc_parent_f'];
				 $smc='y';
			 }
			 else
			 {
				 				 $smc='n';

		     }
			 
			 
			 $queryfty = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$_REQUEST['school_code']."'");  
			 $datafty = mysqli_fetch_array($queryfty);
			 if($datafty['playground_present']!=0)
			 {
				 $play=2;
			 }
			 else
			 {
     			 $play=0;
 
			 }
			 
			 if($datafty['no_of_computers']!=0)
			 {
				 $comp=1;
			 }
			 else
			 {
     			 $comp=0;
 
			 }
			
						 if($datafty['physics_lab']!=0)
			 {
				 $phy=1;
			 }
			 else
			 {
     			 $phy=0;
 
			 }
			 			 if($datafty['chemistry_lab']!=0)
			 {
				 $che=1;
			 }
			 else
			 {
     			 $che=0;
 
			 }
			    if(($data1['teacher_student_ratio'])<= 25) { $pt=5; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $pt=3; }
						   else if(($data1['teacher_student_ratio'])> 35) { $pt=2; }
						  
			 
			 
			 
			 $sum = $play+$comp+$phy+$che+$pt;
			 
			 
			 }
			 else
			 {
				 $query1 = $database->query("SELECT * FROM `preschool_main_info` where school_code='".$_REQUEST['school_code']."'");  
			 $data1 = mysqli_fetch_array($query1);
			 if($data1['cce']!=0)
			 {
				 $cce=1;
			 }
			 else
			 {
				 				 $cce=0;

		     }
			  if($data1['smc_present']==1)
			 {
				 $smc_sum=$data1['smc_parent_m']+$data1['smc_parent_f'];
				 $smc='y';
			 }
			 else
			 {
				 				 $smc='n';

		     }
			
			 
			 $queryfty = $database->query("SELECT * FROM `preschool_facilities_info` where school_code='".$_REQUEST['school_code']."'");  
			 $datafty = mysqli_fetch_array($queryfty);
			 if($datafty['playground_present']!=0)
			 {
				 $play=2;
			 }
			 else
			 {
     			 $play=0;
 
			 }
			 
			 if($datafty['no_of_computers']!=0)
			 {
				 $comp=1;
			 }
			 else
			 {
     			 $comp=0;
 
			 }
			
						 if($datafty['physics_lab']!=0)
			 {
				 $phy=1;
			 }
			 else
			 {
     			 $phy=0;
 
			 }
			 			 if($datafty['chemistry_lab']!=0)
			 {
				 $che=1;
			 }
			 else
			 {
     			 $che=0;
 
			 }
			    if(($data1['teacher_student_ratio'])<= 25) { $pt=5; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $pt=3; }
						   else if(($data1['teacher_student_ratio'])> 35) { $pt=2; }
						  
			 
			 
			 
			 $sum = $play+$comp+$phy+$che+$pt;
			 
			 }
			 $type=$data['entity_type'];
			 /////////
			 
			 
			 
			 
			 
			 ///// user reviews///
			 
			 $queryreview = $database->query("SELECT * FROM `user_reviews` where school_code='".$_REQUEST['school_code']."'");  
			 $rows=mysqli_num_rows($queryreview);
			 //// reviews end
			 
			 //// Medium ////
			 $medium='';
			 if($data1['instruction_medium_1']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_1']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
			 if($data1['instruction_medium_2']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_2']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
if($data1['instruction_medium_3']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_3']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
if($data1['instruction_medium_4']>0)
			 {
				 if(strlen($medium)>0)
				 {
					 $medium.=",";
				 }
			 $query21 = $database->query("SELECT * FROM `instruction_medium` where code='".$data1['instruction_medium_4']."'");  
			 $data21 = mysqli_fetch_array($query21);
			 $medium.=$data21['language'];
			 }
			 if(strlen($medium)>0)
				 {
					 $medium = $medium;
				 }
///////////////// Medium End //////////

//// Management ////
$query3 = $database->query("SELECT * FROM `school_management_master` where id='".$data1['school_management']."'");  
			 $data3 = mysqli_fetch_array($query3);
			 $management=$data3['management'];
			
/////////////////////


			  ?>
            
             
             
         
             <div class="col-sm-12">
             
             <div class="resultPagination">
                 <div class="pull-left">
                   <ul class="breadcrumb"  >
                         <li><a style="color:#FFF;"><?php echo ucwords($data1['city']);?></a></li>
                         <li><a  href="../search/?<?php echo $_SERVER['QUERY_STRING'];?>" style="color:#FFF;"><?php echo ucwords($data1['location']);?></a></li>
                         <li class="active"><?php echo ucwords($data['school_name']);?></li>
                   </ul>
                 </div>
                 
                 
                 <div style="clear:both"></div>
             </div>
             <div class="panel panel-primary"  >
                        <div class="panel-heading">
                           <div class="col-sm-10 col-xs-12">
                            <h2 class="panel-title "> <?php echo ucwords($data['school_name']);?>
                            
                            
                            </h2>
                            </div>
                            <div class="col-sm-2 col-xs-12 enquire bs-component">
                             <a class="btn btn-warning btn-raised " onClick="$('#myModalview').modal('show');"><i class="fa fa-question-circle"></i> Send Enquiry</a>
                           </div>
                           <div style="clear:both"></div>
                        </div>
                        <?php $img = $session->get_school_bcg($_REQUEST['school_code']);
						
						if(strlen($img) > 0){  $img = $img;}else{ $img = SECURE_PATH.'photos/school_bcg.jpg';}?>
                        <div class="panel-body schoolBcg" style="background:rgba(0, 0, 0, 0) url('<?php echo $img;?>') no-repeat scroll center center">
                               
                                      <div class="schoolProfileHead">
                                      <div class="schoolProfileHeadTxt">
                                      
                                           <div class="row">
                                            <div class="col-sm-3">
                                              <div class="schoolProfilePic" ><img src="<?php  echo $session->get_school_logo($_REQUEST['school_code']); ?> " alt="No Logo" title="<?php echo ucwords($data['school_name']);?>" /> </div>
                                            
                                            </div>
                                           
                                           <div class="col-sm-9">
                                             
                                             
                                              <div class="row">
                                              
                                              <div class="col-sm-7">
                                              <i class="fa fa-map-marker"></i>  <?php echo ucwords($data1['location']);?>,<span class="loc"><?php echo ucwords($data1['city']);?>,</span><?php echo ucwords($data1['district']);?>-<?php echo $data1['pincode'];?>
                                              <br />
                                             
                                             <?php if($data1['phone_number_1']!=0){ ?> <i class="fa fa-phone"></i> <?php echo $data1['phone_number_1'];?>, <?php echo $data1['phone_number_2'];?><?php } ?>
                                              <br />
                                              <i class="fa fa-envelope"></i> <?php echo $data1['email_id_1'];?>
                                              
                                               <br />
                                              <i class="fa fa-link "></i> <a href="http://<?php echo $data1['website_url'];?>"><?php echo $data1['website_url'];?></a>
                                           </div>
                                           
                                            <div class="col-sm-5">
                                                   <div class="row schoolProfileRating">
                                                      <div class="col-sm-1 check">           
                                                             <a class="btn btn-warning   btn-fab btn-raised mdi-action-grade" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-5 rating"><h2><?php echo $data['ranking'];?></h2>Overall Rating </div>
                                                      <div class="col-sm-1 check">           
                                                             <a class="btn btn-success   btn-fab btn-raised mdi-action-grade" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-5 rating"><h2><?php echo $data['user_ranking'];?></h2>User Rating  </div>   
                                                      
                                                                     
                            </div>     
                                           </div>
                                              
                                              
                                              
                                              </div>
                                           
                                           <div class="row schoolProfileInfo">
                                              
                                              <div class="col-sm-7">
                                              <div >Established: <b><?php echo $data1['establishment_year'];?></b></div>
                                              <div >Board: <b> 
											  <?php echo $session->getBoards($_REQUEST['school_code']);?> </b></div>
                                           
                                           <?php
										   if($data['entity_type']==0)
										   {
											   ?>
                                               <div >Medium: <b>
                                               
                                                <?php echo $session->getMediums($_REQUEST['school_code']);?> 
                                                                                       
                                               </b></div>

                                               <?php
										   }
										  
										   ?>
                                                                                     
                                           
                                           </div>
                                           
                                            <div class="col-sm-5">
                                                   
                                                      
                                                      <div class=" userReviews schoolProfileInfo">
                                                         
                                                          <a  href="#rev-form"> <i class="fa fa-edit"></i> Write a Review</a><br />
                                                         <a href="#reviews"> User Reviews <?php echo $rows;?></a>
                                                                  
                                                        </div>     
                                           </div>
                                              
                                              
                                              
                                              </div>
                                       
                                           </div>
                                           
                                           
                                           
                                          </div>
                                          
                                          
                                      </div>
                                      <div style="clear:both"></div>
                                      
                                      
                                      
                                    
                                      
                                      </div>
                                      
                                      
                        </div>
                    </div>
                    
           
                
                
                
                <div class="row ">
                
                  <div class="col-sm-3">
                  
                  <ul class="shortcode_sidebar">
               
               <li><a class="page_scroll" href="#summary"><i class="fa fa-chevron-right"></i> Overview</a></li>
               <li><a class="page_scroll" href="#gallery"><i class="fa fa-chevron-right"></i> Gallery</a></li>
               <li><a class="page_scroll" href="#facilities"><i class="fa fa-chevron-right"></i> Facilities</a></li>
              
               <li><a class="page_scroll" href="#rev-form"><i class="fa fa-chevron-right"></i> User Reviews</a></li>
               
               <li><a class="page_scroll" onClick="$('#myModalview').modal('show');"><i class="fa fa-chevron-right"></i> Enquire</a></li>
               
            </ul>
            
            
                  </div>
                  
                  <div class="col-sm-9 schoolProfileSummary">
                      
                      
                      <div class="panel"  id="summary">
                          <div class="panel-body">
                          
                          <h3>Overview</h3>
                          
                          <ul id="myTab" class="nav nav-tabs style_2">
                        <li class="active"><a href="#tab_content_1"><i class="fa fa-star-o"></i>
                           <h4>Quick Facts</h4>
                           </a></li>
                        <li><a href="#tab_content_2"><i class="fa fa-info"></i>
                           <h4>About Us</h4>
                           </a></li>
                           <?php if($data['entity_type']==0)
			 {
				 ?>
                        <li><a href="#tab_content_3"><i class="fa fa-clipboard"></i>
                           <h4>Admission Details</h4>
                           </a></li>
                           <?php } ?>
                         </ul>
                         <div class="tab-content style_2">
                        <div id="tab_content_1" class="tab-pane fade in active">
                                                 <ul class="quickFacts" >

<?php echo $session->get_qfacts($_REQUEST['school_code']);?> </ul>
                        </div>
                        <div id="tab_content_2" class="tab-pane fade ">
                        <?php
                        if(strlen($data1['achievements_acadamics'])>0)
						{
							echo $data1['achievements_acadamics'];
                           ?><p>
<?php echo $data1['school_introduction']; 
                        
  ?></p><?php  } else { ?>
<p><?php echo $data['school_name'];?> was established in <?php echo $data1['establishment_year'];?> and it is managed by the <?php echo $management;?>. The school consists of Grades from <?php echo $data['lowest_class'];?> to <?php echo $data['highest_class'];?> . The school is co-educational and <?php echo $session->getMediums($_REQUEST['school_code']);?> is the medium of instructions in this school. The school academic session starts in <?php echo $data1['admissions_month'];?>. This school follows the <?php echo $data1['recognized_by'];?> board. 
The School is located in <?php echo $data1['location'];?> block of <?php echo $data1['city'];?> in the state of <?php echo $data1['state'];?> and is approachable by all weather road

</p>
<p><?php echo $data1['school_introduction']; ?></p>
<?php  } ?>
                           
                           
                        
                        </div>
                        <div id="tab_content_3" class="tab-pane fade">
                         <?php
						   $date = $data1['admissions_start_date'];
						   						   $date1 = $data1['admissions_end_date'];

$t= strtotime($date);
	$t1= strtotime($date1);
					   
						   
						    if(time()>$t && time()< $t1) { ?>  <p>Admission Details: Admissions are in progress </p> <?php } else { if(($data1['admissions_start_date'])>0) {?>
                           <p>Admissions starts from <?php echo $data1['admissions_start_date'];?> to <?php echo $data1['admissions_end_date'];?>.</p><?php }} ?> 
                        </div>
                     </div>
                          </div>
                      
                      
                      </div>
                    
                       
                
                
                
                </div>
                </div>
                
                <div class="row schoolProfileSummary">
                
                  <div class="col-sm-3">
                  
           
            
            <div class="schoolProfileLeftContent ">
              <h5>School Management</h5>
              <h2><?php echo $management;?></h2>
              
               <h5>PTR (Pupil-to-Teacher Ratio)</h5>
              <h2><?php echo $data1['teacher_student_ratio'];?>:1</h2>
              
               <h5>School Timings</h5>
              <h2>MON-FRI: 08:30 AM - 03:30 PM
              <br />SAT: 08:30 AM - 01:00 PM</h2>
              
                <h5>Recognized by</h5>
              <h2><?php echo $data1['recognized_by'];?></h2>
              
                <h5>School Type</h5>
              <h2>Independent</h2>
             
                <h5>Type Of School</h5>
              <h2>Independent</h2>
              
            </div>
                  </div> 
                     
                       <div class="col-sm-9 ">
                      
                   
                        <div class="panel"  id="facilities">
                      
                      <div class="panel-body">
                          
                          <h3>Infrastructure</h3>
                          
                          <ul id="myTab2" class="nav nav-tabs style_2">
                        <li class="active"><a href="#tab2_content_1"><i class="fa fa-list"></i>
                           <h4>Facilities</h4>
                           </a></li>
                        <li><a href="#tab2_content_2"><i class="fa fa-bus"></i>
                           <h4>Transportation</h4>
                           </a></li>
                        <li><a href="#tab2_content_3"><i class="fa fa-map-marker"></i>
                           <h4>Map</h4>
                           </a></li>
                         </ul>
                         <div class="tab-content style_2">
                         <?php
						 
						 $transportation = 0;
						 $transport_routes = '';
						 
						  if($type==0)
						 {
							 $queryfacility = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$_REQUEST['school_code']."'");  
			 $datafacility = mysqli_fetch_array($queryfacility);
							 ?>
                        <div id="tab2_content_1" class="tab-pane fade in active facilities">
                                <div class="row" >
                                
                                <?php
								if($datafacility['library_present']==1)
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="<?php echo $datafacility['no_of_books_lib'];?> Books available">
                                 <h3><i class="fa fa-book text-success" ></i> Library</h3>
                               </div>
                                    <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Library">
                                 <h3><i class="fa fa-book" ></i> Library</h3>
                               </div>
                                    <?php
								}
								?>
                               
                              <?php
								if($datafacility['no_of_computers']!=0)
								{
									?>
                                 <div class="col-sm-3" data-toggle="tooltip" title="<?php echo $datafacility['no_of_computers'];?> Computers available">
                                 <h3><i class="fa fa-desktop text-success" ></i> Computer labs</h3>
                               </div>
                               <?php 
							   } 
							   else
							    {
									?>
                                     <div class="col-sm-3" data-toggle="tooltip" title="Computer labs">
                                 <h3><i class="fa fa-desktop" ></i> Computer labs</h3>
                               </div>
                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['medical_checkup']!=0)
								{
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Medical Checkup Available">
                                 <h3><i class="fa fa-medkit  text-success" ></i> Medical</h3>
                               </div>
                               <?php
								}
								else
								{
									?>
                                     <div class="col-sm-3" data-toggle="tooltip" title="Medical Not Available">
                                 <h3><i class="fa fa-medkit  " ></i> Medical</h3>
                               </div>
                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['transport_provided']!=0)
								{
									$transportation = 1;
									$transport_routes = $datafacility['transport_routes'];
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Transportation Provided">
                                 <h3><i class="fa fa-bus text-success" ></i> Transportation</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Transportation">
                                 <h3><i class="fa fa-bus " ></i> Transportation</h3>
                               </div>
                                    <?php
								}
								?>
                               
                               
                               
                            </div>
                            
                            <div class="row">
                            
                            <?php
								if($datafacility['smart_class']!=0)
								{
									?>
                               <div class="col-sm-3" data-toggle="tooltip" title="Smart Rooms Available">
                                 <h3><i class="fa fa-object-group text-success  " ></i> Smart Rooms</h3>
                               </div>
                               <?php
								}
								else
								{
									?>
                                   <div class="col-sm-3" data-toggle="tooltip" title="Smart Rooms Not Available">
                                 <h3><i class="fa fa-object-group" ></i> Smart Rooms</h3>
                               </div> 
                                    <?php
								}
                              ?>
                              
                              
                               <?php
								if($datafacility['cctv_present']!=0)
								{
									?>
                                 <div class="col-sm-3" data-toggle="tooltip" title="CCTV Installed">
                                 <h3><i class="fa fa-video-camera text-success" ></i> CCTV</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="CCTV not Installed">
                                 <h3><i class="fa fa-video-camera " ></i> CCTV</h3>
                               </div>
                                    <?php
								}
								?>
                               
                               
                               
                               <?php
								if($datafacility['playground_present']!=0)
								{
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Play Ground Available">
                                 <h3><i class="fa fa-futbol-o text-success" ></i> Play Ground </h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Play Ground Not Available">
                                 <h3><i class="fa fa-futbol-o " ></i> Play Ground</h3>
                               </div>
                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['internet']!=0)
								{
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Wifi Available">
                                 <h3><i class="fa fa-wifi text-success" ></i> Wifi</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Wifi Not Available">
                                 <h3><i class="fa fa-wifi  " ></i> Wifi</h3>
                               </div>
                                    <?php
								}
								?>
                            </div>
                            
                            
                            <div class="row">
                            
                             <?php
								if($datafacility['cafeteria_present']!=0)
								{
									?>
                               <div class="col-sm-3" data-toggle="tooltip" title="Cafetaria Available">
                                 <h3><i class="fa fa-coffee  text-success" ></i> Cafetaria</h3>
                               </div>
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Cafetaria Not Available">
                                 <h3><i class="fa fa-coffee  " ></i> Cafetaria</h3>
                               </div>
                                    <?php
								}
								?>
                              
                              
                              <?php
								if($datafacility['security']!=0)
								{
									?>
                                 <div class="col-sm-3" data-toggle="tooltip" title="Security &amp; Safety">
                                 <h3><i class="fa fa-lock text-success" ></i> Security &amp; Safety</h3>
                               </div>
                               
                               <?php
								}
								else
								{
								?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Security &amp; Safety">
                                 <h3><i class="fa fa-lock" ></i> Security &amp; Safety</h3>
                               </div>  
                                 <?php
								}
									?>
                               
                               
                               <?php
								if($datafacility['ac_classrooms']!=0)
								{
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="AC Class rooms  Available">
                                 <h3><i class="fa fa-asterisk text-success " ></i> AC Class rooms</h3>
                               </div>
                               
                               <?php 
								} 
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="AC Class rooms Not Available">
                                 <h3><i class="fa fa-asterisk  " ></i> AC Class rooms</h3>
                               </div>
                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['auditorium']!=0)
								{
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Auditorium Available">
                                 <h3><i class="fa fa-university text-success" ></i> Auditorium</h3>
                               </div>
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Auditorium Not Available">
                                 <h3><i class="fa fa-university" ></i> Auditorium</h3>
                               </div>
                                    <?php
								}
								?>
                               
                            </div>
                            
                            <br />
                            <p class="facilitiesSub">Sports Activities: <span><?php echo $datafacility['sports_activities'];?></span></p>
                           <p class="facilitiesSub">Extra Curricular Activities: <span><?php echo $datafacility['extra_curricular_activities'];?></span></p>
                            
                        </div>
                        <?php } else {
							
							
							$queryfacility = $database->query("SELECT * FROM `preschool_faciliities_info` where school_code=".$_REQUEST['school_code']."");  
			 $datafacility = mysqli_fetch_array($queryfacility);
							 ?> <div id="tab2_content_1" class="tab-pane fade in active facilities">
                                <div class="row">
                                
                                 <?php
								if($datafacility['doctor_present']!=0)
								{
									?>
                               <div class="col-sm-3" data-toggle="tooltip" title="Doctor Available">
                                 <h3><i class="fa  fa-stethoscope text-success" ></i> Doctor</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Doctor Not Available">
                                 <h3><i class="fa fa-stethoscope" ></i> Doctor</h3>
                               </div>
                                    <?php
								}
								?>
                              
                              
                              <?php
								if($datafacility['cctv_present']!=0)
								{
									?>
                                 <div class="col-sm-3" data-toggle="tooltip" title="CCTV Available ">
                                 <h3><i class="fa fa-camera text-success" ></i> CCTV </h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="CCTV Not Available">
                                 <h3><i class="fa fa-camera" ></i> CCTV </h3>
                               </div>
                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['playarea_present']!=0)
								{
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Play Area Available">
                                 <h3><i class="fa fa-futbol-o text-success" ></i> Play-Area</h3>
                               </div>
                               
                               <?php
								}
								 else
								 {
									 ?>
                                     <div class="col-sm-3" data-toggle="tooltip" title="Play Area Not Available">
                                 <h3><i class="fa fa-futbol-o " ></i> Play-Area</h3>
                               </div>
                                     <?php
								 }
								 ?>
                                 
                                 <?php
								if($datafacility['transport_provided']!=0)
								{
									$transportation = 1;
									$transport_routes = $datafacility['transport_routes'];
									?>
                                  <div class="col-sm-3" data-toggle="tooltip" title="Transportation Provided">
                                 <h3><i class="fa fa-bus text-success" ></i> Transportation</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="No Transportation Not Available">
                                 <h3><i class="fa fa-bus " ></i> Transportation</h3>
                               </div>
                                    <?php
								}
								?>
                                 
                                 
                            </div>
                            
                            
                            <div class="row">
                            
                            <?php
								if($datafacility['food_served']!=0)
								{
									?>
                               <div class="col-sm-3" data-toggle="tooltip" title="Food Served ">
                                 <h3><i class="fa fa-apple text-success  " ></i> Food Served</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                    <div class="col-sm-3" data-toggle="tooltip" title="Food Not Served">
                                 <h3><i class="fa fa-apple  " ></i> Food Served</h3>
                               </div>
                                    <?php
								}
								?>
                                
                                <?php
								if($datafacility['splashpool_present']!=0)
								{
									?>
                              
                                 <div class="col-sm-3" data-toggle="tooltip" title="Splash Pool Available">
                                 <h3><i class="fa fa-dot-circle-o text-success  " ></i> Splash Pool </h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                   <div class="col-sm-3" data-toggle="tooltip" title="Splash Pool Not Available ">
                                 <h3><i class="fa fa-dot-circle-o " ></i> Splash Pool</h3>
                               </div> 
                                    <?php
								}
								?>
                                
                                 <?php
								if($datafacility['fieldtrips_present']!=0)
								{
									?>
                              
                                 <div class="col-sm-3" data-toggle="tooltip" title="Field Trips Available">
                                 <h3><i class="fa fa-asterisk text-success  " ></i> Field trips</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                   <div class="col-sm-3" data-toggle="tooltip" title="Field Trips Not Available">
                                 <h3><i class="fa fa-asterisk" ></i> Field trips</h3>
                               </div> 
                                    <?php
								}
								?>
                               
<?php
								if($datafacility['recovery_room']!=0)
								{
									?>
                              
                                 <div class="col-sm-3" data-toggle="tooltip" title="Recovery Room Available">
                                 <h3><i class="fa fa-hospital-o text-success  " ></i> Recovery Room</h3>
                               </div>
                               
                               <?php
								}
								else
								{
									?>
                                   <div class="col-sm-3" data-toggle="tooltip" title="Recovery Room Not Available">
                                 <h3><i class="fa fa-hospital-o" ></i> Recovery Room</h3>
                               </div> 
                                    <?php
								}
								?>                                  
                               
                                  
                            </div>
                            
                            
                            
                            
                            <br />
                            <p class="facilitiesSub">Sports Activities: <span><?php echo $datafacility['sports_activities'];?></span></p>
                           <p class="facilitiesSub">Extra Curricular Activities: <span><?php echo $datafacility['extra_curricular_activities'];?></span></p>
                            
                        </div><?php } ?>
                        <div id="tab2_content_2" class="tab-pane fade">
                           
                           
                           <div id="mapPointers">
                          
							 </div>
						    
                           
                           
                           
                        </div>
                        <div id="tab2_content_3" class="tab-pane fade">
                          
                          <small><a href="https://maps.google.com/maps?q=<?php echo ucwords($data['school_name']);?>,<?php echo ucwords($data1['location']);?>,<?php echo ucwords($data1['city']);?>,</span><?php echo ucwords($data1['district']);?>%20<?php echo $data1['pincode'];?>&t=m&hl=en&ie=UTF8&ll=<?php echo $data1['latitude'];?>,<?php echo $data1['longitude'];?>&spn=0.023859,0.036564&z=12&iwloc=Asource=embed" style="color:#0000FF;text-align:left" target="_blank">View Larger Map</a></small><br />
   <iframe width="100%" height="240px" frameborder="0" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?php echo ucwords($data['school_name']);?>,<?php echo ucwords($data1['location']);?>,<?php echo ucwords($data1['city']);?>,</span><?php echo ucwords($data1['district']);?>%20<?php echo $data1['pincode'];?>+&t=m&hl=en&ie=UTF8&ll=<?php echo $data1['latitude'];?>,<?php echo $data1['longitude'];?>&amp;t=m&amp;hl=en&amp;ie=UTF8&amp;source=embed&amp;z=12&amp;output=embed&amp;title=<?php echo $data['school_name'];?>"></iframe>
                          
                        </div>
                     </div>
                          </div>
                      
                      </div>
                  
                    </div>
                  </div>
                
                <div class="row ">
                
                <div class="col-sm-12 schoolProfileSummary">
                  <div class="panel"  id="gallery">
                          <div class="panel-body">
                          
                          <h3>Gallery</h3>
                          
                          <ul id="myTab3" class="nav nav-tabs style_2">
                        <li class="active"><a href="#tab3_content_1"><i class="fa fa-info"></i>
                           <h4>Photos</h4>
                           </a></li>
                        <li><a href="#tab3_content_2"><i class="fa fa-film"></i>
                           <h4>Videos</h4>
                           </a></li>
                        <li><a href="#tab3_content_3"><i class="fa fa-rotate-270"></i>
                           <h4>360<sup>o</sup> View</h4>
                           </a></li>
                         </ul>
                         <div class="tab-content style_2">
                        <div id="tab3_content_1" class="tab-pane fade in active">
                           
                             <section class="gallery">
      <div class="container-fluid">
      <?php
	  $gal = $session->get_school_gallery($_REQUEST['school_code']);
	  
	  if(count($gal) > 0){
            		foreach ($gal as $key =>$val){
?>

<div class="col-md-3 col-sm-4 col-xs-12 gallery_item">
            <div  ><span class="popup-gallery "> <a href="<?php echo $val;?>" ><img class="img-responsive" src="<?php echo $val;?>" alt=""/>
               
                   </a></span>
                   
            </div>
         </div>
          
                    <?php } 
					
					}?>

      </div>
   </section>
                        
                        </div>
                        <div id="tab3_content_2" class="tab-pane fade">
                         <section class="gallery">
      <div class="container-fluid">
      <?php
	  
	  $vid_array =$session->get_school_videos($_REQUEST['school_code']);
	  
	  if(count($vid_array) > 0){
            		foreach ($vid_array as $key =>$val){
?>
         <div class="col-md-3 col-sm-4 col-xs-12 gallery_item">
            <div class="appear-animation" data-appear-animation="fadeIn">

 
<div id="jp_container_1" class="jp-video jp-video-360p"  role="application" aria-label="media player">
	<div class="jp-type-single">
		<div id="jquery_jplayer_1" class="jp-jplayer"></div>
		<div class="jp-gui">
			<div class="jp-video-play">
				<button class="jp-video-play-icon" role="button" tabindex="0">play</button>
			</div>
			<div class="jp-interface">
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
				<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
				<div class="jp-controls-holder">
					<div class="jp-controls">
						<button class="jp-play" role="button" tabindex="0">play</button>
						<button class="jp-stop" role="button" tabindex="0">stop</button>
					</div>
					<div class="jp-volume-controls">
						<button class="jp-mute" role="button" tabindex="0">mute</button>
						<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
						<div class="jp-volume-bar">
							<div class="jp-volume-bar-value"></div>
						</div>
					</div>
					<div class="jp-toggles">
						<button class="jp-repeat" role="button" tabindex="0">repeat</button>
						<button class="jp-full-screen" role="button" tabindex="0">full screen</button>
					</div>
				</div>
				<div class="jp-details">
					<div class="jp-title" aria-label="title">&nbsp;</div>
				</div>
			</div>
		</div>
		
	</div>
</div>      <br>
<br>
<br>
<br>
          
            </div>
         </div>
                    <?php } 
	  }
	  else{
		?>
        
        <br />
        
        <p align="center"> No Videos Found</p>
        <br />
        <?php  
		  
	  }?>

      </div>
   </section>
                         
                        </div>
                        <div id="tab3_content_3" class="tab-pane fade">
                           
                           
                           <section class="gallery">
      <div class="container-fluid ">
      <?php
	  
	  $pan_array =$session->get_school_panaroma($_REQUEST['school_code']);
	  
	  if(count($pan_array) > 0){
            		foreach ($pan_array as $key =>$val){
?>   
<div class="cycle" style="background:url(<?php echo $val;?>);height:512px;margin-bottom:12px;"></div>
              
        
                    <?php } 
	  }
	  else{
		?>
        
        <br />
        
        <p align="center"> No Views Found</p>
        <br />
        <?php  
		  
	  }?>

      </div>
   </section>
                           
                           
                           
                        </div>
                     </div>
                          </div>
                      
                      
                      </div>
                </div>
                
                </div>
                
                
                
         <div style="clear:both"></div>
         <div class=" similarSchools featuredSchools">
        
              <?php
			 $school_codes="'".$_REQUEST['school_code']."',";
			 
			 $main_table = 'school_main_info';
					if($data['entity_type'] == 1){
						$main_table = 'preschool_main_info';
						 
					}
					
			 
			 
			 
			 $queryfeatured=$database->query("SELECT school_search_info.*,school_search_info.school_code from school_search_info,".$main_table." WHERE (school_search_info.school_code = ".$main_table.".school_code) AND ".$main_table.".advertiser_rank < 10 AND school_search_info.entity_type = ".$data['entity_type']." AND ((school_search_info.location LIKE '".$data1['location']."%')) AND (school_search_info.school_code!=".$_REQUEST['school_code'].") ORDER BY advertiser_rank ASC,ranking DESC,user_ranking DESC LIMIT 0,3 ");
			// $queryfeatured=$database->query("SELECT * from school_main_info s,school_search_info m where (s.school_code = m.school_code)  order by s.school_code DESC LIMIT 0,3 ");
			if(mysqli_num_rows($queryfeatured)>0)
			{
				?>
                     <h2>Featured Schools</h2>
             
             <div class="row">
                <?php
				
				
				
			while($datafeatured=mysqli_fetch_array($queryfeatured))
			{
				?>
			 
                  
            <div class="col-sm-4">
             <div class="panel panel-warning">
                    
                        <div class="panel-body">
                               
                               <div class="col-sm-4">
                                          <img src="<?php echo $session->get_school_logo($datafeatured['school_code']);?>" alt="No Logo" title="<?php echo $datafeatured['school_name'];?>" />
                                 </div>
                                 <div class="col-sm-8">
                                     <div class="row schoolProfileRating">
                                                      <div class="col-sm-2 check">           
                                                             <a class="btn btn-warning   btn-fab btn-raised mdi-action-grade" data-toggle="tooltip" title="Overall Rating" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-4 rating"><h2><?php echo $datafeatured['ranking'];?></h2></div>
                                                      <div class="col-sm-2 check">           
                                                             <a class="btn btn-success   btn-fab btn-raised mdi-action-grade" data-toggle="tooltip" title="User Rating" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-4 rating"><h2><?php echo $datafeatured['user_ranking'];?></h2></div>   
                                                      
                                                                     
                            </div>
                            
                              <div >Established: <b><?php echo $session->get_name($main_table,'school_code',$datafeatured['school_code'],'establishment_year');?></b></div>
                                              <div >Board: <b><a><?php echo $session->getBoards($datafeatured['school_code']);?></a></b></div>
                                           <div >Medium: <b><a><?php echo $session->getMediums($datafeatured['school_code']);?></a></b></div>
                                          
                                 </div>
                                      
                        </div>
                            <div class="panel-footer">
                            <h2 class="panel-title"><a href="../school?sc=<?php echo $datafeatured['school_code'];?>" ><?php echo $datafeatured['school_name'];?></a></h2>
                            <h5><i class="fa fa-map-marker"></i> <span class="loc"><?php echo ucwords($datafeatured['location']);?></span>, <?php echo ucwords($datafeatured['city']);?></h5>
                        </div>
                    </div>
                  </div>
                  
                  <?php
 $school_codes.= "'".$datafeatured['school_code']."',";
                       ?> 
                         
               
                <?php }
				
				?>
                       
                  
                  
         </div>
                <?php
				
				}  ?>
                  
                  
            
          
         </div>
         
         <div class=" similarSchools">
           
             <?php
			 //
			 
			 
			 $school_codes=trim($school_codes,' ,');
			  
			 
			  $sc=" school_search_info.entity_type = ".$data['entity_type']." AND school_code NOT IN (".$school_codes.") AND ";
			
			 $querysimilar=$database->query("SELECT school_search_info.*  from school_search_info  WHERE   ".$sc."  (school_search_info.location LIKE '".$data1['location']."%') ORDER BY ranking DESC,user_ranking DESC LIMIT 0,3 "); 
               //$querysimilar=$database->query("SELECT * from school_main_info s,school_search_info m where (s.school_code = m.school_code)  order by s.school_code DESC LIMIT 0,3 ");
			if(mysqli_num_rows($querysimilar)>0)
			{
				
				?>
                  <h2>Similar Schools</h2>
             
             <div class="row">
                <?php
				
				
			while($datasimilar=mysqli_fetch_array($querysimilar))
			{
				?>
			 
                  
            <div class="col-sm-4">
             <div class="panel panel-warning">
                    
                        <div class="panel-body">
                               
                               <div class="col-sm-4">
                                          <img src="<?php echo $session->get_school_logo($datasimilar['school_code']);?>" alt="No Logo" title="<?php echo $datasimilar['school_name'];?>"  />
                                 </div>
                                 <div class="col-sm-8">
                                     <div class="row schoolProfileRating">
                                                      <div class="col-sm-2 check">           
                                                             <a class="btn btn-warning   btn-fab btn-raised mdi-action-grade" data-toggle="tooltip" title="Overall Rating" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-4 rating"><h2><?php echo $datasimilar['ranking'];?></h2></div>
                                                      <div class="col-sm-2 check">           
                                                             <a class="btn btn-success   btn-fab btn-raised mdi-action-grade" data-toggle="tooltip" title="User Rating" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-4 rating"><h2><?php echo $datasimilar['user_ranking'];?></h2></div>   
                                                      
                                                                     
                            </div>
                            
                              <div >Established: <b><?php echo $session->get_name($main_table,'school_code',$datasimilar['school_code'],'establishment_year');?></b></div>
                                              <div >Board: <b> <?php echo $session->getBoards($datasimilar['school_code']);?> </b></div>
                                           <div >Medium: <b> <?php echo $session->getMediums($datasimilar['school_code']);?> </b></div>
                                          
                                 </div>
                                      
                        </div>
                            <div class="panel-footer">
                            <h2 class="panel-title"><a href="../school?sc=<?php echo $datasimilar['school_code'];?>" ><?php echo ucwords($datasimilar['school_name']);?></a></h2>
                            <h5><i class="fa fa-map-marker"></i> <span class="loc"><?php echo ucwords($datasimilar['location']);?></span>, <?php echo ucwords($datasimilar['city']);?></h5>
                        </div>
                    </div>
                  </div>
                   
               
                <?php }
				
				
				
				?>
                          
         </div>
                <?php
				
				}  ?>
               
                  
                
                  
               
                  
                     
                  
        
          
         </div>
          
          
		  <?php
$count=0;
$nameerr='';
$phoneerr='';
$emailerr='';
$school_nameerr='';
$school_code=$_REQUEST['school_code'];
$reviewerr='';

	   $success = 0;  

if(isset($_POST['submit']))
		  {
			 
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$fee=$_POST['fee'];
$school_name=$_POST['school_name'];
$review=$_POST['review'];
$exp=$_POST['exp'];
$aca=$_POST['aca'];
$infra=$_POST['infra'];
$fee_cost=$_POST['fee_cost'];
$money=$_POST['money'];
$school_code=$_POST['school_code'];

if(strlen($name)==0)
	  {
		  	

		$nameerr="*Please enter your name ";
		$count++;
	   }
	   
	   if(strlen($email)==0)
	  {
		  	

		$emailerr="*Please enter your email id ";
		$count++;
	   }
	   
elseif(strlen($email) > 0){
         /* Check if valid email address */
         $regex = "~^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
                 ."@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
                 ."\.([a-z]{2,}){1}$~";
         
                $email = stripslashes($email);
         if(!preg_match($regex,$email)){
$emailerr="*Invalid email id ";
		$count++;         }
        
    }
	  
	   
	   
	   
	   if(strlen($phone)==0)
	  {
		  	

		$phoneerr="*Please enter your mobile no ";
		$count++;
	   }
	    else if(strlen($phone) < 10){
$phoneerr="*Mobile number below 10 digits ";
		$count++;     }
    else if(strlen($phone) > 10){
             $phoneerr="* Mobile number above 10 digits";
			 		$count++;

      }
     /* mobile number check */
     else if(!preg_match("~^([7-8-9]{1}[0-9]{9})+$~", $phone)){
              $phoneerr = "* Invalid Mobile number";
			  		$count++;

      }

	  
	    if(strlen($review)==0)
	  {
		  	

		$reviewerr="*Please enter your review ";
		$count++;
	   }
	
if($count==0)
{
$query = $database->query("insert into user_reviews values(NULL,'".$name."','".$school_code."','".$fee."','".$review."',0,'".$phone."','".$email."','".$school_name."','".$exp."','".$aca."','".$fee_cost."','".$infra."','".$money."','".time()."')");

$success = 1;
}

		  }
		 
?>


      
                
                <div class="row reviewForm" id="rev-form">
                
                <div class="col-sm-12 schoolProfileSummary">
                  <div class="panel"  id="">
                          <div class="panel-body">
                          
                          <h3>Write a Review</h3>
                          
                        <div  class="item personalized_search"  >
            
               <form class=" bs-component" action="index.php?school_code=<?php echo $_REQUEST['school_code'];?>#rev-form" method="post">
    <fieldset>
     
        <div class="form-group">
           
                <input class="form-control  floating-label" id="name" value="<?php if(isset($_POST['name'])){ echo $_POST['name']; }  ?>" name="name" placeholder="Your Full Name">
                

        <font style="color:#F00"><?php echo $nameerr ?></font>
        </div>
                        <div class="form-group">
         
        <div class="col-sm-7 email check"><input class="form-control floating-label" id="email" placeholder="Email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }  ?>" type="email">
                 <font style="color:#F00"><?php echo $emailerr ?></font>
  
        </div>
         
         <div class="col-sm-1">
               
             </div>
          <div class="col-sm-4 mobile check">
               <input class="form-control floating-label" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; }  ?>" name="phone" id="phone" placeholder="Mobile" type="phone">
                    <font style="color:#F00"><?php echo $phoneerr ?></font>

        </div>
        
        </div>
        <br>
<br>

        
           <div class="form-group">
           <div style="height:30px;"></div>
            <label for="inputSalaryF" class=" control-label">Select Fee (Yearly) </label>
           <br />
            <div class="col-sm-12 col-xs-12">
          <b class="rangeTxtLow"  >8000</b>
           
         <input type="text" id="salary_range"  name="fee"  value="<?php if(isset($_REQUEST['fee'])){ echo $_REQUEST['fee']; }  ?>"   data-slider-min="8000" data-slider-max="60000" data-slider-step="2000" data-slider-value="24000" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  > &gt; 60000</b> 
             </div>
        </div>
                
        
    <br />
               
  
      <br />
            
        
            <div class="form-group">
         
               
               <input class="form-control floating-label" value="<?php if(isset($data['school_name'])){ echo $data['school_name']; }  ?>" name="school_name" id="inputSchool" placeholder="School Name of your child" type="hidden">

        </div>
         
       
             <div class="form-group">
             
               <textarea class="form-control floating-label" name="review" id="inputSchool" placeholder="Review" rows="4" ><?php if(isset($_POST['review'])){ echo $_POST['review']; }  ?> </textarea>
                                  <font style="color:#F00"><?php echo $reviewerr ?></font>

        </div>
        
        <div class="form-group">
           <div style="height:30px;"></div>
            <label for="inputSalaryF" class=" control-label">Ratings </label>
           <br />
           <div class="row">
            <div class="col-sm-4 col-xs-4">
            
            Overall Experience
            </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating1"  name="exp"   value="<?php if(isset($_REQUEST['exp'])){ echo $_REQUEST['exp']; }  ?>"   data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
            Academics </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating2"    value="<?php if(isset($_REQUEST['aca'])){ echo $_REQUEST['aca']; }  ?>" name="aca"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             
             
              </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
           Infrastructure </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating3"   value="<?php if(isset($_REQUEST['infra'])){ echo $_REQUEST['infra']; }  ?>"   name="infra"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             
               </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
            Fee &amp; Cost </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating4"  value="<?php if(isset($_REQUEST['fee_cost'])){ echo $_REQUEST['fee_cost']; }  ?>"   name="fee_cost"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             
               </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
            Value for Money </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating5"  value="<?php if(isset($_REQUEST['money'])){ echo $_REQUEST['money']; }  ?>"   name="money"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
         
         <input type="hidden" name="school_code" value="<?php echo $_REQUEST['school_code'];?>">
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             </div>
        </div>
        <div class="form-group" style="text-align:center">
            
               <input type="submit" class="btn btn-primary btn-raised btn-lg" name="submit" value="Submit">
            
        </div>
    </fieldset>
</form>
               
               
           </div>
           
           
                        <hr />
                           <h3 id="reviews">Read Reviews</h3>
                           
         
 
               

                           <div class="reviewsDisplay">
                           <?php
                           $queryreview = $database->query("SELECT * FROM `user_reviews` where school_code='".$_REQUEST['school_code']."' order by id desc limit 10");  
						   
						   if(mysqli_num_rows($queryreview)> 0){
			 while($datareview = mysqli_fetch_array($queryreview))
			 {?>
			

                             <div class="well">
                              <p><?php echo $datareview['username'];?>.</p>
                           - <i> <?php echo $datareview['review'];?> (<b><?php echo $data['school_name'];?></b>)</i>
                           </div>
                           
                        <?php  } 
						   }
						   else{
							?>
                            
                             <div class="well">
                              <p align="center">No reviews yet. Be the first one to rate this School!!</p>
                           
                           </div>
                            
                            <?php   
							   
						   }
						?>    
                           
                            
                           </div>
                         
                          </div>
                      
                      
                      </div>
                </div>
                
                </div>
             
                
               
             </div>
             
             <!--<div class="col-md-4 col-sm-8">
             
                <div class="adBox">
                Ads here
                
                </div>
                
                <div class="adBox">
                Space left for Links
                
                </div>
                
                
                <div class="adBox">
                Space Left for Links
                
                </div>
             </div>-->
         
         
         
     
     
         
      </div>
      </div>
      
   </section>
   

  
<?php  $session->commonFooter();?>

</section>
 <?php $session->commonJS();

?>
<script type="text/javascript">
 						     
							   
							   var geocoder;
  var map;
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
 
  
 // initialize();
  
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(17.3700, 78.4800);
    var mapOptions = {
      zoom: 14,
      center: latlng,
       mapTypeId : google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("mapPointers"), mapOptions);
     directionsDisplay.setMap(map);

    //initMap();
}

 function initMap(){
     
 var addr = '<?php echo $data['location'];?>';
  // addr_list = addr.split(",");
   
   var address = addr;
 
    var position;
 
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        
            map.setCenter(results[0].geometry.location);
       
            
            position = results[0].geometry.location;
       
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  
      var waypts = [];
	 
	 <?php
	    if($transportation > 0){
			
		   $rt = explode(',',$transport_routes);	
			
		    if(count($rt) > 0){
				for($i=1;$i < (count($rt)-1);$i++){
			   	?>
					 waypts.push({
	    					location: '<?php echo $rt[$i];?>',
     						stopover: true
					 });
				<?php
				}
			}
			?>
			  directionsService.route({
    origin: '<?php echo $rt[0];?>',
    destination: '<?php echo end($rt);?>',
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
      var summaryPanel = document.getElementById('directions-panel');
      summaryPanel.innerHTML = '';
      // For each route, display summary information.
      for (var i = 0; i < route.legs.length; i++) {
        var routeSegment = i + 1;
        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
            '</b><br>';
        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
      }
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
			<?php
		}
	 
	 
	 ?>
     
	 
	 
	 
    
 }
 
 
 

	 
 </script>
 <script src="<?php echo JS_PATH;?>custom_jquery.js"></script>  
<?php
  $videos = $session->get_school_videos($_REQUEST['school_code']);
  
  if(count($videos) > 0){
            		foreach ($videos as $key =>$val){
						
?>
      
 <script type="text/javascript">
//<![CDATA[

	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				m4v: "<?php echo $val;?>",
				ogv: "<?php echo $val;?>",
				webmv: "<?php echo $val;?>",
				poster: "<?php echo $val;?>"
			});
		},
		swfPath: "<?php echo JS_PATH;?>jplayer",
		supplied: "webmv, ogv, m4v",
		size: {
			width: "400px",
			height: "200px",
			cssClass: "jp-video-360p"
		},
		useStateClassSkin: true,
		autoBlur: false,
		smoothPlayBar: true,
		keyEnabled: true,
		remainingDuration: true,
		toggleDuration: true
	});
	

//]]>


</script>
               
                    <?php }
  }?>
<?php
if($success > 0){
?> 
 <script type="text/javascript">
	 
                

function viewmap(){
	
}
	</script>  
<script type="text/javascript">
	$('#myModal2').modal('show');
   $("#name").val('');
   $("email").val('');
   $("phone").val('');
   $("review").val('');

	</script>
    
    
  <?php
 $success =0; 
}
  ?>
<!--go-top link--> 
<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a> 
 


                           <div class="reviewsDisplay" id="reviews">
                           <?php
                         $queryreview = $database->query("SELECT * FROM `user_reviews` where school_code='".$_REQUEST['school_code']."'");   
			 while($datareview = mysqli_fetch_array($queryreview))
			 {?>
			

                             <div class="well">
                              <p><?php echo $datareview['name'];?>.</p>
                           - <i> <?php echo $datareview['review'];?> (<b><?php echo $data['school_name'];?></b>)</i>
                           </div>
                           
                        <?php  } ?>   
                        </div> 
                
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal2" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Thankyou!</h4>
                      </div>
                      <div class="modal-body">
                          Your Review Posted Successfully.
                      </div>
                  </div>
              </div>
          </div> 
          
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalview" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body" id="returnval">
<form class="bs-component"   > 
           
            
            
           <div class="item personalized_search">
            
            
    <fieldset>
     
        <div class="form-group full_name" data-content="Please fill your full name" data-trigger="focus" onclick="$(this).popover('hide');">
           
            <input class="form-control  floating-label"  value="<?php if(isset($_POST['full_name'])){ echo $_POST['full_name'];}?>" id="full_name" placeholder="Your Full Name" name="full_name"   />
                
           
        </div>
         
        <div class="form-group user_email" data-content="Please Enter a valid email id" data-trigger="focus" onclick="$(this).popover('hide');">
            <input class="form-control floating-label" value="<?php if(isset($_POST['user_email'])){ echo $_POST['user_email'];}?>" name="user_email" id="user_email" placeholder="Email" type="text"   />
           
        </div>
               
            
          <div class="form-group  user_mobile" data-content="Please Enter a valid mobile number" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['user_mobile'])){ echo $_POST['user_mobile'];}?>" name="user_mobile" id="user_mobile"   placeholder="Mobile" type="text"   />
            
        </div>
        
    
    
    
     <div class="form-group  age" data-content="Please Enter Your Age" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['age'])){ echo $_POST['age'];}?>" name="age" id="age"   placeholder="Age" type="text"   />
            
        </div>
        
        
         <div class="form-group  qualification" data-content="Please Enter Your Qualification" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['qualification'])){ echo $_POST['qualification'];}?>" name="qualification" id="qualification"   placeholder="Qualification" type="text"   />
            
        </div>
        
        <div class="form-group  location" data-content="Please Enter Your Location" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['location'])){ echo $_POST['location'];}?>" name="location" id="location"   placeholder="Location" type="text"   />
            
        </div>
        
        
        <div class="col-md-12 col-xs-12">

<div class="form-group">
            

<select class="selectpicker form-control" name="target_class" id="target_class" data-style="btn-primary">
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

     
        
           <div class="form-group" >
           <div style="height:30px;"></div>
            <label for="inputSalaryF" class=" control-label">Select Salary Range </label>
           <br />
            <div class="col-sm-12 col-xs-12">
          <b class="rangeTxtLow"  >8000</b>
           
          <input type="text" id="salary_rangen" name="salary_rangen"  value="<?php if(isset($_POST['salary_rangen'])){ echo $_POST['salary_rangen'];}?>"      data-slider-min="8000" data-slider-max="60000" data-slider-step="2000" data-slider-value="[20000,40000]" data-slider-orientation="horizontal" />
          
             <b  class=" rangeTxtHigh"  > &gt; 60000</b> 
             </div>
        </div>
                
        <br>

  
  
        <div class="form-group" style="display:none">
            <label class=" control-label">Do You have another Child studying in School?</label>
          
                <div class="radio radio-primary">
                    <label>
                        <input name="cbox"   id="cbox"  value="1" <?php if(isset($_POST['cbox'])){ if($_POST['cbox']==1)echo 'checked="checked"';}?> onClick="fun($(this).val())"  type="radio" />
                        Yes
                    </label>
                
                    <label>
                        <input name="cbox"   checked="" id="cbox"  value="0" <?php if(isset($_POST['cbox'])){ if($_POST['cbox']==0)echo 'checked="checked"';}?> onClick="fun($(this).val())" type="radio" />
                        No
                    </label>
                </div>
                  <input type="hidden" id="radd" value="<?php if(isset($_POST['cbox'])){ echo $_POST['cbox'];}?>" />

                <div style="display:none;" id="sibling_school">
            
                    <input class="form-control floating-label" id="sibling_schooln" name="sibling_schooln" placeholder="School Name"  value="<?php if(isset($_POST['sibling_school'])){ echo $_POST['sibling_schooln'];}?>"  type="text" />
            
        
            </div>
        </div>
        
          
       
           
        <div class="form-group">
              
                
                    <label>
                    <table >
                <tr>
                <td>
                        <input type="checkbox" id="tds" checked="checked"  class="form-control coupon_question"   name="tds" value="1"  <?php if(isset($_POST['tds'])){ echo 'checked="checked"'; } ?> /> 
                            <input type="hidden" id="tds1" name="tds1" value="<?php if(isset($_POST['tds1'])){ echo $_POST['tds1'];}?>" />

                          <span class="checkbox-material" >
                           <span class="check" />
                        </span>
                        </td><td>
                          I agree the <a href="#">Terms &amp; Conditions</a> and read the <a href="#">Privacy Policy</a></td></tr></table>
                    </label>
                </div>
                <br />
                
         
        <div class="form-group" style="text-align:center">
                <a  class="btn btn-primary btn-raised btn-lg" onClick="setState('myModalview','ajax.php','data=1&full_name='+$('#full_name').val()+'&user_email='+$('#user_email').val()+'&user_mobile='+$('#user_mobile').val()+'&salary_rangen='+$('#salary_rangen').val()+'&tds1='+$('#tds1').val()+'&sibling_schooln='+$('#sibling_schooln').val()+'&tds='+$('#tds').val()+'&age='+$('#age').val()+'&qualification='+$('#qualification').val()+'&location='+$('#location').val()+'&target_class='+$('#target_class').val()+'&school_code=<?php echo $_REQUEST['school_code'];?>');" >Submit</a>
            
        </div>
        
        <div id="errVal" style="display:none;">
            
        </div>
    </fieldset>

               
               
           </div>
    
      </form>                      </div>
                  </div>
              </div>
          </div>         


 
<script type="text/javascript">

 
	
		$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
			  		  document.getElementById("tds1").value='1';

    } else {
				  		  document.getElementById("tds1").value='2';

    }
});
		
 </script>
 
</body>
</html>