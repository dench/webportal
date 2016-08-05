<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<section class="grey">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="home-title">
                    <div class="home-title-text"><?= Yii::t('app', 'Новости дня') ?></div>
                </div>
                <div class="row project-home">
                    <div class="col-sm-4">
                        <a href="#" rel="nofollow" class="thumbnail"><i></i></a>
                    </div>
                    <div class="col-sm-8">
                        <a href="#" class="title">Дом-термос, не требующий отопления, стал реальностью для жителя Ивано-Франковска</a>
                        <div class="text">
                            Уникальный дом, который не нуждается в системе индивидуального отопления, построил житель
                            Ивано-Франковска Николай Яцинович. По словам нашего соотечественника, на возведение этого
                            «архитектурного чуда» у него ушло 10 лет, а финансовые затраты оказались вполне равноценны
                            сумме,...
                        </div>
                        <a href="#" class="btn btn-success" rel="nofollow">Подробнее</a>
                        <a href="#" class="btn btn-primary" rel="nofollow">Все новости</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 dashed-left">
                <div class="home-title">
                    <a href="#" class="btn btn-primary pull-right hidden-md" rel="nofollow">Все компании</a>
                    <div class="home-title-text"><?= Yii::t('app', 'Лидеры каталога') ?></div>
                    <hr>
                </div>
                <div class="list-group list-liders row">
                    <div class="list-group-col col-sm-6 col-md-12">
                        <a href="#" class="list-group-item">
                            <img src="http://www.stroimdom.com.ua/images/companies_logos/thumb/432.jpeg">
                            <h4 class="list-group-item-heading">Заголовок пункта списка группы</h4>
                        </a>
                    </div>
                    <div class="list-group-col col-sm-6 col-md-12">
                        <a href="#" class="list-group-item">
                            <img src="http://www.stroimdom.com.ua/images/companies_logos/thumb/432.jpeg">
                            <h4 class="list-group-item-heading">Заголовок пункта списка группы</h4>
                        </a>
                    </div>
                    <div class="list-group-col col-sm-6 col-md-12">
                        <a href="#" class="list-group-item">
                            <img src="http://www.stroimdom.com.ua/images/companies_logos/thumb/432.jpeg">
                            <h4 class="list-group-item-heading">Заголовок пункта списка группы</h4>
                        </a>
                    </div>
                    <div class="list-group-col col-sm-6 col-md-12 visible-sm">
                        <a href="#" class="list-group-item">
                            <img src="http://www.stroimdom.com.ua/images/companies_logos/thumb/432.jpeg">
                            <h4 class="list-group-item-heading">Заголовок пункта списка группы</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="green">
    <div class="container">
        <div class="home-title">
            <a href="<?= \yii\helpers\Url::to(['/page/default/index', 'slug' => 'privet']) ?>" class="btn btn-danger pull-right" rel="nofollow">Весь каталог</a>
            <div class="home-title-text"><?= Yii::t('app', 'Каталог товаров') ?></div>
        </div>
        <div class="list-group list-catalog row">
            <div class="list-group-col col-sm-6 col-md-4">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический электрический </h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>

            <div class="list-group-col col-sm-6 col-md-4">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>

            <div class="list-group-col col-sm-6 col-md-4 hidden-xs">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4 hidden-xs">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4 hidden-xs">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>

            <div class="list-group-col col-sm-6 col-md-4 hidden-xs">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4 hidden-xs">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
            <div class="list-group-col col-sm-6 col-md-4 hidden-xs">
                <a href="#" class="list-group-item">
                    <span class="badge">1142</span>
                    <img src="http://www.stroimdom.com.ua/new/img/catalog/32.png">
                    <h4 class="list-group-item-heading">Инструмент электрический</h4>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="white">
    <div class="container">
        <div class="home-title">
            <a href="#" class="btn btn-primary pull-right" rel="nofollow">Все предложения</a>
            <div class="home-title-text"><?= Yii::t('app', 'Новые предложения') ?></div>
            <hr>
        </div>

    </div>
</section>

<section class="grey">
    <div class="container">
        <div class="home-title">
            <a href="#" class="btn btn-primary pull-right" rel="nofollow">Строительные статьи</a>
            <div class="home-title-text"><?= Yii::t('app', 'Все статьи') ?></div>
            <hr>
        </div>

    </div>
</section>
