<?php
include('include/session.php');


if(isset($_POST['validateForm']))
{	
if($_REQUEST['name']=='' || $_REQUEST['email']=='' || $_REQUEST['message']=='')
{
	?>
    <script type="text/javascript">
$('#myModal1').modal('show');
	
	</script>
    <?php
}
else
{
$query = $database->query("insert into user_data values(NULL,'".$_REQUEST['name']."','".$_REQUEST['email']."','".$_REQUEST['message']."','".time()."')");
?>
<script type="text/javascript">

$('#myModal2').modal('show');
 $("#name").remove();
 $("#email").remove();
$("#message").remove();

	</script>
	<?php
}
}

?>

</html>