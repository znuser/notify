<?php

namespace ZnUser\Notify\Domain\Services;

use Illuminate\Support\Collection;
use ZnUser\Notify\Domain\Entities\SettingEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\SettingRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Services\SettingServiceInterface;
use ZnBundle\User\Domain\Interfaces\Services\AuthServiceInterface;
use ZnCore\Domain\Entity\Exceptions\NotFoundException;
use ZnCore\Domain\Query\Entities\Where;
use ZnCore\Domain\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\Domain\Query\Entities\Query;
use ZnCore\Domain\EntityManager\Traits\EntityManagerAwareTrait;

class SettingService /*extends BaseCrudService*/ implements SettingServiceInterface
{

    use EntityManagerAwareTrait;

    private $authService;

    public function __construct(EntityManagerInterface $em, SettingRepositoryInterface $repository, AuthServiceInterface $authService)
    {
        $this->setEntityManager($em);
//        $this->repository = $repository;
        $this->authService = $authService;
    }

    public function getEntityClass(): string
    {
        return SettingEntity::class;
    }

    protected function forgeQuery(Query $query = null)
    {
        $query = parent::forgeQuery($query);
        $userId = $this->authService->getIdentity()->getId();
        $query->whereNew(new Where('user_id', $userId));
        return $query;
    }

    public function getSettingsByUserId(int $userId): array {
        $data = [];
        $settingsCollection = $this->allByUserId($userId);
        foreach ($settingsCollection as $settingsEntity) {
            $data[$settingsEntity->getNotifyTypeId()][$settingsEntity->getContactTypeId()] = $settingsEntity->getIsEnabled();
        }
        return $data;
    }

    private function allByUserId(int $userId): Collection {
        $query = new Query();
        $query->whereNew(new Where('user_id', $userId));
        $query->with(['notifyType', 'contactType']);
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findAll($query);
    }

    public function allByUserAndType(int $userId, int $typeId): Collection {
        $query = new Query();
        $query->whereNew(new Where('user_id', $userId));
        $query->whereNew(new Where('notify_type_id', $typeId));
        $query->with(['notifyType', 'contactType']);
        return $this->getEntityManager()->getRepository($this->getEntityClass())->findAll($query);
    }

    public function getMySettings(): array {

        $userId = $this->authService->getIdentity()->getId();

        return $this->getSettingsByUserId($userId);
    }

    public function saveMySettings(array $data) {
        $userId = $this->authService->getIdentity()->getId();
        foreach ($data as $typeId => $typeData) {
            foreach ($typeData as $contactTypeId => $value) {
                try {
                    $query = new Query();
                    $query->whereNew(new Where('notify_type_id', $typeId));
                    $query->whereNew(new Where('contact_type_id', $contactTypeId));
                    $query->whereNew(new Where('user_id', $userId));
                    $settingEntity = $this->getEntityManager()->getRepository($this->getEntityClass())->one($query);
                } catch (NotFoundException $e) {
                    $settingEntity = new SettingEntity();
                    $settingEntity->setNotifyTypeId($typeId);
                    $settingEntity->setContactTypeId($contactTypeId);
                    $settingEntity->setUserId($userId);
                }
                $settingEntity->setIsEnabled(boolval($value));
                $this->getEntityManager()->persist($settingEntity);
            }
        }
    }
}
