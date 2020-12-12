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

# 08:新規投稿フォームを作ろう 
ここでは、お店情報を登録する投稿フォームを作ります。この投稿フォームでは、プルダウンリストでカテゴリを選択できるようにします。

## ルーティングを設定する
routes/web.php
```
Route::get('/shops', 'ShopController@index')->name('shop.list');
Route::get('/shop/new', 'ShopController@create')->name('shop.new');
Route::post('/shop', 'ShopController@store')->name('shop.store');

Route::get('/shop/{id}', 'ShopController@show')->name('shop.detail');

Route::get('/', function () {
    return redirect('/shops');
});
```

## コントローラのcreate()を記述する
app/Http/Controllers/ShopController.php:
```
<?php

namespace App\Http\Controllers;

use App\Shop;
use App\Category;
use Illuminate\Http\Request;


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shop = new Shop;
        $categories = Category::all()->pluck('name', 'id');
        return view('new', ['shop' => $shop, 'categories' => $categories]);
    }
```

## 新規投稿フォームのビューを追加する
resources/views/new.blade.php
```
@extends('layout')

@section('content')
    <h1>新しいお店</h1>
    {{ Form::open(['route' => 'shop.store']) }}
        <div class='form-group'>
            {{ Form::label('name', '店名:') }}
            {{ Form::text('name', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('address', '住所:') }}
            {{ Form::text('address', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('category_id', 'カテゴリ:') }}
            {{ Form::select('category_id', $categories) }}
        </div>
        <div class="form-group">
            {{ Form::submit('作成する', ['class' => 'btn btn-outline-primary']) }}
        </div>
    {{ Form::close() }}

    <div>
        <a href={{ route('shop.list') }}>一覧に戻る</a>
    </div>

@endsection
```

# 09:投稿フォームの内容を保存しよう 
ここでは、新規投稿フォームの内容を保存する機能を作ります。さらに、このフォームを呼び出すよう、一覧ページからリンクします。

## コントローラのstore()を記述する
app/Http/Controllers/ShopController.php:
```
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shop = new Shop;
        $shop->name = request('name');
        $shop->address = request('address');
        $shop->category_id = request('category_id');
        $shop->save();
        return redirect()->route('shop.detail', ['id' => $shop->id]);
    }
```

## 一覧ページから新規投稿フォームにリンクする
resources/views/index.blade.php
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

    <div>
        <a href={{ route('shop.new') }} class='btn btn-outline-primary'>新しいお店</a>
    <div>
@endsection
```

# 10:お店の編集フォームを作ろう 
ここでは、お店情報を編集するフォームを作ります。このフォームでは、既存のお店情報を読み込んで、変更できるようにします。

## ルーティングを設定する
routes/web.php
```
Route::get('/shops', 'ShopController@index')->name('shop.list');
Route::get('/shop/new', 'ShopController@create')->name('shop.new');
Route::post('/shop', 'ShopController@store')->name('shop.store');
Route::get('/shop/edit/{id}', 'ShopController@edit')->name('shop.edit');
Route::post('/shop/update/{id}', 'ShopController@update')->name('shop.update');

Route::get('/shop/{id}', 'ShopController@show')->name('shop.detail');

Route::get('/', function () {
    return redirect('/shops');
});
```

## コントローラのedit()を追記
app/Http/Controllers/ShopController.php:
```
    public function edit($id)
    {
        $shop = Shop::find($id);
        $categories = Category::all()->pluck('name', 'id');
        return view('edit', ['shop' => $shop, 'categories' => $categories]);
    }
```

## editビューを作成する
resources/views/edit.blade.php
```
@extends('layout')

@section('content')
    <h1>{{$shop->name}}を編集する</h1>
    {{ Form::model($shop, ['route' => ['shop.update', $shop->id]]) }}
        <div class='form-group'>
            {{ Form::label('name', '店名:') }}
            {{ Form::text('name', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('address', '住所:') }}
            {{ Form::text('address', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('category_id', 'カテゴリ:') }}
            {{ Form::select('category_id', $categories) }}
        </div>
        <div class="form-group">
            {{ Form::submit('更新する', ['class' => 'btn btn-outline-primary']) }}
        </div>
    {{ Form::close() }}

    <div>
        <a href={{ route('shop.list') }}>一覧に戻る</a>
    </div>

@endsection
```

# 11:編集内容を更新しよう 
ここでは、編集フォームの内容を保存する機能を作ります。先ほど作成した編集フォームの内容で、データベースを更新します。

## コントローラのupdate()を追記
app/Http/Controllers/ShopController.php:
```
/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id, Shop $shop)
     {
         $shop = Shop::find($id);
         $shop->name = request('name');
         $shop->address = request('address');
         $shop->category_id = request('category_id');
         $shop->save();
         return redirect()->route('shop.detail', ['id' => $shop->id]);
     }
 ```
 
 ## 詳細ページからリンク
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
        <a href={{ route('shop.list' )}>一覧に戻る</a>
         | <a href={{ route('shop.edit', ['id' =>  $shop->id]) }}>編集</a>
    </div>
@endsection
```

# 12:お店の情報を削除しよう 
ここでは、Lunchmapアプリの削除機能を作成します。登録したお店情報を削除できるようにしましょう。

## ルーティングを設定する
routes/web.php
```
Route::get('/shops', 'ShopController@index')->name('shop.list');
Route::get('/shop/new', 'ShopController@create')->name('shop.new');
Route::post('/shop', 'ShopController@store')->name('shop.store');
Route::get('/shop/edit/{id}', 'ShopController@edit')->name('shop.edit');
Route::post('/shop/update/{id}', 'ShopController@update')->name('shop.update');

Route::get('/shop/{id}', 'ShopController@show')->name('shop.detail');
Route::delete('/shop/{id}', 'ShopController@destroy')->name('shop.destroy');

Route::get('/', function () {
    return redirect('/shops');
});
```

## コントローラにdestroyメソッドを追記
app/Http/Controllers/ShopController.php:
```
    public function destroy($id)
    {
        $shop = Shop::find($id);
        $shop->delete();
        return redirect('/shops');
    }
```

# 詳細ページに削除ボタンを追加
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
        <a href={{ route('shop.list' )}}>一覧に戻る</a>
         | <a href={{ route('shop.edit', ['id' =>  $shop->id]) }}>編集</a>
        <p></p>
        {{ Form::open(['method' => 'delete', 'route' => ['shop.destroy', $shop->id]]) }}
            {{ Form::submit('削除') }}
        {{ Form::close() }}
    </div>
@endsection
```

# 13:Googleマップを表示しよう 
ここでは、住所に合わせた地図をLunchmapアプリに表示します。そのため、詳細ページにGoogleマップを組み込みます。

## APIとは
APIとは、Application Programming Interfaceの略で、プログラムから別のプログラムの機能を呼び出すために用意された命令や関数のこと。

## Google Maps API
- Google Maps Platform - Geo-location API
https://cloud.google.com/maps-platform/

- Developer Guide | Maps Embed API | Google Developers
https://developers.google.com/maps/documentation/embed/guide

## APIキーの取得手順
1. Google Developers Consoleにアクセスする
Google Developers Console
https://console.developers.google.com/

2. プロジェクトを作成を選択
3. Google APIが表示されたら、Google Maps APIから「Google Maps Embed API」を選択
4. 「有効にする」をクリック
5. 「認証情報を作成」をクリックして、「必要な認証情報」ボタンをクリック
6. 表示されたAPIキーを記録する

※特定のWebサービスだけから利用できるよう、「API利用制限」を設定することをオススメします。
※この手順や利用範囲はGoogle側で変更される場合があります。

## 詳細ページのビューにマップを追加
resources/views/show.blade.php
```
@extends('layout')

@section('content')
    <h1>{{ $shop->name }}</h1>
    <div>
        <p>{{ $shop->category->name }}</p>
        <p>{{ $shop->address }}</p>
    </div>

    <iframe id='map' src='https://www.google.com/maps/embed/v1/place?key=AIzaSyCJBgcuCowQa5-V8owXaUCHhUNBN8bfMfU&amp;q={{ $shop->address }}'
    width='100%'
    height='320'
    frameborder='0'>
    </iframe>

    <div>
        <a href={{ route('shop.list' )}>一覧に戻る</a>
    </div>
@endsection
```

