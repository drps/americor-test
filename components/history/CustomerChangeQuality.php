<?php

namespace app\components\history;

use app\models\Customer;
use app\models\History;

class CustomerChangeQuality extends Item
{
    public function renderBody(History $history): string
    {
        return "{$history->eventText} " .
            (Customer::getQualityTextByQuality($history->getDetailOldValue('quality')) ?? "not set") . ' to ' .
            (Customer::getQualityTextByQuality($history->getDetailNewValue('quality')) ?? "not set");
    }

    public function render(History $history): string
    {
        return $this->renderFile('_item_statuses_change', [
            'model' => $history,
            'oldValue' => Customer::getQualityTextByQuality($history->getDetailOldValue('quality')),
            'newValue' => Customer::getQualityTextByQuality($history->getDetailNewValue('quality')),
        ]);
    }
}
