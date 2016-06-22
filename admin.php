<?php
/*
Listes all the generated Photos
*/
 if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header("WWW-Authenticate: Basic realm=\"Admin Login\"");
        header("HTTP/1.0 401 Unauthorized");
        print("Unauthorized Access!");
        
        exit;
    } else {
        if (($_SERVER['PHP_AUTH_USER'] == 'admin') && ($_SERVER['PHP_AUTH_PW'] == 'admin')) {
        } else {
            header("WWW-Authenticate: Basic realm=\"Admin Login\"");
            header("HTTP/1.0 401 Unauthorized");
            print("Unauthorized Access!");
            exit;
        }
    }
    
?>
<html>
<head>
    <title>Whatsapp Photo Faker</title>
    <style type="text/css">
    .maindiv{
        margin: 0 auto;
        padding: 10px;
        border-radius: 6px;
        width: 80%;
        border: 1px solid #03A9F4;
        background-color: #2196F3;
        color: #fff;
        text-align: center;
    }
    .maindiv h1{
        text-align: center;
        font-weight: normal;
        font-style: italic;
    }
    .imgholder{
        width: 100px;
        height: auto;
        margin: 6px;
    }
    </style>
</head>
<body>
    <div class="maindiv">
        <h1>Fake Photo Generator</h1>
        <p>Admin Area</p>
        <hr>
        <?php
        $picsarr = glob("photos//*-3.jpg");
        foreach ($picsarr as $filename) {
            echo '<img src="'.$filename.'" class="imgholder">';
        }
        ?>
        <hr>
        <p>Developed by Naveen</p>
    </div>  
</body>
</html>