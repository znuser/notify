<?php

namespace ZnUser\Notify\Domain\Interfaces\Services;

use Illuminate\Support\Collection;
use ZnUser\Notify\Domain\Entities\SettingEntity;

interface SettingServiceInterface
{

    /**
     * @param int $userId
     * @param int $typeId
     * @return Collection | SettingEntity[]
     */
    public function allByUserAndType(int $userId, int $typeId): Collection;

    /**
     * @param int $userId
     * @return Collection | SettingEntity[]
     */
//    public function allByUserId(int $userId): Collection;
}

