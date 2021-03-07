<?php
// Connecting server
require_once "../connectserver.php";

if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM books WHERE name LIKE ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        // Set parameters
        $param_term = $_REQUEST["term"] . '%';
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $name = $row["name"];
                    echo "<p>" . "<a href='ViewBook.php?bookid=". $row['bookid'] ."' title='Book Details' style='color: black;' data-toggle='tooltip'> $name</span></a>" . "</p>";
                    //echo "<a href='ViewBook.php?bookid=". $row['bookid'] ."' title='Book Details' data-toggle='tooltip'> $name</span></a>";
                }
            } else{
                echo "<p>No matches found</p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}
 
// close connection
mysqli_close($link);
?>