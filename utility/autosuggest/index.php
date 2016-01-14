<?php 
include('../../include/session.php');
if(isset($_GET["to"])){
$input = $_GET["to"];
$data = array();
// query your DataBase here looking for a match to $input
$entity = '';
if(isset($_GET['entity'])){
	
	$en = 0;
	if($_GET['entity'] == 'nursery')
	$en = 1;
	
	$entity = " AND entity_type = ".$en;
}


$query = $database->query("select DISTINCT(location) as val from school_search_info WHERE (location LIKE '".$input."%') ".$entity." LIMIT 0,5 UNION select DISTINCT(school_name) as val from school_search_info WHERE (location LIKE '".$input."%' OR school_name LIKE '".$input."%')  ".$entity." LIMIT 0,5");

while ($row = mysqli_fetch_assoc($query)) {
$json = array();
$json['value'] = $row['val'];
$json['name'] = ucwords($row['val']);
 
$data[] = $json;
}

 
header("Content-type: application/json");
echo json_encode($data);
}


if(isset($_GET['school_code'])){
	$school_info = $database->query("SELECT * FROM school_search_info WHERE school_code = '".$_GET['school_code']."'");
	$school = mysqli_fetch_array($school_info);
	
	
	$main_table = 'school_main_info';
	if($school['entity_type'] == 1)
	$main_table = 'preschool_main_info';
	
	
	$path =  "../../photos/images/".$school['school_code']."/logo/";
	
	if(is_dir($path)){
	$files=scandir($path);

		foreach ($files as $key =>$val){
					
					if(strlen($val) >3  && $val != '.DS_Store'&& $val != 'Thumbs.db')
					{
						
						 $path = $val;
						
						
					}
		}
	}
	?>
    <a class="closeView" onClick="$('#schoolView').hide();"><i class="fa fa-times fa-2x"></i></a><div class="panel panel-primary">
                        <div class="panel-body">
                              
                               <div class="col-sm-4 vschoolProfilePic">
                                          <img src="../photos/images/<?php echo $school['school_code'];?>/logo/<?php echo $path;?>"  title="<?php echo $school['school_name']; ?>" alt="No Logo" />
                                 </div>
                                 <div class="col-sm-8">
                                     <div class="row schoolProfileRating">
                                                      <div class="col-sm-2 check">           
                                                             <a class="btn btn-warning   btn-fab btn-raised mdi-action-grade" data-toggle="tooltip" title="Overall Rating" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-4 rating"><h2><?php echo $school['ranking']; ?></h2></div>
                                                      <div class="col-sm-2 check">           
                                                             <a class="btn btn-success   btn-fab btn-raised mdi-action-grade" data-toggle="tooltip" title="User Rating" href="javascript:void(0)"></a>
                                                      </div>
                                                      <div class="col-sm-4 rating"><h2><?php echo $school['user_ranking']; ?></h2></div>   
                                                      
                            </div>
                            
                              <div >Established: <b><?php echo $session->get_name($main_table,'school_code',$school['school_code'],'establishment_year');?></b></div>
                                              <div >Board: <b> <?php $session->getBoards($school['school_code']);?> </b></div>
                                           <div >Medium: <b><?php $session->getMediums($school['school_code']);?></b></div>
                                          
                                 </div>
                                      
                        </div>
                            <div class="panel-footer">
                            <h2 class="panel-title"><?php echo ucwords($school['school_name']);?></h2>
                            <h5><i class="fa fa-map-marker"></i> <span class="loc"><?php echo ucwords($school['location']);?></span>,  <?php echo ucwords($school['city']);?></h5>
                        </div>
                    </div>
                      <div class="schoolProfileSummary"> <h4>Quick Facts</h4>
                      <ul class="quickFacts" >
                      
                      </ul> </div>
    <?php
	
}
?>