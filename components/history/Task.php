<?php

namespace app\components\history;

use app\models\History;

class Task extends Item
{
    public function renderBody(History $history): string
    {
        return "$history->eventText: " . ($history->task->title ?? '');
    }

    public function render(History $history): string
    {
        $task = $history->task;

        return $this->renderFile('_item_common', [
            'user' => $history->user,
            'body' => $this->renderBody($history),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $history->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }
}
