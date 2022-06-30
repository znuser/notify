<?php

namespace ZnUser\Notify\Domain\Interfaces\Services;

use ZnCore\Domain\Service\Interfaces\CrudServiceInterface;
use ZnUser\Notify\Domain\Entities\TypeEntity;

interface TypeServiceInterface extends CrudServiceInterface
{

    //public function oneByIdWithI18n(int $id): TypeEntity;
    public function findOneByName(string $name): TypeEntity;
}

