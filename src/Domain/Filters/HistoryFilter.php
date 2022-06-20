<?php

namespace ZnUser\Notify\Domain\Filters;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnCore\Domain\Constraints\Enum;
use ZnCore\Base\Libs\Validation\Interfaces\ValidationByMetadataInterface;
use ZnSandbox\Sandbox\Status\Domain\Enums\StatusEnum;

class HistoryFilter implements ValidationByMetadataInterface
{

    protected $statusId = StatusEnum::ENABLED;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
    }

    public function setStatusId(int $value): void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }
}
