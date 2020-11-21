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

