<?php

namespace App\Http\Controllers;

use App\Actions\ImageDecorator;
use App\ColorMap\WatermarkMap;
use App\Decorators\WaterMark;
use App\Http\Requests\ImageRequest;

class ImageController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @param ImageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function download(ImageRequest $request)
    {
        try {
            $action = new ImageDecorator($request->file('image'));

            $hsv = $action->mainColor()->convertToHsv()->getHsv();

            $decor = new WaterMark($request->file('image'), new WatermarkMap($hsv));

            $image = $decor->addMarkToImage()->save();
        } catch (\Throwable $e) {
            return back()->withErrors(['image' => 'Incorrect image']);
        }

        return view('welcome', compact('image'));
    }
}
