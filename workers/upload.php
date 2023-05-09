<?php
$target_dir = "../img/";
$target_file = $target_dir . "userphoto" . (count(glob($target_dir . "userphoto*")) + 1) . ".jpg";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
const DB_HOST = "db5012072209.hosting-data.io";
const DB_NAME = "dbs10160063";
const DB_USER = "dbu5648674";
const DB_PASSWORD = "alabamacollegetrails!";
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if image file is an actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "<script>alert('Sorry, file already exists.')</script>";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 4000000) {
    echo "<script>alert('Sorry, your file is too large.')</script>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    header('Location: /pages/join.php');
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $filename = basename($_FILES["fileToUpload"]["name"]);
        $filepath = $target_file;
        $sql = "INSERT INTO Gallery (filename, filepath) VALUES ('$filename', '$filepath')";
        if ($conn->query($sql) === TRUE) { // add data to the gallery table
            echo "<script>alert('The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.');</script>";
            header('Location: /pages/join.php');
        } else {
            echo "<script>alert('There was an error inserting the image information into the database: " . $conn->error . "')</script>";
            header('Location: /pages/join.php');

        }
    } else {
        echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        header('Location: /pages/join.php');
    }
}

mysqli_close($conn);

