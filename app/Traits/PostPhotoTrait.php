<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait PostPhotoTrait
{
    public function thumbnail(string $photoName, $file): string|false
    {
        if (!$file) return false;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->cover(570, 375)->toWebp(80);

        Storage::disk('public')->put("images/post/thumbnails/{$photoName}", (string) $image);

        return "/storage/images/post/thumbnails/{$photoName}";
    }

    public function ckEditorUploadPhoto(string $photoName, $file): string|false
    {
        if (!$file) return false;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        if($image->width() > 650) {
            $image = $image->scale(650);
        }

        $finalImg = $image->toWebp(80);

        Storage::disk('public')->put("images/post/uploads/{$photoName}", (string) $finalImg);

        return "/storage/images/post/uploads/{$photoName}";
    }

    public function slideImage(string $photoName, $file) : string | false
    {
        if (!$file) return false;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->cover(1920, 900)->toWebp(80);

        Storage::disk('public')->put("images/sliders/{$photoName}", (string) $image);

        return "/storage/images/sliders/{$photoName}";
    }

}
