<?php
    namespace app\controllers;

    use Yii;
    use app\models\LoginForm;
    use app\models\ContactForm;
    use app\models\SignupForm;
    use yii\filters\ContentNegotiator;
    use yii\web\Response;
    use yii\filters\AccessControl;
    use yii\rest\Controller;
    use yii\filters\auth\HttpBearerAuth;
    /**
        * Site controller
    */
    class ApiController extends Controller
    {
        /**
            * @inheritdoc
        */
        public function behaviors()
        {
            $behaviors = parent::behaviors();
            $behaviors['authenticator'] = [
                'class' => HttpBearerAuth::className(),
                'only' => ['dashboard'],
            ];
            $behaviors['contentNegotiator'] = [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ];
            $behaviors['access'] = [
                'class' => AccessControl::className(),
                'only' => ['dashboard'],
                'rules' => [
                    [
                        'actions' => ['dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ];
            return $behaviors;
        }
        
        public function actionLogin()
        {
            $model = new LoginForm();
            if($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()){
                    return ['access_token' => Yii::$app->user->identity->getAuthKey()];
            }else{
                $model->validate();
                return $model;
            }
        }
        
        public function actionDashboard()
        {
            $response = [
                'phone' => Yii::$app->user->identity->phone,
                'access_token' => Yii::$app->user->identity->getAuthKey(),
            ];
            return $response;
        }
        
        public function actionSignup()
        {
            $model = new SignupForm();
 
            if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }
                }
            }
            
            $model->validate();
            return $model;
        }
    }
