<?php

namespace ZnUser\Notify\Domain\Interfaces\Repositories;

use Illuminate\Support\Collection;
use ZnCore\Base\Libs\Repository\Interfaces\CrudRepositoryInterface;
use ZnUser\Notify\Domain\Entities\TransportEntity;

interface TransportRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $typeId
     * @return Collection|array|TransportEntity[]
     */
    public function allEnabledByTypeId(int $typeId): Collection;
}
