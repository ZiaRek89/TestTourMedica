<?php

namespace My\TestBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PESEL extends Constraint
{
    public $message = 'Nieprawidłowy numer PESEL';
}
