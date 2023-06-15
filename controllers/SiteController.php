<?php

namespace app\controllers;

use app\models\Files;
use app\models\UploadForm;
use app\models\Users;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\Setting;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        // echo "<pre>";
        // print_r(Yii::$app->request->post());
        // die;
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->redirect(Url::to(['site/page']));
            return $this->redirect(Url::to(['/files/']));
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /**
     * Displays about page.
     *
     * @return string
     */
    // public function actionCountry(){
    //     return $this->render('country');
    // }
    public function actionUpload()
    {
        $model = new UploadForm();
        //$model = new Files();

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            //$model->file = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                //$model->save();
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionPage()
    {
        $imageExtensions = ['jpg', 'jpeg', 'png']; 
        $files = FileHelper::findFiles('uploads/', [
            'only' => ['*.jpg', '*.jpeg', '*.png'],
        ]);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $files,
            'pagination' => [
                'pageSize' => 10, // Số lượng tệp tin hiển thị trên mỗi trang
            ],
        ]);

        return $this->render('page', [
            'dataProvider' => $dataProvider,
        ]);
        
    }
    public function actionSignUp(){
        $model = new Users();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->save();
            return $this->redirect(['site/login']);
        } else{
            return $this->render('signUp', [
                'model' => $model,
            ]);
        }
    }
    
}
