<?php  
include('./config/db_connect.php');

//write qury to get data
$sql = 'SELECT id, title, email, ingredients FROM coffee ORDER BY created_at ';

//get the result
$result=mysqli_query($conn,$sql);

//fetch the resulting rows as array
$coffees=mysqli_fetch_all($result,MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close the database connection
mysqli_close($conn);


?>

<!DOCTYPE html>
<html>


<?php  include('templates/header.php'); ?>

<h4 class="center grey-text">Coffees</h4>
<div class="container">
	<div class="row">
		<?php 
		foreach ($coffees as $key => $coffee):?>
			<div class="col s6 md3">
				<div class="card z-depth-0">
					<div class="card-content center">
						<h6><?php echo htmlspecialchars($coffee['title']); ?></h6>
						<div>
							<ul>
								<?php foreach (explode(',', $coffee['ingredients']) as $ing) : ?>
									<li><?php echo htmlspecialchars($ing); ?></li>
								<?php endforeach; ?>


								
							</ul>
						</div>
					</div>
					<div class="card-action right-align">
						<a class="brand-text" href="detail.php?id=<?php echo $coffee['id'] ?>" php>more info</a>
					</div>
				</div>
			</div>
			
		<?php endforeach; ?>

		<?php if(count($coffees)>=3): ?>
			<p>there are three more coffees</p>
			<?php else: ?>
				<p>there are less than 3 coffees</p>



		<?php endif; ?>



		 
	</div>
</div>

<?php  include('templates/footer.php'); ?>

</html>