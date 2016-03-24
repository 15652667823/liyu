<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        $db = Yii::$app->db;
        $list = $db->createCommand("select * from liu")->queryAll();
        return $this->render('index',['list'=>$list]);
    }

    public function actionLiu()
    {
        $db = Yii::$app->db;
        $request = Yii::$app->request;
        $bao = $request->get('bao');
        //echo $bao;die;
        $time = date('Y-m-d H:i:s');
        $re = $db->createCommand("insert into liu(content,addtime) values('$bao','$time')")->execute();
        $list = $db->createCommand("select * from liu")->queryAll();
        echo json_encode($list);
    }

    public function actionShan(){
        $db = Yii::$app->db;
        $id = $_GET['id'];
        //echo $id;die;
        $re = $db->createCommand("delete from liu where id='$id'")->execute();
        if ($re) {
            echo "<script>alert('删除成功')</script>";
        }
        $list = $db->createCommand("select * from liu")->queryAll();
        return $this->render('index',['list'=>$list]);
    }

    public function actionXiu(){
        $db = Yii::$app->db;
        $id = $_GET['id'];
        $list = $db->createCommand("select * from liu where id='$id'")->queryOne();
        return $this->render('index1',['list'=>$list]);
    }

    public function actionGai(){
        $db = Yii::$app->db;
        @$id = $_POST['id'];
        @$content = $_POST['content'];
        $li = $db->createCommand("update liu set content='$content' where id='$id'")->execute();
        if ($li) {
            echo "<script>alert('修改成功')</script>";
        }
        $list = $db->createCommand("select * from liu")->queryAll();
        return $this->render('index',['list'=>$list]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

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

    public function actionAbout()
    {
        return $this->render('about');
    }
}
