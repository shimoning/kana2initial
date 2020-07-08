<?php

namespace Shimoning\Kana2Initial;

class KanaToInitial
{
    const MAP = [
        'あ' => 'A', 'い' => 'I', 'う' => 'U', 'え' => 'E', 'お' => 'O',
        'か' => 'K', 'き' => 'K', 'く' => 'K', 'け' => 'K', 'こ' => 'K',
        'さ' => 'S', 'し' => 'S', 'す' => 'S', 'せ' => 'S', 'そ' => 'S',
        'た' => 'T', 'ち' => 'T', 'つ' => 'T', 'て' => 'T', 'と' => 'T',
        'な' => 'N', 'に' => 'N', 'ぬ' => 'N', 'ね' => 'N', 'の' => 'N',
        'は' => 'H', 'ひ' => 'H', 'ふ' => 'H', 'へ' => 'H', 'ほ' => 'H',
        'ま' => 'M', 'み' => 'M', 'む' => 'M', 'め' => 'M', 'も' => 'M',
        'や' => 'Y', 'ゆ' => 'Y', 'よ' => 'Y',
        'ら' => 'R', 'り' => 'R', 'る' => 'R', 'れ' => 'R', 'ろ' => 'R',
        'わ' => 'W', 'ゐ' => 'I', 'ゑ' => 'E', 'を' => 'O',
        'ん' => 'N',

        'ゔ' => 'V',
        'が' => 'G', 'ぎ' => 'G', 'ぐ' => 'G', 'げ' => 'G', 'ご' => 'G',
        'ざ' => 'Z', 'じ' => 'Z', 'ず' => 'Z', 'ぜ' => 'Z', 'ぞ' => 'Z',
        'だ' => 'D', 'ぢ' => 'D', 'づ' => 'D', 'で' => 'D', 'ど' => 'D',
        'ば' => 'B', 'び' => 'B', 'ぶ' => 'B', 'べ' => 'B', 'ぼ' => 'B',
        'ぱ' => 'P', 'ぴ' => 'P', 'ぷ' => 'P', 'ぺ' => 'P', 'ぽ' => 'P',
    ];

    const HEBON_MAP = [
        'ち' => 'C',
        'ふ' => 'F',
        'ゐ' => 'W',
        'ゑ' => 'W',
        'を' => 'W',
        'ゔ' => 'B',
        'じ' => 'J',
        'ぢ' => 'J',
        'づ' => 'Z',
    ];

    private static $__hebon = false;
    private static $__replaceRL = false;

    public static function init($hebon = false, $replaceRL = false)
    {
        static::$__hebon = $hebon;
        static::$__replaceRL = $replaceRL;
    }

    public static function convert($string)
    {
        $firstLetter = mb_substr($string, 0, 1);

        if (!static::validate($string)) {
            return $firstLetter;
        }

        if (static::$__hebon && isset(self::HEBON_MAP[$firstLetter])) {
            return self::HEBON_MAP[$firstLetter];
        }

        $replaced = static::MAP[$firstLetter] ?? '';
        if (static::$__replaceRL && $replaced === 'R') {
            return 'L';
        }

        return $replaced;
    }

    public static function validate($string)
    {
        return preg_match('/^[あいおうえおか-もやゆよら-ろわ-ん]+/u', $string);
    }
}
