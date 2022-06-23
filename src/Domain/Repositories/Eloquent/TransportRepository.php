<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use Illuminate\Support\Collection;
use ZnCore\Base\Status\Enums\StatusEnum;
use ZnCore\Domain\Entity\Helpers\CollectionHelper;
use ZnCore\Domain\Entity\Helpers\EntityHelper;
use ZnCore\Domain\Query\Entities\Query;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnUser\Notify\Domain\Entities\TransportEntity;
use ZnUser\Notify\Domain\Entities\TypeTransportEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\TransportRepositoryInterface;

class TransportRepository extends BaseEloquentCrudRepository implements TransportRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_transport';
    }

    public function getEntityClass(): string
    {
        return TransportEntity::class;
    }

    public function allEnabledByTypeId(int $typeId): Collection
    {
        $query = new Query();
        $query->where('type_id', $typeId);
        $query->where('status_id', StatusEnum::ENABLED);
        $query->with('transport');
        $collectionVia = $this->getEntityManager()->getRepository(TypeTransportEntity::class)->all($query);
        $array = CollectionHelper::getColumn($collectionVia, 'transport');
        return new Collection($array);
    }
}
