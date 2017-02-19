<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Videos */

//$this->title = 'Create Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-11">
<?php 
if(Yii::$app->session->hasFlash('success')){?>
	<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-info"></i> Alert!</h4>
        <?php echo Yii::$app->session->getFlash('success'); ?>
     </div><?php
	
}
?>
</div>

<div class="col-md-11">
<div class="box box-success">
    <div class="box-header with-border">
   		<h3 class="box-title">Create Video</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
		<div class="videos-create">

		    <h1><?= Html::encode($this->title) ?></h1>

		    <?= $this->render('_form', [
		        'model' => $model,
		        'category' => $category,
		    ]) ?>

		</div>
	</div>
</div>
</div>

