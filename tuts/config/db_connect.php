<?php 

	$conn = mysqli_connect('localhost', 'beata', 'test1234', 'ninja_pizza2');

	if(!$conn){
		echo 'Connection error:' . mysqli_connect_error();
	} 

 ?>