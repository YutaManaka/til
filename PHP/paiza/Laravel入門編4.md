# 02:アプリケーションディレクトリを用意しよう 
ここでは、Laravelのアプリケーションディレクトリを用意します。また、アプリケーションのデータベースを準備しましょう。

## アプリケーション用ディレクトリを自動生成する
```
$ laravel new lunchmap
```

## ディレクトリ作成を高速化するには
"laravel new"コマンドの実行前に以下のような設定をしておけば、コマンドの実行時間を短くできます。
```
$ composer config -g repositories.packagist composer 'https://packagist.jp'
$ composer global require hirak/prestissimo
```

##  Webサーバを起動
```
$ cd lunchmap
$ php artisan serve
```

ブラウザで以下にアクセスすると、アプリのWebページを表示する
https://localhost:8000/
Webサーバを停止するには、ターミナルで、キーボードで「CTRL」キー(コントロールキー)を押しながら「C」のキーを押す。

## .envファイルを修正する
lunchmap/.env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lunchmapdb
DB_USERNAME=root
# DB_PASSWORD=secret
```

## laravelのバージョンアップによる変更点
動画ではlaravel5.7を使用していますが、現在はより新しいLaravel5.8が公開されています。

`$ laravel new`で作成したプロジェクトはその時点で最新のLaravelがダウンロードされるため、時期によっては動画と全く同じコードでは無いかもしれませんが2019年3月現在大幅な変更はされていないので大きな影響はありません。


例えば、以下のような違いが見られる場合があります。


### artisan make:modelで作成したマイグレーションファイル
以前はidカラムがincrementsで定義されていましたが、新しくbigIncrementsで定義されるようになります。

これはデータベースのカラムの型に影響し
```
increments() : 符号なし4byte整数
bigIncrements() : 符号なし8byte整数
```
となります。

符号なし8byte整数(2\^64通り)は、符号なし4byte整数(2\^32通り)の2\^32倍 = 4,294,967,295倍もの空間を持っています。

bigIncrements()でIDを定義するとincrements()にくらべてこれだけの余裕ができ、より多くのデータを格納できるようになるというわけです。
```
    public function up()
    {
        Schema::create('Shop', function (Blueprint $table) {
            // ここがbigIncrementsになっている
            $table->bigIncrements('id');
            $table->timestamps();
        });
    }
```

### AppServiceProvider.phpの関数の順番が異なる
AppServiceProvider.phpの関数が動画と違う並び順になっている場合があります。
並び順が異なるだけでメソッドそのものは変わっていませんので、目的のメソッドの位置を確認してください。

paiza cloud向けのHTTPSの設定はboot()メソッドに記述します。
```
class AppServiceProvider extends ServiceProvider
{
    // メソッドの並び順が逆になっている
    public function register()
    {
        //
    }

    public function boot()
    {
        //
    }
}
```

### 404エラーのデザインが変わっている
404エラーが発生した場合（アクセス先のURLを間違えた場合など）に表示されてるエラーページのデザインがシンプルなものへ変更されました。
paizaラーニングの講座でも存在しないURLへアクセスすれば表示されますので、興味があれば確認してみましょう。


### laravelの更新情報（英語）
- [Release Notes - Laravel](https://laravel.com/docs/5.8/releases)
- [Laravel News](https://laravel-news.com/)

# 03:モデルとコントローラを用意しよう 
ここでは、Lunchmapアプリのモデルとコントローラを用意します。そして、先ほどのチャプターで作成したデータベースに、お店情報とカテゴリ情報を格納するテーブルを作成するため、マイグレーションを実行します。

## モデルファイルを作成
```
$ cd lunchmap
$ php artisan make:model Category -m
$ php artisan make:model Shop -m -c -r
```

## カテゴリーのマイグレーションファイルにカラムを追加
database/migrations/2019_xx_xx_xxxxxxxx_create_categories_table.php
```
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
    }
```

## Shopsマイグレーションファイルにカラムを追加
database/migrations/2019_xx_xx_xxxxxxxx_create_shops_table.php
```
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->integer('category_id');
            $table->timestamps();
        });
    }
```

## マイグレーション実行
```
$ php artisan migrate
```

# 04:お店とカテゴリのテーブルを関連付けよう 
ここでは、先ほど作ったデータベースで、お店とカテゴリのテーブルを関連付けます。さらに、アプリケーションのサンプルデータを投入しましょう。

## Shopモデルにリレーションを設定
app/Shop.php
```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
```

## phpmyadminでサンプルデータを投入
categoriesテーブル
```
INSERT INTO categories(name)
VALUES
    ('イタリアン'),
    ('中華'),
    ('和食');
```

shopsテーブル
```
INSERT INTO shops(name,address,category_id)
VALUES
    ('パイザ亭', '東京都港区南青山3丁目', 1),
    ('ラーメンLaravel', '東京都港区東青山', 2),
    ('そばの霧島', '東京都港区西青山', 3);
```

## PaizaCloud用https対応
app/Providers/AppServiceProvider.php
```
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \URL::forceScheme('https');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
```

# 05:お店の一覧ページを作ろう 
ここでは、Lunchmapアプリのお店一覧ページを作ります。ルーティングとコントローラ、ビューを記述して、登録しておいたサンプルデータを一覧表示しましょう。

## お店一覧のルーティングを定義する
routes/web.php
```
<?php

Route::get('/shops', 'ShopController@index')->name('shop.list');

Route::get('/', function () {
    return redirect('/shops');
});
```

## コントローラにお店一覧を記述する
app/Http/Controllers/ShopController.php
```
<?php

namespace App\Http\Controllers;

use App\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return view('index', ['shops' => $shops]);
    }
}
```

## お店一覧のビューを作成する
resources/views/index.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Lunchmap</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>お店一覧</h1>

        @foreach ($shops as $shop)
            <p>
                {{ $shop->category->name }},
                {{ $shop->name }},
                {{ $shop->address }}
            </p>
        @endforeach
    </body>
</html>
```

# 06:共通テンプレートにBootstrapを導入しよう 
ここでは、Lunchmapアプリの共通テンプレートを追加します。HTMLフレームワークのBootstrapを導入して、ナビゲーションバーを追加します。

## layout.blade.phpを分離する
resources/views/layout.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>Lunchmap</title>
        <style>body {padding: 80px;}</style>
    </head>
    <body>
        @yield('content')
    </body>
</html>
```

## index.blade.phpに、セクションを追加
resources/views/index.blade.php
```
@extends('layout')

@section('content')
    <h1>お店一覧</h1>

    @foreach ($shops as $shop)
        <p>
            {{ $shop->category->name }},
            {{ $shop->name }},
            {{ $shop->address }}
        </p>
    @endforeach
@endsection
```

## 共通テンプレートにBootstrapを割り当てる
resources/views/layout.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' >
        <title>Lunchmap</title>
        <style>body {padding-top: 80px;}</style>
    </head>
    <body>
        <nav class='navbar navbar-expand-md navbar-dark bg-dark fixed-top'>
            <a class='navbar-brand' href={{route('shop.list')}}>Lunchmap</a>
        </nav>
        <div class='container'>
            @yield('content')
        </div>
    </body>
</html>
```

# 07:お店の詳細ページを作ろう 
ここでは、Lunchmapアプリでお店情報の詳細ページを作ります。また、お店一覧ページをBootstrapとテーブルタグで見栄えを整えます。

## ルーティングを設定する
routes/web.php
```
Route::get('/shops', 'ShopController@index')->name('shop.list');
Route::get('/shop/{id}', 'ShopController@show')->name('shop.detail');

Route::get('/', function () {
    return redirect('/shops');
});
```

## コントローラを記述する
app/Http/Controllers/ShopController.php
'''
/**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Shop::find($id);
        return view('show', ['shop' => $shop]);
    }
'''

## ビューを追加する
resources/views/show.blade.php
```
@extends('layout')

@section('content')
    <h1>{{ $shop->name }}</h1>
    <div>
        <p>{{ $shop->category->name }}</p>
        <p>{{ $shop->address }}</p>
    </div>
    <div>
        <a href={{ route('shop.list') }}>一覧に戻る</a>
    </div>
@endsection
```

## お店一覧をテーブルタグにして、リンクを追加
esources/views/index.blade.php
```
@extends('layout')

@section('content')
    <h1>お店一覧</h1>

    <table class='table table-striped table-hover'>
        <tr>
            <th>カテゴリ</th><th>店名</th><th>住所</th>
        </tr>
        @foreach ($shops as $shop)
            <tr>
                <td>{{ $shop->category->name }}</td>
                <td>
                    <a href={{ route('shop.detail', ['id' =>  $shop->id]) }}>
                        {{ $shop->name }}
                    </a>
                </td>
                <td>{{ $shop->address }}</td>
            </tr>
        @endforeach
    </table>
@endsection
```
