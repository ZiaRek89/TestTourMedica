<?php

namespace My\TestBundle\EventListener;  

use My\TestBundle\Event\UppercaseEvent; 
 
class UpListener
{
 
    public function up(UppercaseEvent $event) {
 
            $event->setUp(); 
    }
}