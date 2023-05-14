<?php

use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info/{id}.jpg', function ($id) {
    $img = (new ImageManager( 'gd' ))->create(200, 50);
    $img->drawRectangle(0, 0, function ($rectangle) {
        $rectangle->size(300, 200);
        $rectangle->background('#ffffff'); 
    });

    $img->text("Attendee ID: $id", 10, 10, function($font) {
        $font->filename( resource_path('fonts/Roboto-Regular.ttf') );
        $font->color('#000000');
        $font->size(14);
        $font->align('left');
        $font->valign('middle');
    });

    $img->text("Booth: B", 10, 36, function($font) {
        $font->filename( resource_path('fonts/Roboto-Regular.ttf') );
        $font->color('#41770e');
        $font->size(20);
        $font->align('left');
        $font->valign('left');
    });

    return response( $img->toJpeg( 100 ) )
        ->header('Content-Type', 'image/jpeg');
});