<?php
require_once('../base_request.php');
require_once('../../query/favorite.php');

$favorite = new Favorite();

$result=$favorite->delete_favorite($data);


send_response(isset($result), $result); 