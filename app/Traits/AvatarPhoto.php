<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait AvatarPhoto
{
    public function photo(string $photoName, $file): string|false
    {
        if (!$file) return false;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($file)->toWebp(80);

        Storage::disk('public')->put("images/avatars/{$photoName}", (string) $image);

        return "/storage/images/avatars/{$photoName}";
    }
}

