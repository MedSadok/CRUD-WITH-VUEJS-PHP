<?php

	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST');
	header("Access-Control-Allow-Headers: X-Requested-With");

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
		$sql = $conn->query("SELECT * FROM books");
		$book = array();
		while ($row = $sql->fetch_assoc()) {
			array_push($book, $row);
		}
		$result['books'] = $book;
	}



	// ADDING DATA TO THE DB
	if($action == "create"){
		$Title = $_POST['Title'];
		$Author = $_POST['Author'];
		$Price = $_POST['Price'];

		$sql = $conn->query("INSERT INTO books (Title,Author,Price) VALUES('$Title','$Author','$Price')");

		if($sql){
			$result['message'] = "Book was added successfully!";
		}
		else{
			$result['error'] = true;
			$result['message'] = "Cannot add book! Maybe it's already exist";
		}
	}



	// UPDATING DATA
	if($action == "update"){
		$id = $_POST['id'];
		$Title = $_POST['Title'];
		$Author = $_POST['Author'];
		$Price = $_POST['Price'];

		$sql = $conn->query("UPDATE books SET Title='$Title',Author='$Author',Price='$Price' WHERE id='$id'");

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

		$sql = $conn->query("DELETE FROM books WHERE id='$id'");

		if($sql){
			$result['message'] = "Book was deleted successfully!";
		}
		else{
			$result['error'] = true;
			$result['message'] = "Cannot delete this book!";
		}
	}


	echo json_encode($result);
	$conn->close();
?>