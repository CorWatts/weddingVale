<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RsvpForm;

class SiteController extends Controller
{
    public $background;

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
        $this->background = "background.jpg";
        return $this->render('index');
    }

    public function actionRegistry()
    {
        $this->background = "background.jpg";
        return $this->render('registry');
    }

    public function actionVenue()
    {
        $this->background = "background.jpg";
        return $this->render('venue');
    }

    public function actionRsvp()
    {
        $this->background = "rsvp_background.jpg";
        $model = new RsvpForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            
        Yii::$app->mail->compose('@app/views/mail/toSam',['model' => $model])
             ->setFrom('admin@weddingvale.com')
             ->setTo("corwatts@gmail.com")
             ->setSubject("Someone has RSVPed for your wedding!")
             ->setReplyTo($model->email)
             ->send();

            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('rsvp', [
                'model' => $model,
            ]);
        }
    }
}
