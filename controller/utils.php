<?php

session_start();

class ImageUploader
{
    public function imgUpload(): ? string
    {
        $img = $_FILES['imagen'];
        $uploadDirectory = "../view/img/";
        $imgFileName = uniqid() . '_' . basename($img['name']);
        $imgFilePath = $uploadDirectory . $imgFileName;

        if (move_uploaded_file($img['tmp_name'], $imgFilePath)) {
            return $imgFilePath;
        } else {
            $_SESSION["error"] = "Error uploading image. Please try again.";
            header("Location: ../view/updateInfoProfile.php");
            exit();
        }
    }
}