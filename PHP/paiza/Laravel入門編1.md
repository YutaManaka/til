# Laravelの基本を理解しよう 
ここでは、この講座の目的・対象者・学習の進め方を確認します。それから、Laravelの特徴についても学習します。

## Webアプリケーションフレームワークとは
Webアプリを開発するために便利な部品やツールをひとまとめにしたもの。
Webアプリケーションを短期間に効率よく開発できる。

## Laravelの特徴
- テンプレートエンジン(Blade)
- データベース(O/Rマッパー：Eloquent)
- 対話型コンソール(artisan tinker)
- ユーザー認証 など

# 02:アプリケーションを用意しよう 
ここでは、Laravelを使う準備として、アプリケーション用ディレクトリを用意します。Laravelでは、このディレクトリに、アプリケーションに必要な機能を作り込んでいきます。また、このディレクトリを用意するだけで、Webサーバーを起動して、動作を確認できます。

## アプリケーション用ディレクトリを自動生成する
```
$ laravel new bbs
```
エラーメッセージが出た場合、下記コードで解決。https://laracasts.com/discuss/channels/laravel/when-i-do-laravel-new-project-its-says-that-cabinetlaravelcom-timed-out

```
$ composer create-project --prefer-dist laravel/laravel blog
```

## ディレクトリ作成を高速化するには
"laravel new"コマンドの実行前に以下のような設定をしておけば、コマンドの実行時間を短くできます。
```
$ composer config -g repositories.packagist composer 'https://packagist.jp'
$ composer global require hirak/prestissimo
```

## Webサーバーを起動
```
$ cd bbs
$ php artisan serve
```
ブラウザで以下にアクセスすると、アプリのWebページを表示する
https://localhost:8000/

Webサーバーを停止するには、ターミナルで、キーボードで「CTRL」キー(コントロールキー)を押しながら「C」のキーを押す。

## Artisanとは
ターミナルで「artisan」(アーティサン)コマンドを使ってLaravelの機能を呼び出すことができます。LaravelでWebアプリケーションを開発するときに役に立つ、数多くのコマンドを提供しています。

# 03:Laravel で HelloWorld 
ここでは、Laravelのアプリケーションで簡単なメッセージを表示します。Hello Worldを表示して、Laravelでアプリケーションを作るための基本操作を理解しましょう。

## Welcomeページを修正する
bbs/resources/views/welcome.blade.php
```
<div class='title m-b-md'>
    paiza bbs
</div>
<p><?= date('Y/m/d H:i:s') ?></p>
```

# 04:1行掲示板を作ろう 
ここでは、Laravelで作る1行掲示板の概要を整理します。また、掲示板で必要になるデータベースを準備しましょう。

## データベース構成
1行掲示板のデータベースには、次の情報が必要になります。

- データベース : mybbs
- テーブル : articles
- カラム : id, content, created_at, updated_at

このデータベースは、phpMyAdminで用意しておきます。

## アプリケーションのデータベース設定
アプリケーションからデータベースを呼び出すには、次のデータベース設定が必要です。

「.env」ファイルは、隠しファイルになっているので、「bbs」ディレクトリを右クリック->「隠しファイルを表示」で表示しておきます。

bbs/.env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mybbs
DB_USERNAME=root
# DB_PASSWORD=secret
```

# 05:モデルとコントローラを用意する 
ここでは、Laravelから１行掲示板のデータベースを操作するモデルを用意します。モデルを使うと、PHPのオブジェクトとして、データベースのレコードを操作できるようになります。

## モデルとマイグレーション、コントローラを作成
```
$ cd bbs
$ php artisan make:model Article -m -c -r
```

## contentカラムを追加
database/migrations/2018_xx_xx_xxxxxxxx_create_articles_table.php
```
public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->timestamps();
        });
    }
```

## マイグレーション実行
```
$ php artisan migrate
```

# 06:ルーティングを定義しよう 
ここでは、Laravelの1行掲示板のルーティングを設定します。ルーティングを使うことで、特定のアドレスにアクセスした時、どの機能を呼び出すか設定できます。

# ルーティングとは
どのアドレスにアクセスした時、どの機能を呼び出すか設定できます。LaravelによるWebアプリケーションでは、機能に応じて、アドレスを割り当てておきます。そして、ルーティングで、リクエストに応じて実行するコードを切り替えます。

# 1行掲示板のルーティング(一覧画面、詳細画面)
bbs/routes/web.php
```
Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', 'ArticleController@index')->name('article.list');
Route::get('/article/{id}', 'ArticleController@show')->name('article.show');
```

## paiza-cloud用https対応
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

# 07:コントローラとビューを作成しよう 
ここでは、Laravelの1行掲示板のために、コントローラとビューを作成します。そして、プログラムを制御するコントローラと、ページの見た目を記述するビューの使い方を学習します。

## コントローラからデータを渡す
/bbs/app/Http/Controllers/ArticleController.php:
```
<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Welcome my BBS';
        return view('index', ['message' => $message]);
    }
}
```

## ビューでデータを表示する
/bbs/resources/views/index.blade.php
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
    </body>
</html>
```

# 08:記事一覧を作成しよう 
ここでは、1行掲示板の記事一覧を作成します。そのために、コントローラで、モデルからデータ一覧を取り出して、ビューで一覧表示します。

## コントローラで、記事一覧を取得する
/bbs/app/Http/Controllers/ArticleController.php:
```
<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = 'Hello world';
        $articles = Article::all();
        return view('index', ['message' => $message, 'articles' => $articles]);
    }

}
```

## ビューで記事一覧を表示する
/bbs/resources/views/index.blade.php
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
            <p>{{ $article->content }}</p>
        @endforeach
    </body>
</html>
```

# 09:詳細画面を作ろう 
ここでは、1行掲示板の記事を個別表示する画面を作成します。そのために、コントローラで、モデルから、指定したデータを取り出して、ビューで表示します。

## コントローラのshowメソッドで、特定の記事を取り出す
/bbs/app/Http/Controllers/ArticleController.php:
```
public function show(Request $request, $id, Article $article)
{
    $message = 'This is your article ' . $id;
    $article = Article::find($id);
    return view('show', ['message' => $message, 'article' => $article]);
}
```

## showビューで、指定の記事を表示する
/bbs/resources/views/show.blade.php
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

        <p>
            <a href={{ route('article.list') }}>一覧に戻る</a>
        </p>
    </body>
</html>
```

## 記事一覧から個別の記事にリンクする
/bbs/resources/views/index.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <mata charset="utf-8">
        <title>paiza bbs</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>paiza bbs</h1>
        <p>{{ $message }}</p>
        @foreach ($articles as $article)
            <p>
                <a href='{{ route("article.show", ["id" =>  $article->id]) }}'>
                    {{ $article->content }}
                </a>
            </p>
        @endforeach
    </body>
</html>
```
