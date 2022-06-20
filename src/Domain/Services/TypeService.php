<?php

namespace ZnUser\Notify\Domain\Services;

use ZnCore\Domain\Base\BaseCrudService;
use ZnCore\Base\Libs\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Domain\Libs\Query;
use ZnUser\Notify\Domain\Entities\TypeEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Services\TransportServiceInterface;
use ZnUser\Notify\Domain\Interfaces\Services\TypeServiceInterface;

class TypeService extends BaseCrudService implements TypeServiceInterface
{

    private $transportService;

    public function __construct(EntityManagerInterface $em, TypeRepositoryInterface $repository, TransportServiceInterface $transportService)
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
        $this->transportService = $transportService;
    }

//    public function oneByIdWithI18n(int $id): TypeEntity
//    {
//        $query = new Query();
//        $query->with(['i18n']);
//        /** @var TypeEntity $typeEntity */
//        $typeEntity = $this->getEntityManager()->oneById(TypeEntity::class, $id, $query);
//        //$transportCollection = $this->transportService->allByTypeId($id);
//        //$typeEntity->setTransports($transportCollection);
//        return $typeEntity;
//    }

    public function oneByName(string $name): TypeEntity
    {
        $query = new Query();
        $query->where('name', $name);
        //$query->with('i18n');
        /** @var TypeEntity $typeEntity */
        $typeEntity = $this->getEntityManager()->one(TypeEntity::class, $query);
        return $typeEntity;
    }
}
