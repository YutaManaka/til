# 01:データベースとルーティングを理解しよう 
ここでは、モデル・ビュー・コントローラというLaravelの機能構成について理解します。また、Laravelでデータベースを操作する時、どのような機能が利用できるか学習しましょう。

## モデル・ビュー・コントローラの役割
- モデル：アプリで扱うデータを保持し、操作する
- ビュー：データの表示形式を記述する
- コントローラ：リクエストに応じて、モデル・ビューを呼び出す

## Laravelでデータベースを操作する機能
- artisan tinker：Laravelアプリの環境を有効にしたまま、コマンドで操作
- Eloquent：データベースのレコードをモデルクラスで処理する、O/Rマッパー
- マイグレーション：データベースの操作を一括実行・取り消し

# 02:artisan tinkerでデータベースを確認しよう 
ここでは、Laravelの動作確認に欠かせないartisan tinkerについて、基本的な使い方を学習します。対話型コンソールのartisan tinkerを使うと、Laravelアプリの環境を有効にしたまま、Laravelの機能をコマンドで操作できます。

## artisan tinkerとは
Laravelに含まれているコマンドラインインターフェイス。artisan tinkerを使うと、Laravelアプリの環境を有効にしたまま、Laravelの機能をコマンドで操作できる

## artisan tinkerを起動する
```
$ cd bbs
$ php artisan tinker
```

## artisan tinkerを終了する
```
>>> exit
```
または、CTRL+Cキー

## 主な操作コマンド
```
// すべてのデータを取り出す
>>> Article::all()

// 指定idのレコードを取り出し、カラムを出力
>>> $article = Article::find(1)
>>> $article->content

// echo関数を使わずに、変数名を記述すると、そのまま値を出力する
>>> $article

// レコードを追加する
>>> $article = new Article()
>>> $article->content = 'Hello tinker'
>>> $article->save()

// 指定idのレコードを取り出し、削除する
>>> $article = Article::find(1)
>>> $article->delete()
```

# 03:マイグレーションで、カラムを追加しよう 
ここでは、掲示板アプリケーションのデータベースに、投稿者の名前を表すカラムを追加します。そして、Laravelのマイグレーションについて、さらに理解を深めます。

## マイグレーションとは
一般的に、マイグレーションとは、データベースの中身を一括して移行したり変更したりする作業です。Laravelのマイグレーション機能では、データベースの定義や変更を一度に行うことができます。
マイグレーションは、2段階で行います。まず、専用のコマンドを使ってマイグレーションファイルを作成して、それから必要な情報を修正して、データベースに適用します。

## カラムを変更する前に、ライブラリを追加
Laravelでカラムを変更するには、doctrine/dbalというライブラリが必要になります。
doctrine/dbalを追加するには、次のコマンドを実行します。
```
$ composer require doctrine/dbal
```

## マイグレーションファイルを自動生成する
```
$ cd bbs
$ php artisan make:migration add_column_username --table=articles
```

## マイグレーションファイルにuser_nameカラムを追加する
database/migrations/2019_xx_xx_xxxxxxxx_add_column_username.php
```
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('user_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            //
        });
    }
}
```

## マイグレーションを実行する
```
$ php artisan migrate
```

# 04:モデルに追加したカラムをビューで表示しよう 
ここでは、モデルに追加したカラムをビューで表示します。そして、データベースのデータをビューで表示する時、モデルのカラムをどのように記述するか学習しましょう。

## indexビューにカラムを追加
bbs/resources/views/index.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>paiza bbs</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>paiza bbs</h1>
        <p>{{ $message }}</p>
        @foreach ($articles as $article)
            <p>
                <a href='{{ route("article.show", ["id" =>  $article->id]) }}'>
                    {{ $article->content }},
                    {{ $article->user_name }}
                </a>
            </p>
        @endforeach
    </body>
</html>
```

## showビューにカラムを追加
bbs/resources/views/show.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>paiza bbs</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>paiza bbs</h1>
        <p>{{ $message }}</p>
        <p>{{ $article->content }}</p>
        <p>{{ $article->user_name }}</p>

        <p>
            <a href={{ route('article.list') }}>一覧に戻る</a>
        </p>
    </body>
</html>
```

# 05:Laravelのルーティングを理解しよう 
ここでは、Laravelのルーティングに、新しいルートを追加します。そして、ルーティングの動作について、さらに理解を深めましょう。

## ルーティングとは
LaravelによるWebアプリケーションでは、機能に応じて、アドレスを割り当てておきます。そして、Laravelのルーティングで、リクエストに応じて、実行するコードを切り替えます。

## 通信方式を指定するメソッド
Laravelでは、ブラウザとの通信にHTTPメソッドを指定します。情報を表示するだけなら「GET」を使い、情報を投稿する場合は「POST」を使っています。また、記事を削除する場合は「DELETE」メソッドは指定します。
このメソッドは、ブラウザとサーバ間の通信方式を指定するものです。クラスのコードを呼び出すメソッドと紛らわしいので注意してください。

## ルーティングでリダイレクトを設定
「/」にアクセスしたら、「/articles」にリダイレクトする
routes/web.php
```
Route::get('/', function () {
    return redirect('/articles');
});

Route::get('/articles', 'ArticleController@index')->name('article.list');
Route::get('/article/{id}', 'ArticleController@show')->name('article.show');
```

# 06:データベースに書き込んでみよう 
ここでは、掲示板アプリケーションに記事を書き込みする機能を追加します。フォームを使わずに、固定テキストや更新日時をデータベースに格納してみましょう。

## 新規投稿のルートを追加する
bbs/routes/web.php
```
<?php

Route::get('/', function () {
    return redirect('/articles');
});
Route::get('/articles', 'ArticleController@index')->name('article.list');
Route::get('/article/new', 'ArticleController@create')->name('article.new');
Route::get('/article/{id}', 'ArticleController@show')->name('article.show');
```

## コントローラに、createメソッドを追加する
bbs/app/Http/Controllers/ArticleController.php
```
public function create(Request $request)
    {
        $article = new Article();

        $article->content = 'Hello BBS';
        $article->user_name = 'paiza';
        $article->save();
        return redirect('/articles');
    }
```

## 記事一覧のビューに、新規投稿リンクを追加する
bbs/resources/views/index.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>paiza bbs</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>paiza bbs</h1>
        <p>{{ $message }}</p>
        @foreach ($articles as $article)
            <p>
                <a href='{{ route("article.show", ["id" =>  $article->id]) }}'>
                    {{ $article->content }},
                    {{ $article->user_name }}
                </a>
            </p>
        @endforeach
        <div>
            <a href={{ route('article.new') }}>新規投稿</a>
        </div>
    </body>
</html>
```

# 07:データベースから記事を削除しよう 
ここでは、掲示板アプリケーションで、記事を削除する機能を作ります。 deleteメソッドでアクセスした時、該当の記事を削除する機能を実装してみましょう。

## ルートを設定する
bbs/routes/web.php
```
Route::get('/articles', 'ArticleController@index')->name('article.list');
Route::get('/article/new', 'ArticleController@create')->name('article.new');
Route::get('/article/{id}', 'ArticleController@show')->name('article.show');
Route::delete('/article/{id}', 'ArticleController@destroy')->name('article.delete');
```

## 詳細ページのビューに、削除ボタンを追加
bbs/resources/views/show.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>paiza bbs</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>paiza bbs</h1>
        <p>{{ $message }}</p>
        <p>{{ $article->content }}</p>
        <p>{{ $article->user_name }}</p>

        <p>
            <a href={{ route('article.list') }}>一覧に戻る</a>
        </p>
        <div>
            {{ Form::open(['method' => 'delete', 'route' => ['article.delete', $article->id]]) }}
                {{ Form::submit('削除') }}
            {{ Form::close() }}
        </div>
    </body>
</html>
```

## コントローラのdestroyメソッドを追加する
bbs/app/Http/Controllers/ArticleController.php
```
public function destroy(Request $request, $id, Article $article)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles');
    }
```

## Webページのソースコードを確認する方法
paiza cloud内のブラウザで、WebページのHTMLを確認するには、次のように操作します。
ここでは、Mac OS X版のChromeを例にしていますが、他のWebブラウザでも、ほぼ同じ操作で確認できます。

1. 右上にある「新しいウィンドウで開く」アイコンをクリック
2. HTMLを確認したいWebページを表示する
3. Chromeのメニューで「ページのソースを表示」を選択する

## Form用ライブラリのインストールについて
削除ボタンを追加するには、Laravelでフォームを使用する場合に必要となる「laravelcollective/html」というライブラリをインストールします。これは、次のコマンドでインストールします。
```
$ cd bbs
$ composer require "laravelcollective/html":"^5.4.0"
```
