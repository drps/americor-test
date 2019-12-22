<?php

namespace app\components\history;

use app\models\History;
use Yii;
use yii\helpers\Html;

class Fax extends Item
{
    public function renderBody(History $history): string
    {
        return $history->eventText;
    }

    public function render(History $history): string
    {
        $fax = $history->fax;

        return $this->renderFile('_item_common', [
            'user' => $history->user,
            'body' => $this->renderBody($history).
                ' - ' .
                (isset($fax->document) ? Html::a(
                    Yii::t('app', 'view document'),
                    $fax->document->getViewUrl(),
                    [
                        'target' => '_blank',
                        'data-pjax' => 0
                    ]
                ) : ''),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $history->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ]);
    }
}
