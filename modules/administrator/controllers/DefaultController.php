<?php

namespace app\modules\administrator\controllers;

use app\modules\registration\models\Application;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * Default controller for the `administrator` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {


        $applicationDataProvider = new ActiveDataProvider(['query' => Application::find()->where(['status'=> 0])
        ]);

        return $this->render('index',compact('applicationDataProvider'));
    }

    public function actionOfferStudent($application_id){

        $member_email = Application::find()->where(['id'=>$application_id])
            ->one()
            ->student
            ->member
            ->id0
            ->email;

        $application = Application::find()->where(['id'=>$application_id])->one();

        $application->status=1; //update to offered status

        if ($application->update()){

            \Yii::$app->mailer->compose()
                ->setTo($member_email)
                ->setCc("nurul.hidayah@brainybunch.com")
                ->setSubject("Offer Letter From BrainyBunch")
                ->setHtmlBody("<p>Tahniah</p>")
                ->attach($this->generatePdf($application->id,$application),
                    ['fileName' => 'Offer_Letter.pdf'])
                ->send();

            \Yii::$app->session->setFlash('success','Student Offered');

            return $this->redirect(['/administrator/default/index']);
        }

    }

    private function generatePdf($running_number, $application)
    {

        $content = $this->renderPartial('offer_letter_template',compact('application'));

        $pdfOptions = [
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_FILE,
            'content' => $content,
            'filename' => \Yii::getAlias('@webroot') . '/'.$running_number.'.pdf'
        ];

        $pdf = new Pdf($pdfOptions);

        $pdf->render();

        return  \Yii::getAlias('@webroot') . '/'.$running_number.'.pdf';
    }
}
