<?php

namespace app\components;

use app\components\history\Call;
use app\components\history\CustomerChangeQuality;
use app\components\history\CustomerChangeType;
use app\components\history\Fax;
use app\components\history\Item;
use app\components\history\ItemDefault;
use app\components\history\Sms;
use app\components\history\Task;
use app\models\History;

class HistoryItemRenderer
{
    private $renderers = [];
    
    public function render(History $history)
    {
        return $this
            ->createRenderer($history)
            ->render($history);
    }

    private function createRenderer(History $model): Item
    {
        $event = $model->event;

        if (array_key_exists($event, $this->renderers)) {
            return $this->renderers[$event];
        }

        switch ($event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                return $this->renderers[$event] = new Task();

            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return $this->renderers[$event] = new Sms();

            case History::EVENT_OUTGOING_FAX:
            case History::EVENT_INCOMING_FAX:
                return $this->renderers[$event] = new Fax();

            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return $this->renderers[$event] = new CustomerChangeType();

            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return $this->renderers[$event] = new CustomerChangeQuality();

            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                return $this->renderers[$event] = new Call();

            default:
                return $this->renderers[$event] = new ItemDefault();
        }
    }
}
