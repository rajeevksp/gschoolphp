<?php
 include('../include/session.php');
 
 $post = $session->cleanInput($_REQUEST);
 /*$routes = $session->getCurrentUri();
 
 $post['entity_type'] = $routes[1];
 $post['as_values_location'] = $routes[2];
 */
 if(isset($post['as_values_userLocation'])){
	$post['as_values_location'] = trim($post['as_values_userLocation'],' ,'); 
 }
 
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
   

   <!--features-->
   
   <!--home block 1-->
   <section  class="searchForm"  >
      <div  class="shortcode_anchor"></div>
         
         
        <div class="container-fluid">
        
        <div class="container">
        
          
       
               
           <div id="search_filters"  class="item ">
           
           <br />
               
               <form class=" bs-component" action="../search" method="get" >
    <fieldset>
     
        <div class="form-group">
           
           <div class=" col-sm-7 col-md-7">
                <input id="userLocation"  class="form-control "   type="text" />

            </div>     
            <input id="prefill" type="hidden" value="<?php if(isset($post['as_values_location'])){ echo  trim($post['as_values_location'],' ,');}?>" />
            
                <input type="hidden" name="entity_type" class="entity_type"  id="entity" value="<?php if(isset($post['entity_type'])){ echo $post['entity_type'];} else{ echo 'school';}?>" />
 
           <div class=" col-sm-5 col-md-5 check">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" class="form-control" name="transportation" <?php if(isset($post['transportation'])){ if($post['transportation'] == 1){ echo 'checked="checked"';}}?>  value="1" />
                        <span class="checkbox-material">
                           <span class="check"></span>
                        </span>
                        &#160;Transportation
                    </label>
                &#160;&#160;
                    <label>
                        <input type="checkbox" class="form-control" name="reservation" <?php if(isset($post['reservation'])){ if($post['reservation'] == 1){ echo 'checked="checked"';}}?> value="1"/>
                        <span class="checkbox-material">
                           <span class="check"></span>
                        </span>
                        &#160;Spl. Reservation (SC/ST/BC)
                    </label>
                </div>
               
        </div>
</div>
  
       <div class="form-group">
           
           <div class=" col-sm-2 check">
            

<select class="selectpicker form-control" name="target_class" data-style="btn-primary">
<option value="">Class/Standard</option>
<option value="0" <?php if(isset($post['target_class'])){ if($post['target_class'] == 0){ echo 'selected="selected"';}}?> >Kindergarten</option>
<option value="1" <?php if(isset($post['target_class'])){ if($post['target_class'] == 1){ echo 'selected="selected"';}}?> >Class 1</option>
<option value="2" <?php if(isset($post['target_class'])){ if($post['target_class'] == 2){ echo 'selected="selected"';}}?> >Class 2</option>
<option value="3" <?php if(isset($post['target_class'])){ if($post['target_class'] == 3){ echo 'selected="selected"';}}?> >Class 3</option>
<option value="4" <?php if(isset($post['target_class'])){ if($post['target_class'] == 4){ echo 'selected="selected"';}}?> >Class 4</option>
<option value="5" <?php if(isset($post['target_class'])){ if($post['target_class'] == 5){ echo 'selected="selected"';}}?> >Class 5</option>
<option value="6" <?php if(isset($post['target_class'])){ if($post['target_class'] == 6){ echo 'selected="selected"';}}?> >Class 6</option>
<option value="7" <?php if(isset($post['target_class'])){ if($post['target_class'] == 7){ echo 'selected="selected"';}}?> >Class 7</option>
<option value="8" <?php if(isset($post['target_class'])){ if($post['target_class'] == 8){ echo 'selected="selected"';}}?> >Class 8</option>
<option value="9" <?php if(isset($post['target_class'])){ if($post['target_class'] == 9){ echo 'selected="selected"';}}?> >Class 9</option>
<option value="10" <?php if(isset($post['target_class'])){ if($post['target_class'] == 10){ echo 'selected="selected"';}}?> >Class 10</option>

</select>
        
  </div>
   <div class=" col-sm-2 ">
                
                <select class="selectpicker form-control" name="board" data-style="btn-primary">
<option value="">School Board</option>
 <option value="CBSE"  <?php if(isset($post['board'])){ if($post['board'] == 'cbse'){ echo 'selected="selected"';}}?> >CBSE</option>
<option value="ICSE" <?php if(isset($post['board'])){ if($post['board'] == 'icse'){ echo 'selected="selected"';}}?> >ICSE</option>
<option value="IB" <?php if(isset($post['board'])){ if($post['board'] == 'ib'){ echo 'selected="selected"';}}?> >IB</option>
<option value="State" <?php if(isset($post['board'])){ if($post['board'] == 'state'){ echo 'selected="selected"';}}?> >State</option>
 
</select>

    
       
       
            </div>   
         
          <div class="form-group col-sm-1 check resultsFee"   >
               
                <label for="inputSalaryF" class=" control-label"> Fee(Yearly) </label>
                </div>
        <div class="form-group col-sm-5 check"   >
               
           
       <b class="rangeTxtLow"  >12K</b>
           
       <input type="text" id="fee_range"  name="fee_range"   value=""   data-slider-min="12000" data-slider-max="120000" data-slider-step="2000" data-slider-value="[<?php if(isset($post['fee_range'])){  echo $post['fee_range']; }else{ echo '24000,48000';}?>]" data-slider-orientation="horizontal" /><b  class=" rangeTxtHigh"  >&gt; 1.2L</b> 
               
        </div>
       
     <div class=" col-sm-2 col-md-2 check" style="text-align:center">
         
         <button type="submit"  class="btn btn-block btn-primary btn-raised  " >
           
             <i class="fa fa-search"></i> Filter Results</button>
          
               
        </div>    
        
        <br />
      
</div> 
        
        
        <br />
        <div class="row" style="display:none;" id="moreFilters">        
               <div class=" col-sm-3   ">
               
               
                 <select class="selectpicker form-control" name="school_type" data-style="btn-primary">
<option value="">School Type</option>
 <option value="1"  <?php if(isset($post['school_type'])){ if($post['school_type'] == 1){ echo 'selected="selected"';}}?> >Boys</option>
<option value="2" <?php if(isset($post['school_type'])){ if($post['school_type'] == 2){ echo 'selected="selected"';}}?>>Girls</option>
<option value="3" <?php if(isset($post['school_type'])){ if($post['school_type'] == 3){ echo 'selected="selected"';}}?>>Co-Educational</option> 
 
</select>
                
        </div>
          
          
          <div class=" col-sm-2  ">
             
             
                       <select class="selectpicker form-control" name="medium" data-style="btn-primary">
<option value="">Medium</option>
  <?php
	    $instruction_sel = $database->query("SELECT * FROM instruction_medium");
		
		if(mysqli_num_rows($instruction_sel) > 0){
		   while($instruction = mysqli_fetch_array($instruction_sel)){
			   
			  ?>
                <option value="<?php echo $instruction['code'];?>"  <?php if(isset($post['medium'])){ if($post['medium'] == $instruction['code']){ echo 'selected="selected"';}}?>><?php echo ucwords($instruction['language']) ?></option>
       
              <?php   
		   }
		}
	  ?>
</select>
     </div>
        
        <div class="col-sm-3 check">
        
          <div class="checkbox">
                    <label>
                        <input type="checkbox" class="form-control"  name="residential" <?php if(isset($post['residential'])){ if($post['residential'] == 1){ echo 'checked="checked"';}}?>  value="1" />
                        <span class="checkbox-material">
                           <span class="check"></span>
                        </span>
                        &#160;Residential
                    </label>
                &#160;&#160;
                    <label>
                        <input type="checkbox" class="form-control"  <?php if(isset($post['playground'])){ if($post['playground'] == 1){ echo 'checked="checked"';}}?> name="playground" value="1" />
                        <span class="checkbox-material">
                           <span class="check"></span>
                        </span>
                        &#160;Playground
                    </label>
                </div>
        
        </div>
        
        <div class="col-sm-4">
        
                         <select class="selectpicker form-control" name="management" data-style="btn-primary">
<option value="">Management</option>
  <option value="1" <?php if(isset($post['management'])){ if($post['management'] == 1){ echo 'selected="selected"';}}?>>Private Aided</option>
    <option value="2" <?php if(isset($post['management'])){ if($post['management'] == 2){ echo 'selected="selected"';}}?>>Govt. Aided</option>
</select>
     
        
        
        </div>
         
       </div>
       
  
        
 <div class="row">
                   <div class="col-sm-4">
                   </div>
                   <div class="col-sm-4">
                       <a  class="btn   btn-default btn-raised btn-xs" onclick="this.form.reset()"><i class="fa fa-refresh"></i> Clear</a>
         <a  class="btn  btn-warning btn-raised   btn-xs" id="moreBtn" onclick="$('#moreFilters').slideToggle('slow',function(){ $('#moreBtn i').toggleClass('fa-minus')})"><i class="fa fa-plus"></i> More</a>
        
                   </div>
                   <div class="col-sm-4">
                   </div>
               </div>       
    </fieldset>
</form>
                 
               
               
               
               
           </div>
    
       
         
   
         
         </div>
      </div>
   </section>
  
  
   <!--counters-->
   
   <!--services-->
       <section class="schoolResults big_block">
       
      <div class="container-fluid">
      
         
         <div class="container">
          <div class="compareHolder" >
                        <div class="col-sm-10">
                            <ul id="compareHolder">


                            </ul>
                        </div>
                        <div class="col-sm-2">
                             
              <input type="hidden" id="compare_schools" name="compare_schools" value="" />
               
              <a onClick="window.location = '../compare/?schools='+$('#compare_schools').val();" class="btn btn-block btn-danger btn-raised"   ><i class="fa fa-expand"></i> Compare</a> 
                        </div>       
              
          </div>
              
         
             <div class="col-sm-8 col-md-8">
             
                   
             
                 
             <div class="resultPagination">
                 <div class="pull-left">
                   <ul class="breadcrumb"  >
                         <li><a href="javascript:void(0)">Hyderabad</a></li>
                         <?php
						 if(isset($post['as_values_location'])){ 
						 ?>
                         <li><a href="<?php SECURE_PATH.'search/?entity_type=school&as_values_location='.$post['as_values_location'];?>"><?php   echo  ucwords(trim($post['as_values_location'],' ,'));?></a></li>
                         <?php
						 }
						 ?>
                            <?php
						 if(isset($post['board'])){ 
						 ?>
                         <li><a href="<?php SECURE_PATH.'search/?entity_type=school&as_values_location='.$post['as_values_location'].'&board='.$post['board'];?>"><?php   echo  $post['board'];?></a></li>
                         <?php
						 }
						 ?>
                   </ul>
                 </div>
                 <div class="pull-right">
                 <div class="btn-group" role="group" aria-label="Toggle View">
                       
                   <a  class="btn btn-primary btn-xs" href="<?php echo SECURE_PATH.'search/?'.$_SERVER['QUERY_STRING']; ?>"><i class="fa fa-list"></i></a>
                   <a  class="btn btn-default btn-xs" href="<?php  echo SECURE_PATH.'map/?'.$_SERVER['QUERY_STRING']; ?>"><i class="fa fa-map"></i></a>
                       
                   </div>
                 </div>
                 <div style="clear:both"></div>
             </div>
             
                 <?php
				 
				    $location =trim($post['as_values_location'],' ,');
					$entity = $post['entity_type'];
					
					$entity_type = 0;
					$sponsor_limit = 2;
					
					$main_table = 'school_main_info';
					if($entity == 'nursery'){
						$main_table = 'preschool_main_info';
						$entity_type = 1;
					}
					
					
					
					 
 if(isset($post['personalized'])){
	  
	  //Insert userdata into database.
	 $tr = 0;
	 if(isset($post['transportation']))
	 $tr = 1;
	 
	 $res = 0;
	 if(isset($post['reservation']))
	 $res = 1;
	 
	 
	 $jt = 0;
	 if(isset($post['job_transferable']))
	 $jt = 1;
	 
	 
	 
	  
	  $database->query("INSERT INTO user_search VALUES(NULL, '".$post['as_values_location']."', '".$entity_type."', '".$post['board']."', '".$post['school_type']."', '".$post['full_name']."', '".$post['user_email']."', '".$post['user_mobile']."', '".$post['salary_range']."', '".$post['sibling_school']."', '".$jt."', '".$tr."', '".$res."','".$_SERVER['REMOTE_ADDR']."',NOW())"); 
	  
	  unset($_REQUEST['personalized']);
	 
 }
					
					
					
					$loc_array = explode(',',$location);
					
					//Location & school name condition
					$loc_con = "";
					foreach($loc_array as $val){
					 	if(strlen($loc_con) > 0){
						  $loc_con.= " OR ";	
						}
						
						$loc_con.= "(school_search_info.location LIKE '".$val."%' OR school_search_info.school_name LIKE '".$val."%')";
					}
					
					
					//Entity and advertiser condition
					    $query_con = "WHERE (school_search_info.school_code = ".$main_table.".school_code) AND ".$main_table.".advertiser_rank < 10 AND school_search_info.entity_type = ".$entity_type." ";
						
						if(strlen($loc_con) > 0)
						  $query_con = $query_con." AND (".$loc_con.")";
					
				
					
					
					 $query = "SELECT school_search_info.*,school_search_info.school_code from school_search_info,".$main_table." ".$query_con."  ORDER BY  advertiser_rank ASC,ranking DESC,user_ranking DESC LIMIT 0,".$sponsor_limit;
					
					$sponsored_school_sel = $database->query($query);
				 
                    $school_codes = "";
					$tot_results = 0; 				 
				     //Sponsored Results here
				     if(mysqli_num_rows($sponsored_school_sel) > 0){
						  
						  while($school = mysqli_fetch_array($sponsored_school_sel)) {
							  
							  $school_codes.= "'".$school['school_code']."',";
							 ?> 
							  
							  <div class="panel  panel-primary"  >
                          
                        <div class="panel-heading">
                           
                            <h2 class="panel-title" ><a href="../school?sc=<?php echo $school['school_code'];?>" ><?php echo ucwords($school['school_name']);?></a></h2>
                            
                            <h5><i class="fa fa-map-marker"></i> <span class="loc"> <?php echo ucwords($school['location']);?></span>,  <?php echo ucwords($school['city']);?></h5>
                            
                            <div class="schoolCompare" title="Add to Compare" data-toggle="tooltip">
                                <a class="btn btn-success btn-block btn-fab btn-raised " onclick="addToCompare('<?php echo $school['school_code'];?>','<?php echo ucwords($school['school_name']);?>','<?php echo ucwords($school['location']).", ".ucwords($school['city']);?>')"><i class="fa fa-expand"></i></a>
                                
                            </div>
                            <div class="schoolRating">
                               
                                <a class="btn btn-warning btn-block btn-fab btn-raised " href="javascript:void(0)"><i class="fa fa-star"></i></a>
                            <p><?php echo $school['ranking'];?></p>
                            </div>
                              
                        </div>
                        <div class="panel-body">
                               
                                      <div class="row">
                                      <div class="col-sm-3 col-xs-3 schoolProfilePic">
                                          <img src="<?php echo $session->get_school_logo($school['school_code']);?>" alt="No Logo" title="<?php echo ucwords($school['school_name']);?>" />
                                      </div>
                                     
                                      <div class="col-sm-9 col-xs-9">
                                         <div class="row">
                                             <div class="col-xs-4">Board: <b>
                                                    <?php $session->getBoards($school['school_code']);?>  
                                                     
                                                 </b></div>
                                             <div class="col-xs-6">Medium: <b>
                                                     <?php $session->getMediums($school['school_code']);?>  
                                                 </b></div>
                                             <div class="col-xs-2">Est. <b><?php echo $session->get_name($main_table,'school_code',$school['school_code'],'establishment_year');?></b></div>
                                           
                                         </div>
                                          <div class="row">
                                              <div class="col-xs-4"><i class="fa fa-phone"></i> <?php echo "+91-".$session->get_name($main_table,'school_code',$school['school_code'],'phone_number_1');
											  if(strlen($session->get_name($main_table,'school_code',$school['school_code'],'phone_number_2')) > 0){
												echo ', '.$session->get_name($main_table,'school_code',$school['school_code'],'phone_number_2');  
											  }
											  ?></div>
                                              <div class="col-xs-6"><i class="fa fa-envelope"></i> <?php echo $session->get_name($main_table,'school_code',$school['school_code'],'email_id_1');?></div>
                                              <div class="col-xs-2"><i class="fa fa-link "></i> <a href="http://<?php echo $session->get_name($main_table,'school_code',$school['school_code'],'website_url');?>"> Visit</a></div>
                                           
                                         </div>
                                          
                                         <div class="row schoolInfo">
                                         
                                         <div class="col-xs-12">
                                             <?php 
											     $intro = $session->get_name($main_table,'school_code',$school['school_code'],'school_introduction');
											     if(strlen($intro) > 50)
												   $intro =substr($intro,0,50).'...';
													
											     echo ucfirst($intro);		
											 ?>
                                         </div>
                                         </div>
                                         
                                      <div class="row">
                                       <div class="col-xs-12 featuresList">
                                                  
                                                  
                                                   <?php
												     
													 if($school['school_type'] == 1){
														?>
                                                        <span class="ficon" title="Boys">
                                              
                                                        <i class="fa fa-2x fa-male text-success" ></i>
                                                       </span>
                                                        <?php 
													 }
													 if($school['school_type'] == 2){
														?>
                                                        <span class="ficon" title="Girls">
                                              
                                                       <i class="fa fa-2x fa-female text-success" ></i>
                                                       </span>
                                                        <?php 
													 }
													 if($school['school_type'] == 3){
														?>
                                                         <span class="ficon" title="Co-Educational">
                                              
                                                       <i class="fa fa-2x fa-male text-success" ></i>
                                                       <i class="fa fa-2x fa-female text-success" ></i>
                                                       </span>
                                                        <?php 
													 }
													 if($entity_type == 0){
													    
												       $facilities_sel = $database->query("SELECT * FROM school_facilities_info WHERE school_code = '".$school['school_code']."'");
					                                    
														if(mysqli_num_rows($facilities_sel) > 0){
														   $facility = mysqli_fetch_array($facilities_sel);
														   ?>
                                                             
                                                             
                                                          <span class="ficon" title="<?php $facility['no_of_books_lib'].' books';?>">
                                                            <i class="fa fa-2x fa-book <?php  if($facility['library_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Transportation">
                                                            <i class="fa fa-2x fa-bus <?php  if($facility['transport_provided'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Internet">
                                                            <i class="fa fa-2x fa-wifi <?php  if($facility['internet'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="<?php $facility['no_of_computers'].' computers';?>">
                                                            <i class="fa fa-2x fa-desktop <?php  if($facility['no_of_computers'] > 0){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Playground">
                                                            <i class="fa fa-2x fa-futbol-o <?php  if($facility['playground_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Medical Checkup">
                                                            <i class="fa fa-2x fa-medkit <?php  if($facility['medical_checkup'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                             <span class="ficon" title="Cafeteria">
                                                            <i class="fa fa-2x fa-coffee <?php  if($facility['cafeteria_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                            <span class="ficon" title="Hostel">
                                                            <i class="fa fa-2x fa-bed <?php  if($facility['boys_hostel'] > 0 || $facility['girls_hostel'] > 0){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                             <span class="ficon" title="<?php $facility['no_of_books_lib'].' books';?>">
                                                            <i class="fa fa-2x fa-book <?php  if($facility['library_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                                        
                                                              
                                                              
                                                            <?php   
														   
														   	
														}
																					    	 
														 
													 }
												  
												  ?>
                                                  
                                                  
                                        
                                         
                                       </div>
                                       
                                      </div>
                                      </div>
                                      </div>
                                      
                                      
                        </div>
                    </div>
							  
							<?php  
							  $tot_results++;
						  }
						 
					 }
					 
				 
				     $school_con = "";
					 if(strlen($school_codes) > 0){
					   $school_con = "  AND school_search_info.school_code NOT IN (".trim($school_codes,',').")";
					 }
				 
		         	//Entity and advertiser condition
					    $query_con = "WHERE (school_search_info.school_code = ".$main_table.".school_code) AND school_search_info.entity_type = ".$entity_type.$school_con;
						
						if(strlen($loc_con) > 0)
						  $query_con = $query_con." AND (".$loc_con.")";
							    

				 
				 	//Filter Conditions
					$filter_con = "";
					
					if($entity_type == 0){
						if(isset($post['reservation'])){
							if(strlen($filter_con) > 0)
							   $filter_con.= " AND ";
							
						   $filter_con.= " ".$main_table.".reservation_available = 1";	
						}
						
						
						if(isset($post['medium'])){
							if($post['medium'] > 0){
							if(strlen($filter_con) > 0)
							   $filter_con.= " AND ";
							
						   $filter_con.= " (".$main_table.".instruction_medium_1 = ".$post['medium']." OR ".$main_table.".instruction_medium_2 = ".$post['medium']." OR ".$main_table.".instruction_medium_3 = ".$post['medium']." OR ".$main_table.".instruction_medium_4 = ".$post['medium'].")";	
							}
						}
					
					if(isset($post['residential'])){
							if(strlen($filter_con) > 0)
							   $filter_con.= " AND ";
							
						   $filter_con.= " ".$main_table.".is_residential = 1";	
						}
						
					
					}
					
					
						
						if(isset($post['target_class'])){
							if(strlen($post['target_class']) > 0){
							if(strlen($filter_con) > 0)
							   $filter_con.= " AND ";
							
						   $filter_con.= " school_search_info.lowest_class <= ".$post['target_class'];	
							}
						}
					
						if(isset($post['board'])){
							if(strlen($post['board']) > 0){
							if(strlen($filter_con) > 0)
							   $filter_con.= " AND ";
							
						   $filter_con.= " (school_search_info.affiliation_board_1 = '".$post['board']."' OR school_search_info.affiliation_board_2 = '".$post['board']."' OR school_search_info.affiliation_board_3 = '".$post['board']."' OR school_search_info.affiliation_board_4 = '".$post['board']."')";	
							}
						}
					
					
					if(isset($post['school_type'])){
							if(strlen($post['school_type']) > 0){
							if(strlen($filter_con) > 0)
							   $filter_con.= " AND ";
							
							  
							
						   $filter_con.= " (school_search_info.school_type = ".$post['school_type'].")";	
							}
						}
						
						
						
						
					
					  if(strlen($filter_con) > 0)
					    $query_con = $query_con." AND (".$filter_con.")";
					
				        $query = "SELECT school_search_info.*,school_search_info.school_code from school_search_info,".$main_table." ".$query_con."  ORDER BY   ranking DESC,user_ranking DESC LIMIT 0,50";
					
					$school_sel = $database->query($query);
				   
				   
				   //Normal Results here
				     if(mysqli_num_rows($school_sel) > 0){
						  
						  while($school = mysqli_fetch_array($school_sel)) {
							  
							  $display = 1;
							  if(isset($post['playground'])){
								if(strlen($post['playground']) > 0){
								   
								   if($entity_type == 0)
									$display = $database->get_name('school_facilities_info','school_code',$school['school_code'],'playground_present');
									
									 if($entity_type == 1)
									$display = $database->get_name('preschool_facilities_info','school_code',$school['school_code'],'playarea_present');	
								}
						      }
							  
							  
							   if(isset($post['transportation'])){
								if(strlen($post['transportation']) > 0){
								  
									 
									$display = $database->get_name($main_table,'school_code',$school['school_code'],'transport_provided');	
								}
						      }
						      
							  if($display > 0){
							  
							  
							 
							 ?> 
							  
							  <div class="panel  panel-default"  >
                          
                        <div class="panel-heading">
                           
                            <h2 class="panel-title" ><a href="../school?sc=<?php echo $school['school_code'];?>" ><?php echo ucwords($school['school_name']);?></a></h2>
                            
                            <h5><i class="fa fa-map-marker"></i> <span class="loc"> <?php echo ucwords($school['location']);?></span>,  <?php echo ucwords($school['city']);?></h5>
                            
                            <div class="schoolCompare" title="Add to Compare" data-toggle="tooltip">
                                <a class="btn btn-success btn-block btn-fab btn-raised " onclick="addToCompare('<?php echo $school['school_code'];?>','<?php echo ucwords($school['school_name']);?>','<?php echo ucwords($school['location']).", ".ucwords($school['city']);?>')"><i class="fa fa-expand"></i></a>
                                
                            </div>
                            <div class="schoolRating">
                               
                                <a class="btn btn-warning btn-block btn-fab btn-raised " href="javascript:void(0)"><i class="fa fa-star"></i></a>
                            <p><?php echo $school['ranking'];?></p>
                            </div>
                              
                        </div>
                        <div class="panel-body">
                               
                                      <div class="row">
                                      <div class="col-sm-3 col-xs-3 schoolProfilePic">
                                          <img src="<?php echo $session->get_school_logo($school['school_code']);?>" alt="No Logo" title="<?php echo ucwords($school['school_name']);?>" />
                                      </div>
                                     
                                      <div class="col-sm-9 col-xs-9">
                                         <div class="row">
                                             <div class="col-xs-4">Board: <b>
                                                    <?php $session->getBoards($school['school_code']);?>  
                                                     
                                                 </b></div>
                                             <div class="col-xs-6">Medium: <b>
                                                     <?php $session->getMediums($school['school_code']);?>  
                                                 </b></div>
                                             <div class="col-xs-2">Est. <b><?php echo $session->get_name($main_table,'school_code',$school['school_code'],'establishment_year');?></b></div>
                                           
                                         </div>
                                          <div class="row">
                                              <div class="col-xs-4"><i class="fa fa-phone"></i> <?php echo "+91-".$session->get_name($main_table,'school_code',$school['school_code'],'phone_number_1');
											  if(strlen($session->get_name($main_table,'school_code',$school['school_code'],'phone_number_2')) > 0){
												echo ', '.$session->get_name($main_table,'school_code',$school['school_code'],'phone_number_2');  
											  }
											  ?></div>
                                              <div class="col-xs-6"><i class="fa fa-envelope"></i> <?php echo $session->get_name($main_table,'school_code',$school['school_code'],'email_id_1');?></div>
                                              <div class="col-xs-2"><i class="fa fa-link "></i> <a href="http://<?php echo $session->get_name($main_table,'school_code',$school['school_code'],'website_url');?>"> Visit</a></div>
                                           
                                         </div>
                                          
                                         <div class="row schoolInfo">
                                         
                                         <div class="col-xs-12">
                                             <?php 
											     $intro = $session->get_name($main_table,'school_code',$school['school_code'],'school_introduction');
											     if(strlen($intro) > 50)
												   $intro =substr($intro,0,50).'...';
													
											     echo ucfirst($intro);		
											 ?>
                                         </div>
                                         </div>
                                         
                                      <div class="row">
                                       <div class="col-xs-12 featuresList">
                                                  
                                                  
                                                   <?php
												     
													 if($school['school_type'] == 1){
														?>
                                                        <span class="ficon" title="Boys">
                                              
                                                        <i class="fa fa-2x fa-male text-success" ></i>
                                                       </span>
                                                        <?php 
													 }
													 if($school['school_type'] == 2){
														?>
                                                        <span class="ficon" title="Girls">
                                              
                                                       <i class="fa fa-2x fa-female text-success" ></i>
                                                       </span>
                                                        <?php 
													 }
													 if($school['school_type'] == 3){
														?>
                                                         <span class="ficon" title="Co-Educational">
                                              
                                                       <i class="fa fa-2x fa-male text-success" ></i>
                                                       <i class="fa fa-2x fa-female text-success" ></i>
                                                       </span>
                                                        <?php 
													 }
													 if($entity_type == 0){
													    
												       $facilities_sel = $database->query("SELECT * FROM school_facilities_info WHERE school_code = '".$school['school_code']."'");
					                                    
														if(mysqli_num_rows($facilities_sel) > 0){
														   $facility = mysqli_fetch_array($facilities_sel);
														   ?>
                                                             
                                                             
                                                          <span class="ficon" title="<?php $facility['no_of_books_lib'].' books';?>">
                                                            <i class="fa fa-2x fa-book <?php  if($facility['library_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Transportation">
                                                            <i class="fa fa-2x fa-bus <?php  if($facility['transport_provided'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Internet">
                                                            <i class="fa fa-2x fa-wifi <?php  if($facility['internet'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="<?php $facility['no_of_computers'].' computers';?>">
                                                            <i class="fa fa-2x fa-desktop <?php  if($facility['no_of_computers'] > 0){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Playground">
                                                            <i class="fa fa-2x fa-futbol-o <?php  if($facility['playground_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>
                                                           <span class="ficon" title="Medical Checkup">
                                                            <i class="fa fa-2x fa-medkit <?php  if($facility['medical_checkup'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                             <span class="ficon" title="Cafeteria">
                                                            <i class="fa fa-2x fa-coffee <?php  if($facility['cafeteria_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                            <span class="ficon" title="Hostel">
                                                            <i class="fa fa-2x fa-bed <?php  if($facility['boys_hostel'] > 0 || $facility['girls_hostel'] > 0){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                             <span class="ficon" title="<?php $facility['no_of_books_lib'].' books';?>">
                                                            <i class="fa fa-2x fa-book <?php  if($facility['library_present'] == 1){ echo "text-success"; }?>"></i>
                                                          </span>    
                                                              
                                                                        
                                                              
                                                              
                                                            <?php   
														   
														   	
														}
																					    	 
														 
													 }
												  
												  ?>
                                                  
                                                  
                                        
                                         
                                       </div>
                                       
                                      </div>
                                      </div>
                                      </div>
                                      
                                      
                        </div>
                    </div>
							  
							<?php  
							 
							  $tot_results++;
						  
						  
							  }
						  
						  }
						 
					 }
					 
				 
				 
				 ?>
     
     
     
             <?php
			    if($tot_results == 0){
					
				?>
                
                  
                     <div class="panel  panel-default"  >
                         
                           <div class="panel-body" style="text-align:center;padding-top:40px;">
                               <h2 class="panel-title" >Oops! we couldn't find any results for that!!</h2>
                               <p>Please try a different search. Start typing a locality or school name</p>
                              
                           </div>
                         
                       </div>
                
                <?php	
					
				}
			 ?>
                
     
             </div>
             
             <div class="col-md-4 col-sm-8">
             
                <div class="adBox">
                Ads here
                
                </div>
                <div class="adBox">
                Ads here
                
                </div>
                <div class="adBox">
                Ads here
                
                </div>
             </div>
         
         
         
     
     
         <div style="clear:both"></div>
         
         
         
         
         
         
      </div>
      </div>
      
   </section>
   

  
<?php  $session->commonFooter();?>

</section>
 
<!--go-top link--> 
<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a> 
 
 
<?php $session->commonJS();

  if($tot_results == 0){
	?>
     <script type="text/javascript">
							    
							      $('#prefill').val('');
								  initAutocomplete();
								  
								  $('#location').focus()
							   $('.selectpicker').selectpicker();
							   </script>
<?php  
	
  }
?> 
 
<script src="<?php echo JS_PATH;?>custom_jquery.js"></script>
</body>
</html>