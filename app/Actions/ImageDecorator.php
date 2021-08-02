<?php

namespace App\Actions;

use App\Colors\Rgb;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageDecorator
{
    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * ImageDecorator constructor.
     * @param UploadedFile $file
     */
    public function __construct(UploadedFile $file)
    {
        $this->file = $file;
    }

    /**
     * @return Rgb
     * @throws \Exception
     */
    public function mainColor(): Rgb
    {
        $image = $this->imageCreator();
        $width = ImageSX($image);
        $height = ImageSY($image);
        $square = $width * $height;

        $totalR = 0;
        $totalG = 0;
        $totalB = 0;

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = ImageColorAt($image, $x, $y);
                $totalR += ($rgb >> 16) & 0xFF;
                $totalG += ($rgb >> 8) & 0xFF;
                $totalB += $rgb & 0xFF;
            }
        }

        ImageDestroy($image);

        return new Rgb(round($totalR / $square), round($totalG / $square), round($totalB / $square));
    }

    /**
     * @return resource
     * @throws \Exception
     */
    public function imageCreator()
    {
        $ext = $this->file->getClientOriginalExtension();
        switch ($ext) {
            case 'jpg':
                return imagecreatefromjpeg($this->file);
            case 'png':
                return imagecreatefrompng($this->file);
            default:
                throw new \Exception();
        }
    }
}
