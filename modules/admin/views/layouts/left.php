<aside class="main-sidebar">

    <section class="sidebar">

        <?= app\modules\admin\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Control', 'options' => ['class' => 'header']],
                    ['label' => 'Users', 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/user/index']],
                    ['label' => 'Pages', 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/page/index']],
                    ['label' => 'Categories', 'icon' => 'fa fa-file-code-o', 'url' => ['/admin/article-category/index']],
                ],
            ]
        ) ?>

    </section>

</aside>
