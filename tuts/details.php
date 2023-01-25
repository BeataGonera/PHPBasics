<?php 

    include('config/db_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql = "DELETE FROM pizzas WHERE id=$id_to_delete";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');

        }{
            echo "Query error" . mysql_error($conn);
        }
    }

    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM pizzas WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn);

        print_r($pizza);
    }


 ?>

 <!DOCTYPE html>
 <html>
 	<?php include('Templates/header.php'); ?>

    <div class="container center">

        <?php if($pizza){ ?>
        <div class="card z-depth-0">
            <h4 class="center"><?php echo htmlspecialchars(strtoupper($pizza['title'])); ?></h4>
            <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
            <p><?php echo date($pizza['created_at']); ?></p>

            <ul>
                <?php foreach(explode(',', $pizza['ingredients']) as $ingredient): ?>
                <li><?php echo htmlspecialchars($ingredient); ?></li></br>
                <?php endforeach; ?>
            </ul>

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                <input type="submit" name="delete" value="Delete" class="btn z-depth-0 brand">
            </form>
        </div>

        <?php }else{ ?>
            <p>No such pizza exists.</p>
        <?php } ?>

    </div>

 	<?php include('Templates/footer.php'); ?>

 </html>