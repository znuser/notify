<?php

namespace ZnUser\Notify\Yii2\Widgets;

use ZnUser\Notify\Domain\Enums\NotifyStatusEnum;
use ZnUser\Notify\Domain\Interfaces\Services\MyHistoryServiceInterface;
use ZnCore\Domain\Query\Entities\Where;
use ZnCore\Domain\Query\Entities\Query;
use ZnLib\Web\Components\Widget\Base\BaseWidget2;

class NotifyMenuWidget extends BaseWidget2
{

    public $myHistoryService;

    public function __construct(MyHistoryServiceInterface $myHistoryService, $config = [])
    {
        $this->myHistoryService = $myHistoryService;
    }

    public function run(): string
    {
        $query = new Query();
        $query->whereNew(new Where('status_id', NotifyStatusEnum::NEW));
        $dataProvider = $this->myHistoryService->getDataProvider($query);
        return $this->render('index', [
            'countMyHistory' => $dataProvider->getTotalCount(),
            'dataProvider' => $dataProvider,
        ]);
    }
}
