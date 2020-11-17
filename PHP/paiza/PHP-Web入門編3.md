# 01:PHPでデータベースに接続しよう 
ここでは、PHPからSQLを実行する基本的な操作手順を学習します。

## PHPで、データベースからデータを取り出す
public_html/sql.php

- PDOとは https://www.php.net/manual/ja/class.pdo.php
- fetchメソッド https://www.php.net/manual/ja/pdostatement.fetch.php
- echoとprintの違い https://www.it-swarm-ja.tech/ja/php/php%E3%81%AEecho%E3%80%81print%E3%80%81printr%E3%81%AE%E9%81%95%E3%81%84%E3%81%AF%E4%BD%95%E3%81%A7%E3%81%99%E3%81%8B%EF%BC%9F/968854098/
```
<?php
    //PDOを用いてデータベースに接続
    $pdo = new PDO('mysql:host=localhost; dbname=mydb; charset=utf8','root','');
    
    //sql変数にSQL文を代入
    $sql = 'SELECT * FROM players';
    
    //sqlステートメントをprepareメソッドで準備
    $statement = $pdo->prepare($sql);
    
    //executeメソッドでSQLを実行
    $statement->execute();

    //fetchメソッドでカラム名で添字を付けた配列を返す。
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
		print_r($row);
		echo('<br>');
	}

    $statement = null;
    $pdo = null;
```

# 02:テンプレートでデータを表示しよう 
ここでは、MySQLから読み込んだデータをテンプレートでを使って表示します。テンプレートで表示できるようになれば、データベースの処理コードと見た目を分離して、プログラムを分かりやすくできます。

## PHPで、データベースのデータを取り出すコード
public_html/sql.php
```
<?php

    $pdo = new PDO('mysql:host=localhost; dbname=mydb; charset=utf8','root','');

    $sql = 'SELECT * FROM players';
    $statement = $pdo->prepare($sql);
    $statement->execute();

    $results = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $results[] = $row;
    }

    $statement = null;
    $pdo = null;

    $message = 'hello world';
    require_once 'views/content.tpl.php';
```

## データベースのデータを表示するテンプレート
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <?php foreach ($results as $player) { ?>
            <p><?php print_r($player); ?></p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 03:データベースを使ってみよう - 取り出し 
ここでは、初歩的なSQL文を作成して、サンプルデータベースの中身を見ていきます。PHPとSQLを使って、mydbデータベースの「players」テーブルから色々な方法でデータを取り出しましょう。

##  PHPで、データベースのデータを取り出すコード
public_html/sql.php
- bindValueメソッド https://www.php.net/manual/ja/pdostatement.bindvalue.php

```
<?php

    $pdo = new PDO('mysql:host=localhost; dbname=mydb; charset=utf8','root','');

    $sql = 'SELECT * FROM players WHERE level >= :lower';
    $statement = $pdo->prepare($sql);
    $low_value = 7;
    $statement->bindValue(':lower', $low_value, PDO::PARAM_INT);
    $statement->execute();

    $results = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $results[] = $row;
    }

    $statement = null;
    $pdo = null;

    $message = 'hello world';
    require_once 'views/content.tpl.php';
```

## データベースのデータを表示するテンプレート
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <?php foreach ($results as $player) { ?>
            <p><?php print_r($player); ?></p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 04:データベースを使ってみよう - 追加、更新、削除 
ここでは、データベースにデータを追加・更新・削除する方法を学んでいきます。この機能を使うことで、例えば、RPGのプレイヤーに新しいメンバーを追加したり、名前を変更したり、削除したりできます。

## PHPで、データベースのデータを取り出すコード
public_html/sql.php
```
<?php

    $pdo = new PDO('mysql:host=localhost; dbname=mydb; charset=utf8','root','');

    $sql = 'SELECT * FROM players WHERE level >= :lower';
    $statement = $pdo->prepare($sql);
    $low_value = 7;
    $statement->bindValue(':lower', $low_value, PDO::PARAM_INT);
    $statement->execute();

    $results = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $results[] = $row;
    }

    $statement = null;
    $pdo = null;

    $message = 'hello world';
    require_once 'views/content.tpl.php';
```

## データベースのデータを表示するテンプレート
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <?php foreach ($results as $player) { ?>
            <p><?php print_r($player); ?></p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```
##  SQL文の例
```
# データを追加する
$name = '霧島1号';
$level = 1;
$job_id = 1;
$sql = 'INSERT INTO players (name, level, job_id) VALUES (:name, :level, :job_id)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':name', $name, PDO::PARAM_STR);
$statement->bindValue(':level', $level, PDO::PARAM_INT);
$statement->bindValue(':job_id', $job_id, PDO::PARAM_INT);
$statement->execute();

# データを更新する
UPDATE players SET level = 10 WHERE id = 11

# データを更新する。1増加
UPDATE players SET level = level + 1 WHERE id = 11

# データを削除する
DELETE FROM players WHERE id = 11

# 複数のデータを削除する
DELETE FROM players WHERE id >= 11
```

