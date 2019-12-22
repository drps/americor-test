<?php

namespace app\components\history;

use app\models\History;

class ItemDefault extends Item
{
    public function renderBody(History $history): string
    {
        return $history->eventText;
    }

    public function render(History $history): string
    {
        return $this->renderFile('_item_common', [
            'user' => $history->user,
            'body' => $this->renderBody($history),
            'bodyDatetime' => $history->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ]);
    }
}
