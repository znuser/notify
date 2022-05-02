<?php

namespace ZnUser\Notify\Domain\Services;

use ZnUser\Notify\Domain\Entities\ActivityEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\ActivityRepositoryInterface;
use ZnUser\Notify\Domain\Interfaces\Services\ActivityServiceInterface;
use ZnBundle\User\Domain\Interfaces\Services\AuthServiceInterface;
use ZnCore\Domain\Base\BaseCrudService;
use ZnCore\Domain\Exceptions\UnprocessibleEntityException;
use ZnCore\Domain\Helpers\EntityHelper;
use ZnCore\Contract\Domain\Interfaces\Entities\EntityIdInterface;

class ActivityService extends BaseCrudService implements ActivityServiceInterface
{

    private $authService;

    public function __construct(ActivityRepositoryInterface $repository, AuthServiceInterface $authService)
    {
        $this->setRepository($repository);
        $this->authService = $authService;
    }

    public function addEntity(EntityIdInterface $entity, string $action)
    {
        $this->add(get_class($entity), $entity->getId(), $action, [
            'entity' => EntityHelper::toArray($entity),
        ]);
    }

    public function add(string $entityName, $entityId, string $action, array $attributes = [])
    {
        $entity = new ActivityEntity();
        $entity->setTypeId(1);
        $entity->setEntityName($entityName);
        $entity->setEntityId($entityId);
        $entity->setAction($action);
        $entity->setAttributes(json_encode($attributes));
        $entity->setUserId($this->authService->getIdentity()->getId());
        try {
            $this->getRepository()->create($entity);
        } catch (UnprocessibleEntityException $e) {
            dd($e->getErrorCollection());
        }
    }
}
