<!doctype html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Template </title>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/minty/bootstrap.min.css">

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div id="wrapper">
        <header>
            <div id='headertext'>
                <center> <h1> SellThings </h1> </center>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart">Shopping Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminhome" >Admin Page</a>
                    </li>
                    <!-- <li> -->
                        <!-- <a href="<?php echo base_url()?>shopping/tampil_cart"><i class="glyphicon glyphicon-shopping-cart"></i>  Keranjang Belanja</a> -->
                    <!-- </li> -->
                    </ul>
                </div>
            </nav>
        </header>
        <div>
		<?php
		if(isset($page)){
			echo $page;
		}
		?>
		</div>
        	
    </div>
    
</body>
</html>


