<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1></h1>

<div class="row">
    <div class="panel panel-default ">
        <div class="panel-body posts">
            <div class="col-md-11">
                <div class="post-item">
                    <div class="post-title">
                        My Favorites
                    </div>
                </div>
                <?php

                foreach($videos as $video){
                    ?>
                    <div class="col-md-4">
                    
                    <div class="post-item">
                        <div class="post-title">
                            <a href="pages-blog-post.html"><?php echo $video->title; ?></a>
                        </div>
                        <div class="post-date"><span class="fa fa-calendar"></span> <?php echo $video->createDate; ?> / <a href="pages-blog-post.html#comments">3 Comments</a> / <a href="pages-profile.html">by Dmitry Ivaniuk</a></div>
                        <div class="post-text">
                            <img src="<?php echo $video->image; ?>" class="img-responsive img-text" width="300" height="300"/>
                            <div id="play"></div>                                            
                        </div>
                        <div class="post-row">
                            <div class="post-info">
                                <span class="fa fa-thumbs-up"></span> 15 - <span class="fa fa-eye"></span> 15,332 - <span class="fa fa-star"></span> 322
                            </div>
                            <a href="<?php echo Url::to(['videos/watch', 'id' =>$video->id ]); ?>" class="btn btn-default btn-rounded pull-right">View Video &RightArrow;</a>
                        </div>
                    </div> 
                </div>
                <?php }
                ?>                                                                                
                    
             
            </div>
        </div>
    </div>
</div>


















