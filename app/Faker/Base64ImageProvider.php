<?php

namespace App\Faker;

use Faker\Provider\Base;
use InvalidArgumentException;

class Base64ImageProvider extends Base
{
    protected static $providers = [
        'placeholder',
        'robohash',
    ];

    // https://dummyimage.com/
    // https://plchldr.co/
    // https://ipsumimage.appspot.com/
    // https://fakeimg.pl/
    // https://avatars.dicebear.com/
    // https://getavataaars.com/
    // https://randomuser.me/
    // https://ui-avatars.com/
    // http://www.tinygraphs.com/


    protected static $placeholderSupportedFormats = [
        'png',
        'jpg',
        'jpeg',
        'gif',
    ];

    protected static $roboHashSupportedFormats = [
        'png',
        'jpg',
        'bmp'
    ];

    public function base64Image(string $provider, ...$args): string
    {
        switch ($provider) {
            case 'placeholder':
                $imageUrl = $this->placeholder(...$args);
                break;

            case 'robohash':
                $imageUrl = $this->robohash(...$args);
                break;

            default:
                throw new InvalidArgumentException('Supported image providers are ' . implode(', ', static::$providers));
        }

        return base64_encode(file_get_contents($imageUrl));
    }

    public function placeholder(string $size = '300x300', string $format = 'png', string $backgroundColor = null, string $textColor = null, string $text = null): string
    {
        if (!preg_match('/^[0-9]+x[0-9]+$/', $size)) {
            throw new InvalidArgumentException('Size should be specified in format 300x300');
        }

        if (!in_array($format, static::$placeholderSupportedFormats)) {
            throw new InvalidArgumentException('Supported formats are ' . implode(', ', static::$placeholderSupportedFormats));
        }

        if ($backgroundColor && !preg_match('#((?:^[0-9a-f]{3}$)|(?:^[0-9A-Fa-f]{6}$)){1}(?!.*\H)#i', $backgroundColor)) {
            throw new InvalidArgumentException("backgroundColor must be a hex value without '#'");
        }

        if ($textColor && !preg_match('#((?:^[0-9a-f]{3}$)|(?:^[0-9A-Fa-f]{6}$)){1}(?!.*\H)#i', $textColor)) {
            throw new InvalidArgumentException("textColor must be a hex value without '#'");
        }

        $url = "https://placehold.it/$size.$format";

        if ($backgroundColor) {
            $url .= "/$backgroundColor";
        }

        if ($textColor) {
            $url .= "/$textColor";
        }

        if ($text) {
            $url .= "?text=$text";
        }

        return $url;
    }

    public function robohash(string $slug = null, string $size = '300x300', string $format = 'png', string $set = 'set1', string $bgset = null): string
    {
        if (!preg_match('/^[0-9]+x[0-9]+$/', $size)) {
            throw new \InvalidArgumentException('Size should be specified in format 300x300');
        }

        if (!in_array($format, static::$roboHashSupportedFormats)) {
            throw new \InvalidArgumentException('Supported formats are ' . implode(', ', static::$roboHashSupportedFormats));
        }

        $slug = $slug ?? $this->generator->slug(3);

        $bgsetQuery = $bgset ? "&bgset=$bgset" : '';

        return "https://robohash.org/$slug.$format?size=$size&set=$set$bgsetQuery";
    }
}
