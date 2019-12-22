<?php

namespace app\components\history;

use app\models\History;
use app\models\Sms as SmsModel;
use Yii;

class Sms extends Item
{
    public function renderBody(History $history): string
    {
        return $history->sms->message ? $history->sms->message : '';
    }

    public function render(History $history): string
    {
        return $this->renderFile('_item_common', [
            'user' => $history->user,
            'body' => $this->renderBody($history),
            'footer' => $history->sms->direction == SmsModel::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $history->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $history->sms->phone_to ?? ''
                ]),
            'iconIncome' => $history->sms->direction == SmsModel::DIRECTION_INCOMING,
            'footerDatetime' => $history->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }
}
