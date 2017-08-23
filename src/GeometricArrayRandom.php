<?php

namespace OutCloud\GeometricArrayRandom;

use OutCloud\GeometricArrayRandom\Exception\EachValueHasToHaveProbabilityException;
use OutCloud\GeometricArrayRandom\Exception\InvalidProbabilitySumException;
use OutCloud\GeometricArrayRandom\Exception\ProbabilityOutOfScopeException;
use OutCloud\GeometricArrayRandom\Exception\UnrecognizedModeException;

/**
 * Class GeometricRandom
 * @author Grzegorz Lieske <grzesiu.lieske@gmail.com>
 */
class GeometricArrayRandom
{
    public const MODE_VALUE_AND_PROBABILITY_TOGETHER = 1;
    public const MODE_TWO_DIMENSIONS = 2;
    private const MODE_TWO_DIMENSIONS_VALUES_INDEX = 0;
    private const MODE_TWO_DIMENSIONS_PROBABILITIES_INDEX = 1;
    private const EPSILON = 0.00001;
    /** @var  array */
    private $matrix;
    /** @var  array */
    private $cumulatedMatrix;

    /**
     * GeometricGenerator constructor.
     * @param array $matrix
     * @param int $mode
     * @throws \OutCloud\GeometricArrayRandom\Exception\UnrecognizedModeException
     * @throws \OutCloud\GeometricArrayRandom\Exception\EachValueHasToHaveProbabilityException
     * @throws \OutCloud\GeometricArrayRandom\Exception\InvalidProbabilitySumException
     * @throws \OutCloud\GeometricArrayRandom\Exception\ProbabilityOutOfScopeException
     */
    public function __construct(array $matrix, int $mode = self::MODE_VALUE_AND_PROBABILITY_TOGETHER)
    {
        switch ($mode) {
            case self::MODE_TWO_DIMENSIONS:
                $this->generateTogetherModeMatrix($matrix);
                break;
            case self::MODE_VALUE_AND_PROBABILITY_TOGETHER:
                $this->matrix = $matrix;
                break;
            default:
                throw new UnrecognizedModeException();
        }
        $this->cumulate();
    }

    /**
     * This method converts input of mode with two dimensions to mode with value, probability pairs
     * @param array $matrix
     * @throws \OutCloud\GeometricArrayRandom\Exception\EachValueHasToHaveProbabilityException
     */
    private function generateTogetherModeMatrix(array $matrix): void
    {
        $countValues = count($matrix[self::MODE_TWO_DIMENSIONS_VALUES_INDEX]);
        $countProbability = count($matrix[self::MODE_TWO_DIMENSIONS_PROBABILITIES_INDEX]);
        if ($countValues !== $countProbability) {
            throw new EachValueHasToHaveProbabilityException();
        }
        for ($i = 0; $i < $countValues; $i++) {
            $this->matrix [] = [
                $matrix[self::MODE_TWO_DIMENSIONS_VALUES_INDEX][$i],
                $matrix[self::MODE_TWO_DIMENSIONS_PROBABILITIES_INDEX][$i],
            ];
        }
    }

    /**
     * This method cumulates probabilities.
     * @throws \OutCloud\GeometricArrayRandom\Exception\ProbabilityOutOfScopeException
     * @throws \OutCloud\GeometricArrayRandom\Exception\InvalidProbabilitySumException
     */
    private function cumulate(): void
    {
        $probabilitySum = 0;
        foreach ($this->matrix as [$value, $probability]) {
            if ($probability < 0 || $probability > 1 + self::EPSILON) {
                throw new ProbabilityOutOfScopeException();
            }
            $probabilitySum += $probability;
            if ($probability > 0) {
                $this->cumulatedMatrix [] = [$value, $probabilitySum];
            }
        }

        if (!$this->same_float($probabilitySum, 1.0)) {
            throw new InvalidProbabilitySumException();
        }
    }

    /**
     * this method compares two floats with given prexision.
     * @param float $a
     * @param float $b
     * @param float $epsilon
     * @return bool
     */
    private function same_float(float $a, float $b, float $epsilon = self::EPSILON)
    {
        return abs($a - $b) < $epsilon;
    }

    /**
     * This method returns N next random values
     * @param int $n
     * @return array
     * @throws \LogicException
     */
    public function nextNValues(int $n = 1): array
    {
        for ($i = 0; $i < $n; $i++) {
            $randomValues [] = $this->nextValue();
        }

        return $randomValues ?? [];
    }

    /**
     * @return mixed
     * @throws \LogicException
     */
    public function nextValue()
    {
        $rand = (float)mt_rand() / (float)mt_getrandmax();

        foreach ($this->cumulatedMatrix as [$value, $range]) {
            if ($rand <= $range) {
                return $value;
            }
        }

        throw new \LogicException('This should not happen.');
    }
}
