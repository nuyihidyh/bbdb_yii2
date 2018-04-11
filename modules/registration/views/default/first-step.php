<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08-Dec-17
 * Time: 2:41 PM
 */

use app\models\LookupCurrency;
use app\models\LookupGuardian;
use app\models\LookupSalary;
use app\modules\registration\assets\RegAsset;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

RegAsset::register($this);
?>



<div class="container">

    <div class="stepwizard col-md-offset-3">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                <p>Step 1</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p>Step 2</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p>Step 3</p>
            </div>
        </div>
    </div>


        <div class="row setup-content" id="step-1">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin()?>

                    <h3>Member Account</h3>


                    <?php echo $form->field($account,'email') ?>
                    <?php echo $form->field($account,'newPassword')->passwordInput() ?>
                    <?php echo $form->field($account,'newPasswordConfirm')->passwordInput() ?>

                    <h3>Member Details</h3>

                    <?php echo $form->field($member,'name') ?>
                    <?php echo $form->field($member,'mykad_no') ?>
                    <?php echo $form->field($member,'passport_no') ?>
                    <?php echo $form->field($member,'current_employer') ?>
                    <?php echo $form->field($member,'position') ?>
                    <?php
                    $salary_list = ArrayHelper::map(LookupSalary::find()->all(),'id','salary_range');
                    $currency_list = ArrayHelper::map(LookupCurrency::find()->all(),'id','combined_currency');
                    $guardian_list = ArrayHelper::map(LookupGuardian::find()->all(),'id','name');

                    ?>
                    <?php echo $form->field($member,'salary_id')->dropDownList($salary_list,['prompt'=>'Please select']) ?>
                    <?php echo $form->field($member,'currency_id')->dropDownList($currency_list) ?>
                    <?php echo $form->field($member,'work_address')->textarea() ?>
                    <?php echo $form->field($member,'work_phone') ?>
                    <?php echo $form->field($member,'mobile') ?>

                    <?php echo $form->field($member,'relationship')->dropDownList($guardian_list) ?>


                    <?php echo \yii\helpers\Html::submitButton('Save & Next',['class' => 'btn btn-success']); ?>

                    <?php ActiveForm::end(); ?>


            </div>
        </div>


</div>
</div>
