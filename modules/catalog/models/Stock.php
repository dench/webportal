<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 27.07.16
 * Time: 18:09
 */

namespace app\modules\catalog\models;

use yii\base\Object;
use yii\helpers\ArrayHelper;

class Stock extends Object
{
    public $id;
    public $name;

    private static $data = [
        1 => ['id' => 1, 'name' => 'В наличии'],
        2 => ['id' => 2, 'name' => 'Нет в наличии'],
        3 => ['id' => 3, 'name' => 'Под заказ'],
    ];

    public static function findOne($id)
    {
        return isset(self::$data[$id]) ? new static(self::$data[$id]) : null;
    }

    public static function findAll()
    {
        return new static(self::$data);
    }

    public static function list()
    {
        return ArrayHelper::map(self::$data, 'id', 'name');
    }
}