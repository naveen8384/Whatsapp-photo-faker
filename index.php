<?php
error_reporting(0);
$newname = date("dmyHis", time());
$newname1 = $newname.'-1.jpg';
$newname2 = $newname.'-2.jpg';
$newname3 = $newname.'-3.jpg';
$errors = array();
if(isset($_POST['submit'])){
    $allowedExts = array("jpg");//Only .jpg files are allowed
    $temp = explode(".", $_FILES["layer1"]["name"]);
    $extension =  strtolower(end($temp));
    if (in_array($extension, $allowedExts)) {
         if ($_FILES["layer1"]["error"] > 0) {
              $errors[] = $_FILES["layer1"]["error"];
    } else {
    	if (file_exists("photos/" . $_FILES["layer1"]["name"])) {
        $errors[] = $_FILES["layer1"]["name"] . " already exists. ";//Not possible
        } else {
            move_uploaded_file($_FILES["layer1"]["tmp_name"],"photos/" . $newname1);
         }
     }
}else {
  $errors[] = "<h5>Invalid First Image ! Only <b>.jpg</b> files are Allowed.</h5>";
}
    $temp = explode(".", $_FILES["layer2"]["name"]);
    $extension = strtolower(end($temp));
     if (in_array($extension, $allowedExts)) {
         if ($_FILES["layer2"]["error"] > 0) {
              $errors[] = $_FILES["layer1"]["error"];
      } else {
        if (file_exists("photos/" . $_FILES["layer2"]["name"])) {
         $errors[] = $_FILES["layer2"]["name"] . " already exists. ";//even it is not possible
        } else {
            move_uploaded_file($_FILES["layer2"]["tmp_name"],"photos/" . $newname2);
         }
     }
}else {
  $errors[] = "<h5>Invalid Second Image! Only <b>.jpg</b> files are Allowed.</h5>";
}

if (count($errors)<1)
{
	//$img = imagecreatetruecolor(400,1600);//creating new image doesn't works
	$img = imagecreatefromjpeg('reference.jpg');
	$layer1 = imagecreatefromjpeg('layer1.jpg');
	$layer2 = imagecreatefromjpeg('photos/'.$newname1);
	$layer3 = imagecreatefromjpeg('photos/'.$newname2);
	list($width, $height, $type) = getimagesize('photos/'.$newname1);
	list($width2, $height2, $type2) = getimagesize('photos/'.$newname2);
	imagecopy($img, $layer1, 0, 0, 0, 0, 400, 400);
	imagecopyresized($img, $layer2, 0, 400, 0, 0, 400, 400, $width, $height);
	imagecopyresized($img, $layer3, 0, 800, 0, 0, 400, 800, $width2, $height2);
	imagejpeg($img,'photos/'.$newname3);
	imagedestroy($img);
	/*
	uncomment this to delete uploaded photos
	unlink('photos/'.$newname1);
	unlink('photos/'.$newname2);
	*/
	}
}
?>
<html>
<head>
	<title>Watsapp Photo Faker</title>
	<style type="text/css">
	.formdiv{
		margin: 0 auto;
	    padding: 10px;
	    border-radius: 6px;
	    max-width: 400px;
	    border: 1px solid #03A9F4;
	    background-color: #2196F3;
	    color: #fff;
	}
	.formdiv h1{
		text-align: center;
		font-weight: normal;
		font-style: italic;
	}
	.formdiv span{
		width: 100%;
	    float: left;
	    padding: 4px;
	}
	.formdiv [type="file"],[type="submit"]{
		border: 1px solid #000;
		width: 100%;
		padding: 4px;
	}
	#imgpreview{
		margin: 0 auto;
		border: 1px solid #fff;
	}
	.credits{
		color: #000;
		width: 100%;
		text-align: center;
		display: block;
	}
	</style>
</head>
<body>
	<div class="formdiv">
		<h1>Fake Photo Generator</h1>
		<?php 
		if (count($errors)>0) {
			foreach ($errors as $error) {
				echo '<span style="text-align:center;width:100%;">'.$error.'</span>';
			}
		}
		?>
		<form method="POST" action="" enctype="multipart/form-data">
			<p><span>Original Image</span><input type="file" name="layer1" title="Select Original Image" required></p>
			<p><span>Hidden Image</span><input type="file" name="layer2" title="Select Hidden Image" required></p>
			<p><input type="submit" name="submit" value="Upload"></p>
		</form>
		<?php
	if ($_POST && empty($errors)) {
		echo '<span style="text-align:center;width:100%;">TIP: Rightclick on image and click save as</span>';
		echo '<img id="imgpreview" src="photos/'.$newname3.'" title="Fake Image">';
		echo '<p class="credits">Coded by Naveen</p>';
	}
	?>
	</div>	
</body>
</html>