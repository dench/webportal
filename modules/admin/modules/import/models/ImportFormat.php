<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 22.07.16
 * Time: 12:15
 */

namespace app\modules\admin\modules\import\models;


use yii\base\Object;
use yii\helpers\ArrayHelper;

class ImportFormat extends Object
{
    public $id;
    public $name;

    private static $data = [
        1 => ['id' => 1, 'name' => 'Hotline'],
        2 => ['id' => 2, 'name' => 'Price.ua'],
        3 => ['id' => 3, 'name' => 'ibud.ua'],
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