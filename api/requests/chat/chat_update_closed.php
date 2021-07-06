<?php
require_once('../base_request.php');
require_once('../../query/chat.php');

$chat = new Chat();

$result=$chat->update_chat_closed($data->id);


send_response(isset($result), $result); 