<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interests extends Model
{
    use HasFactory;

    const BOOK_ICON = './assets/icons/book.png';
    const CONSOLE_ICON = './assets/icons/console.png';
    const BOOK = 'book';
    const CONSOLE = 'console';

    const DESCRIPTION = 'Хобби';

    const MANGA_LN_TITLE = 'Манга и ранобэ';
    const VIDEOGAMES_TITLE = 'Видеоигры';

    const DIR = './assets/hobbyImgs/';

    const MANGA_LN = "mangaLN";
    const VIDEOGAMES = "videogames";

    public $mangaLNImgs = [];
    public $videogameImgs = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->mangaLNImgs = [
            ['name' => 'chainsaw-man', 'url' => self::DIR . 'chainsaw-man.jpg'],
            ['name' => 'overlord', 'url' => self::DIR . 'overlord.jpg'],
            ['name' => 'love-is-war', 'url' => self::DIR . 'love-is-war.jpg'],
            ['name' => 'dorohedoro', 'url' => self::DIR . 'dorohedoro.jpg'],
            ['name' => 'golden-kamuy', 'url' => self::DIR . 'golden-kamuy.jpg'],
            ['name' => 'made-in-abyss', 'url' => self::DIR . 'made-in-abyss.jpg']
        ];

        $this->videogameImgs = [
            ['name' => 'underrail', 'url' => self::DIR . 'underrail.jpg'],
            ['name' => 'kenshi', 'url' => self::DIR . 'kenshi.jpg'],
            ['name' => 'disco-elysium', 'url' => self::DIR . 'disco-elysium.jpg'],
            ['name' => 'hollow-knight', 'url' => self::DIR . 'hollow-knight.jpg'],
            ['name' => 'dark-souls-3', 'url' => self::DIR . 'dark-souls-3.jpg'],
            ['name' => 'darkest-dungeon', 'url' => self::DIR . 'darkest-dungeon.jpg'],
            ['name' => 'nier-automata', 'url' => self::DIR . 'nier-automata.jpg'],
            ['name' => 'undertale', 'url' => self::DIR . 'undertale.jpg']
        ];
    }
}
