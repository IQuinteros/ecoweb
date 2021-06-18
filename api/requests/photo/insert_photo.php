<?php
require_once('../base_request.php');
require_once('../../query/photo.php');

$photo = new Photo();

$result=$photo->insert_photo($data);


send_response(isset($result), $result); 