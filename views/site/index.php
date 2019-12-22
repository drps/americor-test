<?php

use app\widgets\HistoryList\HistoryList;

/* @var $itemRenderer app\components\HistoryItemRenderer */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $linkExport string */
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <?= HistoryList::widget([
        'dataProvider' => $dataProvider,
        'linkExport' => $linkExport,
        'itemRenderer' => $itemRenderer,
    ]) ?>

</div>
