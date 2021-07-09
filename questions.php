<?php
require_once __DIR__.('/php/views/dashboard/appbar.php');
require_once __DIR__.('/php/views/dashboard/header.php');
require_once __DIR__.('/php/views/dashboard/aside_buttons.php');
require_once __DIR__.('/php/views/dashboard/footer.php');
require_once __DIR__.('/php/views/list_items/question_list_item.php');
require_once __DIR__.('/api/query/article.php');

$articleConnection = new Article();

$storeObject = json_decode(json_encode(array("store_id" => $id)));
$articles = $articleConnection->select_article($storeObject);
$questions = array(); 

foreach($articles as $value){
    if($value->questions != null)
    $questions = array_merge($questions, $value->questions);
}

$questionsWithoutAnswer = array_filter(
    $questions, function($value, $key)  { return $value->answer == null; },
    ARRAY_FILTER_USE_BOTH
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js" integrity="sha512-VCHVc5miKoln972iJPvkQrUYYq7XpxXzvqNfiul1H4aZDwGBGC0lq373KNleaB2LpnC2a/iNfE5zoRYmB4TRDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    
<div class="layout">

    <?= new AppBarView(new AppBarSelected(AppBarSelected::QUESTIONS)) ?>

    <main class="main">
        <?= new HeaderView("Preguntas", count($questionsWithoutAnswer)." preguntas sin responder", null, count($questions)." preguntas en total") ?>
        
        <div class="main__container unique">
            <article class="card">
                <?php foreach($articles as $articleRef) {?>

                    <?php foreach($articleRef->questions as $questionRef){ ?>
                        <?= new QuestionListItemView($questionRef, $articleRef) ?>
                        <hr class="divider">
                    <?php } ?>

                <?php } ?>
            </article>
        </div>
        <?= new AsideButtonsView() ?>
    </main>

    <?= new FooterView() ?>

</div>

<script src="js/script.js"></script>

</body>
</html>