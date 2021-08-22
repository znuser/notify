<?php

namespace ZnUser\Notify\Domain\Libs\ContactDrivers;

use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Interfaces\Libs\ContactDriverInterface;
use ZnCore\Domain\Interfaces\Libs\EntityManagerInterface;
use ZnCore\Domain\Traits\EntityManagerTrait;

class WebDriver implements ContactDriverInterface
{

    use EntityManagerTrait;

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function send(NotifyEntity $notifyEntity)
    {
        $this->getEntityManager()->persist($notifyEntity);
    }
}