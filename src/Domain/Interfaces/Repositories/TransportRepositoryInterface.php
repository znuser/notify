<?php

namespace ZnUser\Notify\Domain\Interfaces\Repositories;

use ZnCore\Domain\Collection\Interfaces\Enumerable;
use ZnCore\Domain\Collection\Libs\Collection;
use ZnCore\Domain\Repository\Interfaces\CrudRepositoryInterface;
use ZnUser\Notify\Domain\Entities\TransportEntity;

interface TransportRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param int $typeId
     * @return Enumerable|array|TransportEntity[]
     */
    public function allEnabledByTypeId(int $typeId): Enumerable;
}
