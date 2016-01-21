<?php
include('../include/session.php');

if(!isset($_REQUEST['school_code']) && !isset($_REQUEST['sc']))
header('location: '.$session->referrer);

else if(isset($_REQUEST['sc']))
$_REQUEST['school_code'] = $_REQUEST['sc'];

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
                             <a class="btn btn-warning btn-raised " onClick="modal()"><i class="fa fa-question-circle"></i> Send Enquiry</a>
                           </div>
                           <div style="clear:both"></div>
                        </div>
                        <div class="panel-body schoolBcg" style="background:rgba(0, 0, 0, 0) url('../photos/pencil-sharpener-838605_1920.jpg') no-repeat scroll center center">
                               
                                      <div class="schoolProfileHead">
                                      <div class="schoolProfileHeadTxt">
                                      
                                           <div class="row">
                                            <div class="col-sm-3">
                                              <div class="schoolProfilePic" ><img src="<?php  echo $session->get_school_logo($_REQUEST['school_code']); ?> " alt=""> </div>
                                            
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
               
               <li><a class="page_scroll" onClick="modal()"><i class="fa fa-chevron-right"></i> Enquire</a></li>
               
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
                          <?php  if($data['entity_type']==0)
			 {
                         ?> 
                         <ul class="quickFacts" >
                       <li >
                             Total Enrolled Students: <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> 
                           </li>
                           <li >
                           <?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Individual attention on students is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.
                           </li>
                           <li >
                           <?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                              This institution concentrates on  <?php echo $text;?>  of students. 
                           </li>
                           <?php
						   if($cce!=0)
						   {
							   ?>
                               <li >
                              School follows  Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                           </li>

                               <?php
						   }
						   ?>
                                                     <?php
													 if($smc=='y')
													 {
														 ?>
                                                          <li >
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                           </li>
                                                         <?php
													 }
													 else
													 {
														 ?>
                                                          <li >
                              This school is maintained by a trust or society.                           </li>
                                                         <?php
													 }
													 ?>
                                                     
                           <li >
                              This school operates  with multiple branches  and offers <?php echo $session->getMediums($_REQUEST['school_code']);?> Curriculum. 
                           </li>
                         </ul>
 <?php } ?>
 
 <?php  if($data['entity_type']==1)
			 {
                         ?> 
                         <ul class="quickFacts" >
                       <li >
                             Total Enrolled Students: <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> 
                           </li>
                           <li >
                           <?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Individual attention on students is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.
                           </li><li >
                           <?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                              This institution concentrates on  <?php echo $text;?>  of students. 
                           </li>
                           <?php
						   if($cce!=0)
						   {
							   ?>
                               <li >
                              School follows  Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                           </li>

                               <?php
						   }
						   ?>
                                                     <?php
													 if($smc=='y')
													 {
														 ?>
                                                          <li >
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                           </li>
                                                         <?php
													 }
													 else
													 {
														 ?>
                                                          <li >
                              This school is maintained by a trust or society.                           </li>
                                                         <?php
													 }
													 ?>
                                                     
                           <li >
                              This school operates  with multiple branches  and offers <?php echo $session->getMediums($_REQUEST['school_code']);?> Curriculum. 
                           </li>
                         </ul>
 <?php } ?>
 
 
                        </div>
                        <div id="tab_content_2" class="tab-pane fade ">
                        
                        <p><?php echo $data['school_name'];?> was established in <?php echo $data1['establishment_year'];?> and it is managed by the <?php echo $management;?>. The school consists of Grades from <?php echo $data['lowest_class'];?> to <?php echo $data['highest_class'];?> . The school is co-educational and <?php echo $session->getMediums($_REQUEST['school_code']);?> is the medium of instructions in this school. The school academic session starts in <?php echo $data1['admissions_month'];?>. This school follows the <?php echo $data1['recognized_by'];?> board. 
The School is located in <?php echo $data1['location'];?> block of <?php echo $data1['city'];?> in the state of <?php echo $data1['state'];?> and is approachable by all weather road

</p>
                           
                           
                        
                        </div>
                        <div id="tab_content_3" class="tab-pane fade">
                           <p>Admission Details: <?php if($data1['admissions_month']==date('M')) { ?>Active Now</p>
                           <p>Admissions starts from <?php echo $data1['admissions_start_date'];?> to <?php echo $data1['admissions_end_date'];?>.</p><?php } ?> 
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
                         <?php if($type==0)
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
                            <p>  </p>
                            
                            <br />
                             <iframe width="100%" height="240px" frameborder="0" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m27!1m12!1m3!1d30442.36782489268!2d78.34626576241303!3d17.49337906395455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m12!3e3!4m5!1s0x3bcb91f25cde1747%3A0xea5a485059490c80!2sJNTU+Bus+Stop%2C+National+Highway+9%2C+Kukatpally+Housing+Board+Colony%2C+Hyderabad%2C+Telangana!3m2!1d17.496402!2d78.3941299!4m4!1s0x0%3A0x111e4f6915a2f1b!3m2!1d17.4874228!2d78.3324444!5e0!3m2!1sen!2sin!4v1448429844134"></iframe>
                        </div>
                        <div id="tab2_content_3" class="tab-pane fade">
                          <iframe width="100%" height="240px" frameborder="0" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1902.7102906381656!2d78.33135005799856!3d17.48742535525154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb92f35d7ce941%3A0x111e4f6915a2f1b!2sMnr+High+School!5e0!3m2!1sen!2sin!4v1448360742773"></iframe>
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
            		foreach ($session->get_school_gallery($_REQUEST['school_code']) as $key =>$val){
?>

<div class="col-md-3 col-sm-4 col-xs-12 gallery_item">
            <div  ><span class="popup-gallery "> <a href="<?php echo $val;?>" ><img class="img-responsive" src="<?php echo $val;?>" alt=""/>
               
                   </a></span>
                   
            </div>
         </div>
          
                    <?php } ?>

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
                                          <img src="<?php echo $session->get_school_logo($datafeatured['school_code']);?>" alt="" />
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
                                          <img src="<?php echo $session->get_school_logo($datasimilar['school_code']);?>" alt="" />
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
	   if(strlen($phone)==0)
	  {
		  	

		$phoneerr="*Please enter your mobile no ";
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
?>
<script type="application/javascript">
	window.location=window.location.href;

	alert("Review submitted successfully")
	</script>
<?php
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
           
                <input class="form-control  floating-label" value="<?php if(isset($_REQUEST['name'])){ echo $_REQUEST['name']; }  ?>" name="name" placeholder="Your Full Name">
                

        <font style="color:#F00"><?php echo $nameerr ?></font>
        </div>
                        <div class="form-group">
         
        <div class="col-sm-7 email check"><input class="form-control floating-label" id="inputEmail" placeholder="Email" name="email" value="<?php if(isset($_REQUEST['email'])){ echo $_REQUEST['email']; }  ?>" type="email">
                 <font style="color:#F00"><?php echo $emailerr ?></font>
  
        </div>
         
         <div class="col-sm-1">
               
             </div>
          <div class="col-sm-4 mobile check">
               <input class="form-control floating-label" value="<?php if(isset($_REQUEST['phone'])){ echo $_REQUEST['phone']; }  ?>" name="phone" id="inputMobile" placeholder="Mobile" type="phone">
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
           
         <input type="text" id="salary_range"  name="fee"  value=""   data-slider-min="8000" data-slider-max="60000" data-slider-step="2000" data-slider-value="24000" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  > &gt; 60000</b> 
             </div>
        </div>
                
        
    <br />
               
  
      <br />
            
        
            <div class="form-group">
         
               
               <input class="form-control floating-label" value="<?php if(isset($_REQUEST['school_name'])){ echo $_REQUEST['school_name']; }  ?>" name="school_name" id="inputSchool" placeholder="School Name of your child" type="text">
                     <font style="color:#F00"><?php echo $school_nameerr ?></font>

        </div>
         
       
             <div class="form-group">
             
               <textarea class="form-control floating-label" name="review" id="inputSchool" placeholder="Review" rows="4" ></textarea>
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
           
         <input type="text" id="rating1"  name="exp"  value=""   data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
            Academics </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating2"   value=""  name="aca"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             
             
              </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
           Infrastructure </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating3"   value=""  name="infra"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             
               </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
            Fee &amp; Cost </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating4"   value=""  name="fee"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
          
             <b  class=" rangeTxtHigh"  >  10</b> 
             </div>
             
               </div>
             
             
               <div class="row">
            <div class="col-sm-4 col-xs-4">
           
            Value for Money </div>
             <div class="col-sm-8 col-xs-8">
          <b class="rangeTxtLow"  >1</b>
           
         <input type="text" id="rating5"   value=""  name="money"  data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="8" data-slider-orientation="horizontal" >
         
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
                           $queryreview = $database->query("SELECT * FROM `reviews` where school_code='".$_REQUEST['school_code']."'");  
						   
						   if(mysqli_num_rows($queryreview)> 0){
			 while($datareview = mysqli_fetch_array($queryreview))
			 {?>
			

                             <div class="well">
                              <p><?php echo $datareview['name'];?>.</p>
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
 
<!--go-top link--> 
<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a> 
 
 
<?php $session->commonJS();?> 
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

function viewmap(){
	
}
</script>
               
                    <?php }
  }?>

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
             
<script src="<?php echo JS_PATH;?>custom_jquery.js"></script>              
</body>
</html>