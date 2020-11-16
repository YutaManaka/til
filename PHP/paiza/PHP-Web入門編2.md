# 02:投稿フォームを作ろう 
ここでは、PHPのテンプレートを使って、簡単な投稿フォームを作ってみましょう。

## フォームを表示するコード
public_html/form.php
```
<?php
    $message = 'Hello World';
    require_once 'views/form.tpl.php';
```

## フォームを表示するテンプレート
public_html/views/form.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>フォーム</h1>
        <p><?= $message ?></p>

        <form action='result.php' method='post'>
            <label for='article'>投稿</label>
            <input type='text' name='article'>
            <p></p>
            <label for='name'>名前</label>
            <input type='text' name='name'>
            <button type='submit'>送信する</button>
        </form>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 03:投稿したデータを表示しよう 
ここでは、WebサーバーとWebブラウザのデータ転送方式であるGETメソッドとPOSTメソッドについて学習します。そして、フォームから送信したデータをサーバー側で処理してみましょう。

## フォームのデータを処理するコード
- htmlspecialcharsとは https://www.php.net/manual/ja/function.htmlspecialchars.php
- $_REQUESTとは https://www.php.net/manual/ja/reserved.variables.request.php
public_html/result.php
```
<?php
    $message = 'This is paiza';

    $article = htmlspecialchars($_REQUEST['article']);
    $name = htmlspecialchars($_REQUEST['name']);

    require_once 'views/form.tpl.php';
```

## フォームを表示するテンプレート
- issetとは https://www.php.net/manual/ja/function.isset.php

public_html/views/form.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>フォーム</h1>
	      <p><?= $message ?></p>

        <form action='result.php' method='post'>
            <label for='article'>投稿</label>
            <input type='text' name='article'>
            <p></p>
            <label for='name'>名前</label>
            <input type='text' name='name'>
            <button type='submit'>送信する</button>
        </form>

        <p>
            <?php
                if(isset($article)) {
                    echo $article . ', ';
                }

                echo ' ';

                if(isset($name)) {
                    echo $name;
                }
            ?>
        </p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 04:フォームを使ってRPGの戦闘シーンを作ろう1 
ここでは、先ほどのフォームを利用して、フォームの動作を確認します。そして、フォームからGETメソッドを送信して、どのようにフォームとコードがデータをやり取りするか、さらに理解しましょう。

## POSTメソッドとGETメソッドの使い分け
- POST:アドレスにフォームの入力内容が表示されない→パスワードの入力
- GET:アドレスにフォームの入力内容が表示される→検索キーワード

## フォームのデータを取り出すコード
public_html/result.php
```
<?php
    $message = 'This is paiza';

    $article = htmlspecialchars($_REQUEST['article']);
    $name = htmlspecialchars($_REQUEST['name']);

    require_once 'views/form.tpl.php';
```

## GETメソッドのフォーム
public_html/views/form.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>フォーム</h1>
        <p><?= $message ?></p>

        <form action='result.php' method='get'>
            <label for='article'>投稿</label>
            <input type='text' name='article'>
            <p></p>
            <label for='name'>名前</label>
            <input type='text' name='name'>
            <button type='submit'>送信する</button>
        </form>
				
        <p>
            <?php
                if(isset($article)) {
                    echo $article . ', ';
                }

                if(isset($name)) {
                    echo $name;
                }
            ?>
        </p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 05:フォームを使ってRPGの戦闘シーンを作ろう2 
ここでは、PHPによるフォームの具体例として、RPGの戦闘シーンを作ります。先ほどのチャプターで作ったフォームをベースにして、ドロップダウンメニューでプレイヤーを選択できるようにしましょう。

## RPGの戦闘シーン(コード)
public_html/battle.php
```
<?php
    $players = ['勇者', '戦士', '魔法使い'];

    if(isset($_REQUEST['name'])) {
        $message = htmlspecialchars($_REQUEST['name']) . 'はモンスターと戦った';
    } else {
        $message = 'あらたなモンスターがあらわれた！';
    }

    require_once 'views/battle.tpl.php';
```

# RPGの戦闘シーン(テンプレート)
public_html/views/battle.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>RPGの戦闘フォーム</h1>
        <p><?= $message ?></p>

        <form action='battle.php' method='post'>
            <label for='name'>プレイヤー</label>
            <select name='name'>
                <?php foreach ($players as $player) { ?>
                    <option value='<?= $player ?>'>
                        <?= $player ?>
                    </option>
                <?php } ?>
            </select>
            <p></p>
            <button type='submit'>たたかう</button>
        </form>

        <form action='battle.php' method='get'>
            <button type='submit'>にげる！</button>
        </form>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 06:1行掲示板を作ろう - 投稿したデータを表示する 
ここでは、数回に渡って、PHPを使ったWebアプリケーションの具体例として、簡単な1行掲示板を作成します。まずは、投稿内容を記録したテキストファイルから、データを表示してみましょう。

## 投稿一覧のダミーデータ
末尾を改行しておく。

public_html/articles.txt
```
Hello World,paiza
Hello Ruby,paiza
Hello Sinatra,paiza
世界の皆さんコンニチハ,霧島
にゃー,ネコ
```

## 投稿一覧を読み込むコード
- file関数とは https://www.php.net/manual/ja/function.file.php
public_html/bbs.php
```
<?php
    $message = 'Hello World';

    $lines = file(__DIR__ . '/articles.txt', FILE_IGNORE_NEW_LINES);

    require_once 'views/bbs.tpl.php';
```

## 投稿一覧を表示するテンプレート
public_html/views/bbs.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>1行掲示板</h1>
        <p><?= $message ?></p>

        <form action='result.php' method='post'>
            <label for='article'>投稿</label>
            <input type='text' name='article'>
            <p></p>
            <label for='name'>名前</label>
            <input type='text' name='name'>
            <button type='submit'>送信する</button>
        </form>
        <p>
            <?php
                if(isset($article)) {
                    echo $article . ', ';
                }

                if(isset($name)) {
                    echo $name;
                }
            ?>
        </p>

        <h2>投稿一覧</h2>

        <?php foreach ($lines as $line) { ?>
            <p><?= $line ?></p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 07:1行掲示板を作ろう - 投稿内容を表示する 
PHPを使ったWebアプリケーションの具体例として、簡単な1行掲示板を作成します。先ほどに続いて、投稿内容を受け取って表示する機能を作成してみましょう。

## 投稿内容を表示するコード
public_html/result.php
```
<?php
    $message = 'This is paiza';

    $article = htmlspecialchars($_REQUEST['article']);
    $name = htmlspecialchars($_REQUEST['name']);

    require_once 'views/result.tpl.php';
```

## 投稿結果を表示するテンプレート
public_html/views/result.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>書き込みました</h1>
        <p><?= $message ?></p>

        <p>
            <?php
                if(isset($article)) {
                    echo $article . ', ';
                }

                if(isset($name)) {
                    echo $name;
                }
            ?>
        </p>

        <form action='bbs.php' method='get'>
            <button type='submit'>戻る</button>
        </form>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 08:1行掲示板を作ろう - 投稿をファイルに保存する 
ここでは、数回に渡って、PHPを使ったWebアプリケーションの具体例として、簡単な1行掲示板を作成します。いよいよ、投稿をファイルに保存する機能を作成してみましょう。

##  投稿結果を書き込むコード
- PHP_EOLとは https://tadtadya.com/php-new-line-php-eol/
- file_put_contentsとは https://www.php.net/manual/ja/function.file-put-contents.php

public_html/result.php
```
<?php
    $message = 'This is paiza';

    $article = htmlspecialchars($_REQUEST['article']);
    $name = htmlspecialchars($_REQUEST['name']);

    $line = $article . ',' . $name . PHP_EOL;
    file_put_contents(__DIR__ . '/articles.txt', $line, FILE_APPEND | LOCK_EX);

    require_once 'views/result.tpl.php';
```

## 書き込み許可を与える
```
cd public_html
chmod -v a+w articles.txt
```

## 投稿結果を表示するテンプレート
public_html/views/result.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>書き込みました</h1>
        <p><?= $message ?></p>

        <p>
            <?php
                if(isset($article)) {
                    echo $article . ', ';
                }

                if(isset($name)) {
                    echo $name;
                }
            ?>
        </p>

        <form action='bbs.php' method='get'>
            <button type='submit'>戻る</button>
        </form>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```
