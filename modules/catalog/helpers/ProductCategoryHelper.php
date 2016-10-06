<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 13.07.16
 * Time: 11:39
 */

namespace app\modules\catalog\helpers;

use app\modules\catalog\models\ProductCategory;

class ProductCategoryHelper
{
    private static $_all;

    private static $_parent;

    private static $_tree;

    /**
     * Tree categories
     *
     * @param int $parent_id
     * @param int $enabled
     * @return mixed
     */
    public static function tree($parent_id = 0, $enabled = 1)
    {
        if (empty(self::$_tree[$parent_id])) {
            self::$_tree[$parent_id] = [];
            if (empty(self::$_parent[$parent_id])) {
                if (empty(self::$_all)) {
                    self::$_all = ProductCategory::find()->filterWhere(['enabled' => $enabled])->orderBy('position')->indexBy('id')->asArray()->all();
                }
                foreach (self::$_all as $item) {
                    self::$_parent[(int)$item['parent_id']][] = $item;
                }
            }
            if (!empty(self::$_parent[$parent_id])) {
                foreach (self::$_parent[$parent_id] as $item) {
                    if (isset(self::$_parent[$item['id']])) {
                        $item['items'] = self::tree($item['id'], $enabled);
                    }
                    self::$_tree[$parent_id][] = $item;
                }
            }
        }
        return self::$_tree[$parent_id];
    }

    public static function list($parent_id = 0, $enabled = 1, $level = 0)
    {
        $list = [];

        foreach (self::tree($parent_id, $enabled) as $item) {
            $prefix = '';
            for ($i = 0; $i < $level; $i++) {
                $prefix .= ' - ';
            }
           $list[$item['id']] = $prefix . $item['name'];
            if (!empty($item['items'])) {
                $list += self::list($item['id'], $enabled, $level + 1);
            }
        }

        return $list;
    }

    public static function familyIds($parent_id = 0, $enabled = 1)
    {
        $ids = array_keys(self::list($parent_id, $enabled));
        $ids[] = $parent_id;
        return $ids;
    }

    public static function level($parent_id = null, $enabled = 1)
    {
        return ProductCategory::find()->select(['name'])->where(['parent_id' => $parent_id])->andFilterWhere(['enabled' => $enabled])->orderBy('position')->indexBy('id')->asArray()->column();
    }
}