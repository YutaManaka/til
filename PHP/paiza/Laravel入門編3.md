# 02:テンプレートを共通化しよう
ここでは、Laravelで複数のページを利用する場合、その共通部分をまとめる方法について学習します。共通部分をまとめると、Webデザインの作成やメンテナンスを効率よく進めることができます。

## 共通テンプレートの変更部分を指定する
resources/views/layout.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>paiza bbs</title>
        <style>body {padding: 10px;}</style>
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
@endsection
```

## show.blade.phpに、セクションを追加
resources/views/show.blade.php
```
@extends('layout')

@section('content')
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
@endsection
```

# 03:掲示板にBootstrapを適用しよう 
ここでは、Laravelで作る1行掲示板に、HTMLテンプレートのBootstrapを適用します。Bootstrapを利用すると、Webアプリケーションのデザインを簡単にレベルアップさせることができます。
今回は練習用に手動で導入する手続きを学習します。

## Bootstrapを読み込む
resources/views/style-sheet.blade.php
```
<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'&gt;
<style>body {padding-top: 80px;}</style>
```

## ナビゲーションバーを追加する
resources/views/nav.blade.php
```
<nav class='navbar navbar-expand-md navbar-dark bg-dark fixed-top'>
    <a class='navbar-brand' href={{ route('article.list') }}>paiza bbs</a>
</nav>
```

## layout.blade.phpにBootstrapとナビゲーションバーを追加する
resources/views/layout.blade.php
```
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <title>paiza bbs</title>
        @include('style-sheet')
    </head>
    <body>
        @include('nav')
        <div class='container'>
            @yield('content')
        </div>
    </body>
</html>
```

# 04:Bootstrapでページの見栄えを整えよう 
ここでは、Bootstrapを利用して掲示板アプリケーションの見栄えを整えます。Bootstrapには、テーブルタグやボタンに見栄えの良いスタイルが用意してあります。これを利用すれば、アプリケーションのデザインを簡単にレベルアップできます。

## 一覧ページをテーブルとボタンに変える
resources/views/index.blade.php
```
@extends('layout')

@section('content')
    <h1>paiza bbs</h1>
    <p>{{ $message }}</p>
    <table class='table table-striped table-hover'>
        @foreach ($articles as $article)
            <tr>
                <td>
                    <a href='{{ route("article.show", ["id" =>  $article->id]) }}'>
                        {{ $article->content }}
                    </a>
                </td>
                <td>{{ $article->user_name }}</td>
            </tr>
        @endforeach
    </table>

    <div>
        <a href={{ route('article.new') }} class='btn btn-outline-primary'>新規投稿</a>
    </div>
@endsection
```

# 詳細ページのボタンを変える
resources/views/show.blade.php
```
@extends('layout')

@section('content')
    <h1>paiza bbs</h1>
    <p>{{ $message }}</p>
    <p>{{ $article->content }}</p>
    <p>{{ $article->user_name }}</p>

    <p>
        <a href={{ route('article.list') }} class='btn btn-outline-primary'>一覧に戻る</a>
    </p>
    <div>
        {{ Form::open(['method' => 'delete', 'route' => ['article.delete', $article->id]]) }}
            {{ Form::submit('削除', ['class' => 'btn btn-outline-secondary']) }}
        {{ Form::close() }}
    </div>
@endsection
```

# 05:検索フォームを設置しよう 
ここでは、1行掲示板に検索機能を追加します。そのため、記事の一覧画面に検索フォームを追加します。そして、Laravelでフォームを使うための基本的な操作を理解しましょう。

## ファサードとは
Laravelでフォームを利用するには、2重の波カッコにフォームと記述します。このような部品を、Formファサードと呼びます。
ファサード(facade）とは、建物の入り口という意味です。Laravelのファサードは、アプリケーションのサービスコンテナに登録したクラスに対するインターフェイスを提供します。

## 検索フォームのテンプレートを用意する
resources/views/search.blade.php
```
{{ Form::open(['method' => 'get']) }}
    {{ csrf_field() }}
    <div class='form-group'>
        {{ Form::label('keyword', 'キーワード:') }}
        {{ Form::text('keyword', null, ['class' => 'form-control']) }}
    </div>
    <div class='form-group'>
        {{ Form::submit('検索', ['class' => 'btn btn-outline-primary'])}}
        <a href={{ route('article.list') }}>クリア</a>
    </div>
{{ Form::close() }}
```
## 記事一覧に検索フォームを追加する
resources/views/index.blade.php
```
@extends('layout')

@section('content')
    <h1>paiza bbs</h1>
    <p>{{ $message }}</p>
    @include('search')

    <table class='table table-striped table-hover'>
        @foreach ($articles as $article)
            <tr>
                <td>{{ $article->content }}</td>
            </tr>
        @endforeach
    </table>
@endsection
```
## Form用ライブラリのインストールについて
Laravelでフォームを使用するには、「laravelcollective/html」というライブラリが必要になります。これは、ターミナルで次のコマンドを実行します。

```
$ cd bbs
$ composer require "laravelcollective/html":"^5.4.0"
```

このチャプターの環境には、このライブラリをインストール済みです。
自分の環境に、このライブライがインストールされているか確認するには、次のコマンドを実行します。
```
$ composer info
```

# 06:フォームの値を取得しよう 
ここでは、1行掲示板に検索機能を追加します。そのため、フォームから受け取った値で、該当する投稿だけを表示するよう、コントローラを修正します。

## 検索機能を追加する
app/Http/Controllers/ArticleController.php
```
public function index(Request $request)
    {
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $message = 'Welcome my BBS: ' . $keyword;
            $articles = Article::where('content', 'like', '%' . $keyword . '%')->get();
        } else {
            $message = 'Welcome my BBS';
            $articles = Article::all();
        }

        return view('index', ['message' => $message, 'articles' => $articles]);
    }
```

# 07:掲示板のルーティングを設計しよう 
ここからは、1行掲示板に投稿機能を作成していきます。まずは、掲示板に必要な機能を再確認し、そのためのルーティングを設定しましょう。

## ルーティングを記述する
routes/web.php
```
Route::get('/', function () {
    // return view('welcome');
    return redirect('/articles');
});

Route::get('/articles', 'ArticleController@index')->name('article.list');
Route::get('/article/new', 'ArticleController@create')->name('article.new');
Route::post('/article', 'ArticleController@store')->name('article.store');

Route::get('/article/edit/{id}', 'ArticleController@edit')->name('article.edit');
Route::post('/article/update/{id}', 'ArticleController@update')->name('article.update');

Route::get('/article/{id}', 'ArticleController@show')->name('article.show');
Route::delete('/article/{id}', 'ArticleController@destroy')->name('article.delete');
```

## コントローラのメソッドをテストする
app/Http/Controllers/ArticleController.php
```
public function edit(Request $request, $id, Article $article)
    {
        $message = 'Edit your article ' . $id;
        $article = Article::find($id);
        return view('show', ['message' => $message, 'article' => $article]);
    }
```

# 08:新規投稿フォームを作成しよう 
ここでは、1行掲示板の新規投稿フォームを作成します。前回のレッスンで、新規投稿を格納するcreateメソッドを作成してあるので、それに投稿フォームを組み合わせます。

## コントローラのstoreメソッドで、固定テキストを保存する
app/Http/Controllers/ArticleController.php
```
public function store(Request $request)
{
    $article = new Article;

    $article->content = 'Hello BBS';
    $article->user_name = 'paiza';
    $article->save();
    return redirect('/articles');
}
```

## createメソッドで、フォームを呼び出す
app/Http/Controllers/ArticleController.php
```
    public function create(Request $request)
    {
        $message = 'New article';
        return view('new', ['message' => $message]);
    }
```

# 09:記事の保存機能を完成させよう 
ここでは、先ほどのチャプターの続きとして、新規投稿フォームのビューを作成します。そして、新規投稿の保存機能を完成させましょう。

## 新規投稿フォームをnew.blade.phpに記述する
resources/views/new.blade.php
```
@extends('layout')

@section('content')
    <h1>paiza bbs</h1>
    <p>{{ $message }}</p>
    {{ Form::open(['route' => 'article.store']) }}
        <div class='form-group'>
            {{ Form::label('content', 'Content:') }}
            {{ Form::text('content', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('user_name', 'Name:') }}
            {{ Form::text('user_name', null) }}
        </div>
        <div class="form-group">
            {{ Form::submit('作成する', ['class' => 'btn btn-primary']) }}
            <a href={{ route('article.list') }}>一覧に戻る</a>
        </div>
    {{ Form::close() }}
@endsection
```

## 投稿内容を保存するようstoreメソッドを修正する
app/Http/Controllers/ArticleController.php
```
public function store(Request $request)
{
    $article = new Article;

    $article->content = $request->content;
    $article->user_name = $request->user_name;
    $article->save();
    return redirect()->route('article.show', ['id' => $article->id]);
}
```

# 10:編集フォームを追加しよう - その1 
ここでは、1行掲示板に、既存の投稿を修正する機能を追加します。まずは、編集フォームに既存の投稿を読み込みましょう
## コントローラに、Editを追加する
app/Http/Controllers/ArticleController.php
```
public function edit(Request $request, $id, Article $article)
    {
        $message = 'Edit your article ' . $id;
        $article = Article::find($id);
        return view('edit', ['message' => $message, 'article' => $article]);
    }
```

## 編集フォームを記述する
resources/views/edit.blade.php
```
@extends('layout')

@section('content')
    <h1>paiza bbs</h1>
    <p>{{ $message }}</p>
    {{ Form::model($article, ['route' => ['article.update', $article->id]]) }}
        <div class='form-group'>
            {{ Form::label('content', 'Content:') }}
            {{ Form::text('content', null) }}
        </div>
        <div class='form-group'>
            {{ Form::label('user_name', 'Name:') }}
            {{ Form::text('user_name', null) }}
        </div>
        <div class="form-group">
            {{ Form::submit('保存する', ['class' => 'btn btn-primary']) }}
            <a href={{ route('article.show', ['id' =>  $article->id]) }}>戻る</a>
        </div>
    {{ Form::close() }}
@endsection
```

# 11:編集フォームを追加しよう - その2 
ここでは、1行掲示板に、修正した投稿を保存する機能を追加します。そのために、修正内容を保存する機能を作成しましょう。

## コントローラに、updateを追加する
app/Http/Controllers/ArticleController.php
```
public function update(Request $request, $id, Article $article)
{
    $article = Article::find($id);
    $article->content = $request->content;
    $article->user_name = $request->user_name;
    $article->save();
    return redirect()->route('article.show', ['id' => $article->id]);
}
```

## show.blade.phpから、編集フォームにリンクする
resources/views/show.blade.php
```
@extends('layout')

@section('content')
    <h1>paiza bbs</h1>
    <p>{{ $article->content }}</p>
    <p>{{ $article->user_name }}</p>

    <p>
        <a href={{ route('article.list') }} class='btn btn-outline-primary'>一覧に戻る</a>
        <a href={{ route('article.edit', ["id" =>  $article->id]) }} class='btn btn-outline-primary'>編集</a>
    </p>
    <div>
        {{ Form::open(['method' => 'delete', 'route' => ['article.delete', $article->id]]) }}
            {{ Form::submit('削除', ['class' => 'btn btn-outline-secondary']) }}
        {{ Form::close() }}
    </div>
@endsection
```
