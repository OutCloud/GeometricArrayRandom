<?php

namespace OutCloud\GeometricArrayRandom\Exception;

/**
 * Class InvalidProbabilitySumException
 * @package OutCloud\GeometricRandom\Exception
 */
class EachValueHasToHaveProbabilityException extends \InvalidArgumentException
{
    /**
     * InvalidProbabilitySumException constructor.
     */
    public function __construct()
    {
        parent::__construct('Each value has to have probability assigned.');
    }
}

