<?php

namespace common\lib;

use Yii;
use yii\widgets\Breadcrumbs;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Breadcrumb extends Breadcrumbs
{

    public $tag = 'ul'; // установка тега

    public $encodeLabels = false; // Снимаем энкодинг, для вывода icon

    public $options = ['class' => 'breadcrumbs__menu']; // установка класса

    public $itemTemplate = "<li class=\"breadcrumbs__item\">{link} <a><i class=\"fa fa-angle-right\"></i></a></li>\n";

    public $activeItemTemplate = "<!--noindex--><li  class=\"breadcrumbs__item breadcrumbs__item--active\"><a href=\"javascript:void(0);\">{link} <i class=\"fa fa-angle-right\"></i></a></li><!--/noindex-->\n";


    /**
     * Renders the widget.
     * Изменения создания тегов согласно верстке, изменение в созданиеи тегов убрал li
     */
    public function run()
    {
        if (empty($this->links)) {
            return;
        }
        $links = [];
        if ($this->homeLink === null) {
            $links[] = $this->renderItem([
                'label' => Yii::t('yii', 'Home'),
                'url' => Yii::$app->homeUrl,
            ], $this->itemTemplate);
        } elseif ($this->homeLink !== false) {
            $links[] = $this->renderItem($this->homeLink, $this->itemTemplate);
        }
        foreach ($this->links as $link) {
            if (!is_array($link)) {
                $link = ['label' => $link . '  <i class="fa fa-angle-right"></i>'];
            }
            $links[] = $this->renderItem($link, isset($link['url']) ? $this->itemTemplate : $this->activeItemTemplate);
        }
        echo Html::tag($this->tag, implode('', $links), $this->options);
    }

    /**
     * Renders a single breadcrumb item.
     *
     * Изменения создания тегов согласно верстке, изменние в создании тегов, убрал li, добавил классы к a
     *
     * @param array $link the link to be rendered. It must contain the "label" element. The "url" element is optional.
     * @param string $template the template to be used to rendered the link. The token "{link}" will be replaced by the link.
     * @return string the rendering result
     * @throws InvalidConfigException if `$link` does not have "label" element.
     */
    protected function renderItem($link, $template)
    {
        $encodeLabel = ArrayHelper::remove($link, 'encode', $this->encodeLabels);
        if (array_key_exists('label', $link)) {
            $label = $encodeLabel ? Html::encode($link['label']) : $link['label'];
        } else {
            throw new InvalidConfigException('The "label" element is required for each link.');
        }
        if (isset($link['template'])) {
            $template = $link['template'];
        }
        if (isset($link['url'])) {
            $options = $link;
            unset($options['template'], $options['label'], $options['url']);
            $link = Html::a($label, $link['url'], $options);
        } else {
            $link = $label;
        }
        return strtr($template, ['{link}' => $link]);
    }

}