<?php

namespace App\Decorators;

use App\ColorMap\WatermarkMap;
use App\Colors\Hsv;
use App\Files\ImageFile;
use Intervention\Image\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class WaterMark
{
    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var Hsv
     */
    protected $watermarkMap;

    /**
     * WaterMark constructor.
     * @param UploadedFile $file
     * @param WatermarkMap $watermarkMap
     */
    public function __construct(UploadedFile $file, WatermarkMap $watermarkMap)
    {
        $this->file = $file;
        $this->watermarkMap = $watermarkMap;
    }

    /**
     * @return ImageFile
     * @throws \App\Http\Exceptions\IncorrectColorException
     */
    public function addMarkToImage(): ImageFile
    {
        return new ImageFile($this->getImage()->insert($this->prepareMark(), 'center'));
    }

    /**
     * @return Image
     */
    public function getImage(): Image
    {
        return $this->getDriver()::make($this->getFile());
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return \Intervention\Image\Facades\Image::class;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): UploadedFile
    {
        return $this->file;
    }

    /**
     * @return Image
     * @throws \App\Http\Exceptions\IncorrectColorException
     */
    public function prepareMark(): Image
    {
        return $this->getDriver()::make($this->getWatermarkMap()->getPath())->opacity(70);
    }

    /**
     * @return WatermarkMap
     */
    public function getWatermarkMap(): WatermarkMap
    {
        return $this->watermarkMap;
    }
}
