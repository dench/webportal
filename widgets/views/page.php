<?php
/**
 * Created by PhpStorm.
 * User: dench
 * Date: 09.08.16
 * Time: 15:14
 */

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/** @var $date string */
/** @var $name string */
/** @var $text string */

?>

<div class="page-date"><?= Html::encode($date) ?></div>
<h1 class="page-title"><?= Html::encode($name) ?></h1>
<div class="page-text">
    <?= HtmlPurifier::process($text) ?>
</div>