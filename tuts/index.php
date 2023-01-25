<?php 

include ('config/db_connect.php');

//query for all pizzas
	$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

//make query
	$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an associative array
	$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free from memory 
	mysqli_free_result($result);

//close connection
	mysqli_close($conn);
	
?>

<!DOCTYPE html>
<html>


	<?php include('Templates/header.php'); ?>
	
	<h4 class='grey-text center'>Pizzas</h4>
	<div class="container">
		<div class="row">
			<?php foreach ($pizzas as $pizza): ?>
				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
							<ul>
							<p>
								<?php foreach (explode(',', $pizza['ingredients']) as $ingredient): ?> 
									<li><?php echo htmlspecialchars($ingredient);  ?></li>
								<?php endforeach; ?>
							</p>
							</ul>
							<div class="card-action right-align">
								<a class='brand-text' href='details.php?id=<?php echo $pizza['id']?>'>More info</p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>

			<?php if(count($pizzas) >= 2):  ?>
				<p>There are 2 or more pizzas</p>
			<?php else: ?>
				<p>There are less than 2 pizzas</p>
			<?php endif; ?>
		</div>
	</div>

	<?php include('Templates/footer.php'); ?>

</html>