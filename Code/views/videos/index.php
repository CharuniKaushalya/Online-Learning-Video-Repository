<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VideosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Videos';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-11">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
            </div><!-- /.box-header -->
    <div class="box-body">
<div class="videos-index">

    <h1></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Videos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'url:url',
            'description:ntext',
            'createDate',
            // 'creator',
            // 'rating',
			Yii::$app->user->identity->role==100 ? (
        	
            ['class' => 'yii\grid\ActionColumn', 'template'=> '{view}{update}{delete}']
			) : (
			 ['class' => 'yii\grid\ActionColumn', 'template'=> '{view}{update}']
			),
        ],
    ]); ?>
</div>
</div>
</div>
</div>



















