<?php
include('./config/db_connect.php');


$errors= array('email' =>'' , 'type'=>'','ingredients'=>'');
if(isset($_POST['submit'])) {
	if(empty($_POST['email'])){
		$errors['email']="email is required <br />";
	}else{
		$email=$_POST['email'];
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$errors['email']="email is not valid";
		}
	}
	if(empty($_POST['type'])){
		$errors['type']="cofee type is required <br />";
	}else{
		$type=$_POST['type'];
		if(!preg_match('/^[a-zA-Z\s]+$/',$type)){
			$errors['type']='invalid type';
		}
	}
	if(empty($_POST['ingredients'])){
		$errors['ingredients']="ingredients is required <br />";
	}else{
		$ingredients=$_POST['ingredients'];
		if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA_Z\s]*)*$/',$type)){
			$errors['ingredients']="invalid ingredients";
		}
	}
	if(array_filter($errors)){
		echo "errors in the form";
	}else{
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$type = mysqli_real_escape_string($conn,$_POST['type']);
		$ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);

		$sql= "INSERT INTO coffee(title,email,ingredients) VALUES('$type','$email','$ingredients')";

		if(mysqli_query($conn,$sql)){

		}else{
			echo 'query error'.mysqli_error($conn);
		}



		header('Location:index.php');


	}
}



 ?>

<!DOCTYPE html>
<html>
<?php  include('templates/header.php'); ?>

<section class="container grey-text">
	<h4 class="center">Add a Coffee</h4>
	<form class="white" action="add.php" method="POST">
		<label>Your Email</label>
		<input type="text" name="email">
		<div class="red-text"><?php echo $errors['email'] ?></div>
		<label>Coffee Type</label>
		<input type="text" name="type">
		<div class="red-text"><?php echo $errors['type'] ?></div>
		<label>Ingredients</label>
		<input type="text" name="ingredients">
		<div class="red-text"><?php echo $errors['ingredients'] ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand" >
		</div>
	</form>
</section>

<?php  include('templates/footer.php'); ?>
</html>