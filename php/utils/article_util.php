<?php
require_once __DIR__.('/../../api/models/article_model.php');

class ArticleEcoIndicator{

    public bool $hasReuseTips = false;
    public bool $isRecyclable = false;
    public bool $hasRecycledMaterials = false;

    public function __construct(Article_model $article)
    {
        if($article == null) return;
        if($article->form == null) return;

        $this->hasReuseTips = $article->form->reuse_tips != null && !empty($article->form->reuse_tips);
        $this->isRecyclable = $article->form->recycled_mats != null && !empty($article->form->recycled_mats);
        $this->hasRecycledMaterials = $article->form->recycled_prod != null && !empty($article->form->recycled_prod);
    }

}

class ArticleRating{

}