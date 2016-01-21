 <?php
 include('../include/session.php');
 
 $post = $session->cleanInput($_REQUEST);
 
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
   

   
  
  
   <!--counters-->
   
   <!--services-->
       <section class="mapViewSchools ">
       <div style="height:70px;"></div>
      <div class="container-fluid">
      
         
         <!--<div class="container">
         -->
         <?php
		 			 $school_codes='';

		 $tablename='school_main_info';
		 $av1=substr($_REQUEST['schools'],0,-1);
		$av=explode(',',$av1);
for($i=0;$i<sizeof($av);$i++){  

 		
			 
				  $query1 = $database->query("SELECT * FROM school_search_info where school_code='".$av[$i]."' ");  
				  			$data= mysqli_fetch_array($query1);
if($data['entity_type']==0)
			 {
				 $query1 = $database->query("SELECT * FROM `school_main_info` where school_code='".$av[$i]."'");  
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
			 
			 
			 $queryfty = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$av[$i]."'");  
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
				 $query1 = $database->query("SELECT * FROM `preschool_main_info` where school_code='".$av[$i]."'");  
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
			
			 
			 $queryfty = $database->query("SELECT * FROM `preschool_faciliities_info` where school_code='".$av[$i]."'");  
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

           ?>
                         <div class="col-sm-3 col-md-3 mapScroll">
            
                      <div class="panel panel-default"  >
                        <div class="panel-heading">
                            <h2 class="panel-title" >
                               <a href="../school/index.php?school_code=<?php echo $av[$i]; ?>" > <?php echo $data['school_name'];?></a>
                            </h2>
                             <h5><i class="fa fa-map-marker"></i> <span class="loc">                                 <?php echo $data['location'];?>
</span>,                                 <?php echo $data1['city'];?>
 </h5>
                            
                            
                        </div>
                        <div class="panel-body">
                               
                                           
                                      <div class="row">
                                      <div class="col-sm-3 mschoolProfilePic">
                                           <img src="<?php echo $session->get_school_logo($av[$i]);?>" alt="<?php echo $data['school_name'];?>" />
                                      </div>
                                     
                                      <div class="col-sm-9">
                                         <div class="row">Board: <b>
                                            <?php echo $session->getBoards($av[$i]);?> 
                                             </b></div>
                                           <div class="row">Medium: <b>
                                               <?php echo $session->getMediums($av[$i]);?>  
                                               </b></div>
                                           <div class="row">Est. <b><?php echo $data1['establishment_year'];?></b></div>
                                           
                                      
                                      </div>
                                      </div>
                                      <hr />
                                          <div class="row schoolProfileSummary">
                                      <div class="col-sm-12 col-xs-12">
                                          <h3>Quick Facts</h3>
                                          
                                        <ul class="quickFacts" >
                       <?php echo $session->get_qfacts($av[$i]);?> 
                         </ul>
                                      </div>
                                      </div>  
                        </div>
                         
                                      
                        </div>
                    </div>                  
             <?php 
 $school_codes.= "'".$av[$i]."',";
                        
                          }    
           
                         ?>
                      <?php if(sizeof($av)<=2){ ?>
                         <div class="col-sm-3 col-md-3 mapScroll">
            
                      <div class="panel panel-default"  >
                        <div class="panel-heading">
                            <h2 class="panel-title">Select School To Compare</h2>
                            <h5><i class="fa fa-map-marker"></i> Your Location</h5>
                        </div>
                        <div class="panel-body">
                               
                                    Select School To Compare
                                      
                        </div>
                    </div>                  
                
                             
                   
             </div> <?php } ?>
                         
                         <?php
						 $sc='';
			 
			 $as=explode(',',$school_codes);
			 $query = $database->query("SELECT * FROM `school_search_info` where school_code=".$as[0]."");  
	    	 $data = mysqli_fetch_array($query);

			 if($school_codes!='')
			 {
			 $school_codes=substr($school_codes,0,-1);
$sc=" school_search_info.entity_type = ".$data['entity_type']." AND school_code NOT IN (".$school_codes.") AND ";			 }
			 
			
			 $querysimilar=$database->query("SELECT school_search_info.*  from school_search_info  WHERE   ".$sc."  (school_search_info.location LIKE '".$data['location']."%') ORDER BY ranking DESC,user_ranking DESC LIMIT 0,3 "); 
			 
if(mysqli_num_rows($querysimilar)>0)
{			 
			 	$datasimilar=mysqli_fetch_array($querysimilar);
if($datasimilar['entity_type']==0)
			 {
				 $query1 = $database->query("SELECT * FROM `school_main_info` where school_code='".$datasimilar['school_code']."'");  
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
			 
			 
			 $queryfty = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$data['school_code']."'");  
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
			 $type=$data['entity_type'];?>
                         
                         <div class="col-sm-3 col-md-3 mapScroll">
            
                      <div class="panel panel-warning"  >
                        <div class="panel-heading">
                           <a href="../school/index.php?school_code=<?php echo $datasimilar['school_code']; ?>" > <?php echo $datasimilar['school_name'];?></a>
                             <h5><i class="fa fa-map-marker"></i> <span class="loc"> <?php echo $datasimilar['location'];?></span>,  <?php echo $datasimilar['city'];?></h5>
                            
                            
                        </div>
                        <div class="panel-body">
                               
                                        <div class="row">
                                      <div class="col-sm-3 mschoolProfilePic">
                                           <img src=" <?php echo $session->get_school_logo($datasimilar['school_code']);?>  " alt="<?php echo $datasimilar['school_name'];?>" />
                                      </div>
                                     
                                      <div class="col-sm-9">
                                         <div class="row">Board: <b>
                                             <?php echo $session->getBoards($datasimilar['school_code']);?>  
                                             </b></div>
                                           <div class="row">Medium: <b>
                                                <?php echo $session->getBoards($datasimilar['school_code']);?>  
                                               </b></div>
                                           <div class="row">Est.<?php echo $data1['establishment_year'];?> <b></b></div>
                                           
                                      
                                      </div>
                                      </div>
                                      
                            
                            <hr />
                                      <div class="row schoolProfileSummary">
                                      <div class="col-sm-12 col-xs-12">
                                          <h3>Quick Facts</h3>
                                          
                                          <ul class="quickFacts" >
                                              <?php echo $session->get_qfacts($data1['school_code']);?> 

                         </ul>
                                      </div>
                                      </div>
                        </div>  
                          
                
                    </div>                  
                
                             
                   
             </div>
                         
                          <?php }
						  else
						  {
						  
						   ?>
                         
                         <div class="col-sm-3 col-md-3 mapScroll">
            
                      <div class="panel panel-default"  >
                        <div class="panel-heading">
                            <h2 class="panel-title">No Sponsored school found </h2>
                            <h5><i class="fa fa-map-marker"></i> Your Location</h5>
                        </div>
                        <div class="panel-body">
                               
                                    No Sponsored school found other than compared
                                      
                        </div>
                    </div>                  
                
                             
                   
             </div>
                         <?php } ?>
                   
     
         <div style="clear:both"></div>
         
         
         
         
         
     <!-- </div>-->
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