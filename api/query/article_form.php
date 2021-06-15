<?php
require_once __DIR__.('/../Connection.php');
require_once __DIR__.('/../models/article_form_model.php');
class Article_form extends Connection{
    public function insert_article_form($objectobject){
        $this->connection_hosting();
        $sql="INSERT INTO `article_form` (`id`, `creation_date`, `last_update_date`, `recycled_mats`, 
        `recycled_mats_detail`, `general_detail`, `reuse_tips`, `recycled_prod`, `recycled_prod_detail`) 
        VALUES (NULL, CURRENT_TIME(), CURRENT_TIME(), :recycled_mats, :recycled_mats_detail, :general_detail, 
        :reuse_tips, :recycled_prod, :recycled_prod_detail);";
    }
}