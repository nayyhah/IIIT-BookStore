<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    
    <!-- Icon -->
    <link rel="icon" href="Student/Images/iiit-logo.png" sizes="35x35" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- CSS Linked -->
    <link rel="stylesheet" href="Admin/CSS/style.css" />
    <link rel="stylesheet" href="Student/CSS/navbar.css"/>

    <title>IIIT Book-Shop</title>

</head>
<body class="Afterlogin">
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
                    <img style="width: 64px" src="Student/Images/iiit-logo.png"alt="iiit logo"/>
                    <span class="iiitbookstore">IIIT Book-Shop</span>
                </a>
            </div>
            <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="../index.php">Home</a></li>
                <li><a href="Admin/Admin-Login.php">Admin <i class="fa fa-user" style="color: rgb(160, 159, 158)" aria-hidden="true"></i> </a> </li>
                <li><a class="logout" href="Student/Student-Login.php">Student-Login <i class="fa fa-sign-in" style="color: blue" aria-hidden="true"></i> </a> </li>
            </ul>
        </div>
      </div>
    </nav>

    <div class="home-content">
      <h2>IIIT</h2>
      <div class="text">
        <p>Book Shop</p>
      </div>
    </div>

    <!-- Footer  -->
    <footer id="footer" class="footer">
      <p class="text-center">
        Email: library@iiit-bh.ac.in
        <br />Mobile: 0674-2653-321
      </p>
    </footer>

    <!-- Bootsrtap JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- JavaScript Linked-->
    <script src="Javascript/navbar.js"></script>
  </body>
</html>
