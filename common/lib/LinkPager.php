<?php

namespace common\lib;

use yii\helpers\Html;
use Yii;

class LinkPager extends \yii\widgets\LinkPager
{

    public $options = ['class' => 'paginator'];

    public $linkOptions = ['class' => 'paginator__item'];

    public $firstPageCssClass = 'paginator__item paginator__item--arrow';

    public $lastPageCssClass = 'paginator__item paginator__item--arrow';

    public $prevPageCssClass = 'paginator__item paginator__item--arrow';

    public $nextPageCssClass = 'paginator__item paginator__item--arrow';

    public $activePageCssClass = 'paginator__item--current';

    public $maxButtonCount = 3;

    public $nextPageLabel = '<i class="fa fa-angle-right"></i>';

    public $prevPageLabel = '<i class="fa fa-angle-left"></i>';

    public $firstPageLabel = '<i class="fa fa-angle-double-left"></i>';

    public $lastPageLabel = '<i class="fa fa-angle-double-right"></i>';

    public function init()
    {
        parent::init();
        $this->registerLinkTags = true;
    }

    /**
     * Изменение в тегах убрал ненужные, добавил классы
     *
     * Renders the page buttons.
     * @return string the rendering result
     */
    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton($firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
        }

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
        }

        // Первых 2 старницы, если ушли слишком далеко
        if($pageCount > ($this->maxButtonCount + 1) && ($currentPage > (($this->maxButtonCount / 3) * 2))){
            for ($i = 0; $i <= 1; ++$i) {
                $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
            }
            if($currentPage > 3){
                $buttons[] = $this->renderPageButton('...', 'dots', null, true, false);
            }
        }


        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
        }

        // Последних 2 старницы, если ушли слишком далеко
        if($pageCount > ($this->maxButtonCount + 1) && ($currentPage + 1 < $pageCount - (($this->maxButtonCount / 3) * 2))){
            if($currentPage < $pageCount - 4){
                $buttons[] = $this->renderPageButton('...', 'dots', null, true, false);
            }
            for ($i = ($pageCount - 2); $i < $pageCount; ++$i) {
                $buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
            }
        }

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton($lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
        }

        return Html::tag('div', implode("\n", $buttons), $this->options);
    }

    /**
     * Изменение в тегах убрал ненужные, добавил классы
     *
     * @param string $label
     * @param int $page
     * @param string $class
     * @param bool $disabled
     * @param bool $active
     *
     * @return string
     */
    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = ['class' => empty($class) ? $this->pageCssClass : $class];
        if ($active) {
            Html::addCssClass($options, $this->activePageCssClass);
        }
        $linkOptions = $this->linkOptions;
        $linkOptions['class'] = empty($class) ? $linkOptions['class'] : $class;
        if ($active) {
            $linkOptions['class'] .= ' ' . $this->activePageCssClass;
        }
        if(is_numeric($page)){
            $linkOptions['data-page'] = $page;
            $page = $page * Yii::$app->params['pageSize'];
        }
        if($active){
            $linkOptions['rel'] = 'nofollow';
        }
        if($disabled && is_numeric($page)){
            return '';
        }elseif($disabled && $page == 'dots') {
            $linkOptions['class'] .= ' paginator__item--dot';
            return Html::a($label, 'javascript:void(0);', $linkOptions);
        }
        return Html::a($label, $this->pagination->createUrl($page, null, false), $linkOptions);
    }

}