<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="author" content="Neha Jha">
    <meta name="description" content="RDBMS Project">
    <meta name="title" property="og:title" content="IIIT BookStore" />
    <meta property="og:type" content="Website" />
    <meta 
	      name="image" 
	      property="og:image" 
	      content="https://live.staticflickr.com/65535/51113060029_6b6dc4aaf9_z.jpg" 
    />
    
    <!-- Icon -->
    <link rel="icon" href="Student/Images/iiit-logo.png" sizes="35x35" type="image/png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   
    <!-- CSS Linked -->
    <link rel="stylesheet" href="Student/CSS/navbar.css"/>
    <link rel="stylesheet" href="home.css"/>

    <title>IIIT Book-Shop</title>

</head>
<body class="Afterlogin"  translate="no">

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
                    <span class="iiitbookstore" style="font-family: 'Open Sans', sans-serif;">IIIT Book-Store</span>
                </a>
            </div>
            <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="index.php"><i class="fa fa-home fa-fw" style="font-size: 20px;" aria-hidden="true"></i>Home</a></li>
                <li><a href="Admin/Admin-Login.php">Admin <i class="fa fa-user" aria-hidden="true"></i> </a> </li>
                <li><a href="Student/Student-Signup.php">Student-SignUp <i class="fa fa-sign-in" style="color: blue" aria-hidden="true"></i></a></li>
                <li><a href="Student/Student-Login.php">Student-Login <i class="fa fa-sign-in" style="color: blue" aria-hidden="true"></i></a></li>
            </ul>
        </div>
      </div>
    </nav>

    <!-- Home Content -->

    <div class="container">
	    <div id="login-box">
		    <div class="logo">
			    <img src="Student/Images/iiit-logo.png" class="img img-responsive img-circle center-block" />
			    <h1 class="logo-caption"><span class="tweak">IIIT</span> Book-Store</h1>
		    </div>
	    </div>
    </div>
    
    
    <!-- Footer  -->
    <footer id="footer" class="footer" style="position: fixed">
      <p class="text-center">
        Email: bookstore@iiit-bh.ac.in
        <br />Mobile: 0674-2653-321
      </p>
    </footer>

    <div id="particles-js"></div>
   

    <!-- Bootsrtap JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- JavaScript Linked-->
    <script src="home.js"></script>

  </body>
</html>


