<?php
include('../include/session.php');
 
if(isset($_POST['data']))
{	
	$post = $session->cleanInput($_POST);

	$_SESSION['error'] = array();
	
	$field = 'full_name';
	if(!$post['full_name'] || strlen(trim($post['full_name'])) == 0){
	  $_SESSION['error'][$field] = "*Please enter full name";
	} 
	
	$field = 'user_email';
	if(!$post['user_email'] || strlen(trim($post['user_email'])) == 0){
	  $_SESSION['error'][$field] = "*Please enter user email";
	} 
	
	$field = 'user_mobile';
	if(!$post['user_mobile'] || strlen(trim($post['user_mobile'])) == 0){
	  $_SESSION['error'][$field] = "*Please enter user mobile";
	} 
	
	
	$field = 'age';
	if(!$post['age'] || strlen(trim($post['age'])) == 0){
	  $_SESSION['error'][$field] = "*Please enter age";
	} 
	
	$field = 'location';
	if(!$post['location'] || strlen(trim($post['location'])) == 0){
	  $_SESSION['error'][$field] = "*Please enter location";
	} 
	
	$field = 'qualification';
	if(!$post['qualification'] || strlen(trim($post['qualification'])) == 0){
	  $_SESSION['error'][$field] = "*Please enter qualification";
	} 
	
	$field = 'target_class';
	if(!$post['target_class'] || strlen(trim($post['target_class'])) == 0){
	  $_SESSION['error'][$field] = "*Please select target class";
	} 
if(count($_SESSION['error']) > 0 ){
	?>
    <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body" >
    <form class="bs-component"   > 
           
            
            
           <div class="item personalized_search enquiry_form">
            
            
    <fieldset>
     
        <div class="form-group full_name" data-content="Please fill your full name" data-trigger="focus" onclick="$(this).popover('hide');">
           
            <input class="form-control  floating-label"  value="<?php if(isset($_POST['full_name'])){ echo $_POST['full_name'];}?>" id="full_name" placeholder="Your Full Name" name="full_name"   />
                <span class="error" style="color:#F00;"><?php if(isset($_SESSION['error']['full_name'])){ echo $_SESSION['error']['full_name'];}?></span>
           
        </div>
         
        <div class="form-group user_email" data-content="Please Enter a valid email id" data-trigger="focus" onclick="$(this).popover('hide');">
            <input class="form-control floating-label" value="<?php if(isset($_POST['user_email'])){ echo $_POST['user_email'];}?>" name="user_email" id="user_email" placeholder="Email" type="text"   />
            <span class="error" style="color:#F00;"><?php if(isset($_SESSION['error']['user_email'])){ echo $_SESSION['error']['user_email'];}?></span>
        </div>
               
            
          <div class="form-group  user_mobile" data-content="Please Enter a valid mobile number" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['user_mobile'])){ echo $_POST['user_mobile'];}?>" name="user_mobile" id="user_mobile"   placeholder="Mobile" type="text"   />
            <span class="error" style="color:#F00;"><?php if(isset($_SESSION['error']['user_mobile'])){ echo $_SESSION['error']['user_mobile'];}?></span>
        </div>
        
    
    
    
     <div class="form-group  age" data-content="Please Enter Your Age" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['age'])){ echo $_POST['age'];}?>" name="age" id="age"   placeholder="Age" type="text"   />
             <span class="error" style="color:#F00;"><?php if(isset($_SESSION['error']['age'])){ echo $_SESSION['error']['age'];}?></span>
        </div>
        
        
         <div class="form-group  qualification" data-content="Please Enter Your Qualification" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['qualification'])){ echo $_POST['qualification'];}?>" name="qualification" id="qualification"   placeholder="Qualification" type="text"   />
             <span class="error" style="color:#F00;"><?php if(isset($_SESSION['error']['qualification'])){ echo $_SESSION['error']['qualification'];}?></span>
        </div>
        
        <div class="form-group  location" data-content="Please Enter Your Location" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="<?php if(isset($_POST['location'])){ echo $_POST['location'];}?>" name="location" id="location"   placeholder="Location" type="text"   />
             <span class="error" style="color:#F00;"><?php if(isset($_SESSION['error']['location'])){ echo $_SESSION['error']['location'];}?></span>
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
 <span class="error" style="color:#F00;"><?php if(isset($_SESSION['error']['target_class'])){ echo $_SESSION['error']['target_class'];}?></span>
</div>

     
        
           <div class="form-group" >
           <div style="height:30px;"></div>
            <label for="inputSalaryF" class=" control-label">Select Salary Range </label>
           <br />
            <div class="col-sm-12 col-xs-12">
          <b class="rangeTxtLow"  >20k</b>
           
          <input type="text" id="salary_rangen" name="salary_rangen"  value="<?php if(isset($_POST['salary_rangen'])){ echo $_POST['salary_rangen'];}?>"      data-slider-min="20000" data-slider-max="150000" data-slider-step="2000" data-slider-value="[20000,60000]" data-slider-orientation="horizontal" />
          
             <b  class=" rangeTxtHigh"  > &gt; 1.5L</b> 
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
        
          
           
         <div class="form-group  query" >
              <textarea class="form-control floating-label"  value="<?php if(isset($_POST['query'])){ echo $_POST['query'];}?>" name="query" id="query"   placeholder="Your Query" ></textarea>
            
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
                <a  class="btn btn-primary btn-raised btn-lg" onClick="setState('myModalview','ajax.php','data=1&full_name='+$('#full_name').val()+'&user_email='+$('#user_email').val()+'&user_mobile='+$('#user_mobile').val()+'&salary_rangen='+$('#salary_rangen').val()+'&tds1='+$('#tds1').val()+'&sibling_schooln='+$('#sibling_schooln').val()+'&tds='+$('#tds').val()+'&age='+$('#age').val()+'&qualification='+$('#qualification').val()+'&query='+$('#query').val()+'&location='+$('#location').val()+'&target_class='+$('#target_class').val()+'&school_code=<?php echo $_REQUEST['school_code'];?>');" >Submit</a>
            
        </div>
        
        <div id="errVal" style="display:none;">
            
        </div>
    </fieldset>

               
               
           </div>
    
      </form>
      
      <script type="text/javascript">
       
$('#salary_rangen').bootstrapSlider({tooltip:'always',tooltip_position:'top'});

 
      </script>
     </div>
                  </div>
              </div>
<?php	
	}
else
{
	if($_REQUEST['tds1']==2)
	{
		$tds=2;
	}
	else
	{
		$tds=1;
	}
$query = $database->query("insert into enquiry_data values(NULL,'".$_REQUEST['full_name']."','".$_REQUEST['user_email']."','".$_REQUEST['user_mobile']."','".$_REQUEST['salary_rangen']."','".$_REQUEST['age']."','".$_REQUEST['qualification']."','".$tds."','".$_REQUEST['location']."','".$_REQUEST['target_class']."','".$_REQUEST['school_code']."','".time()."')");

?>

<script type="text/javascript">

   document.getElementById("full_name").value= "";
   document.getElementById("user_email").value= "";
   document.getElementById("user_mobile").value= "";
   document.getElementById("salary_rangen").value= "";
   document.getElementById("sibling_schooln").value= "";
   document.getElementById("main_school").value= "";

	</script>
    <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" style="color:#F00;">Information Saved Successfully</h4>
                      </div>
                      <div class="modal-body" >
    <form class="bs-component"   > 
           
            
            
           <div class="item personalized_search">
            
            
    <fieldset>
     
        <div class="form-group full_name" data-content="Please fill your full name" data-trigger="focus" onclick="$(this).popover('hide');">
           
            <input class="form-control  floating-label"  value="" id="full_name" placeholder="Your Full Name" name="full_name"   />
               
           
        </div>
         
        <div class="form-group user_email" data-content="Please Enter a valid email id" data-trigger="focus" onclick="$(this).popover('hide');">
            <input class="form-control floating-label" value="" name="user_email" id="user_email" placeholder="Email" type="text"   />
           
        </div>
               
            
          <div class="form-group  user_mobile" data-content="Please Enter a valid mobile number" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="" name="user_mobile" id="user_mobile"   placeholder="Mobile" type="text"   />
            
        </div>
        
    
    
    
     <div class="form-group  age" data-content="Please Enter Your Age" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="" name="age" id="age"   placeholder="Age" type="text"   />
             
        </div>
        
        
         <div class="form-group  qualification" data-content="Please Enter Your Qualification" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="" name="qualification" id="qualification"   placeholder="Qualification" type="text"   />
            
        </div>
        
        <div class="form-group  location" data-content="Please Enter Your Location" data-trigger="focus" onclick="$(this).popover('hide');">
              <input class="form-control floating-label"  value="" name="location" id="location"   placeholder="Location" type="text"   />
            
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
           
          <input type="text" id="salary_rangen" name="salary_rangen"  value=""      data-slider-min="8000" data-slider-max="60000" data-slider-step="2000" data-slider-value="[20000,40000]" data-slider-orientation="horizontal" />
          
             <b  class=" rangeTxtHigh"  > &gt; 60000</b> 
             </div>
        </div>
                
        <br>

  
  
        <div class="form-group" style="display:none">
            <label class=" control-label">Do You have another Child studying in School?</label>
          
                <div class="radio radio-primary">
                    <label>
                        <input name="cbox"   id="cbox"  value="1"  onClick="fun($(this).val())"  type="radio" />
                        Yes
                    </label>
                
                    <label>
                        <input name="cbox"   checked="" id="cbox"  value="0"  onClick="fun($(this).val())" type="radio" />
                        No
                    </label>
                </div>
                  <input type="hidden" id="radd" value="" />

                <div style="display:none;" id="sibling_school">
            
                    <input class="form-control floating-label" id="sibling_schooln" name="sibling_schooln" placeholder="School Name"  value=""  type="text" />
            
        
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
    
      </form>
     </div>
                  </div>
              </div>
	<?php
}
}

?>