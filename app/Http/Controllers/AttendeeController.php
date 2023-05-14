<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class AttendeeController extends Controller
{
    public function boothInfo( Attendee $attendee ) {
        $img = (new ImageManager( 'gd' ))->create(200, 50);
        
        $img->drawRectangle(0, 0, function ($rectangle) {
            $rectangle->size(300, 200);
            $rectangle->background('#ffffff'); 
        });

        $img->text("Attendee ID: $attendee->id", 10, 15, function($font) {
            $font->filename( resource_path('fonts/Roboto-Regular.ttf') );
            $font->color('#000000');
            $font->size(14);
            $font->align('left');
            $font->valign('middle');
        });

        $img->text("Booth: $attendee->Booth", 10, 40, function($font) {
            $font->filename( resource_path('fonts/Roboto-Regular.ttf') );
            $font->color('#41770e');
            $font->size(20);
            $font->align('left');
            $font->valign('left');
        });

        return response( $img->toJpeg( 100 ) )
            ->header('Content-Type', 'image/jpeg')
            ->header('Cache-Control', 'public, max-age=3600');
    }
}
