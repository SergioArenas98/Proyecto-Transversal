<?php

class ImageUploader
{
    public function imgUpload($fileName): ? string
    {
        if (!empty($_FILES[$fileName]['tmp_name'])) {
            $file = $_FILES[$fileName];
            $uploadDirectory = "../view/img/";
            $fileName = $file['name'];
            $filePath = $uploadDirectory . $fileName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                return $filePath;

            } else {
                $_SESSION["error"] = "Error uploading image. Please try again.";
                return null;
            }
        }
    }
}