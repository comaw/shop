<?php

namespace common\lib;

use Yii;
use yii\web\Request;

class Pagination extends \yii\data\Pagination
{

    public $pageSizeParam = false;
    public $forcePageParam = false;

    /**
     * Добавил параметр для более правильной определения страницы
     *
     * Pagination constructor.
     *
     * @param array $config
     */
    public function __construct($config = [])
    {
        if(Yii::$app->request->get($this->pageParam)){
            $_GET[$this->pageParam] = (Yii::$app->request->get($this->pageParam) / Yii::$app->params['pageSize']) + 1;
        }

        parent::__construct($config);
        $this->pageSize = Yii::$app->params['pageSize'];
    }

    /**
     * Creates the URL suitable for pagination with the specified page number.
     * This method is mainly called by pagers when creating URLs used to perform pagination.
     * @param integer $page the zero-based page number that the URL should point to.
     * @param integer $pageSize the number of items on each page. If not set, the value of [[pageSize]] will be used.
     * @param boolean $absolute whether to create an absolute URL. Defaults to `false`.
     * @param $toRout string|null если нужно делать переход на пагинацию другой страницы
     * @return string the created URL
     * @see params
     * @see forcePageParam
     */
    public function createUrl($page, $pageSize = null, $absolute = false, $toRout = null)
    {
        $page = (int) $page;
        $pageSize = (int) $pageSize;
        if (($params = $this->params) === null) {
            $request = Yii::$app->getRequest();
            $params = $request instanceof Request ? $request->getQueryParams() : [];
        }
        if ($page > 0 || $page >= 0 && $this->forcePageParam) {
            $params[$this->pageParam] = $page + 1;
        } else {
            unset($params[$this->pageParam]);
        }
        if ($pageSize <= 0) {
            $pageSize = $this->getPageSize();
        }
        if ($pageSize != $this->defaultPageSize) {
            $params[$this->pageSizeParam] = $pageSize;
        } else {
            unset($params[$this->pageSizeParam]);
        }
        $params[0] = $this->route === null ? Yii::$app->controller->getRoute() : $this->route;
        $urlManager = $this->urlManager === null ? Yii::$app->getUrlManager() : $this->urlManager;
        if ($absolute) {
            return $urlManager->createAbsoluteUrl($params);
        } else {
            return $urlManager->createUrl($params);
        }
    }

}