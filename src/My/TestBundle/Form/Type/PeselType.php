<?php

namespace My\TestBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class PeselType extends AbstractType
{
    public function getParent()
    {
        return 'text';
    }

    public function getName()
    {
        return 'pesel';
    }
}
