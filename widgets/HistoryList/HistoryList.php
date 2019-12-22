<?php

namespace app\widgets\HistoryList;

use Exception;
use yii\base\Widget;

class HistoryList extends Widget
{
    public $dataProvider;
    public $linkExport;
    public $itemRenderer;

    /**
     * @throws Exception
     */
    public function init()
    {
        parent::init();

        if (!$this->itemRenderer) {
            throw new Exception('itemRenderer is not set');
        }
    }

    public function run()
    {
        return $this->render('main', [
            'linkExport' => $this->linkExport,
            'dataProvider' => $this->dataProvider,
            'itemRenderer' => $this->itemRenderer,
        ]);
    }
}
