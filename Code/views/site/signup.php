<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */

$this->title = 'Sign Up';
?>

<?php

	if(Yii::$app->session->getFlash('SignInFormSubmitted')):?>
		<div class="alert alert-success">
			You have succesfully registered with the Online Video Learning. Please Login. 
        </div>
	<?php else:
?>
<div class="col-md-10 col-md-offset-1">
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
<div class="col-md-10 col-md-offset-1">
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Sign Up</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <p>Please fill out the following fields to login:</p>
        <div class="site-signup">

            <?php $form = ActiveForm::begin(['id' => 'signup-form',]); ?>

                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput(); ?>
                <?= $form->field($model, 'firstName') ?>
                <?= $form->field($model, 'lastName') ?>
                <?= $form->field($model, 'file')->fileInput() ?>
            
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success pull-right']) ?>
                </div>
            <?php ActiveForm::end(); ?>

        </div><!-- site-signup -->
	<?php endif; ?>


    </div>
</div>
</div>