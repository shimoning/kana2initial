<?php

namespace Shimoning\Kana2Initial;

/**
 * ひらがなをローマ字の頭文字に変換する静的クラス
 *
 * @author Shimon Haga <haga@shimon.biz>
 */
class KanaToInitial
{
    /**
     * ひらがなとローマ字の頭文字のマッピング
     *
     * @var array
     */
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

    /**
     * ヘボン式用のマッピング
     *
     * @var array
     */
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

    /**
     * ヘボン式を利用するかどうか
     *
     * @var boolean
     */
    private static $__hebon = false;

    /**
     * 「ら」行の頭文字は通常 'R' だが、 'L' にしたい場合は true をセットする
     *
     * @var boolean
     */
    private static $__replaceR2L = false;

    /**
     * 初期化関数
     *
     * ヘボン式を利用したり、「ら」行の扱いを変える時に呼ぶ
     *
     * @param boolean $hebon
     * @param boolean $replaceR2L
     * @return void
     */
    public static function init($hebon = false, $replaceR2L = false)
    {
        static::$__hebon = $hebon;
        static::$__replaceR2L = $replaceR2L;
    }

    /**
     * ひらがなをローマ字の頭文字に変換する
     *
     * もし対応できない文字列がきた場合は、頭文字を無変換で返す
     *
     * @param string $string
     * @return string
     */
    public static function convert(string $string): string
    {
        $firstLetter = mb_substr($string, 0, 1);

        if (!static::validate($string)) {
            return $firstLetter;
        }

        if (static::$__hebon && isset(self::HEBON_MAP[$firstLetter])) {
            return self::HEBON_MAP[$firstLetter];
        }

        $replaced = static::MAP[$firstLetter] ?? '';
        if (static::$__replaceR2L && $replaced === 'R') {
            return 'L';
        }

        return $replaced;
    }

    /**
     * 変換可能無文字列かどうかチェックする
     *
     * @param string $string
     * @return boolean
     */
    public static function validate(string $string): boolean
    {
        return preg_match('/^[あいおうえおか-もやゆよら-ろわ-ん]+/u', $string);
    }
}
