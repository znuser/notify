<?php

namespace ZnUser\Notify\Domain\Services;

use ZnCore\Entity\Interfaces\EntityIdInterface;
use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Enums\NotifyStatusEnum;
use ZnUser\Notify\Domain\Interfaces\Services\MyHistoryServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnCore\Entity\Exceptions\NotFoundException;
use ZnCore\Service\Base\BaseCrudService;
use ZnCore\Query\Entities\Where;
use ZnCore\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Query\Entities\Query;

class MyHistoryService extends BaseCrudService implements MyHistoryServiceInterface
{

//    use SoftDeleteTrait;
//    use SoftRestoreTrait;

    private $authService;

    public function __construct(
        EntityManagerInterface $em,
//        HistoryRepositoryInterface $repository,
        AuthServiceInterface $authService
    )
    {
        $this->setEntityManager($em);
        $repository = $this->getEntityManager()->getRepository(NotifyEntity::class);
        $this->setRepository($repository);

        $this->authService = $authService;
    }

    public function clearMyMessages()
    {
        $myIdentity = $this->authService->getIdentity();
        $this->getRepository()->deleteByCondition(['recipient_id' => $myIdentity->getId()]);
    }

    public function findOneById($id, Query $query = null): EntityIdInterface
    {
        $this->seenById($id);
        return parent::findOneById($id, $query);
    }

    public function seenById(int $id)
    {
        $myIdentity = $this->authService->getIdentity();
        $query = new Query();
        $query->whereNew(new Where('recipient_id', $myIdentity->getId()));
        $query->whereNew(new Where('status_id', NotifyStatusEnum::NEW));
        $query->whereNew(new Where('id', $id));
        try {
            /** @var NotifyEntity $entity */
//            $entity = $this->getRepository()->findOne($query);
            $entity = $this->getEntityManager()->getRepository(NotifyEntity::class)->findOne($query);
        } catch (NotFoundException $e) {
            return;
        }
        $entity->seen();
        $this->getEntityManager()->persist($entity);
    }

    public function readAll()
    {
        $myIdentity = $this->authService->getIdentity();
        $query = new Query();
        $query->whereNew(new Where('recipient_id', $myIdentity->getId()));
        $query->whereNew(new Where('status_id', NotifyStatusEnum::NEW));
        $this->getRepository()->updateByQuery($query, [
            'status_id' => NotifyStatusEnum::SEEN,
        ]);
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $myIdentity = $this->authService->getIdentity();
        $query->whereNew(new Where('recipient_id', $myIdentity->getId()));
        return $query;
    }
}
