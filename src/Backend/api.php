<?php
	$server= "localhost";
	$user= "root";
	$password= "";
	$dbname = "bookstore";
	$port= "3308";

	$conn = new mysqli($server,$user,$password,$dbname,$port);

	if($conn->connect_error){
		die("Connection Failed!, " .$conn->connect_error);
	}

	$result = array('error'=>false);
	$action = '';

	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}



	// FETCHING DATA FROM THE DB
	if($action == "read"){
		$sql = $conn->query("SELECT * FROM book");
		$book = array();
		while ($row = $sql->fetch_assoc()) {
			array_push($book, $row);
		}
		$result['book'] = $book;
	}



	// ADDING DATA TO THE DB
	if($action == "create"){
		$name = $_POST['name'];
		$author = $_POST['author'];
		$price = $_POST['price'];

		$sql = $conn->query("INSERT INTO book (name,author,price) VALUES('$name','$author','$price')");

		if($sql){
			$result['message'] = "Book was added successfully!";
		}
		else{
			$result['error'] = true;
			$result['message'] = "Cannot add book!";
		}
	}



	// UPDATING DATA
	if($action == "update"){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$author = $_POST['author'];
		$price = $_POST['price'];

		$sql = $conn->query("UPDATE book SET name='$name',author='$author',price='$price' WHERE id='$id'");

		if($sql){
			$result['message'] = "Book was updated successfully!";
		}
		else{
			$result['error'] = true;
			$result['message'] = "Cannot update the book info!";
		}
	}



	// DELETING DATA
	if($action == "delete"){
		$id = $_POST['id'];

		$sql = $conn->query("DELETE FROM book WHERE id='$id'");

		if($sql){
			$result['message'] = "Book was deleted successfully!";
		}
		else{
			$result['error'] = true;
			$result['message'] = "Cannot delete this book!";
		}
	}


	$conn->close();
	echo json_encode($result);
?>