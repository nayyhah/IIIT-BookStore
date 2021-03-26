<!DOCTYPE html>
<html>
<head>

    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="author" content="Neha Jha">
    <meta name="description" content="RDBMS Project">
    
    <!-- Icon -->
    <link rel="icon" href="Images/iiit-logo.png" sizes="35x35" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Linked -->
    <link rel="stylesheet" href="CSS/navbar.css"/>

    <title>IIIT Book-Shop</title>

    <!-- Additional CSS for Search Box -->
    <style type="text/css">
        .search-box
        {
            width: 245px;
            margin-top:26px;
            position: relative;
            display: inline-block;
            font-size: 14px;
            
        }
        .search-box input[type="text"]
        {
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
            border-radius: 00.30rem;
        }
        .result
        {
            position: absolute;        
            z-index: 999;
            top: 100%;
            left: 0;
        }
        .search-box input[type="text"], .result
        {
            width: 100%;
            box-sizing: border-box;
            color:rgb(10, 10, 10);
        }
        /* Formatting result items */
        .result p
        {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
            background-color: #ffffff;
        }
        .result p:hover
        {
            background-color: #f2f2f2;
            
        }
        .result p a
        {
            font-weight:normal;
            font-size:14px;
        }
        .result p a:hover
        {
            text-decoration: none;  
        }
        .wrapper table.table-hover tbody tr:hover{
            background-color:#2e2d2d;
        }
        .wrapper table{
            background-color:#222121; 
            border-color:rgb(53, 51, 51); 
            font-size: 15px;
        }
        .wrapper table thead tr{
            color:rgb(211, 198, 241); 
            background-color:#1b1b1b; 
        }
        .wrapper table tbody tr{
            color:rgb(202, 199, 199);
            border-color:rgb(53, 51, 51);
        }
    </style>

    <!-- Javascript for Search Box-->
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('.search-box input[type="text"]').on("keyup input", function()
            {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if(inputVal.length)
                {
                    $.get("backend-search.php", {term: inputVal}).done(function(data)
                    {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } 
                else
                {
                    resultDropdown.empty();
                }
            });   
            // Set search input value on click of result item
            $(document).on("click", ".result p", function(){
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

</head>

<body class="book-details" style="background-color:rgb(12, 12, 12); color:white;">

    <!-- Navigation -->
    <nav class="navbar-sticky navbar navbar-inverse navbar-static-top navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar6" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"> 
                    <img style="width: 64px" src="Images/iiit-logo.png"alt="iiit logo"/>
                    <span class="iiitbookstore" style="font-family: 'Open Sans', sans-serif; font-weight:600; font-size: 21px;">IIIT Book-Shop</span>
                </a>
            </div>
            <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="Student-AHome.php"><i class="fa fa-home fa-fw" style="font-size: 20px;" aria-hidden="true"></i>Home</a></li>
                <li class="active"><a href="Books.php">Books <i class="fa fa-bookmark-o" aria-hidden="true"></i></a></li>
                <li><a class="logout" href="Student-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a>
                <li>
                    <div class="search-box">
                        <input type="text" autocomplete="off" placeholder="Search Book..." />
                        <div class="result"></div>
                    </div>
                    <div class="search-button"></div> </li>
                </li>
            </ul>
        </div>
      </div>
    </nav>

    <div class="wrapper" style="margin: 0px 45px 30px 45px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left" style='color:rgb(157, 115, 255);'>Books Available <i class="fa fa-bookmark" aria-hidden="true"></i></h2>  
                        <a href="cart.php" class="btn btn-success pull-right">View Book-Cart <i class="fa fa-shopping-cart"  aria-hidden="true"></i></a> 
                    </div>
                    <?php
                    // Include config file
                    require_once "../connectserver.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM books";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-hover'>";
                                echo "<thead style='font-size: 17px;'>";
                                    echo "<tr>";
                                        echo "<th style='border-color:rgb(53, 51, 51);'>Book Id</th>";
                                        echo "<th style='border-color:rgb(53, 51, 51);'>Book Name</th>";
                                        echo "<th style='border-color:rgb(53, 51, 51);'>Author</th>";
                                        echo "<th style='border-color:rgb(53, 51, 51);'>Availability Status</th>";
                                        echo "<th style='border-color:rgb(53, 51, 51);'>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td style='border-color:rgb(53, 51, 51);'>" . $row['bookid'] . "</td>";
                                        echo "<td style='border-color:rgb(53, 51, 51);'>" . $row['name'] . "</td>";
                                        echo "<td style='border-color:rgb(53, 51, 51);'>" . $row['author'] . "</td>";
                                        echo "<td style='border-color:rgb(53, 51, 51);'>" . $row['status'] . "</td>";
                                        echo "<td style='border-color:rgb(53, 51, 51);'>";
                                            echo "<a style='margin-right: 20px; color:rgb(50, 165, 241);'href='ViewBook.php?bookid=". $row['bookid'] ."' title='Book Details' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a style='margin-right: 20px; color:rgb(50, 165, 241);'href='ViewBook.php?bookid=". $row['bookid'] ."' title='Add to Cart' data-toggle='tooltip'><i class='fa fa-shopping-cart'  aria-hidden='true'></i></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>



    <!-- Footer  -->
    <footer id="footer" class="footer">
      <p class="text-center">
        Email: bookstore@iiit-bh.ac.in
        <br />Mobile: 0674-2653-321
      </p>
    </footer>

    <!-- Bootsrtap JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
    <!-- JavaScript Linked-->
    <script src="Javascript/navbar.js"></script>
    <script src="Javascript/searchbook.js"></script>

</body>
</html>