<div class="col-md-9">
    vikna-ua.com.ua › ➊ Главная › ➋ Контакты ☎
</div>
<div class="col-md-3">
    <?php

    use yii\bootstrap\Nav;

    $menuItems = [
        ['label' => 'Home', 'url' => ['/main/default/index']],
        ['label' => 'Contact', 'url' => ['/main/contact/index']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'nav nav-stacked'],
        'items' => $menuItems,
    ]);

    ?>
</div>
