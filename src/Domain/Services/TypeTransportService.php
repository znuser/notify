<?php

namespace ZnUser\Notify\Domain\Services;

use ZnUser\Notify\Domain\Interfaces\Services\TypeTransportServiceInterface;
use ZnCore\Domain\Interfaces\Libs\EntityManagerInterface;
use ZnCore\Domain\Base\BaseCrudService;
use ZnUser\Notify\Domain\Entities\TypeTransportEntity;

class TypeTransportService extends BaseCrudService implements TypeTransportServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return TypeTransportEntity::class;
    }


}

