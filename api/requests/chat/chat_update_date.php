<?php
require_once('../base_request.php');
require_once('../../query/chat.php');

$chat = new Chat();

$result=$chat->update_chat_date($data);


send_response(isset($result), $result); 