<?php

use app\models\History;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $linkExport string */
/* @var $itemRenderer app\components\HistoryItemRenderer */

?>

<div class="panel panel-primary panel-small m-b-0">
    <div class="panel-body panel-body-selected">
        <div class="pull-sm-right">
            <?php if (!empty($linkExport)) {
                echo Html::a(Yii::t('app', 'CSV'), $linkExport, ['class' => 'btn btn-success']);
            } ?>
        </div>
    </div>
</div>

<?php Pjax::begin(['id' => 'grid-pjax', 'formSelector' => false]); ?>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function (History $history) use ($itemRenderer) {
        return $itemRenderer->render($history);
    },
    'options' => [
        'tag' => 'ul',
        'class' => 'list-group'
    ],
    'itemOptions' => [
        'tag' => 'li',
        'class' => 'list-group-item'
    ],
    'emptyTextOptions' => ['class' => 'empty p-20'],
    'layout' => '{items}{pager}',
]); ?>

<?php Pjax::end(); ?>
