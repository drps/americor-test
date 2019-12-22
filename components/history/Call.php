<?php

namespace app\components\history;

use app\models\Call as CallModel;
use app\models\History;

class Call extends Item
{
    public function renderBody(History $history): string
    {
        $call = $history->call;
        return ($call ? $call->totalStatusText . ($call->getTotalDisposition(false) ? " <span class='text-grey'>" . $call->getTotalDisposition(false) . "</span>" : "") : '<i>Deleted</i> ');
    }

    public function render(History $history): string
    {
        $call = $history->call;
        $answered = $call && $call->status == CallModel::STATUS_ANSWERED;

        return $this->renderFile('_item_common', [
            'user' => $history->user,
            'content' => $call->comment ?? '',
            'body' => $this->renderBody($history),
            'footerDatetime' => $history->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == CallModel::DIRECTION_INCOMING
        ]);
    }
}
