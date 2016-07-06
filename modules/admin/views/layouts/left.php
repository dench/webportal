<aside class="main-sidebar">

    <section class="sidebar">

        <?= app\modules\admin\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    //['label' => 'Управление', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Пользователи'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/user']],
                    ['label' => Yii::t('app', 'Страницы'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/page']],
                    ['label' => Yii::t('app', 'Статьи'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/article']],
                    ['label' => Yii::t('app', 'Категории статей'), 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/article-category']],
                ],
            ]
        ) ?>

    </section>

</aside>
