<?php

namespace app\components\history;

use app\models\Customer;
use app\models\History;

class CustomerChangeType extends Item
{
    public function renderBody(History $history): string
    {
        return "$history->eventText " .
            (Customer::getTypeTextByType($history->getDetailOldValue('type')) ?? "not set") . ' to ' .
            (Customer::getTypeTextByType($history->getDetailNewValue('type')) ?? "not set");
    }

    public function render(History $history): string
    {
        return $this->renderFile('_item_statuses_change', [
            'model' => $history,
            'oldValue' => Customer::getTypeTextByType($history->getDetailOldValue('type')),
            'newValue' => Customer::getTypeTextByType($history->getDetailNewValue('type'))
        ]);
    }
}
