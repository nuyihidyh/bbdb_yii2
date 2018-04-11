<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08-Dec-17
 * Time: 2:41 PM
 */

use app\models\LookupCampus;
use app\modules\registration\assets\RegAsset;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

RegAsset::register($this);
?>



<div class="container">

    <div class="stepwizard col-md-offset-3">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="<?php echo \yii\helpers\Url::to(['/registration/default/first-step'])?>" type="button" class="btn btn-default btn-circle">1</a>
                <p>Step 1</p>
            </div>
            <div class="stepwizard-step">
                <a href="<?php echo \yii\helpers\Url::to(['/registration/default/second-step'])?>" type="button" class="btn btn-primary btn-circle" >2</a>
                <p>Step 2</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" >3</a>
                <p>Step 3</p>
            </div>
        </div>
    </div>

<form role="form" action="" method="post">
        <div class="row setup-content" id="step-1">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin()?>

                    <h3>Application Details</h3>

                    <?php
                    $campus_list = ArrayHelper::map(LookupCampus::find()->all(),'id','campus_name');

                    ?>

                    <?php echo $form->field($campus_programme,'campus_id')->dropDownList($campus_list,['prompt'=>'Please select']) ?>

                    <?php echo $form->field($campus_programme, 'programme_id')->widget(DepDrop::className(),[
                            'pluginOptions' => [
                                    'depends' => ['campusprogramme-campus_id'],
                                'placeholder' =>'Select one...',
                                'url' => \yii\helpers\Url::to(['/registration/default/programme-list-by-campus'])
                            ]
                    ]); ?>

                    <h3>Student/Child Details</h3>


                    <?php echo $form->field($student,'mykid_no') ?>
                    <?php echo $form->field($student,'passport_no') ?>

                    <?php echo $form->field($student,'first_name') ?>
                    <?php echo $form->field($student,'last_name') ?>

                    <?php echo $form->field($student,'gender')->dropDownList([
                        0 => "Male",
                        1 => "Female"
                    ]) ?>
                    <?php echo $form->field($student,'dob') ?>
                    <?php echo $form->field($student,'pob') ?>
                    <?php echo $form->field($student,'home_address') ?>

                    <?php echo \yii\helpers\Html::submitButton('Save & Next',['class' => 'btn btn-success']); ?>

                    <?php ActiveForm::end(); ?>


            </div>
        </div>


</div>
</div>