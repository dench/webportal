<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 09.08.16
 * Time: 15:12
 */

namespace app\widgets;

use yii\base\Widget;

class Page extends Widget
{
    public $name;

    public $date;

    public $text;

    public function run()
    {
        return $this->render('page', [
            'name' => $this->name,
            'date' => $this->date,
            'text' => $this->text,
        ]);
    }
}