<?php

namespace app\controllers;

use app\components\HistoryItemRenderer;
use app\models\search\HistorySearch;
use app\widgets\Export\Export;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    private $historyRenderer;

    public function __construct($id, $module, HistoryItemRenderer $historyRenderer, $params = [])
    {
        parent::__construct($id, $module, $params);
        $this->historyRenderer = $historyRenderer;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => $this->getDataProvider(),
            'itemRenderer' => $this->historyRenderer,
            'linkExport' => $this->getLinkExport(),
        ]);
    }

    /**
     * @param string $exportType
     * @return string
     */
    public function actionExport($exportType)
    {
        $model = new HistorySearch();

        return $this->render('export', [
            'dataProvider' => $this->getDataProvider(),
            'exportType' => $exportType,
            'model' => $model,
            'itemRenderer' => $this->historyRenderer,
        ]);
    }

    private function getDataProvider()
    {
        return (new HistorySearch())->search(\Yii::$app->request->queryParams);
    }

    /**
     * @return string
     */
    private function getLinkExport()
    {
        $params = \Yii::$app->getRequest()->getQueryParams();
        $params = ArrayHelper::merge([
            'exportType' => Export::FORMAT_CSV
        ], $params);
        $params[0] = 'site/export';

        return Url::to($params);
    }
}
