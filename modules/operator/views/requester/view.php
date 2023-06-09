<?php

use app\modules\operator\models\Profile;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\operator\models\Requester */

$this->title = $model->document_number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requesters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="requester-view">
    <?php if ($model->request_by == Yii::$app->user->identity->profile->user_id) { ?>
        <p>
            <?= Html::a('<i class="fas fa-chevron-left"></i> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('<i class="fas fa-edit"></i> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php } else { ?>
        <p>
            <?= Html::a('<span class="fas fa-chevron-left"></span> ' . Yii::t('app', 'Go Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php } ?>


    <div class="actions-form">
        <div class="box box-info box-solid">
            <div class="box-header">
                <div class="box-title"><?= $this->title ?></div>
            </div>
            <div class="box-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th style="width: 250px;">{label}</th><td> {value}</td></tr>',
                    'attributes' => [

                        
                        [
                            'attribute' => 'status.status_name',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->status->color
                                    . ';"><b>'
                                    . $model->status->status_details
                                    . '</b></span>';
                            },
                        ],

                        [
                            'attribute' => 'document_number',
                            'format' => 'html',
                            // 'value' => $model->document_number,
                            'value' => function ($model) {
                                return '<span style="color:'
                                    . $model->status->color
                                    . ';"><b>' . $model->document_number . ' Rev. ' . $model->latest_rev . '</b></span>';
                            },
                        ],

                        [
                            'attribute' => 'types_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->types->color
                                    . ';"><b>'
                                    . $model->types->type_details
                                    . '</b></span>';
                            },
                        ],

                        'type_details:ntext',

                        [
                            'attribute' => 'request_by',
                            'format' => 'html',
                            'value' => $model->requestBy->profile->name,
                        ],

                        [
                            'attribute' => 'categories_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->categories->color . ';"><b>'
                                    . $model->categories->category_code
                                    . ' </b></span> - '
                                    . $model->categories->category_details;
                            },
                        ],
                        [
                            'attribute' => 'departments_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<span class="badge" style="background-color:'
                                    . $model->departments->color . ';"><b>'
                                    . $model->departments->department_code
                                    . '</b></span> - '
                                    . $model->departments->department_details;
                            },

                        ],
                        'document_title',
                        'details:ntext',
                        'document_age',
                        'document_public_at:date',
                        // 'created_at:date',
                        
                        [
                            'attribute' => 'covenant',
                            'format' => 'html',
                            'value' => $model->listDownloadFiles('covenant')
                        ],
                        [
                            'attribute' => 'docs',
                            'format' => 'html',
                            'value' => $model->listDownloadFiles('docs')
                        ],

                        'created_at:date',
                        [
                            'attribute' => 'created_by',
                            'format' => 'html',
                            'value' => $model->createdBy->profile->name,

                        ],
                        'updated_at:date',

                        [
                            'attribute' => 'updated_by',
                            'format' => 'html',
                            'value' => $model->updatedBy->profile->name,
                        ],
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>