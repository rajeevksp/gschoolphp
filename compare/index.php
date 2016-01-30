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
       <div style="height:100px;"></div>
      <div class="container-fluid">
      
         
         <!--<div class="container">
         -->
        
           
           <div class="col-sm-12 col-md-12 mapScroll">
            
                      <div class="panel panel-default"  >
                      
           <table class="table table-striped table-bordered table-condensed table-hover">
    <tr style="height:40px;"><th colspan="5" style="color:#F33;border-bottom:2px solid #F33; font-size:18px; padding-left:25px;">Overview</th></tr>
		
	<tr>
    
    <td> <table class="table table-striped table-bordered table-condensed table-hover">
                        <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                    <b> School Name </b>        
                            </h2>
                             </div></td></tr>
                             
                             
                             <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                    <b> Logo  </b>       
                            </h2>
                             </div></td></tr>
                             
                             
                             <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                   <b>  Board    </b>
                            </h2>
                             </div></td></tr>
                             
                              <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                   <b>  Medium  </b>  
                            </h2>
                             </div></td></tr>
                             
                             
                             <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                    <b> Established       </b>
                            </h2>
                             </div></td></tr>
                             
                             
                             <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                   <b>  Enrollments  </b>    
                            </h2>
                             </div></td></tr>
                             
                             
                             
                             <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                   <b>  Individual attention on students    </b>   
                            </h2>
                             </div></td></tr>
                             
                             
                             
                             <tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                    <b>  Concentrates on  </b>      
                            </h2>
                             </div></td></tr>
                             
                             
                             
                             <tr><td style="height:100px;"><div class="panel-heading"><h2 class="panel-title" >
                    <b> School follows   </b>    
                            </h2>
                             </div></td></tr>
                             
                             
                             <tr><td style="height:100px;"><div class="panel-heading"><h2 class="panel-title" >
                   <b>  Committe   </b>   
                            </h2>
                             </div></td></tr>
                             
                             
                             <tr><td style="height:100px;"><div class="panel-heading"><h2 class="panel-title" >
                   <b>  Curriculum   </b> 
                            </h2>
                             </div></td></tr>
                             
                             </table>
                             </td>
     <?php
		 			 $school_codes='';

		 $tablename='school_main_info';
		 $av1=substr($_REQUEST['schools'],0,-1);
		$av=explode(',',$av1);
for($i=0;$i<sizeof($av);$i++){  

 		
			 $_REQUEST['school_code']=$school_code=$av[$i];
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
			
			 
			 $queryfty = $database->query("SELECT * FROM `preschool_faciliities_info` where school_code='".$_REQUEST['school_code']."'");  
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
      ?>
<?php  if($data['entity_type']==0)
			 {
                         ?>
  <td>
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
                        <tr><td style="height:100px;"><div class="panel-heading"><h2 class="panel-title" >
                               <a href="../school/index.php?school_code=<?php echo $av[$i]; ?>" > <?php echo $data['school_name'];?></a>
                            </h2>
                             <h5><i class="fa fa-map-marker"></i> <span class="loc">                                 <?php echo $data['location'];?>
</span>,                                 <?php echo $data1['city'];?>
 </h5></div></td></tr>
 
 
 <tr><td style="height:100px;"><div style="text-align:center;"><img height="40"  src=" <?php echo $session->get_school_logo($data['school_code']);?>  " alt="<?php echo $data['school_name'];?>" /></div></td></tr>
 
 <tr style="height:100px;"><td><b>
                                            <?php echo $session->getBoards($av[$i]);?> 
                                             </b>
 </td></tr>
 
 
 <tr style="height:100px;"><td><b>
                                               <?php echo $session->getMediums($av[$i]);?>  
                                               </b></td></tr>
 
 
 <tr style="height:100px;"><td>  <b><?php echo $data1['establishment_year'];?></b></td></tr>
 
    <tr style="height:100px;"><td>  <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> </td></tr>
		
    <tr><td style="height:100px;"><?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.</td></tr>
                              
                                  <tr style="height:100px;"><td><?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                               <?php echo $text;?>  of students. </td></tr>


    <tr style="height:100px;"><td><?php
						   if($cce!=0)
						   {
							   ?>
                              
                               Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                          

                               <?php
						   }
						   ?></td></tr>


    <tr style="height:100px;"><td><?php
													 if($smc=='y')
													 {
														 ?>
                                                         
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                                              <?php
													 }
													 else
													 {
														 ?>
                                                         
                              This school is maintained by a trust or society.                           
                                                         <?php
													 }
													 ?></td></tr>


    <tr style="height:100px;"><td><?php if($data['num_inst_chain']<=1){ ?> This school operates  with multiple branches  and offers <?php echo $session->getMediums($av[$i]);?> Curriculum. <?php } else { ?>  This school operates  independently and offers <?php echo $session->getMediums($av[$i]);?> Curriculum. <?php } ?></td></tr>




    
    
    </table>
                        
                        
                        
                        </td>
         
         
         
         
         
     <?php } ?>
     
    <?php  if($data['entity_type']==1)
			 {
                         ?>  <td>
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
         <tr><td style="height:100px;"><div class="panel-heading"><h2 class="panel-title" >
                               <a href="../school/index.php?school_code=<?php echo $av[$i]; ?>" > <?php echo $data['school_name'];?></a>
                            </h2>
                             <h5><i class="fa fa-map-marker"></i> <span class="loc">                                 <?php echo $data['location'];?>
</span>,                                 <?php echo $data1['city'];?>
 </h5></div></td></tr>
 
 <tr><td style="height:100px;"><div style="text-align:center;"><img height="40"  src=" <?php echo $session->get_school_logo($data['school_code']);?>  " alt="<?php echo $data['school_name'];?>" /></div></td></tr>

    <tr style="height:100px;"><td> Total Enrolled Students: <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> </td></tr>
    <tr style="height:100px;"><td><?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Individual attention on students is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.</td></tr>
    <tr style="height:100px;"><td> <?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                              This institution concentrates on  <?php echo $text;?>  of students. </td></tr>
    <tr style="height:100px;"><td><?php
						   if($cce!=0)
						   {
							   ?>
                               
                              School follows  Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                           

                               <?php
						   }
						   ?></td></tr>
    <tr style="height:100px;"><td><?php
													 if($smc=='y')
													 {
														 ?>
                                                         
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                                                         <?php
													 }
													 else
													 {
														 ?>
                              This school is maintained by a trust or society.                          
                                                         <?php
													 }
													 ?></td></tr>
    <tr style="height:100px;"><td> This school operates  with multiple branches  and offers <?php echo $session->getMediums($_REQUEST['school_code']);?> Curriculum. </td></tr>


    
    
    </table>
                        
                        
                        
                        </td>
        <?php       
    }
	
	
	}
	
	
	 if(sizeof($av)<=2){ ?>
                         <td>
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
         <tr><td style="height:100px;"> <div class="panel panel-default"  >
                        <div class="panel-heading">
                            <h2 class="panel-title">Select School to compare </h2>
                        </div>
                        
                    </div>                  
                </td></tr>
 
 

    
    
    
    
    
    


    
    
    </table>
                        
                        
                        
                        </td> <?php } ?>
             
             
             
             
             
             
             
             <?php
						 $sc='';
			 
			 $as=explode(',',$school_codes);
			 $query = $database->query("SELECT * FROM `school_search_info` where school_code=".$av[0]."");  
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
				 $query1 = $database->query("SELECT * FROM `preschool_main_info` where school_code='".$datasimilar['school_code']."'");  
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
			
			 
			 $queryfty = $database->query("SELECT * FROM `preschool_facilities_info` where school_code='".$datasimilar['school_code']."'");  
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
                         
                         
                         <?php  if($data['entity_type']==0)
			 {
                         ?>
  <td>
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
                        <tr><td style="height:100px;" class="panel panel-warning"><div class="panel-heading warning"><h2 class="panel-title" >
                               <a href="../school/index.php?school_code=<?php echo $datasimilar['school_name']; ?>" > <?php echo $datasimilar['school_name'];?></a>
                            </h2>
                             <h5><i class="fa fa-map-marker"></i> <span class="loc">                                 <?php echo $data['location'];?>
</span>,                                 <?php echo $data1['city'];?>
 </h5></div></td></tr>
 
 
 <tr><td style="height:100px;"><div style="text-align:center;"><img height="40"  src=" <?php echo $session->get_school_logo($datasimilar['school_code']);?>  " alt="<?php echo $data['school_name'];?>" /></div></td></tr>
 
 <tr style="height:100px;"><td>Board: <b>
                                            <?php echo $session->getBoards($datasimilar['school_code']);?> 
                                             </b>
 </td></tr>
 
 
 <tr style="height:100px;"><td>Medium: <b>
                                               <?php echo $session->getMediums($datasimilar['school_code']);?>  
                                               </b></td></tr>
 
 
 <tr style="height:100px;"><td> Est. <b><?php echo $data1['establishment_year'];?></b></td></tr>
 
    <tr style="height:100px;"><td> Total Enrolled Students: <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> </td></tr>
		
    <tr><td style="height:100px;"><?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Individual attention on students is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.</td></tr>
                              
                                  <tr style="height:100px;"><td><?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                              This institution concentrates on  <?php echo $text;?>  of students. </td></tr>


    <tr style="height:100px;"><td><?php
						   if($cce!=0)
						   {
							   ?>
                              
                              School follows  Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                          

                               <?php
						   }
						   ?></td></tr>


    <tr style="height:100px;"><td><?php
													 if($smc=='y')
													 {
														 ?>
                                                         
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                                              <?php
													 }
													 else
													 {
														 ?>
                                                         
                              This school is maintained by a trust or society.                           
                                                         <?php
													 }
													 ?></td></tr>


    <tr style="height:100px;"><td><?php if($data['num_inst_chain']<=1){ ?> This school operates  with multiple branches  and offers <?php echo $session->getMediums($datasimilar['school_name']);?> Curriculum. <?php } else { ?>  This school operates  independently and offers <?php echo $session->getMediums($datasimilar['school_name']);?> Curriculum. <?php } ?></td></tr>




    
    
    </table>
                        
                        
                        
                        </td>
         
         
         
         
         
     <?php } ?>
     
    <?php  if($data['entity_type']==1)
			 {
                         ?>  <td>
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
         <tr><td style="height:100px;"><div class="panel-heading warning"><h2 class="panel-title" >
                               <a href="../school/index.php?school_code=<?php echo $av[$i]; ?>" > <?php echo $data['school_name'];?></a>
                            </h2>
                             <h5><i class="fa fa-map-marker"></i> <span class="loc">                                 <?php echo $data['location'];?>
</span>,                                 <?php echo $data1['city'];?>
 </h5></div></td></tr>
 
 <tr><td style="height:100px;"><div style="text-align:center;"><img height="40"  src=" <?php echo $session->get_school_logo($data['school_code']);?>  " alt="<?php echo $data['school_name'];?>" /></div></td></tr>

 <tr style="height:100px;"><td>Board: <b>
                                            <?php echo $session->getBoards($av[$i]);?> 
                                             </b>
 </td></tr>
 
 
 <tr style="height:100px;"><td>Medium: <b>
                                               <?php echo $session->getMediums($av[$i]);?>  
                                               </b></td></tr>
 
 
 <tr style="height:100px;"><td> Est. <b><?php echo $data1['establishment_year'];?></b></td></tr>
    <tr style="height:100px;"><td> Total Enrolled Students: <?php echo $data1['student_count_preprimary']+$data1['student_count_boys']+$data1['student_count_girls'];?> </td></tr>
    <tr style="height:100px;"><td><?php if(($data1['teacher_student_ratio'])<= 25) { $s="good"; }
						   else if(($data1['teacher_student_ratio'])> 25 && ($data1['teacher_student_ratio'])< 35) { $s="Moderate"; }
						   else if(($data1['teacher_student_ratio'])> 35) { $s="Less"; }
						    ?>
                              Individual attention on students is <?php echo $s; ?> as PTR Stands at <?php echo $data1['teacher_student_ratio'];?>:1 ratio.</td></tr>
    <tr style="height:100px;"><td> <?php
                           if($sum >=8)
						   {
							   $text="Holistic development";
						   }
						   else
						   {
					           $text="Academic Focus";

						   }
						   ?>
                              This institution concentrates on  <?php echo $text;?>  of students. </td></tr>
    <tr style="height:100px;"><td><?php
						   if($cce!=0)
						   {
							   ?>
                               
                              School follows  Continuous and Comprehensive Evaluation (CCE)  for student assessment.  
                           

                               <?php
						   }
						   ?></td></tr>
    <tr style="height:100px;"><td><?php
													 if($smc=='y')
													 {
														 ?>
                                                         
                              This school maintains a good number of parents in School Management Committee meetings to take decisions.
                                                         <?php
													 }
													 else
													 {
														 ?>
                              This school is maintained by a trust or society.                          
                                                         <?php
													 }
													 ?></td></tr>
    <tr style="height:100px;"><td> This school operates  with multiple branches  and offers <?php echo $session->getMediums($_REQUEST['school_code']);?> Curriculum. </td></tr>


    
    
    </table>
                        
                        
                        
                        </td>
        <?php       
    }
	
                         
                          }
						  else
						  {
						  
						   ?>
                         
                         <td>
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
         <tr><td style="height:100px;"> <div class="panel panel-default"  >
                        <div class="panel-heading">
                            <h2 class="panel-title">No Sponsored school found </h2>
                            <h5><i class="fa fa-map-marker"></i> Your Location</h5>
                        </div>
                        <div class="panel-body">
                               
                                    No Sponsored school found other than compared
                                      
                        </div>
                    </div>                  
                </td></tr>
 
 

    
    
    
    
    
    


    
    
    </table>
                        
                        
                        
                        </td>
                         <?php } ?>

	
    

    </tr>
    
    </table>
    
    
    
    
    
    <table class="table table-striped table-bordered table-condensed table-hover">
    <tr style="height:40px;"><th colspan="5" style="color:#F33;border-bottom:2px solid #F33; font-size:18px;padding-left:25px;"">Facilities</th></tr>
		
	<tr  >    <td class="col-sm-2 col-md-2"> <table class="table table-striped table-bordered table-condensed table-hover">

<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-book" ></i><b> Library</b>
                            </h2>
                             </div></td></tr>
                             

                                   
                              
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-desktop" ></i><b> Computer labs</b>
                              </h2>
                             </div></td></tr>
                               
                               
                               
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-medkit  " ></i><b> Medical</b>
</h2>
                             </div></td></tr>
                                                                 
                               
                               
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-bus " ></i><b> Transportation</b>
</h2>
                             </div></td></tr>
                                                          
                          
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-object-group" ></i><b> Smart Rooms</b>
</h2>
                             </div></td></tr>
                                                                 
                              
                              
                               
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-video-camera " ></i><b> CCTV</b>
</h2>
                             </div></td></tr>
                                                                
                               
                               
                               
                              
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-futbol-o " ></i> <b>Play Ground</b>
</h2>
                             </div></td></tr>
                                                                
                               
                               
                              
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-wifi  " ></i><b> Wifi</b>
</h2>
                             </div></td></tr>
                                                                
                           
                            
                            
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-coffee  " ></i><b> Cafetaria</b>
</h2>
                             </div></td></tr>
                                                                 
                              
                             
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-lock" ></i> <b>Security &amp; Safety</b>
</h2>
                             </div></td></tr>
                                                             
                             
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-asterisk  " ></i> <b>AC Class rooms</b>
</h2>
                             </div></td></tr>
                                                          
<tr><td style="height:100px; "><div class="panel-heading"><h2 class="panel-title" >
                                 <i class="fa fa-university" ></i> <b>Auditorium</b>
</h2>
                             </div></td></tr>
                                                                 
                               
                            
                            
                           
                            </table></td>
     <?php
		 			 $school_codes='';

		 $tablename='school_main_info';
		 $av1=substr($_REQUEST['schools'],0,-1);
		$av=explode(',',$av1);
for($i=0;$i<sizeof($av);$i++){  

 		
			 $_REQUEST['school_code']=$school_code=$av[$i];
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
			
			 
			 $queryfty = $database->query("SELECT * FROM `preschool_faciliities_info` where school_code='".$_REQUEST['school_code']."'");  
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
      ?>
<?php  if($data['entity_type']==0)
			 {
                         ?>
  <td class="col-sm-2 col-md-2">
                        
            <table class="table table-striped table-bordered table-condensed table-hover">             <?php
						 
						 $transportation = 0;
						 $transport_routes = '';
						 
						  
						
							 $queryfacility = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$av[$i]."'");  
			 $datafacility = mysqli_fetch_array($queryfacility);
							 ?>
                           
                                <?php
								if($datafacility['library_present']==1)
								{
									?>
                                   <tr style="height:100px;"><td><b>
                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                                    <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>
                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                              <?php
								if($datafacility['no_of_computers']!=0)
								{
									?>
                                 <tr style="height:100px;"><td><b>
                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php 
							   } 
							   else
							    {
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['medical_checkup']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['transport_provided']!=0)
								{
									$transportation = 1;
									$transport_routes = $datafacility['transport_routes'];
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               
                           
                            <?php
								if($datafacility['smart_class']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
                              ?>
                              
                              
                               <?php
								if($datafacility['cctv_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               
                               <?php
								if($datafacility['playground_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['internet']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                            
                            
                             <?php
								if($datafacility['cafeteria_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                              
                              
                              <?php
								if($datafacility['security']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
								?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                                 <?php
								}
									?>
                               
                               
                               <?php
								if($datafacility['ac_classrooms']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                               
                               <?php 
								} 
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['auditorium']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                            
                        <?php ?>
                        
                        </table>
                        
                        </td>
         
         
         
         
         
     <?php } ?>
     
    <?php  if($data['entity_type']==1)
			 {
                         ?>
  <td class="col-sm-2 col-md-2">
                        
            <table class="table table-striped table-bordered table-condensed table-hover">             <?php
						 
						 $transportation = 0;
						 $transport_routes = '';
						 
						  
						
							 $queryfacility = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$av[$i]."'");  
			 $datafacility = mysqli_fetch_array($queryfacility);
							 ?>
                           
                                <?php
								if($datafacility['library_present']==1)
								{
									?>
                                   <tr style="height:100px;"><td><b>
                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>
                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                              <?php
								if($datafacility['no_of_computers']!=0)
								{
									?>
                                 <tr style="height:100px;"><td><b>
                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i>
 </b>
 </td></tr>                               <?php 
							   } 
							   else
							    {
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['medical_checkup']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['transport_provided']!=0)
								{
									$transportation = 1;
									$transport_routes = $datafacility['transport_routes'];
									?>
<tr style="height:100px;"><td><b>                                <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               
                           
                            <?php
								if($datafacility['smart_class']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
                              ?>
                              
                              
                               <?php
								if($datafacility['cctv_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i>
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               
                               <?php
								if($datafacility['playground_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['internet']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                            
                            
                             <?php
								if($datafacility['cafeteria_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                              
                              
                              <?php
								if($datafacility['security']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
								?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                 <?php
								}
									?>
                               
                               
                               <?php
								if($datafacility['ac_classrooms']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php 
								} 
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['auditorium']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                            
                        <?php ?>
                        
                        </table>
                        
                        </td>
         
         
         
         
         
     <?php }
	
	
	}
	
	
	 if(sizeof($av)<=2){ ?>
                         <td class="col-sm-2 col-md-2">
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
         <tr><td style="height:100px;"> <div class="panel panel-default"  >
                        <div class="panel-heading">
                            <h2 class="panel-title"> </h2>
                        </div>
                        
                    </div>                  
                </td></tr>
 
 

    
    
    
    
    
    


    
    
    </table>
                        
                        
                        
                        </td> <?php } ?>
             
             
             
             
             
             
             
             <?php
						 $sc='';
			 
			 $as=explode(',',$school_codes);
			 $query = $database->query("SELECT * FROM `school_search_info` where school_code=".$av[0]."");  
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
				 $query1 = $database->query("SELECT * FROM `preschool_main_info` where school_code='".$datasimilar['school_code']."'");  
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
			
			 
			 $queryfty = $database->query("SELECT * FROM `preschool_facilities_info` where school_code='".$datasimilar['school_code']."'");  
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
                         
                         
                         <?php  if($data['entity_type']==0)
			 {
                         ?>
  
                         
  <td class="col-sm-2 col-md-2">
                        
            <table class="table table-striped table-bordered table-condensed table-hover">             <?php
						 
						 $transportation = 0;
						 $transport_routes = '';
						 
						  
						
							 $queryfacility = $database->query("SELECT * FROM `school_facilities_info` where school_code='".$datasimilar['school_code']."'");  
			 $datafacility = mysqli_fetch_array($queryfacility);
							 ?>
                           
                                <?php
								if($datafacility['library_present']==1)
								{
									?>
                                   <tr style="height:100px;"><td><b>
                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>
                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                              <?php
								if($datafacility['no_of_computers']!=0)
								{
									?>
                                 <tr style="height:100px;"><td><b>
                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                               <?php 
							   } 
							   else
							    {
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['medical_checkup']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['transport_provided']!=0)
								{
									$transportation = 1;
									$transport_routes = $datafacility['transport_routes'];
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               
                           
                            <?php
								if($datafacility['smart_class']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
                              ?>
                              
                              
                               <?php
								if($datafacility['cctv_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               
                               <?php
								if($datafacility['playground_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['internet']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                            
                            
                             <?php
								if($datafacility['cafeteria_present']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                              
                              
                              <?php
								if($datafacility['security']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php
								}
								else
								{
								?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                 <?php
								}
									?>
                               
                               
                               <?php
								if($datafacility['ac_classrooms']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                               
                               <?php 
								} 
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                               
                               <?php
								if($datafacility['auditorium']!=0)
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-check text-success" style="padding:40px 10px 10px 100px;" ></i> 
 </b>
 </td></tr>                               <?php
								}
								else
								{
									?>
<tr style="height:100px;"><td><b>                                 <i class="fa fa-times text-danger" style="padding:40px 10px 10px 100px;"></i> 
 </b>
 </td></tr>                                    <?php
								}
								?>
                               
                            
                        <?php ?>
                        
                        </table>
                        
                        </td>
         
         
         
         
        
         
         
         
         
         
     <?php } 
     
    
                         
                          }
						  else
						  {
						  
						   ?>
                         
                         <td class="col-sm-2 col-md-2">
                        
                        <table class="table table-striped table-bordered table-condensed table-hover">
         <tr><td style="height:100px;"> <div class="panel panel-default"  >
                        <div class="panel-heading">
                            <h2 class="panel-title">No Sponsored school found </h2>
                            <h5><i class="fa fa-map-marker"></i> Your Location</h5>
                        </div>
                        <div class="panel-body">
                               
                                    No Sponsored school found other than compared
                                      
                        </div>
                    </div>                  
                </td></tr>
 
 

    
    
    
    
    
    


    
    
    </table>
                        
                        
                        
                        </td>
                         <?php } ?>

	
    

    </tr>
    
    </table>
    
    </div></div>
           
    
      
			 
			
                   
     
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