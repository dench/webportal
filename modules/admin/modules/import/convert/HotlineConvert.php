<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 22.07.16
 * Time: 16:07
 */

namespace app\modules\admin\modules\import\convert;

use app\modules\catalog\models\Stock;

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
                'remote_id' => (int)$item->id,
                'parent_id' => $item->parentId ? (int)$item->parentId : null,
                'name' => (string)$item->name,
            ];
        }

        foreach ($raw->items->item as $item) {

            $stock = Stock::NOT_AVAILABLE;

            if ((string)$item->stock == 'В наличии') {
                $stock = Stock::IN_STOCK;
            }

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
                'stock_id' => $stock,
            ];
        }

        return $result;
    }
}