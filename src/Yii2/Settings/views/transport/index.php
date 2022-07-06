<?php

/**
 * @var View $this
 * @var \ZnCore\Collection\Interfaces\Enumerable | TypeEntity[] $typeCollection
 * @var \ZnCore\Collection\Interfaces\Enumerable | ContactTypeEntity[] $contactTypeCollection
 */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use ZnBundle\Person\Domain\Entities\ContactTypeEntity;
use ZnLib\I18Next\Facades\I18Next;
use ZnUser\Notify\Domain\Entities\TypeEntity;

$this->title = I18Next::t('user.notify', 'transport.title');

?>

<?php $form = ActiveForm::begin() ?>

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>
            Name
        </th>
        <?php foreach ($contactTypeCollection as $contactTypeEntity): ?>
            <th>
                <?= $contactTypeEntity->getTitle() ?>
            </th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($typeCollection as $typeEntity): ?>
        <tr>
            <td>
                <?= $typeEntity->getI18n()->first()->getSubject() ?>
            </td>
            <?php foreach ($contactTypeCollection as $contactTypeEntity):
                $notifyTypeId = $typeEntity->getId();
                $contactTypeId = $contactTypeEntity->getId();
                $fieldName = $notifyTypeId . '[' . $contactTypeId . ']';
                ?>
                <td>
                    <div class="float-left">
                        <?= Html::activeCheckbox($model, $fieldName, ['class' => 'form-control', 'label' => false]); ?>
                    </div>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<?= Html::submitButton(I18Next::t('core', 'action.save'), ['class' => 'btn btn-success']) ?>

<?php ActiveForm::end() ?>
