<div class="administrator-default-index">
    <div class="row">
    <h1>Administrator</h1>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    Application List
                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
                <a href="#" class="list-group-item">Morbi leo risus</a>
                <a href="#" class="list-group-item">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item">Vestibulum at eros</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Application List Details</h3>
                </div>
                <div class="panel-body">
                    <?php
                    echo \yii\grid\GridView::widget([
                            'dataProvider' => $applicationDataProvider,
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                            ['class' => 'yii\grid\DataColumn',
                                'value' => function($model){
                        return strtoupper($model->student->first_name." ". $model->student->last_name);
                                },
                                'label'=>'Student Name'

                        ],

                        [
                             'class' => 'yii\grid\DataColumn',
                            'value' => function($model){
                        Yii::$app->formatter->timeZone = 'Asia/Kuala_Lumpur';
                        return Yii::$app->formatter->asDatetime($model->submit_datetime . 'Europe/Berlin ');
                            },
                            'label' =>'Application Date'
                        ],
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                     'header' => 'Action',
                                     'template' => '{update}',
                                     'buttons' => [
                                             'update' => function($url,$model, $key){
                                                        return \yii\helpers\Html::a('offer this student',\yii\helpers\Url::to
                                                 (['/administrator/default/offer-student','application_id'=> $model->id]));
                                             }
                                     ]
                            ]
                        ]

                    ]);


                    ?>
                </div>
            </div>
        </div>

    </div>

</div>
