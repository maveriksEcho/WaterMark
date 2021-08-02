<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="antialiased">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1>Add watermark to image</h1>
            </div>
            <div class="col-sm-12">
                <form action="{{ route('download') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Add image</label>
                        <input type="file" class="form-control-file" name="image">


                    </div>

                    <button class="btn btn-primary">Download</button>
                </form>
            </div>
            <div class="col-sm-12">
                @isset($image)
                    <img src="{{ $image->getImageUrl() }}" width="500" height="500" alt="image" class="ounded mx-auto d-block">
                @endisset
            </div>
        </div>
    </div>

    @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    </body>
</html>
