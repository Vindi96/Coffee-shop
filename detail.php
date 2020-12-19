<?php 
include('./config/db_connect.php');

if(isset($_POST['delete'])){
	$id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);

	$sql="DELETE FROM coffee WHERE id=$id_to_delete";

if(mysqli_query($conn,$sql)){
	//success
	header('Location: index.php');
}{
	echo "Query Error:" .mysqli_error($conn);
}
}
// check GET request id param
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($conn,$_GET['id']);

	//make sql
	$sql="SELECT * FROM coffee WHERE id=$id";

	//get query result
	$result = mysqli_query($conn,$sql);

	//fetch result in array format

	$coffee=mysqli_fetch_assoc($result);

	mysqli_free_result($result);
	mysqli_close($conn);

	

}

 ?>

 <!DOCTYPE html>
 <html>
 <?php  include('templates/header.php'); ?>
 <div class="container center">
 	<?php if($coffee): ?>
 		<h4><?php echo htmlspecialchars($coffee['title']); ?></h4>
 		<p>created by: <?php echo htmlspecialchars($coffee['email']); ?></p>
 		<p><?php echo htmlspecialchars($coffee['created_at']); ?></p>
 		<h5>Ingredients: <?php echo htmlspecialchars($coffee['ingredients']); ?></h5>

 		<!--DELETE FORM-->
 		<form action="detail.php" method="POST">
 			<input type="hidden" name="id_to_delete" value="<?php  echo $coffee['id']?>">
 			<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
 		</form>



 	<?php else: ?>
 		<h4><?php echo "No such coffee exist"; ?></h4>
 	<?php endif ?>
 </div>
 <?php  include('templates/footer.php'); ?>
 </html>