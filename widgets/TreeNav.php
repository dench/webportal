<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 08.07.16
 * Time: 12:09
 */

namespace app\widgets;

use yii\base\Widget;
use yii\bootstrap\Nav;

class TreeNav extends Widget
{
    public $tree;

    public $url;

    public function run()
    {
        return Nav::widget([
            'options' => ['class' => 'nav nav-stacked'],
            'items' => $this->renderItems($this->tree),
        ]);
    }

    public function renderItems($items)
    {
        $menuItems = [];

        foreach ($items as $item) {
            $temp = [
                'label' => $item['name'],
                'url' => [$this->url, 'slug' => $item['slug']],
            ];
            if (!empty($item['items'])) {
                $temp['items'] = $this->renderItems($item['items']);
            }
            $menuItems[] = $temp;
        }

        return $menuItems;
    }
}