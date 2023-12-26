<?php

namespace Framework\Dbal\Event;

use Framework\Dbal\Entity;
use Framework\Event\Event;

class EntityPersist extends Event
{

    public function __construct(
        private Entity $entity
    )
    {

    }

    /**
     * @return Entity
     */
    public function getEntity(): Entity
    {
        return $this->entity;
    }

}