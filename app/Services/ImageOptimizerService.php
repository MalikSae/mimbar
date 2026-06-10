<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizerService
{
    /**
     * Optimize and store an uploaded image.
     *
     * @param UploadedFile $file The uploaded image file.
     * @param string $directory The directory to store the image in (e.g., 'news', 'programs').
     * @param int $maxWidth Maximum width of the image. Defaults to 1200px.
     * @param int $quality WebP quality (0-100). Defaults to 80.
     * @return string The relative path of the stored image.
     */
    public static function optimizeAndStore(UploadedFile $file, string $directory, int $maxWidth = 1200, int $quality = 80): string
    {
        // Inisialisasi ImageManager menggunakan GD Driver
        $manager = new ImageManager(new Driver());
        
        // Membaca image dari UploadedFile
        $image = $manager->read($file->getRealPath());

        // Cek apakah lebar lebih besar dari $maxWidth
        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        // Encode ke WebP
        $encodedImage = $image->toWebp(quality: $quality);

        // Generate nama file unik dengan ekstensi .webp
        $filename = $directory . '/' . uniqid() . '_' . time() . '.webp';

        // Simpan ke storage publik
        Storage::disk('public')->put($filename, $encodedImage->toString());

        return $filename;
    }
}
