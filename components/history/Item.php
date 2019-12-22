<?php

namespace app\components\history;

use app\models\History;
use Yii;
use yii\base\View;

abstract class Item
{
    protected $history;
    protected $context;
    protected $path = '@app/views/history_items/';

    public function __construct(?View $context = null)
    {
        $this->context = $context ?: Yii::$app->view;
    }

    abstract public function renderBody(History $history): string;
    abstract public function render(History $history): string;

    protected function renderFile(string $view, array $params = [])
    {
        return $this->context->render($this->path . $view, $params);
    }
}
