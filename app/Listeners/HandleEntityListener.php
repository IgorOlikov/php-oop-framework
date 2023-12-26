<?php

namespace App\Listeners;

use Framework\Dbal\Entity;
use Framework\Dbal\Event\EntityPersist;

class HandleEntityListener
{
    public function __invoke(EntityPersist $event)
    {
      // dd($event->getEntity());
    }

}