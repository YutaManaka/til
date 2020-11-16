# 01:Webアプリの初歩を理解しよう

## ここで学ぶ基本動作
- ルーティング：Webブラウザからのリクエストに合わせて、呼び出す処理を切り替える
- テンプレート：アプリケーションが保持するデータなどをHTMLのひな型と組み合わせてWebページを生成する

## PHPによるWEBアプリケーション開発の特徴
- Webサーバ上で動作
- Webページを動的に生成
- HTMLに埋め込んで、Webページとして表示

# 02:PHPでWebページを出力しよう
ここでは、PHPを使ってWebアプリケーションを作る準備をします。そのために、PHPでブラウザに簡単なメッセージを出力します。

## PHPのバージョンを確認する

```
$ php -v
```

## PHPでメッセージを表示する
public_html/index.phpに下記のコードを入力。
PHPしか書き込まない場合は、閉じタグを記入する必要なし。

```
<?php
  // Open https://localhost/~ubuntu/index.php
  echo '<h1>Hello ' . 'PHP</h1>';
  echo '<p>世界の皆さん、こんにちは</p>';
```

## プログラムを実行する
PHPのプログラムを実行するには、サーバーに次のアドレスでアクセスする
https://localhost/~ubuntu/index.php

# 03:URLとプログラムの関係を理解しよう
ここでは、Webアプリケーションを呼び出すURLとプログラムの関係について学習します。ルーティングは、Webアプリケーションの基礎技術のひとつですが、PHPでは、ファイルベースのルーティングで、呼び出す処理を切り替えます。

## 別のルートを追加する

public_html/index2.phpに下記のコードを入力。
```
<?php
  // Open https://localhost/~ubuntu/index2.php
  echo "<h1>Hello " . "PHP</h1>";
  echo "<p>よろしくお願いします</p>";
```

ファイルを追加すると、そのファイル名でプログラムを呼び出すことができる。

http://localhost/~ubuntu/index2.php

## URLを取得する
public_html/index2.php
```
<?php
  // Open https://localhost/~ubuntu/index2.php
  echo "<h1>Hello " . "PHP</h1>";
  echo "<p>よろしくお願いします</p>";
  echo '<p>' . $_SERVER['REQUEST_URI'] . '</p>';
```

# 04:テンプレートを表示しよう
ここでは、もう少し複雑なWebページを表示するため、プログラムの中から、別のphpファイルを読み込みます。そして、このファイルをテンプレートにすることで、プログラムの処理やデータと見た目を分離します。

## require_once について
require_once(リクワイア ワンス)は、プログラムファイルを読み込む命令です。読み込んだファイルをコードとして実行します。ワンスと付いているので、一度だけ読み込みます。
読み込むファイルの拡張子は、何でもいいのですが、今回はPHPのコードを含んだファイルを読み込むので、phpという拡張子にしています。

## テンプレートを呼び出す
public_html/index.php
```
<?php
  // Open https://localhost/~ubuntu/index.php
  echo "<h1>Hello " . "PHP</h1>";
  require_once 'views/content.tpl.php';
```
## テンプレートを記述する
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='utf-8'>
        <title>PHP-Web - paiza</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>Hello templates</h1>
    </body>
</html>
```

# 05:テンプレートでデータを利用しよう 
ここでは、PHPの複数のコードファイルで共通のデータを利用してみましょう。処理と見た目を分離した時、処理プログラムの変数を表示プログラムで利用します。

## テンプレートで利用するデータを用意する
public_html/index.php
```
<?php
  // Open https://localhost/~ubuntu/index.php
  $name = 'PHP';
  $message = '世界の皆さん、こんにちは';
  require_once 'views/content.tpl.php';
```

## テンプレートでデータを表示する
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <head>
        <meta charset='utf-8'>
        <title>PHP-Web - paiza</title>
        <style>body {padding: 10px;}</style>
    </head>
    <body>
        <h1>Hello templates</h1>
        <p>This is <?= $name ?></p>
        <p><?= $message ?></p>
    </body>
</html>
```

# 06:RPGの戦闘シーンを表現しよう 
ここでは、PHPでテンプレートを使う具体例として、RPGの戦闘シーンプログラムを作ります。コード側で用意した配列を、テンプレート側でループを使って出力してみましょう。

## 配列を渡すコード
public_html/index.php
```
<?php
    $name = 'paiza';
    $message = '世界の皆さん、こんにちは';
    $players = ['勇者', '戦士', '魔法使い'];
    require_once 'views/content.tpl.php';
```

## ループで配列を出力するテンプレート
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <head>
      <meta charset='utf-8'>
      <title>PHP-Web - paiza</title>
      <style>body {padding: 10px;}</style>
    </head>
    <body>
      <h1>Hello templates</h1>
      <p>This is <?= $name ?></p>
      <p><?= $message ?></p>
      <?php foreach ($players as $player) { ?>
        <p><?= $player ?>はモンスターと戦った</p>
      <?php } ?>
    </body>
</html>
```

# 07:テンプレートの共通部分を分割しよう 
ここでは、テンプレートの共通部分を分離する方法について学習します。PHPのinclude命令を使って、Webアプリケーションに共通のテンプレートを設置してみましょう。

## requireとincludeの違い
- requireは、エラーがあった場合、全ての処理を停止
- includeは、エラーがあった場合、そのまま処理を続ける

## 共通テンプレートとして、ヘッダーファイルを定義する
public_html/views/header.inc.php
```
<head>
    <meta charset='utf-8'>
    <title>PHP-Web - paiza</title>
    <style>body {padding: 10px;}</style>
</head>
```

## 共通テンプレートとして、フッターファイルを定義する
public_html/views/footer.inc.php
```
<hr>
<footer>by paiza</footer>
```

##  個別テンプレートから共通テンプレートを呼び出す
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>
        <h1>Hello templates</h1>
        <p>This is <?= $name ?></p>
        <p><?= $message ?></p>
        <?php foreach ($players as $player) { ?>
            <p><?= $player ?>はモンスターと戦った</p>
        <?php } ?>
        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 08:RPGの行動選択メニューを作ろう1 
ここでは、PHPによるWebアプリの具体例として、RPGの行動選択メニューを作ります。RPGのプレーヤーが、歩いたり、戦ったりするメニューを作りましょう。

## RPGの行動選択メニュー
public_html/player_menu.php
```
<?php
    $player = '勇者';
    require_once 'views/menu.tpl.php';
```

## メニューテンプレート
public_html/views/menu.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>
        <h1><?= $player . 'のメニュー' ?></h1>
        <p><a href='walk.php'>あるく</a></p>
        <p><a href='attack.php'>たたかう</a></p>
        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 09:RPGの行動選択メニューを作ろう2 
ここでは、先ほどのチャプターの続きとして、RPGの行動選択メニューを作ります。すでに、メニューページを作ったので、今度は具体的なアクション部分を作成しましょう。

## RPGの行動選択メニュー
public_html/player_menu.php
```
<?php
    $player = '勇者';
    require_once 'views/menu.tpl.php';
```

## 「あるく」を呼び出す
public_html/walk.php
```
<?php
    $player = '勇者';
    $message = $player . 'は荒野を歩いていた';
    require_once 'views/action.tpl.php';
```

## 「たたかう」を呼び出す
public_html/attack.php
```
<?php
    $player = '勇者';
    $message = $player . 'はモンスターと戦った';
    require_once 'views/action.tpl.php';
```

## メニューテンプレート
public_html/views/menu.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>
        <h1><?= $player . 'のメニュー' ?></h1>
        <p><a href='walk.php'>あるく</a></p>
        <p><a href='attack.php'>たたかう</a></p>
        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

##  アクションテンプレート
public_html/views/action.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>
        <h1><?= $player . 'のアクション' ?></h1>
        <p><?= $message ?></p>
        <p><a href='player_menu.php'>もどる</a></p>
        <?php include('footer.inc.php'); ?>
    </body>
</html>
```
