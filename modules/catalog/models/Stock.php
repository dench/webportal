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
    const NOT_AVAILABLE = 0;
    const IN_STOCK = 1;
    const BY_ORDER = 2;

    public $id;
    public $name;

    private static $data = [
        self::NOT_AVAILABLE => ['id' => self::NOT_AVAILABLE, 'name' => 'Нет в наличии'],
        self::IN_STOCK => ['id' => self::IN_STOCK, 'name' => 'В наличии'],
        self::BY_ORDER => ['id' => self::BY_ORDER, 'name' => 'Под заказ'],
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