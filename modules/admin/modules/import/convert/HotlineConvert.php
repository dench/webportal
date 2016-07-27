<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 22.07.16
 * Time: 16:07
 */

namespace app\modules\admin\modules\import\convert;


use app\modules\catalog\models\Product;

class HotlineConvert
{
    public static function run($file)
    {
        $raw = simplexml_load_string($file);

        $result = [
            'user_id' => (string)$raw->firmId,
            'date' => (string)$raw->date,
            'rate' => (float)$raw->rate,
        ];

        foreach ($raw->categories->category as $item) {
            $result['categories'][] = [
                'id' => (int)$item->id,
                'name' => (string)$item->name,
            ];
        }

        foreach ($raw->items->item as $item) {

            $result['items'][] = [
                'remote_id' => (int)$item->id,
                'category_id' => (int)$item->categoryId,
                'code' => (string)$item->code,
                'vendor' => (string)$item->vendor,
                'name' => (string)$item->name,
                'description' => (string)$item->description,
                'url' => (string)$item->url,
                'price' => (int)$item->priceRUAH,
                'oldprice' => (int)$item->oldprice,
                'image' => (string)$item->image,
                'guarantee' => (string)$item->guarantee,
                'stock' => (string)$item->stock,
            ];
        }

        return $result;
    }
}