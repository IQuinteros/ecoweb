<?php

class UploadUtil {

    private const TARGET_DIR = __DIR__.'/../uploads/';
    // TODO: Change for hosting
    private const DB_DIR = 'http://localhost:8888/ecoweb/php/uploads/';

    public static function uploadImage(string $requestFileName = 'fileUpload', int $id = 0) : UploadResult {
        $fileName = $id.md5(rand(0, 30000000)) . basename($_FILES[$requestFileName]["name"]);
        $target_file = UploadUtil::TARGET_DIR . $fileName;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES[$requestFileName]["tmp_name"]);
        if($check !== false) {

        } else {
            return new UploadResult(false, 'File is not an image');
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            return new UploadResult(false, 'File already exists');
        }

        // Check file size
        if ($_FILES[$requestFileName]["size"] > 500000) {
            return new UploadResult(false, 'Your file is too large');
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            return new UploadResult(false, 'Only JPG, JPEG, PNG & GIF files are allowed');
        }

        if (move_uploaded_file($_FILES[$requestFileName]["tmp_name"], $target_file)) {
            return new UploadResult(
                true, 
                "The file ". htmlspecialchars( basename( $_FILES[$requestFileName]["name"])). " has been uploaded.", 
                UploadUtil::DB_DIR.$fileName
            );
        } else {
            return new UploadResult(false, 'There was an error uploading your file');
        }

        return new UploadResult(false, 'All fine');
    }

}

final class UploadResult {

    public bool $result;
    public string $message;
    public ?string $newFileUrl;

    public function __construct(bool $result, string $message, string $newFileUrl = null)
    {
        $this->result = $result;
        $this->message = $message;
        $this->newFileUrl = $newFileUrl;
    }

}