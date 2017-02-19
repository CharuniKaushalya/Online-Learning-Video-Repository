<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Comments;
use app\models\Users;
use app\models\SavedVideos;
use app\models\Videos;

/* @var $this yii\web\View */
/* @var $model app\models\Videos */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Watch Video', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-11">
    <div class="col-md-9">
        
        <div class="panel panel-default">
            <div class="panel-body posts">
                        
                <div class="post-item">
                    <div class="post-title">
                        <?php echo $model->title; ?>  

                        
                        
                    </div>
                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                      <?= Html::submitButton($save ? 'Saved' : 'Save', ['class' => $save? 'btn btn-warning' : 'btn btn-success', 'disabled'=>  $save? true:false, 'value'=>'save_video', 'name'=>'submit']) ?>
                          <?php ActiveForm::end(); ?>

                    <div class="post-date"><span class="fa fa-calendar"></span> <?php echo $model->createDate; ?>/ <a href="pages-blog-post.html#comments">3 Comments</a> / <a href="pages-profile.html">by Dmitry Ivaniuk</a></div>
                    <div class="post-video">  
                    <iframe width="560" height="315" src="<?php echo $model->url; ?>" frameborder="0" allowfullscreen></iframe>
                    <?php echo $model->url; ?>
                    <!-- <div id="play"></div> -->
                    </div>
                    <div class="post-text">                                           
                        
                        <h4>Description</h4>
                        <p>
                           <?php echo $model->description; ?>
                        </p>
                    </div>
                    <div class="post-row">
                        <div class="post-info">
                            <span class="fa fa-thumbs-up"></span> 15 - <span class="fa fa-eye"></span> 15,332 - <span class="fa fa-star"></span> 322                                                
                        </div>
                    </div>
                </div>                                            
                   
                <h3 class="push-down-20">Comments</h3>
                 

                <ul class="media-list">
                    <?php

                foreach($comments as $comment){
                    ?>
                    
                    <li class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object img-text" src="<?php echo  Users::findOne(['id'=>$comment->users_id])->user_image;?>" alt="Samuel Leroy Jackson" width="64" >
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo  Users::findOne(['id'=>$comment->users_id])->firstName;?></h4>
                            <p><?php echo $comment->comment; ?></p>
                            <p class="text-muted"><?php echo date('d F Y', strtotime($comment->commentdate));?></p>                                                                                      
                        </div>
                    </li>
                    <?php }
                ?> 
                    <li class="media">
                        
                        <div class="media-body">
                        	<?= $this->render('comment_form', [
						        'model' => $new_comment,
						    ]) ?>                                                                                      
                        </div>

                    </li>
                </ul>                                    
            </div>
        </div>
        
    </div>
    <div class="col-md-3">

        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Categories</h3>
                <div class="links">
                <?php foreach($category as $category_item){ ?>
                    <a href="#"> <?php echo $category_item->name; ?> <span class="label label-default"><?php echo  videos::find()->where(['category_id' => $category_item->id])->count();?> </span></a>
                <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Recent</h3>
                <div class="links small">
                <?php foreach($new_videos as $video){ ?>
                    <a href="<?php echo Url::to(['videos/watch', 'id' =>$video->id ]); ?>"><?php echo $video->title; ?> - <?php echo $video->description; ?></a>
                <?php } ?>
                </div>
            </div>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Tags</h3>
                <ul class="list-tags push-up-10">
                <?php foreach($category as $category_item){ ?>
                     <li><a href="#"><span class="fa fa-tag"></span> <?php echo $category_item->name; ?></a></li>
                <?php } ?>
                  
                   
                </ul>
            </div>
        </div>                            
        
    </div>
</div>