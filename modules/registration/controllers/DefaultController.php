<?php

namespace app\modules\registration\controllers;

use app\models\CampusProgramme;
use app\models\LookupCampus;
use app\modules\registration\models\Application;
use app\modules\registration\models\Member;
use app\modules\registration\models\Student;
use app\modules\user\models\Role;
use app\modules\user\models\User;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Default controller for the `registration` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFirstStep()
    {

        //register member
        $account = new User();
        $member = new Member();

        if (\Yii::$app->session->has('stepOne')) {

            $account->load(\Yii::$app->session->get('stepOne'));
            $member->load(\Yii::$app->session->get('stepOne'));
        }

        if (\Yii::$app->request->isPost) {
            //save process

            $account->load(\Yii::$app->request->post());
            $member->load(\Yii::$app->request->post());

            if ($account->validate()) {
                if ($member->validate()) {
                    \Yii::$app->session['stepOne'] = \Yii::$app->request->post();
                    return $this->redirect(['/registration/default/second-step']);
                }
            }


        }

        return $this->render('first-step', compact('account', 'member'));
    }

    public function actionSecondStep(){

        $campus_programme = new CampusProgramme();
        $student = new Student();

        if (\Yii::$app->session->has('stepTwo')) {
            $campus_programme->load(\Yii::$app->session->get('stepTwo'));
            $student->load(\Yii::$app->session->get('stepTwo'));
        }

        if (\Yii::$app->request->isPost) {
            $campus_programme->load(\Yii::$app->request->post());
            $student->load(\Yii::$app->request->post());

            if ($campus_programme->validate()) {

                if ($student->validate()) {
                    if ($student->mykid_no == null && $student->passport_no == null) {
                        $student->addError('mykid_no', 'Either Mykid No or Passport No must be included.');
                        $student->addError('passport_no', 'Either Mykid No or Passport No must be included.');
                    } else {
                        \Yii::$app->session['stepTwo'] = \Yii::$app->request->post();
                        return $this->redirect(['/registration/default/third-step']);
                    }


                }
            }
        }
        return $this->render('second-step', compact('campus_programme', 'student'));

    }

    public function actionThirdStep()
    {

        $account = new User();
        $member = new Member();
        $student = new Student();

        $account->load(\Yii::$app->session->get('stepOne'));
        $member->load(\Yii::$app->session->get('stepOne'));
        $student->load(\Yii::$app->session->get('stepTwo'));

        //reference table
        $campus_programme = new CampusProgramme();
        $campus_programme->load(\Yii::$app->session->get('stepTwo'));

        if(\Yii::$app->request->isPost){
            $account->role_id = Role::ROLE_USER;
            $account->status = 1;

            if($account->save()){

                $account_id = $account->id;
                $member->id = $account_id;

                if($member->save()){

                    $student->member_id = $member->id;

                    if ($student->save()){

                        $application = new Application();
                        $application->student_id = $student->id;

                        $campus_programme_id = CampusProgramme::find()
                            ->where(['programme_id' => $campus_programme->programme_id])
                            ->andWhere(['campus_id'=>$campus_programme->campus_id])
                            ->one()
                            ->id;

                        $application->campus_programme_id = $campus_programme_id;
                        $application->submit_datetime = \Yii::$app->formatter->asDatetime('now','php:Y-m-d H:i:s');

                        if($application->save()){

                            \Yii::$app->session->remove('stepOne');
                            \Yii::$app->session->remove('stepTwo');

                            \Yii::$app->session->setFlash('success','Registration is successful');

                            return $this->redirect(['/registration/default/first-step']);


                        }else{
                            $student->delete();
                            $member->delete();
                            $account->delete();
                        }

                    }else{

                        $member->delete();
                        $account->delete();
                        //todo: error message
                    }

                }else{
                    $account->delete();
                    //TODO: ERROR MESSAGE
                }



            }



        }

        return $this->render('third-step', compact('student','account','member','campus_programme'));

    }

    public function actionProgrammeListByCampus()
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);

    }

    private static function getSubCatList($cat_id){
        $campus = LookupCampus::find()->where(['id' => $cat_id])->one();
        return $campus->getProgrammes()->select(['id', 'programme_name as name'])->asArray()->all();

    }


    }
