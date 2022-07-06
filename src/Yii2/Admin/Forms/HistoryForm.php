<?php

namespace ZnUser\Notify\Yii2\Admin\Forms;

use ZnCore\Entity\Helpers\CollectionHelper;
use ZnUser\Notify\Domain\Interfaces\Repositories\HistoryRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use ZnBundle\Reference\Domain\Interfaces\Services\ItemServiceInterface;
use ZnUser\Identity\Domain\Interfaces\Services\IdentityServiceInterface;
use ZnCore\Entity\Helpers\EntityHelper;
use ZnCore\Domain\Query\Entities\Query;
use ZnYii\Base\Forms\BaseForm;

class HistoryForm extends BaseForm
{

    public $history_id = null;
    public $entity_id = null;
    public $title = null;
    public $description = null;
//    public $status_id = null;

    private $identityService;
    private $itemService;
    private $entityService;
    private $typeRepository;
    private $historyRepository;

    public function __construct(
        $config = [],
        IdentityServiceInterface $identityService,
        ItemServiceInterface $itemService,
        EntityServiceInterface $entityService,
        TypeRepositoryInterface $typeRepository,
        HistoryRepositoryInterface $historyRepository
    )
    {
        parent::__construct($config);
        $this->identityService = $identityService;
        $this->itemService = $itemService;
        $this->entityService = $entityService;
        $this->typeRepository = $typeRepository;
        $this->historyRepository = $historyRepository;
    }

    public function i18NextConfig(): array
    {
        return [
            'bundle' => 'notify',
            'file' => 'history',
        ];
    }

    public function translateAliases(): array
    {
        return [
            'entity_id' => 'entity',
        ];
    }

    public function historyList(): array
    {
        $collection = $this->historyRepository->findAll();
        return CollectionHelper::toArray($collection);
    }

    public function typeList(): array
    {
        $collection = $this->typeRepository->findAll();
        return CollectionHelper::toArray($collection);
    }

    public function entityList(): array
    {
        $query = new Query();
        $collection = $this->entityService->findAll($query);
        return CollectionHelper::toArray($collection);
    }
}