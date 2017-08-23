<?php

namespace OutCloud\GeometricArrayRandom\Exception;

/**
 * Class InvalidProbabilitySumException
 * @package OutCloud\GeometricRandom\Exception
 */
class ProbabilityOutOfScopeException extends \InvalidArgumentException
{
    /**
     * InvalidProbabilitySumException constructor.
     */
    public function __construct()
    {
        parent::__construct('Probability has to be greater or equal 0 and lower or equal 1 (0%-100%).');
    }
}

