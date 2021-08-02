<?php

namespace App\Colors;

class Rgb
{
    /**
     * @var int
     */
    protected $R;
    /**
     * @var int
     */
    protected $G;
    /**
     * @var int
     */
    protected $B;

    /**
     * Rgb constructor.
     * @param int|float $r
     * @param int|float $g
     * @param int|float $b
     */
    public function __construct($r, $g, $b)
    {
        $this->R = $r;
        $this->G = $g;
        $this->B = $b;
    }

    /**
     * @return $this
     */
    public function convertToHsv(): self
    {
        return new static(
            $this->getR() / 255,
            $this->getG() / 255,
            $this->getB() / 255
        );
    }

    /**
     * @return int|float
     */
    public function getR()
    {
        return $this->R;
    }

    /**
     * @return int|float
     */
    public function getG()
    {
        return $this->G;
    }

    /**
     * @return int|float
     */
    public function getB()
    {
        return $this->B;
    }

    /**
     * @return int[]
     */
    public function __toArray(): array
    {
        return [
            $this->getR(), $this->getG(), $this->getB()
        ];
    }

    /**
     * @return Hsv
     */
    public function getHsv(): Hsv
    {
        if ($this->delta() != 0) {
            if ($this->maxRgb() == $this->getR()) {
                $h = (($this->getR() - $this->getB()) / $this->delta());
            } elseif ($this->maxRgb() == $this->getG()) {
                $h = 2 + ($this->getB() - $this->getR()) / $this->delta();
            } else {
                $h = 4 + ($this->getR() - $this->getG()) / $this->delta();
            }
            $hue = round($h * 60);
            if ($hue < 0) {
                $hue += 360;
            }
        } else {
            $hue = 0;
        }

        return new Hsv($hue);
    }

    /**
     * @return float
     */
    public function delta(): float
    {
        return $this->maxRgb() - $this->minRgb();
    }

    /**
     * @return float
     */
    public function maxRgb(): float
    {
        return max((array)$this);
    }

    /**
     * @return float
     */
    public function minRgb(): float
    {
        return min((array)$this);
    }
}
