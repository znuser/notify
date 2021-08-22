<?php

/**
 * @var View $this
 * @var Request $request
 * @var HistoryForm $model
 */

use ZnUser\Notify\Yii2\Admin\Forms\HistoryForm;
use yii\helpers\Html;
use yii\web\Request;
use yii\web\View;
use yii\widgets\ActiveForm;
use ZnCore\Base\Libs\I18Next\Facades\I18Next;
use ZnYii\Web\Widgets\CancelButton\CancelButtonWidget;

?>

<div class="row">

    <div class="col-lg-12">

        <?php $form = ActiveForm::begin(['id' => 'historyform']) ?>

        <div class="form-row">
            <div class="form-group col-md-12">
                <?= Html::activeLabel($model, 'title'); ?>
                <?= Html::activeTextInput($model, 'title', ['class' => 'form-control']); ?>
                <?= Html::error($model, 'title', ['class' => 'text-danger']); ?>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <?= Html::activeLabel($model, 'description'); ?>
                <?= Html::activeTextarea($model, 'description', ['class' => 'form-control']); ?>
                <?= Html::error($model, 'description', ['class' => 'text-danger']); ?>
            </div>
        </div>

        <?= Html::submitButton(I18Next::t('core', 'action.save'), ['class' => 'btn btn-success']) ?>

        <?= CancelButtonWidget::widget() ?>

        <?php ActiveForm::end() ?>

    </div>

</div>
