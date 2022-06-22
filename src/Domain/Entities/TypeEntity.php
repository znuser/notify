<?php

namespace ZnUser\Notify\Domain\Entities;

use Illuminate\Support\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use ZnCore\Domain\Entity\Interfaces\EntityIdInterface;
use ZnCore\Base\Libs\Validation\Interfaces\ValidationByMetadataInterface;

class TypeEntity implements ValidationByMetadataInterface, EntityIdInterface
{

    private $id = null;

    private $name = null;

    private $color = null;

    private $icon = null;

    private $i18n = null;

    private $transports = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank);
        $metadata->addPropertyConstraint('color', new Assert\NotBlank);
        $metadata->addPropertyConstraint('icon', new Assert\NotBlank);
    }

    public function setId($value): void
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($value): void
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setColor($value): void
    {
        $this->color = $value;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setIcon($value): void
    {
        $this->icon = $value;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @return Collection|null|TypeI18nEntity[]
     */
    public function getI18n(): ?Collection
    {
        return $this->i18n;
    }

    public function setI18n(Collection $i18n): void
    {
        $this->i18n = $i18n;
    }

    /**
     * @return Collection|null|TransportEntity
     */
    public function getTransports(): ?Collection
    {
        return $this->transports;
    }

    public function setTransports(Collection $transports): void
    {
        $this->transports = $transports;
    }
}
