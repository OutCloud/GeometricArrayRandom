<?php

namespace OutCloud\GeometricArrayRandom\Exception;

/**
 * Class InvalidProbabilitySumException
 * @package OutCloud\GeometricRandom\Exception
 */
class InvalidProbabilitySumException extends \InvalidArgumentException
{
    /**
     * InvalidProbabilitySumException constructor.
     */
    public function __construct()
    {
        parent::__construct('Sum of values\' probabilities has to be exact 1.0 (100%).');
    }
}

