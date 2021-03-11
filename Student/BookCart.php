<?php
    session_start();
    require_once("connect.php");
    $db_handle = new DBController();
    if(!empty($_GET["action"])) 
    {
        switch($_GET["action"]) 
        {
            case "add":
	            if(!empty($_POST["quantity"])) 
                {
		            $productByBookid = $db_handle->runQuery("SELECT * FROM books WHERE bookid='" . $_GET["bookid"] . "'");
			        $itemArray = array($productByBookid[0]["bookid"]=>array('name'=>$productByBookid[0]["name"],'bookid'=>$productByBookid[0]["bookid"], 'author'=>$productByBookid[0]["author"], 'quantity'=>$_POST["quantity"], 'price'=>$productByBookid[0]["price"], 'image'=>$productByBookid[0]["image"]));
		
		            if(!empty($_SESSION["cart_item"])) 
                    {
			            // if(in_array($productByBookid[0]["bookid"],array_keys($_SESSION["cart_item"]))) 
                        // {
                            $flag = 0;
				            foreach($_SESSION["cart_item"] as $k => $v) 
                            {
						        if($productByBookid[0]["bookid"] == $_SESSION["cart_item"][$k]["bookid"]) 
                                {
							        if(empty($_SESSION["cart_item"][$k]["quantity"])) 
                                    {
								        $_SESSION["cart_item"][$k]["quantity"] = 0;
							        }
							        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                    $flag = 1;
						        }
				            }
			            // }
                        if($flag == 0)
                        {
				            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			            }
		            } 
                    else 
                    {
			            $_SESSION["cart_item"] = $itemArray;
		            }
	            }

	        break;

            case "remove":
	            if(!empty($_SESSION["cart_item"])) 
                {
		            foreach($_SESSION["cart_item"] as $k => $v) 
                    {
                        // print($_SESSION["cart_item"][$k]["bookid"]);
                        // print($_GET["bookid"]);
			            if($_GET["bookid"] == $_SESSION["cart_item"][$k]["bookid"])
				            unset($_SESSION["cart_item"][$k]);				
			            if(empty($_SESSION["cart_item"]))
				            unset($_SESSION["cart_item"]);
		            }
	            }
	        break;

            case "empty":
	            unset($_SESSION["cart_item"]);
            break;
        }
    }
?>

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

    <!-- CSS Linked -->
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="stylesheet" href="CSS/navbar.css" />

    <title>IIIT Book-Shop</title>

</head>

<body class="myproduct">

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
                    <span class="iiitbookstore">IIIT Book-Shop</span>
                </a>
            </div>
            <div id="navbar6" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="AHome.php"><i class="fa fa-home fa-fw" style="font-size: 20px;" aria-hidden="true"></i>Home</a></li>
                <li><a href="Books.php">Books <i class="fa fa-bookmark-o" aria-hidden="true"></i> </a></li>
                <li class="active"><a href="BookCart.php">Book Cart <i class="fa fa-shopping-cart"  aria-hidden="true"></i> </a></li>
                <li><a class="logout" href="Student-Logout.php">Logout <i class="fa fa-sign-out" style="color: blue" aria-hidden="true"></i> </a>
            </ul>
        </div>
      </div>
    </nav>

    <div id="shopping-cart">
        <div class="txt-heading" style="font-size:25px; color: rgb(120, 120, 201);">Shopping Cart <i class="fa fa-shopping-cart"  aria-hidden="true"></i></div>
        <a id="btnEmpty" href="BookCart.php?action=empty">Empty Cart</a>
        <!-- <a id="btnEmpty" href="BookCart.php?action=empty" style="margin-right: 15px; color: green; border-color: green">ORDER</a> -->

        <?php
            if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;
        ?>	

        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
                <tr>
                    <th style="text-align:left; font-size:18px; ">Book Name</th>
                    <th style="text-align:left; font-size:17px; " >Author</th>
                    <th style="text-align:center; font-size:16px; " width="7%">Quantity</th>
                    <th style="text-align:center; font-size:16px; " width="7%">Unit Price</th> 
                    <th style="text-align:right; font-size:16px; " width="10%">Price</th>
                    <th style="text-align:center; font-size:16px; " width="10%">Remove</th>       
                </tr>

                    <?php		
                        foreach ($_SESSION["cart_item"] as $item){
                        $item_price = $item["quantity"]*$item["price"];
		            ?>

				<tr>
			        <td style="font-size:14px;" ><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
			        <td style="font-size:14px;" ><?php echo $item["author"]; ?></td>
			        <td style="text-align:center; font-size:13px;"><?php echo $item["quantity"]; ?></td>
			        <td  style="text-align:center; font-size:13px;"><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> ".$item["price"]; ?></td>
				    <td  style="text-align:right; font-size:13px;"><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> ". number_format($item_price,2); ?></td>
				    <td style="text-align:center; font-size:13px;"><a href="BookCart.php?action=remove&bookid=<?php echo $item["bookid"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>

				<?php
				    $total_quantity += $item["quantity"];
				    $total_price += ($item["price"]*$item["quantity"]);
		        }?>

                <tr>
                    <td colspan="2" align="right">TOTAL :</td>
                    <td align="center"><?php echo $total_quantity; ?></td>
                    <td align="right" colspan="2"><strong><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> ".number_format($total_price, 2); ?></strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>	

        <?php } else { ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php } ?>
    </div>

    <div id="product-grid">
	    <div class="txt-heading" style="font-size:25px; color: rgb(120, 120, 201);" >Books Available <i class="fa fa-bookmark-o" aria-hidden="true"></i></div>
	    <?php
	        $product_array = $db_handle->runQuery("SELECT * FROM books ORDER BY bookid ASC");
            if (!empty($product_array)) { 
		        foreach($product_array as $key=>$value){
	        ?>
	            <div class="product-item">
		            <form method="post" action="BookCart.php?action=add&bookid=<?php echo $product_array[$key]["bookid"]; ?>">
			            <div class="product-image" style="width: 100%"><img src="<?php echo $product_array[$key]["image"]; ?>" style="width: 100%; height: inherit"></div>
			            <div class="product-tile-footer">
			            <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			            <div class="product-price"><?php echo "<i class='fa fa-inr' aria-hidden='true'></i> ".$product_array[$key]["price"]; ?></div>
			            <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			            </div>
			        </form>
		        </div>
	    <?php } } ?>
    </div>


    <div style="height: 1200px;"></div>

    <!-- Footer  -->
    <footer id="footer" class="footer">
      <p class="text-center">
        Email: bookshop@iiit-bh.ac.in
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