<?php

namespace OutCloud\GeometricArrayRandom\Exception;

/**
 * Class InvalidProbabilitySumException
 * @package OutCloud\GeometricRandom\Exception
 */
class UnrecognizedModeException extends \InvalidArgumentException
{
    /**
     * InvalidProbabilitySumException constructor.
     */
    public function __construct()
    {
        parent::__construct('Mode you declared is invalid');
    }
}

