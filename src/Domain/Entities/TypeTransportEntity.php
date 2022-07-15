<?php

namespace ZnUser\Notify\Domain\Entities;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnDomain\Сomponents\Constraints\Enum;
use ZnDomain\Validator\Interfaces\ValidationByMetadataInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class TypeTransportEntity implements ValidationByMetadataInterface, UniqueInterface, EntityIdInterface
{

    private $id = null;

    private $typeId = null;

    private $transportId = null;

    private $statusId = StatusEnum::ENABLED;

    private $transport = null;

    private $type = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('id', new Assert\NotBlank);
        $metadata->addPropertyConstraint('typeId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('transportId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Assert\NotBlank);
        $metadata->addPropertyConstraint('statusId', new Enum([
            'class' => StatusEnum::class,
        ]));
    }

    public function unique() : array
    {
        return [];
    }

    public function setId($value) : void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTypeId($value) : void
    {
        $this->typeId = $value;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setTransportId($value) : void
    {
        $this->transportId = $value;
    }

    public function getTransportId()
    {
        return $this->transportId;
    }

    public function setStatusId($value) : void
    {
        $this->statusId = $value;
    }

    public function getStatusId()
    {
        return $this->statusId;
    }

    public function getTransport(): ?TransportEntity
    {
        return $this->transport;
    }

    public function setTransport(TransportEntity $transport): void
    {
        $this->transport = $transport;
    }

    public function getType(): ?TypeEntity
    {
        return $this->type;
    }

    public function setType(TypeEntity $type): void
    {
        $this->type = $type;
    }
}
