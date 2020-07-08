# kana2initial
ひらがなをローマ字の頭文字に変換するだけ

## Install

### 通常
Packagist には登録してないので、 `KanaToInitial.php` をDLなりコピペして好きなところに置く。

### どうしても composer で管理したい
利用するプロジェクトの `composer.json` に以下を追加する。
```composer.json
"repositories": {
    "kana2initial": {
        "type": "vcs",
        "url": "https://github.com/shimoning/kana2initial.git"
    }
},

"require": {
    "shimoning/kana2initial": ">=0.0.1"
},
```

その後以下でインストールする。

```bash
composer update shimoning/kana2initial
```

## Usage
### 基本
```php
KanaToInitial::convert('ひらがな'); // -> H
```

### 初期化関数
ヘボン式やら行の扱いを変更できる。
static なので、一度変更すると移行 `convert` を呼び出すときにその設定がそのまま利用される。
デフォルトではどちらも初期値は `false` で無効になっている。
```php
KanaToInitial::init($hebon, $replaceR2L)
```

### ヘボン式
```php
KanaToInitial::init(true);
KanaToInitial::convert('ふらふら'); // -> F
```

### ら行を R じゃなくて L にしたい
```php
KanaToInitial::init(false, true);
KanaToInitial::convert('らくらく'); // -> L
```

## License
[MIT](https://opensource.org/licenses/MIT)
