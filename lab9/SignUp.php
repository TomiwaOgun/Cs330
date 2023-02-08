<?php
echo "<h1>Display User Info<h1>";


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
} 
else 
{
    echo "Sorry, there was an error uploading your file.";
}


echo "<br>";
echo "Email: ";
echo $_POST["email"];
echo "<br>";
echo "Username: ";
echo $_POST["uname"];
echo "<br>";
echo "Profile picture: ";
echo "<img src= $target_file >"; 

?>