<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    .mobile-container {
        width: 100%;
        margin: auto;
        background-color: #555;
        color: white;
        position: fixed;
        top: 0;
        z-index: 100;
    }
    @media (min-width:600px) {
        .mobile-container {
            display: none;
        }
    }

    .topnav {
        overflow: hidden;
        background-color: #333;
        position: relative;
    }

    .topnav #links {
        display: none;
    }

    .topnav a {
        color: white;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        display: block;
    }

    .topnav a.icon {
        background: black;
        display: block;
        position: absolute;
        right: 0;
        top: 0;
    }

    .topnav a.icon:hover {
        background-color: #ddd;
        color: black;
    }

    .active {
        background-color: #000;
        color: white;
    }
</style>
</head>
<body>

<!-- Simulate a smartphone / tablet -->
<div class="mobile-container">

  <!-- Top Navigation Menu -->
  <div class="topnav">
    <a class="active">
      <img src="img/logo.png" width='80px' height='100px' />
    </a>
    <div id="links">
        <a href="products.php">Products</a>
	    <a href="about.php">About</a>
        <a href="?type=add">Add</a>
    </div>

    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
  </div>

<!-- End smartphone / tablet look -->
</div>

<script>
    function myFunction() {
        var x = document.getElementById("links");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>

</body>
</html>
