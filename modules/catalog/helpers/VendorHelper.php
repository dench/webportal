<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 27.07.16
 * Time: 17:39
 */

namespace app\modules\catalog\helpers;

use app\modules\catalog\models\Vendor;
use yii\helpers\ArrayHelper;

class VendorHelper
{
    public static function list($enabled = null)
    {
        $temp = Vendor::find()->filterWhere(['enabled' => $enabled])->asArray()->all();

        return ArrayHelper::map($temp, 'id', 'name');
    }
}