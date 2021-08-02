<?php

namespace App\ColorMap;

use App\Colors\Hsv;
use App\Exceptions\IncorrectColorException;
use Illuminate\Support\Arr;

class WatermarkMap
{
    public const BLACK = 'black';
    public const RED = 'red';
    public const YELLOW = 'yellow';
    /**
     * @var Hsv
     */
    protected $hsv;

    /**
     * @var string
     */
    protected $path;

    /**
     * WatermarkMap constructor.
     * @param Hsv $hsv
     */
    public function __construct(Hsv $hsv)
    {
        $this->hsv = $hsv;
        $this->path = storage_path('app/public/watermarks/');
    }

    /**
     * @return array|\ArrayAccess|mixed
     * @throws IncorrectColorException
     */
    public function getPath()
    {
        return Arr::get($this->getMap(), $this->getHsv()->toString());
    }

    /**
     * @return array
     */
    public function getMap(): array
    {
        return [
            Hsv::RED => $this->path() . self::BLACK . '.jpg',
            Hsv::BLUE => $this->path() . self::YELLOW . '.jpg',
            Hsv::GREEN => $this->path() . self::RED . '.jpg',
        ];
    }

    /**
     * @return string
     */
    private function path(): string
    {
        return $this->path;
    }

    /**
     * @return Hsv
     */
    public function getHsv(): Hsv
    {
        return $this->hsv;
    }
}
