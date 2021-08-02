<?php

namespace App\Files;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Image;

class ImageFile
{
    /**
     * @var
     */
    protected $image;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $name;

    public function __construct(Image $image)
    {
        $this->image = $image;
        $this->name = Str::random() . '.jpg';
        $this->path = Storage::disK('public')->path('images/' . $this->name);
    }

    public function getImageUrl()
    {
        return url('storage/images/' . $this->name);
    }

    /**
     * @return $this
     */
    public function save(): self
    {
        $this->getImage()->save($this->getPath());

        return $this;
    }

    /**
     * @return Image
     */
    private function getImage(): Image
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
}
