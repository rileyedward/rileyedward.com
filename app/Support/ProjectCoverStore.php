<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

/**
 * Stores project cover screenshots as resized WebP on the media disk.
 */
class ProjectCoverStore
{
    private const MAX_WIDTH = 1600;

    private const QUALITY = 82;

    /**
     * Resize and encode the upload, returning its stored path.
     */
    public function store(UploadedFile $file): string
    {
        $encoded = Image::decodePath($file->getRealPath())
            ->scaleDown(width: self::MAX_WIDTH)
            ->encode(new WebpEncoder(quality: self::QUALITY));

        $path = 'projects/'.Str::uuid().'.webp';

        Storage::disk(config('site.media_disk'))->put($path, $encoded->toString(), 'public');

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path !== null) {
            Storage::disk(config('site.media_disk'))->delete($path);
        }
    }
}
