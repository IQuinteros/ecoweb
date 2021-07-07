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

    public ?array $opinions;

    public function __construct(Article_model $article)
    {
        if($article == null) return;
        if($article->opinions == null) return;

        $this->opinions = $article->opinions;
    }

    public function getAvgRating() : float{
        if(!isset($this->opinions)) return 0;
        if($this->opinions == null) return 0;

        $sum = 0.0;
        foreach ($this->opinions as $value) {
            $sum += $value->rating;
        }

        return $sum / count($this->opinions);
    }
}