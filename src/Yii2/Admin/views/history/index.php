<?php

/**
 * @var View $this
 * @var Request $request
 * @var \ZnCore\Collection\Interfaces\Enumerable | NotifyEntity[] $collection
 * @var DataProvider $dataProvider
 * @var ValidationByMetadataInterface $filterModel
 */

use yii\helpers\Url;
use yii\web\Request;
use yii\web\View;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\DataProvider\Libs\DataProvider;
use ZnLib\I18Next\Facades\I18Next;
use ZnLib\Web\TwBootstrap\Widgets\Pagination\PaginationWidget;
use ZnSandbox\Sandbox\Status\Web\Widgets\FilterWidget;
use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Enums\NotifyStatusEnum;

$this->title = I18Next::t('user.notify', 'history.list');
$collection = $dataProvider->getCollection();

$statusWidget = new FilterWidget(NotifyStatusEnum::class, $filterModel);

?>

<div class="row">

    <div class="col-lg-12">

        <div class="mb-3">
            <?= $statusWidget->run() ?>
        </div>

        <?php if (!$collection->isEmpty()): ?>

            <?php foreach ($collection as $entity): ?>
                <?= $this->render('_item', [
                    'entity' => $entity,
                ]) ?>
            <?php endforeach; ?>

            <div class="float-left">
                <?php if ($filterModel->getStatusId() == NotifyStatusEnum::NEW): ?>
                    <a class="btn btn-success" href="<?= Url::to(['/notify/history/read-all']) ?>" role="button"
                       data-method="post" data-confirm="<?= I18Next::t('web', 'message.clear_list') ?>">
                        <i class="fas fa-check-double"></i>
                        <?= I18Next::t('user.notify', 'history.action.read_all') ?>
                    </a>
                <?php elseif ($filterModel->getStatusId() == NotifyStatusEnum::SEEN): ?>
                    <a class="btn btn-danger" href="<?= Url::to(['/notify/history/clear-all']) ?>" role="button"
                       data-method="post" data-confirm="<?= I18Next::t('web', 'message.clear_list') ?>">
                        <i class="fa fa-trash"></i>
                        <?= I18Next::t('core', 'action.clear_all') ?>
                    </a>
                <?php endif; ?>
            </div>
            <?= PaginationWidget::widget(['dataProvider' => $dataProvider]) ?>

        <?php else: ?>
            <div class="alert alert-secondary" role="alert">
                <?= I18Next::t('web', 'message.empty_list') ?>
            </div>
        <?php endif; ?>

    </div>

</div>
