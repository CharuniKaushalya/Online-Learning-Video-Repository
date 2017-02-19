<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\Videos;
use yii\web\UploadedFile;
use app\models\VideosSearch;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * @inheritdoc
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
        if (Yii::$app->user->isGuest) {
            //return $this->goHome();
            $this->layout = 'front';
            //print_r($videos);
            return $this->render('index', [
            ]);
        }

        if (Yii::$app->request->post('submit')==='global_search') {
          $searchModel = new VideosSearch();
          $data = $_REQUEST['global_data'];
          $dataProvider = $searchModel->globalsearch($data);
         // print_r($dataProvider);exit;
          return $this->render('..\videos\global_search', [
            'new_videos' => $dataProvider,
        ]);

        }
        if(Yii::$app->user->identity->role==100){
            $videos = Videos::find()->all();
        }else{
            $videos = Videos::find()->where(['creator' => Yii::$app->user->identity->id])->all();
        }
        $new_videos = Videos::find()->orderBy(['createDate' => SORT_DESC])->limit('6')->all();


   
        return $this->render('..\videos\video', [
            'new_videos' => $new_videos,
        ]);
    }

     public function actionHello()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'front';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        if (Yii::$app->user->isGuest) {
            $this->layout = 'front';
        }

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
	
	public function actionSignup()
	{
     $this->layout = 'front';
		$model = new Users();
   

		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
        $data = $_REQUEST['Users'];

				$model->email = $data['email'];
        $model->firstName = $data['firstName'];
        $model->lastName = $data['lastName'];
        $model->role = 0;
				$model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);

        //check upload file
        $imagename = $data['email'];
        if(!UploadedFile::getInstance($model, 'file')){
            $imagename = 'User_No.png';
            $image_location = 'images/videos/'.$imagename;
        }else{ 
          $model->file = UploadedFile::getInstance($model, 'file');
          $image_location = 'images/videos/'.$imagename.'.'.$model->file->extension;
          $valid_types = array('image/gif', 'image/png', 'image/jpeg', 'image/JPEG','image/jpg');

          //check upload file types
          if (!in_array($model->file->type, $valid_types)){
               Yii::$app->session->setFlash('success', 'Please Upload Valid Image Type');
              return $this->refresh(); //refresh the page in sucess
          }else{  
            //save imge into /image/vides folders
            $model->file->saveAs($image_location,false);
          }
        }
        $model->user_image = $image_location;
        $model->save(); //save the data to the Users table
        //set the success session
        Yii::$app->session->setFlash('SignInFormSubmitted');
    
				return $this->refresh(); //refresh the page in sucess
			}
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}
}
