<?php

namespace App\Colors;

use App\Exceptions\IncorrectColorException;

class Hsv
{
    public const RED = 'red';
    public const BLUE = 'blue';
    public const GREEN = 'green';

    /**
     * @var int
     */
    protected $hue;

    /**
     * Hsv constructor.
     * @param int $hue
     */
    public function __construct(int $hue)
    {
        $this->hue = $hue;
    }

    /**
     * @return string
     * @throws IncorrectColorException
     */
    public function toString(): string
    {
        if ($this->getHue() > 320 || $this->getHue() <= 60) {
            return self::RED;
        } elseif ($this->getHue() > 190 && $this->getHue() <= 260) {
            return self::BLUE;
        } elseif ($this->getHue() > 70 && $this->getHue() <= 175) {
            return self::GREEN;
        } else {
            throw new IncorrectColorException();
        }
    }

    /**
     * @return int
     */
    public function getHue(): int
    {
        return $this->hue;
    }
}
