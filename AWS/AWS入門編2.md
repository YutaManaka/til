＃01:LAMP環境を理解しよう
## LAMPとは
LAMP(ランプ)とは、Webアプリケーションの実行環境の組み合わせです。
Webアプリケーションの実行環境では、ふつう、OSとWebサーバー、データベース、スクリプト言語を組み合わせて利用します。
中でもLAMPは、Webサービスがはやり始めたころからある、オーソドックスな組み合わせです。OSにLinux(リナックス)、WebサーバにApache(アパッチ)、データベースにMySQL(マイエスキューエル)、スクリプト言語にPHP(ピーエイチピー)という組み合わせを、その頭文字をとって、LAMP(ランプ)と呼びます。

## LAMP構築の手順
1. PHPをインストールする
2. MySQLをインストールする
3. サンプル掲示板を設置する
4. HTMLベースで改良する
5. PHPベースで改良する
6. PHPベースで改良する

＃02:PHPをインストールしよう

## PHPインストール手順
1. Webサーバーの動作確認
2. SSHでログインする
3. 管理者権限に切り替える
4. サーバの時間設定(UTCからJST)
5. PHPのインストール
6. PHPの設定
7. Apacheの再起動
8. PHPの動作確認

sshコマンドでログイン

$ ssh -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP)


管理者権限に切り替える
$$ sudo su


時刻の確認
## date


ローカルタイムの設定
## ln -sf /usr/share/zoneinfo/Japan /etc/localtime


PHPをインストール
## yum install -y php


PHP設定ファイルのバックアップ
## cp /etc/php.ini /etc/php.bak


Apacheの再起動
## service httpd restart


※記号の意味
コマンドをローカル環境で実行
$ (コマンド)

コマンドをLinux仮想マシンで実行
$$ (コマンド)

コマンドをLinux仮想マシンで管理者権限で実行
## (コマンド)

＃03:PHPの動作確認をしよう

## 設定ファイルのバックアップと復帰方法
設定ファイルを変更する場合、事前にバックアップを取っておくと安心です。バックアップを取っておけば、もしも変更を間違えた場合も、すぐに復帰させることができます。


バックアップを取るには、次のように、ターミナルでファイルをコピーしておきます。「cp」コマンドは、ファイルをコピーするコマンドです。


# cp (元々のファイル名) (バックアップファイル名)


例えば、PHPの設定ファイルをバックアップするには、次のコマンドを実行します。

# cp /etc/php.ini /etc/php.bak



バックアップを復帰させるには、次のように、バックアップファイルを元のファイルに上書きします。

# cp (バックアップファイル名) (元々のファイル名)


例えば、PHPの設定ファイルのバックアップを復帰させるには、次のコマンドを実行します。

# cp /etc/php.bak /etc/php.ini

## PHPの設定変更
phpの設定ファイルを編集
# vi /etc/php.ini

行番号を表示
:set number

指定行に移動
:520

「& ~E_NOTICE」を追加

error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE


OffからOnへ
display_errors = On

Apacheを再起動
# service httpd restart

PHPの動作確認
# vi /var/www/html/index.php

下記の内容を記載して保存
<?php
echo "hello PHP!";
?>

ブラウザ上でhttp://パブリックIP/index.phpが表示されていてばOK

＃04:MySQLのインストール
## MySQLのインストール手順
1. MySQLのインストール
2. MySQLの起動
3. MySQLの設定
4. 文字コードの設定
5. phpMyAdminのインストール
6. phpMyadminの設定
7. phpMyadminの動作確認

sshコマンドでログイン

$ ssh -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP)


管理者権限に切り替える
$$ sudo su


MySQLのインストール
## yum install -y mysql-server

※インストールできなかった場合は、下記記事を参考
https://qiita.com/riekure/items/d667c707e8ca496f88e6


追加プログラム(PHPのMySQLネイティブドライバ)のインストール
## yum install -y php-mysqlnd


MySQLの起動
## service mysqld start


MySQLの設定
## mysql_secure_installation

※パスワード関係でエラーコードが出た場合は下記記事参照
https://hacknote.jp/archives/27301/
ai)kuRH%h08a


MySQLの文字コード設定のために、設定ファイルを開く
## vi /etc/my.cnf


MySQLの再起動
## service mysqld restart


※記号の意味
コマンドをローカル環境で実行
$ (コマンド)

コマンドをLinux仮想マシンで実行
$$ (コマンド)

コマンドをLinux仮想マシンで管理者権限で実行
## (コマンド)

## MySQLの文字コード設定
character-set-server = utf8

＃05:phpMyAdminのインストール
phpMyAdminのダウンロード先を追加

## yum-config-manager --enable epel


phpMyAdminのインストール
## yum install -y phpmyadmin

※エラーが出た場合は書き記事参照
https://www.acrovision.jp/service/aws/?p=1884

phpMyAdminの設定(アクセス制限) のために、設定ファイルを開く
## vi /etc/httpd/conf.d/phpMyAdmin.conf


Apacheの再起動
## service httpd restart


※記号の意味
コマンドをローカル環境で実行
$ (コマンド)

コマンドをLinux仮想マシンで実行
$$ (コマンド)

コマンドをLinux仮想マシンで管理者権限で実行
## (コマンド)

## phpMyAdminの利用
http://(WebサーバーのグローバルIPアドレス)/phpmyadmin

＃06:掲示板を設置しよう
1. MySQL上にデータベースを作成
2. テーブルを作成する
3. カラムを作成する
4. bbs.phpをダウンロードする
5. bbs.phpをアップロードする
6. 動作確認

## データベースの作成情報
データベース
DB名: lesson
照合順序: utf8_general_ci

テーブルの定義
テーブル名: bbs
カラム数: 3

カラムの定義
名前: id, データ型: INT, インデックス: PRIMARY, A_I: オン
名前: content, データ型: TEXT
名前: updated_at, データ型: DATETIME
照合順序: utf8_general_ci

ファイルの転送

$ scp -i ~/.ssh/FirstKey.pem ~/Desktop/bbs.php ec2-user@(パブリックIP):/var/www/html



※記号の意味
コマンドをローカル環境で実行
$ (コマンド)

＃07:HTMLを改良しよう

## HTMLの変更
1. 見出し１のテキストを変更
2. 見出し２のテキストを変更
3. 背景色を変更
4. Bootstrap CDNを適用

<!-- bootstrap CDN -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

＃08:PHPを改良しよう
#PHPの変更
1. 行番号を追加
2. 交互に色を変える

行番号を追加


// 取得したデータをテーブルで表示
?>
<table class="table">
<tr>
  <th>No.</th>
  <th>日時</th>
  <th>投稿内容</th>
</tr>
<?php
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
  $i++;
?>
<tr>
  <td><?php echo "$i"; ?></td>
  <td><?php echo "$row[updated_at]"; ?></td>
  <td><?php echo "$row[content]"; ?></td>
</tr>
<?php
}
?>



交互に色を変える

// 取得したデータをテーブルで表示
?>
<table class="table">
  <tr>
    <th>No.</th>
    <th>日時</th>
    <th>投稿内容</th>
  </tr>
<?php
  while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    $i++;
    if ($i % 2 == 1) {
?>
  <tr bgcolor="#cccccc">
<?php
  } else {
?>
 <tr>
<?php
  }
?>
    <td><?php echo "$i"; ?></td>
    <td><?php echo "$row[updated_at]"; ?></td>
    <td><?php echo "$row[content]"; ?></td>
 </tr>
<?php
  }
?>
</table>

＃09:DBを改良しよう - 投稿の削除
## データベースの修正手順
1. デバッグ用にidを表示
2. 削除ボタンを追加
3. 削除ボタンで送信されたidを表示
4. 受信したidのデータを削除
5. デバッグ用コードをコメントアウト

送信されたid

// 変数の設定
$content = $_POST["content"];
$delete_id = $_POST["delete_id"];


データを削除する
// データベースのデータの削除
$sql = "DELETE FROM bbs WHERE id = :delete_id;";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(":delete_id", $delete_id, PDO::PARAM_INT);
$stmt -> execute();


発言リストのテーブル
// 取得したデータをテーブルで表示
// echo "del_id:".$delete_id;
?>
<table class="table">
    <tr>
        <th>No.</th>
        <!-- <th>id</th> -->
        <th>日時</th>
        <th>投稿内容</th>
    </tr>
<?php
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    $i++;
    if ($i % 2 == 1) {
?>
    <tr bgcolor="#cccccc">
<?php
  } else {
?>
    <tr>
<?php
  }
?>
    <td><?php echo "$i"; ?></td>
    <!-- <td><?php // echo "$row[id]"; ?></td> -->
    <td><?php echo "$row[updated_at]"; ?></td>
    <td><?php echo "$row[content]"; ?></td>
    <td>
      <form action="bbs.php" method="post" role="form">
        <button type="submit" class="btn btn-danger">削除</button>
        <div class="form-group">
			<input type="hidden" name="delete_id" value="<?php echo $row[id]; ?>" class="form-control"/>
		</div>
      </form>
    </td>
    </tr>
<?php
}
?>
</table>

＃10:DBを改良しよう - 投稿者名の追加
機能追加の手順
1. 投稿フォームに、名前欄を追加
2. 発言リストに、名前欄を追加
3. データベースにuser_nameカラムを追加
4. 名前情報を挿入するコードを追加

投稿フォームに名前欄を追加

<h2>投稿フォーム</h2>
<form action="bbs.php" method="post" role="form">
  <div class="form-group">
    <label class="control-label">名前</label>
    <input type="text" name="user_name" class="form-control" placeholder="名前"/>
  </div>
  <div class="form-group">
    <label class="control-label">投稿内容</label>
    <input type="text" name="content" class="form-control" placeholder="投稿内容"/>
  </div>
  <button type="submit" class="btn btn-primary">送信</button>
</form>


送信された名前情報
// 変数の設定
$content = $_POST["content"];
$user_name = $_POST["user_name"];
$delete_id = $_POST["delete_id"];


名前情報をデータベースに挿入
// データベースへのデータの挿入
$sql  = "INSERT INTO bbs (content, updated_at, user_name) VALUES (:content, NOW(), :user_name);";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(":content", $content, PDO::PARAM_STR);
$stmt -> bindValue(":user_name", $user_name, PDO::PARAM_STR);
$stmt -> execute();


発言リストに名前欄を追加
// 取得したデータをテーブルで表示
// echo "del_id:".$delete_id;
?>
<table class="table">
    <tr>
        <th>No.</th>
        <!-- <th>id</th> -->
        <th>名前</th>
        <th>日時</th>
        <th>投稿内容</th>
	<th></th>
    </tr>
<?php
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
    $i++;
    if ($i % 2 == 1) {
?>
    <tr bgcolor="#cccccc">
<?php
  } else {
?>
    <tr>
<?php
  }
?>
    <td><?php echo "$i"; ?></td>
    <td><?php echo "$row[user_name]" ?></td>
    <!-- <td><?php // echo "$row[id]"; ?></td> -->
    <td><?php echo "$row[updated_at]"; ?></td>
    <td><?php echo "$row[content]"; ?></td>
    <td>
      <form action="bbs.php" method="post" role="form">
        <button type="submit" class="btn btn-danger">削除</button>
        <div class="form-group">
			<input type="hidden" name="delete_id" value="<?php echo $row[id]; ?>" class="form-control"/>
		</div>
      </form>
    </td>
    </tr>
<?php
}
?>
</table>
