<?php
	function db_connect(){
		$conn = mysqli_connect("localhost", "root", "Pimpudi.10", "book-shop");
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}
		return $conn;
	}

	function getBookByIsbn($conn, $isbn){
		$query = "SELECT name, author, price FROM books WHERE bookid = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	function getOrderId($conn, $customerid){
		$query = "SELECT orderid FROM orders WHERE customerid = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['orderid'];
	}

	function insertIntoOrder($conn, $customerid, $total_price, $date, $ship_name, $ship_address, $ship_city, $ship_state, $ship_zip_code){
		$query = "INSERT INTO orders VALUES 
		('', '" . $customerid . "', '" . $total_price . "', '" . $date . "', '" . $ship_name . "', '" . $ship_address . "', '" . $ship_city . "', '" . $ship_state . "', '" . $ship_zip_code . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert orders failed " . mysqli_error($conn);
			exit;
		}
	}

	function getbookprice($isbn){
		$conn = db_connect();
		$query = "SELECT price FROM books WHERE bookid = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get book price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['price'];
	}

	function getCustomerId($name, $address, $city, $state, $zip_code){
		$conn = db_connect();
		$query = "SELECT customerid from customers WHERE 
		name = '$name' AND 
		address= '$address' AND 
		city = '$city' AND 
		state = '$state' AND 
		zip_code = '$zip_code' ";
		
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			if (isset($row['customerid'])) 
			{
			    return $row['customerid'];
			}
		} else {
			return null;
		}
	}

	function setCustomerId($name, $address, $city, $state, $zip_code){
		$conn = db_connect();
		$query = "INSERT INTO customers VALUES 
			('', '" . $name . "', '" . $address . "', '" . $city . "','" . $state . "', '" . $zip_code . "')";

		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "insert false !" . mysqli_error($conn);
			exit;
		}
		$customerid = mysqli_insert_id($conn);
		return $customerid;
	}

	function getAll($conn){
		$query = "SELECT * from books ORDER BY bookid DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
?>