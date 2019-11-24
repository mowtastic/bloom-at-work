<?php

namespace BloomAtWork\Model;

/**
 * Class Question
 *
 * @package BloomAtWork\Model
 */
class Question extends AbstractQuestion
{
    /**
     * @var float $max
     */
    private $max;

    /**
     * @var float $min
     */
    private $min;

    /**
     * @var float $mean
     */
    private $mean;

    /**
     * Question constructor.
     *
     * @param string $label
     * @param float  $max
     * @param float  $min
     * @param float  $mean
     */
    public function __construct(string $label, float $max, float $min, float $mean)
    {
        parent::__construct($label);
        $this->max = $max;
        $this->min = $min;
        $this->mean = $mean;
    }

    public function getMax(): float
    {
        return $this->max;
    }

    public function getMin(): float
    {
        return $this->min;
    }

    public function getMean(): float
    {
        return $this->mean;
    }
}