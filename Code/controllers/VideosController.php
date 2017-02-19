<?php

namespace app\controllers;

use Yii;
use app\models\Videos;
use app\models\PermissionHelpers;
use yii\filters\AccessControl;
use app\models\VideosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\VideoForm;
use app\models\LoginForm;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\Comments;
use app\models\SavedVideos;
use app\models\Category;
use yii\helpers\ArrayHelper;


/**
 * VideosController implements the CRUD actions for Videos model.
 */
class VideosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {



        return [
			'access' => [
                'class' => AccessControl::className(),
                 'only' => ['update','delete','create'],
                'rules' => [
                    [
                        'actions' => ['update','delete','create'],
                        'allow' => true,
                        'roles' => ['@'],
						// 'matchCallback' => function($rule, $action) {
						// 	return PermissionHelpers::requireAdmin();
						//  }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Videos models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $searchModel = new VideosSearch();
        // print_r(Yii::$app->request->queryParams);
        // exit;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAll()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        if (Yii::$app->request->post('submit')==='global_search') {
          $searchModel = new VideosSearch();
          $data = $_REQUEST['global_data'];
          $dataProvider = $searchModel->globalsearch($data);
         // print_r($dataProvider);exit;
          return $this->render('global_search', [
            'new_videos' => $dataProvider,
        ]);

        }

        $videos = Videos::find()->all();
        return $this->render('video', [
            'new_videos' => $videos,
        ]);
    }

    /**
     * Displays a single Videos model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Videos for watch.
     * @param integer $id
     * @return mixed
     */
    public function actionWatch($id)
    {
        $model_com = new Comments(); 
        if (Yii::$app->request->post('submit')==='save_video') {
            $save_video = new SavedVideos();
            $save_video->users_id = Yii::$app->user->identity->id;
            $save_video->videos_id = $id;
            $save_video->save();
        }
           
        if ($model_com->load(Yii::$app->request->post()) && $model_com->validate()) {
            $data = $_REQUEST['Comments'];
            $model_com->commentdate = date("Y/m/d");
            $model_com->users_id = Yii::$app->user->identity->id;
            $model_com->videos_id = $id;
            $model_com->save();

        }
        $save_value = true;
        $save_model = SavedVideos::find()->where(['users_id' => Yii::$app->user->identity->id,'videos_id' => $id])->all();
        if(empty($save_model)){
            $save_value = false;

        }
        $new_videos = Videos::find()->orderBy(['createDate' => SORT_DESC])->limit('6')->all();
        $category = Category::find()->all();
        //  $category = Videos::find()
        // ->join('LEFT OUTER JOIN', 'categorys',
        //         'categorys.id =videos.category_id')->all();
        // print_r($category);exit;

      
        $all_comments = $this->findModel($id)->getComments()->all();

         return $this->render('watch', [
            'model' => $this->findModel($id),
            'new_comment' => new Comments(),
            'comments' => $all_comments,
            'save' => $save_value,
            'new_videos' => $new_videos,
            'category' => $category
        ]);
    }

    /**
     * Creates a new Videos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Videos();
        $Category = ArrayHelper::map(Category::find()->all(), 'id', 'name');
        // print_r($Category);
        // exit;
        //$model = new LoginForm();   

        //get post request and check validation
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $data = $_REQUEST['Videos'];
     

            //set requst date to model
            $imagename = $data['title'];
            $model->title = $data['title'];
            $model->description = $data['description'];
            $model->url = $this->convertYoutube($data['url']);
            $model->createDate = date("Y/m/d");
            $model->rating = 1;
            $model->creator = Yii::$app->user->identity->id;
            $model->category_id =$data['category_id'];
            $model->image = $this->getYoutubeImageUrl($data['url']);
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);             
           
        } 
        return $this->render('create', [
            'model' => $model,
            'category' => $Category,
        ]);
        
    }

    /**
     * Updates an existing Videos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Videos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * View an user saved Videos.
     * Display user saved videos.
     * @return mixed
     */
    public function actionSavedvideos()
    {
        $videos = Videos::find()
        ->join('LEFT OUTER JOIN', 'saved_videos',
                'saved_videos.videos_id =videos.id')   
        ->where(['users_id' => Yii::$app->user->identity->id])->all();
        return $this->render('saved_video', [
            'videos' => $videos,
        ]);
    }

    /**
     * Finds the Videos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Videos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Videos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function convertYoutube($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "https://www.youtube.com/embed/$2",
        $string
    );}

    protected function getYoutubeImageUrl($string) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "https://img.youtube.com/vi/$2"."/0.jpg",
        $string
    );
}
}
