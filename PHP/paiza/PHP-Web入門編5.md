# 01:PHPとEloquentで作るmarkdownメモ帳アプリ 
ここでは、どのようなメモ帳アプリを開発するのか、その概要を整理します。PHPとデータベースを操作するEloquentを利用することで、機能の充実したWebアプリケーションを効率よく開発します。

## メモ帳アプリを作成する流れ
- データベースを用意する
- データベースに接続して、メモ一覧を表示する
- メモを表示する
- markdownで表示する
- 新規メモを作する
- メモを保存・削除する
- メモを編集・保存する

# 02:データベースを用意する 
ここでは、メモ帳アプリに必要なデータベースを準備します。phpMyAdminを使って、データベースを作成して、サンプルデータを登録しましょう。

## メモ帳アプリのサンプルデータを作成するSQL
public_html/memo.sql
```
CREATE TABLE notes (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  title VARCHAR(255),
  content TEXT
);

INSERT INTO notes(title,content)
  VALUES
  ('hello world','hello world'),
  ('hello PHP','hello PHP'),
  ('hello Eloquent','hello Eloquent'),
  ('markdownメモ','# 世界の皆さん、こんにちは。\n\nよろしくお願いします。\n\n## 本日のお買い得\n\n- apple\n- orange\n- jucie');
```

## データベースの接続するためのコード
publih_html/db_connect.php
```
<?php

    require_once './vendor/autoload.php';
    use Illuminate\Database\Capsule\Manager as Capsule;
    use Illuminate\Database\Eloquent\Model as Model;

    $db = new Capsule;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'database'  => 'memo',
        'username'  => 'root',
        'password'  => ''
    ]);

    $db->setAsGlobal();
    $db->bootEloquent();

    class Note extends Model {

    }
```

# 03:メモ一覧を表示しよう 
ここでは、メモ帳のサンプルデータを一覧表示する機能を作ります。PHPとEloquentを使って、データベースに接続して、テンプレートで表示してみましょう。

## メモ帳一覧を読み込むするコード
publih_html/index.php
```
<?php

    require_once 'db_connect.php';

    $message = 'Hello World';
    $notes = Note::all();

    require_once 'views/index.tpl.php';
```

## メモ帳一覧を表示するテンプレート
publih_html/views/index.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
        <body>

            <h1><?= $message ?></h1>

            <table>
                <tr><th>Id</th><th>タイトル</th></tr>
                <?php foreach ($notes as $note) { ?>
                    <tr>
                        <td><?= $note->id ?></td>
                        <td><?= $note->title ?></td>
                    </tr>
                <?php } ?>
            </table>
            <p>新規メモ</p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 04:メモを表示しよう 
ここでは、選択したメモを個別に表示する機能を作成します。「show.php」でアクセスした時、指定したメモの詳細情報を表示しましょう。

## メモを個別に読み込むコード
publih_html/show.php
```
<?php

    require_once 'db_connect.php';

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $message = 'Show note #' . $id;
        $note = Note::find($id);
    }

    require_once 'views/show.tpl.php';
```

## 個別のメモを表示するテンプレート
publih_html/views/show.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <p>タイトル:<?= $note->title ?></p>
        <p><?= $note->content ?></p>

        <p><a href='index.php'>一覧に戻る</a> | 編集 | 削除</p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

## メモ一覧のテンプレート
個別メモを呼び出すリンクを追加

publih_html/views/index.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>paiza memo</h1>
        <p><?=$message?></p>

        <table>
            <tr><th>Id</th><th>タイトル</th></tr>
            <?php foreach ($notes as $note) { ?>
                <tr>
                    <td><?= $note->id ?></td>
                    <td>
                        <a href='show.php?id=<?=$note->id?>'>
                            <?=$note->title?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <p>新規メモ</p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 05:Markdownで表示しよう 
ここでは、Markdownで記述したメモの内容を、HTMLで表示できるようにします。そのために、「php-markdown」というMarkdown変換ライブラリを使ってみましょう。Markdownは、見出しや箇条書きなど、文章の見た目をテキストで表現できる簡易記法で、ソフトウェアエンジニアの間で、広く使われています。

## php-markdownのインストール
PHP用のパッケージ管理ツールcomposerを使用してインストールする。

```
$ cd public_html
$ composer require michelf/php-markdown
```

読み込んだphp-markdownは、db_require.phpで、vendor/autoload.phpをrequire_onceすることで、利用可能になります。

## Markdownに変換するコード
publih_html/show.php
```
<?php

    require_once 'db_connect.php';

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $message = 'Show note #' . $id;
        $note = Note::find($id);
    }

    $my_html = Michelf\Markdown::defaultTransform($note->content);

    require_once 'views/show.tpl.php';
```

## Markdownを表示するテンプレート
publih_html/views/show.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <p>タイトル:<?= $note->title ?></p>
        <div><?= $my_html ?></div>

        <p><a href='index.php'>一覧に戻る</a> | 編集 | 削除</p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 06:新規メモを作ろう 
ここでは、メモを新規作成する画面を作ります。一覧画面から「new.php」でアクセスしたら、メモの作成フォームを表示しましょう。

## メモの作成画面を呼び出すコード
public_html/new.php
```
<?php

    $message = 'New note';
    require_once 'views/new.tpl.php';
```

## メモ作成のフォームテンプレート
publih_html/views/new.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <form action='create.php' method='post'>
            <label for='title'>タイトル</label><br>
            <input type='text' name='title' >
            <p></p>
            <label for='content'>本文</label><br>
            <textarea name='content' cols='40' rows='10'></textarea>
            <p></p>
            <button type='submit'>作成する</button>
        </form>

        <p><a href='index.php'>一覧に戻る</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

## メモ一覧からリンクする
publih_html/views/index.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1>paiza memo</h1>
        <p><?=$message?></p>

        <table>
            <tr><th>Id</th><th>タイトル</th></tr>
            <?php foreach ($notes as $note) { ?>
                <tr>
                    <td><?= $note->id ?></td>
                    <td>
                        <a href='show.php?id=<?=$note->id?>'>
                            <?=$note->title?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <p><a href='new.php'>新規メモ</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 07:新規メモを保存しよう 
ここでは、新しいメモを保存する機能を作ります。新規画面で「create.php」を呼び出してデータベースに保存しましょう。また、詳細画面で「destroy.php」にアクセスしたら、そのメモを削除します。

## 新規メモを保存するコード
public_html/create.php
```
<?php

    require_once 'db_connect.php';

    $note = new Note;
    $note->title = $_REQUEST['title'];
    $note->content = $_REQUEST['content'];
    $note->save();

    header('Location: show.php?id=' . $note->id);
    exit;
```

## 指定メモを削除するコード
public_html/destroy.php
```
<?php

    require_once 'db_connect.php';

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $note = Note::find($id);
        $note->delete();
    }

    header('Location: index.php');
    exit;
```

# 削除リンクを追加した詳細画面
public_html/views/show.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <p>タイトル:<?= $note->title ?></p>
        <p><?= $note->content ?></p>

        <p><a href='index.php'>一覧に戻る</a> | 編集 | <a href='destroy.php?id=<?= $note->id ?>'>削除</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 08:メモを編集しよう 
ここでは、メモの編集機能を作ります。「edit.php」でアクセスしたら、指定したメモの内容を編集フォームで表示します。

## 編集フォームを呼び出すコード
public_html/edit.php
```
<?php

    require_once 'db_connect.php';

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $message = 'Edit note #' . $id;
        $note = Note::find($id);
    }

    require_once 'views/edit.tpl.php';
```

## 編集フォームのテンプレート
publih_html/views/edit.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <form action='update.php' method='post'>
    		<input type='hidden' name='id' value="<?= $note['id'] ?>">
            <label for='title'>タイトル</label><br>
            <input type="text" name="title" value="<?= $note['title'] ?>">
            <p></p>
            <label for='content'>本文</label><br>
            <textarea name='content' cols='40' rows='10'><?= $note['content'] ?></textarea>
            <p></p>
            <button type='submit'>保存する</button>
        </form>

        <p><a href='index.php'>一覧に戻る</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

## 編集フォームを呼び出す詳細画面
public_html/views/show.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <p>タイトル:<?= $note->title ?></p>
        <p><?= $note->content ?></p>

        <p><a href='index.php'>一覧に戻る</a> | <a href="edit.php?id=<?= $note->id ?>">編集</a> | <a href='destroy.php?id=<?= $note->id ?>'>削除</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 09:編集したメモを保存しよう 
ここでは、編集したメモを保存する機能を作ります。指定したメモを編集フォームで修正したら、その内容を「update.php」でデータベースに保存します。

## 編集したメモを保存するコード
public_html/update.php
```
<?php

    require_once 'db_connect.php';

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $note = Note::find($id);
        $note->title = $_REQUEST['title'];
        $note->content = $_REQUEST['content'];
        $note->save();
    }

    header('Location: show.php?id=' . $note->id);
    exit;
```
