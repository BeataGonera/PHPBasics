<?php 

	$errors = ['email' => '', 'title' => '', 'ingredients' => ''];

	if(isset($_POST['submit'])){
		// echo htmlspecialchars($_POST['email']); // arrays called globals
		// echo htmlspecialchars($_POST['title']);
		// echo htmlspecialchars($_POST['ingredients']);

		if(empty ($_POST['email'])){
			$errors['email'] = 'An email is required <br/>';
		}else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'E-mail must be a valid e-mail address';
			}
		}

		if(empty ($_POST['title'])){
			$errors['title'] = 'A pizza title is required <br/>';
		}else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only.';
			}
		}

		if(empty ($_POST['ingredients'])){
			$errors['ingredients'] = 'Ingredients are required <br/>';
		}else{
			// echo htmlspecialchars($_POST['ingredients']);
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list.';
			}
		}

		if(array_filter($errors)){
			echo 'errors in the form';
		}else{
			header('Location: index.php');
		}
	
	}
	
?>

<!DOCTYPE html>
<html>

	<?php include 'Templates/header.php'; ?>

	<section class="container grey-text">
	<h4 class="center">Add a pizza</h4>
	<form class="white" action="add.php" method="POST">
		<label>Your e-mail:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
		<div class="red-text"><?php echo $errors['email'] ?></div>
		<label>Pizza title:</label>
		<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
		<div class="red-text"><?php echo $errors['title'] ?></div>
		<label>Ingredients (comma separated):</label>
		<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
		<div class="red-text"><?php echo $errors['ingredients'] ?></div>
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn z-depth-0 brand">
		</div>
	</form>
	</section>

	<?php include 'Templates/footer.php'; ?>

</html>