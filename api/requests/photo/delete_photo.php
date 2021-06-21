<?php
require_once('../base_request.php');
require_once('../../query/photo.php');

$photo = new Photo();

$result=$photo->delete_photo($data->id);


send_response(isset($result), $result); 