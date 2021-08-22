<?php

namespace ZnUser\Notify\Domain\Interfaces\Services;

use ZnCore\Domain\Interfaces\Service\CrudServiceInterface;
use ZnUser\Notify\Domain\Entities\TypeEntity;

interface TypeServiceInterface extends CrudServiceInterface
{

    //public function oneByIdWithI18n(int $id): TypeEntity;
    public function oneByName(string $name): TypeEntity;
}

