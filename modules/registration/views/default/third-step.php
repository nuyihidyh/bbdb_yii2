<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08-Dec-17
 * Time: 2:41 PM
 */

use app\modules\registration\assets\RegAsset;
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
                <a href="<?php echo \yii\helpers\Url::to(['/registration/default/second-step'])?>" type="button" class="btn btn-default btn-circle" >2</a>
                <p>Step 2</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button" class="btn btn-primary btn-circle" >3</a>
                <p>Step 3</p>
            </div>
        </div>
    </div>


        <div class="row setup-content" id="step-1">
            <div class="col-xs-6 col-md-offset-3">
                <div class="col-md-12">


                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Registration Review</h3>
                        </div>
                        <div class="panel-body">

                            <strong>Campus : </strong><?php echo $campus_programme->campus->campus_name; ?><br>
                            <strong>Program : </strong><?php echo $campus_programme->programme->programme_name; ?><br>

                            <hr>
                            <strong>Member Email : </strong><?php echo $account->email; ?><br>
                            <strong>Member Password : </strong>*****<br>

                            <hr>
                            <strong>Member Name : </strong><?php echo $member->name; ?><br>
                            <strong>Member Mykid : </strong><?php echo $member->mykad_no; ?><br>
                            <strong>Member Passport : </strong><?php echo $member->passport_no; ?><br>
                            <strong>Member Current Employer : </strong><?php echo $member->current_employer; ?><br>
                            <strong>Member Position : </strong><?php echo $member->position; ?><br>
                            <strong>Member Salary : </strong><?php echo $member->currency_id . " ".$member->salary->salary_range; ?><br>
                            <strong>Member Work Address : </strong><?php echo $member->work_address; ?><br>
                            <strong>Member mobile : </strong><?php echo $member->mobile; ?><br>
                            <strong>Member Relationship : </strong><?php echo $member->relationship0->name; ?><br>

                            <hr>
                            <strong>Student Name : </strong><?php echo $student->first_name.' '.$student->last_name; ?><br>
                            <strong>Student Mykid : </strong><?php echo $student->mykid_no; ?><br>
                            <strong>Student Passport : </strong><?php echo $student->passport_no; ?><br>
                            <strong>Student gender  : </strong><?php echo ($student->gender == 0) ? "Male" : "Female"; ?><br>
                            <strong>Student Date of Birth : </strong><?php echo $student->dob; ?><br>
                            <strong>Student Place of Birth : </strong><?php echo $student->pob; ?><br>
                            <strong>Student Home Address : </strong><?php echo $student->home_address; ?><br>



                        </div>
                    </div>


                    <?php $form = ActiveForm::begin()?>

                    <?php echo \yii\helpers\Html::submitButton('Confirm & Apply',['class' => 'btn btn-success']); ?>

                    <?php ActiveForm::end(); ?>


            </div>
        </div>


</div>
