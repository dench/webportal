<aside class="main-sidebar">

    <section class="sidebar">

        <?= app\modules\admin\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => Yii::t('app', 'Пользователи'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/user']],
                    ['label' => Yii::t('app', 'Страницы'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/page']],
                    ['label' => Yii::t('app', 'Статьи'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/article']],
                    ['label' => Yii::t('app', 'Категории статей'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/article-category']],
                    ['label' => Yii::t('app', 'Продукты'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/product']],
                    ['label' => Yii::t('app', 'Категории товаров'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/product-category']],
                    ['label' => Yii::t('app', 'Производители'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/vendor']],
                    ['label' => Yii::t('app', 'XML импорт'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/import']],
                ],
            ]
        ) ?>

    </section>

</aside>
