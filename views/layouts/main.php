<?php
    
    /* @var $this \yii\web\View */
    /* @var $content string */
    
    use app\widgets\Alert;
    use yii\helpers\Html;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\widgets\Breadcrumbs;
    use app\assets\AppAsset;
    
    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="app">  
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.5/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.5/angular-route.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-strap/2.3.12/angular-strap.min.js"></script>
        <?php $this->head() ?>
    </head>
    <body ng-controller="MainController">
        <?php $this->beginBody() ?>
        
        <div class="wrap">
            <nav class="navbar-inverse navbar-fixed-top navbar" role="navigation" bs-navbar>
                <div class="container">
                    <div class="navbar-header">
                        <button ng-init="navCollapsed = true" ng-click="navCollapsed = !navCollapsed" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#/">RSA Лендинг</a>
                    </div>
                    <div ng-class="!navCollapsed && 'in'" ng-click="navCollapsed=true" class="collapse navbar-collapse" >
                        <ul id="w1" class="navbar-nav navbar-right nav">
                            <li><a href="#/">Главная</a></li>
                            <li ng-class="{active:isActive('/logout')}" ng-show="loggedIn()" class="ng-hide">
                                <a href="#/hello">Hello</a>
                            </li>
                            <li ng-hide="loggedIn()">
                                <a href="#/signup">Регистрация</a>
                            </li>
                            <li ng-class="{active:isActive('/logout')}" ng-show="loggedIn()" ng-click="logout()" class="ng-hide">
                                <a href="">Выход</a>
                            </li>
                            <li ng-hide="loggedIn()"><a href="#/login">Вход</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
                
                <div class="container">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= Alert::widget() ?>
                    <div ng-view>
                        <?
                            //print_r($content);
                        //= $content ?>
                    </div>
                </div>
        </div>
        
        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
                
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>
        
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
