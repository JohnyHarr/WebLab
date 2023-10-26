<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;

    const DESCRIPTION = 'Сгенерированные искусственным интеллектом изображения по запросу "Dark Souls"';

    const STABLE_TITLE = 'Stable Diffusion';
    const DALLE_TITLE = 'DALL·E';

    const DIR = './assets/galleryImgs/';

    const STABLE = "stable";
    const DALLE = "dalle";

    const STABLE_IMGS_NUMBER = 8;
    const DALLE_IMGS_NUMBER = 7;

    public $stablePhotos = [];
    public $dallePhotos = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        for ($i = 1; $i <= self::STABLE_IMGS_NUMBER; $i++) {
            $this->stablePhotos[] = ['name' => self::STABLE . '-' . $i, 'url' => self::DIR . self::STABLE . '-' . $i . '.jpg'];
        }

        for ($i = 1; $i <= self::DALLE_IMGS_NUMBER; $i++) {
            $this->dallePhotos[] = ['name' => self::DALLE . '-' . $i, 'url' => self::DIR . self::DALLE . '-' . $i . '.jpg'];
        }
    }
}
