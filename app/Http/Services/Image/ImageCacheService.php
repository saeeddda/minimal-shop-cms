<?php

namespace App\Http\Services\Image;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

class ImageCacheService{
    public function cache($imagePath, $size = ''){
        //set image size
        $imageSizes = Config::get('cache-image-sizes');

        if(!isset($imageSizes[$size])){
            $size = Config::get('default-current-cache-image');
        }

        $width = $imageSizes[$size]['width'];
        $height = $imageSizes[$size]['height'];

        //cache image
        if(file_exists($imagePath)){
            $img = Image::cache(function($image) use($imagePath, $width, $height){
                return $image->make($imagePath)->fit($width, $height);
            }, Config::get('image-cache-lifetime'), true);
            return $img->response();
        }else{
            $img = Image::canvas($width, $height, '#cdcdcd')
                ->text('404 - Image not found!', $width / 2, $height /2, function($font){
                    $font->color('#333333');
                    $font->align('center');
                    $font->valign('center');
                    $font->font(public_path('admin-assets/fonts/ttf/IRANYekanWebRegular.ttf'));
                    $font->size(24);
                });
            return $img->response();
        }
    }
}