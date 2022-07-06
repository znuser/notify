<?php

namespace ZnUser\Notify\Domain\Libs\ContactDrivers;

use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Interfaces\Libs\ContactDriverInterface;
use ZnCore\EntityManager\Interfaces\EntityManagerInterface;
use ZnCore\EntityManager\Traits\EntityManagerAwareTrait;

class WebDriver implements ContactDriverInterface
{

    use EntityManagerAwareTrait;

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