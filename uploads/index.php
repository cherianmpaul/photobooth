<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos</title>
</head>
<style>
	.container {
		display: flex; 
		flex-wrap: wrap;
		width: 100vw;
	}
    .output {
        width: 340px;
        display: inline-block;
        vertical-align: top;
    }
    .photo {
        border: 1px solid black;
        box-shadow: 2px 2px 3px black;
        width: 320px;
        height: 240px;
        border-radius: 10px;
    }
    button {
        display: block;
        position: relative;
        margin-left: auto;
        margin-right: auto;
        bottom: 32px;
        background-color: rgb(0 150 0 / 50%);
        border: 1px solid rgb(255 255 255 / 70%);
        box-shadow: 0px 0px 1px 2px rgb(0 0 0 / 20%);
        font-size: 14px;
        font-family: "Lucida Grande", "Arial", sans-serif;
        color: rgb(255 255 255 / 100%);
    }

</style>
<body>
<div class="container">
<?php
    $images = glob("*.png");
    if ($images) {
        //Display the Image
        foreach ($images as $image) {
            echo "<div class=\"output\"><img src=\"/uploads/$image\" class=\"photo\">";
            $name = ucfirst(strtolower(substr($image, 0, strpos($image, "__"))));
            echo "<button>$name</button></div>";
        }
        echo "</div>";

        // Create a ZIP archive of PNG files
        $zipfile = "png_files.zip";
        $idnumber = 1025;
        $zip = new ZipArchive();
        $zip->open($zipfile, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        foreach ($images as $file) {
            $idnumber++;
            $name = $idnumber . "_" . ucfirst(strtolower(substr($file, 0, strpos($file, "__")))) . ".png";
            $zip->addFile($file, $name);
        }
        $zip->close();

        echo "<div><br/><br/><a href=\"/uploads/$zipfile\">Download ZIP File</a></div>";

    } else {
        echo "No PNG images found in the current folder.";
    }
?>
</body>
</html>


