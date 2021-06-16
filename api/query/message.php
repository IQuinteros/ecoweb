<?php

require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/message_model.php');

class Message extends Connection{
    public function insert_message($object){
        $this->connection_hosting();
        $sql="";
    }
}