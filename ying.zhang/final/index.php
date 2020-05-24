<!DOCTYPE html>
<html lang="en">
<head>
	<title>Landing</title>
    <?php include "partials/head.php" ?>
    <!--<link rel="stylesheet" type="text/css" href="CSS/landing.css">-->
    <link href="https://fonts.googleapis.com/css?family=Lato:700" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <style>
        body {
            height: 100vh;
            padding:0;
            margin:0;
        }
    </style>
</head>

<body>
    <?php include "partials/landing-header.html" ?>

    <div class="landing-container">
        <div class="wrapper" style="">
            <div class='row gap' style='width:100%;'>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="text-align:center">    
                    <a onClick="changeColor('1')" href="home.php">
                        <i class='landing-btn fas' id='male'>&#xf183;</i>
                    </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="text-align:center">
                    <a onClick="changeColor('2')" href="home.php">
                        <i class='landing-btn fas' id='female'>&#xf182;</i>
                    </a>
                </div>
            </div>

            <div style='margin-top:72px; width:100%; text-align:center; font-size:24px;'>
                <a href='home.php'>Click to explore more</a>
            </div>
        </div>
    </div>
</body>

<script>
    function changeColor(type) {
        if(type === '1') {
            document.getElementById('male').style.color = "#404959";
            document.getElementById('female').style.color = '#EFEBE8';
        } else {
            document.getElementById('female').style.color = "#D98484";
            document.getElementById('male').style.color = '#EFEBE8';
        }
    }
</script>
</html>