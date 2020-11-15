# 01:Webアプリの仕組みを理解しよう

## 1行掲示板の構築手順

1. Webページを用意する
2. DBを準備する
3. PHPでDBを参照する
4. 投稿フォームを追加する
5. PHPでDBに書き込みする
6. 掲示板の機能をまとめる
7. 削除ボタンを追加する
8. データベースにカラムを追加する
9. 掲示板の見た目を整える

# 02:Webページを作ってみよう
```
<!DOCTYPE html>
<html lang="ja">

<html>

<head>
	<meta charset="utf-8">
	<title>paiza掲示板</title>
</head>

<body>
	<h1>paiza掲示板</h1>

	<h2>投稿フォーム</h2>
	<p>ここに投稿フォームを追加</p>

	<h2>発言リスト</h2>

	<table>
		<tr>
			<th>id</th>
			<th>日時</th>
			<th>投稿内容</th>
		</tr>
		<tr>
			<td>1</td>
			<td>2016-10-14</td>
			<td>こんにちは</td>
		</tr>
	</table>
</body>

</html>
```

# 03:MySQLを準備しよう

phpMyAdminを使って、lessonデータベースに次の3つのカラムからなるbbsテーブルを作成。

- INT型の「id」
- TEXT型の「content」
- DATETIME型の「updated_at」

このとき、idは、インデックスとして「Primary」を設定、A_I（Auto Increment）を設定。

```
-- データを追加する
INSERT INTO bbs(id, content, updated_at)
VALUES
	(1, "こんにちは", "2016-10-16 01:00:00"),
	(2, "よろしくね", "2016-10-16 02:00:00"),
	(3, "さようなら", "2016-10-16 03:00:00");
```

# 04:PHPでデータベースを参照しよう

## PHPでDBを参照する手順
1. データベースに接続する
2. データベースからデータを取得する
3. 取得したデータを表示する
```
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>paiza掲示板</title>
</head>

<body>
	<h1>paiza掲示板</h1>

	<h2>投稿フォーム</h2>
	<p>ここに投稿フォームを追加</p>

	<h2>発言リスト</h2>

	<?php
	// データベースへ接続
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");

	// データベースからデータを取得する
	$sql = "SELECT * FROM bbs ORDER BY updated_at;";
	$stmt = $pdo->prepare($sql);
	$stmt -> execute();

	// 取得したデータを表示する
	while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) {
		print_r($row);
		echo("<br/>");
	}
	?>
	?>
	<table>
		<tr>
			<th>id</th>
			<th>日時</th>
			<th>投稿内容</th>
		</tr>
		<tr>
			<td>1</td>
			<td>2016-10-14</td>
			<td>こんにちは</td>
		</tr>
	</table>
</body>

</html>
```

# 05:フォームでメッセージを投稿
```
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>paiza掲示板</title>
</head>

<body>
	<?php
	// 受け取ったデータを表示
	print_r($_POST);

	if (isset($_POST["content"])) {
		$content = $_POST["content"];
	}
	else {
		$content = "なし";
	}
	echo "投稿内容を受信:" . $content;
	?>

	<h1>paiza掲示板</h1>

	<h2>投稿フォーム</h2>
	<form action="bbs.php" method="post">
		<label>投稿内容</label>
		<input type="text" name="content">
		<button type="submit">送信</button>
	</form>

	<h2>発言リスト</h2>
	<table>
		<tr>
			<th>id</th>
			<th>日時</th>
			<th>投稿内容</th>
		</tr>
		<tr>
			<td>1</td>
			<td>2016-10-14</td>
			<td>こんにちは</td>
		</tr>
	</table>
</body>

</html>
```
# 06:PHPでデータベースに書き込もう

## データベースにデータを書き込む手順
1. 書き込むデータを用意する
2. データベースに接続する
3. データベースにデータを挿入する

```
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>paiza掲示板</title>
</head>

<body>
	<?php
	// データベースに接続する
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");

	// 受け取ったデータを書き込む
	print_r($_POST);

	if (isset($_POST["content"])) {
		$content = $_POST["content"];
		$sql  = "INSERT INTO bbs (content, updated_at) VALUES (:content, NOW());";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":content", $content, PDO::PARAM_STR);
		$stmt -> execute();
	}
	else {
		$content = "なし";
	}
	echo "投稿内容を受信:" . $content;
	?>

	<h1>paiza掲示板</h1>

	<h2>投稿フォーム</h2>
	<form action="bbs.php" method="post">
		<label>投稿内容</label>
		<input type="text" name="content">
		<button type="submit">送信</button>
	</form>

	<h2>発言リスト</h2>
	<table>
		<tr>
			<th>id</th>
			<th>日時</th>
			<th>投稿内容</th>
		</tr>
		<tr>
			<td>1</td>
			<td>2016-10-14</td>
			<td>こんにちは</td>
		</tr>
	</table>
</body>

</html>
```

# 07:掲示板の機能をまとめよう

```
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>paiza掲示板</title>
</head>

<body>
	<?php
	// データベースに接続する
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");
	// print_r($_POST);

	// 受け取ったデータを書き込む
	if (isset($_POST["content"])) {
		$content = $_POST["content"];
		$sql  = "INSERT INTO bbs (content, updated_at) VALUES (:content, NOW());";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":content", $content, PDO::PARAM_STR);
		$stmt -> execute();
	}
	?>

	<h1>paiza掲示板</h1>

	<h2>投稿フォーム</h2>
	<form action="bbs.php" method="post">
		<label>投稿内容</label>
		<input type="text" name="content">
		<button type="submit">送信</button>
	</form>

	<h2>発言リスト</h2>
	<?php
	// データベースからデータを取得する
	$sql = "SELECT * FROM bbs ORDER BY updated_at;";
	$stmt = $pdo->prepare($sql);
	$stmt -> execute();
	?>
	<table>
		<tr>
			<th>id</th>
			<th>日時</th>
			<th>投稿内容</th>
		</tr>
		<?php
		// 取得したデータを表示する
		while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?= $row["id"] ?></td>
				<td><?= $row["updated_at"] ?></td>
				<td><?= $row["content"] ?></td>
			</tr>
		<?php } ?>
	</table>
</body>

</html>
```

# 08:投稿の削除機能を作ろう

```
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>paiza掲示板</title>
</head>

<body>
	<?php
	// データベースに接続する
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");
	// print_r($_POST);

	// 受け取ったidのレコードの削除
	if (isset($_POST["delete_id"])) {
		$delete_id = $_POST["delete_id"];
		$sql  = "DELETE FROM bbs WHERE id = :delete_id;";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":delete_id", $delete_id, PDO::PARAM_INT);
		$stmt -> execute();
	}

	// 受け取ったデータを書き込む
	if (isset($_POST["content"])) {
		$content = $_POST["content"];
		$sql  = "INSERT INTO bbs (content, updated_at) VALUES (:content, NOW());";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":content", $content, PDO::PARAM_STR);
		$stmt -> execute();
	} ?>

	<h1>paiza掲示板</h1>

	<h2>投稿フォーム</h2>
	<form action="bbs.php" method="post">
		<label>投稿内容</label>
		<input type="text" name="content">
		<button type="submit">送信</button>
	</form>

	<h2>発言リスト</h2>
	<?php
	// データベースからデータを取得する
	$sql = "SELECT * FROM bbs ORDER BY updated_at;";
	$stmt = $pdo->prepare($sql);
	$stmt -> execute();
	?>
	<table>
		<tr>
			<th>id</th>
			<th>日時</th>
			<th>投稿内容</th>
			<th></th>
		</tr>
		<?php
		// 取得したデータを表示する
		while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?= $row["id"] ?></td>
				<td><?= $row["updated_at"] ?></td>
				<td><?= $row["content"] ?></td>
				<td>
					<form action="bbs.php" method="post">
						<input type="hidden" name="delete_id" value=<?= $row["id"] ?>>
						<button type="submit">削除</button>
					</form>
				</td>
			</tr>
		<?php } ?>
	</table>
</body>

</html>
```

# 09:投稿者名のカラムを追加しよう

## 追加手順

1. 投稿フォームに名前欄を追加
2. 発言リストに名前欄を追加
3. データベースにuser_nameカラムを追加
4. データの挿入コードを修正

```
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>paiza掲示板</title>
</head>

<body>
	<?php
	// データベースに接続する
	$pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");
	// print_r($_POST);

	// 受け取ったidのレコードの削除
	if (isset($_POST["delete_id"])) {
		$delete_id = $_POST["delete_id"];
		$sql  = "DELETE FROM bbs WHERE id = :delete_id;";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":delete_id", $delete_id, PDO::PARAM_INT);
		$stmt -> execute();
	}

	// 受け取ったデータを書き込む
	if (isset($_POST["content"]) && isset($_POST["user_name"])) {
		$content   = $_POST["content"];
		$user_name = $_POST["user_name"];
		$sql  = "INSERT INTO bbs (content, user_name, updated_at) VALUES (:content, :user_name, NOW());";
		$stmt = $pdo->prepare($sql);
		$stmt -> bindValue(":content", $content, PDO::PARAM_STR);
		$stmt -> bindValue(":user_name", $user_name, PDO::PARAM_STR);
		$stmt -> execute();
	} ?>

	<h1>paiza掲示板</h1>

	<h2>投稿フォーム</h2>
	<form action="bbs.php" method="post">
		<label>投稿内容</label>
		<input type="text" name="content">
		<label>投稿者</label>
		<input type="text" name="user_name">
		<button type="submit">送信</button>
	</form>

	<h2>発言リスト</h2>
	<?php
	// データベースからデータを取得する
	$sql = "SELECT * FROM bbs ORDER BY updated_at;";
	$stmt = $pdo->prepare($sql);
	$stmt -> execute();
	?>
	<table>
		<tr>
			<th>id</th>
			<th>日時</th>
			<th>投稿内容</th>
			<th>投稿者</th>
			<th></th>
		</tr>
		<?php
		// 取得したデータを表示する
		while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { ?>
			<tr>
				<td><?= $row["id"] ?></td>
				<td><?= $row["updated_at"] ?></td>
				<td><?= $row["content"] ?></td>
				<td><?= $row["user_name"] ?></td>
				<td>
					<form action="bbs.php" method="post">
						<input type="hidden" name="delete_id" value=<?= $row["id"] ?>>
						<button type="submit">削除</button>
					</form>
				</td>
			</tr>
		<?php } ?>
	</table>
</body>

</html>
```

# 10:Bootstrapで見た目を整えよう

```
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>paiza掲示板</title>
	<!-- bootstrap CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type=text/css>
		div#main {
			padding: 30px;
			background-color: #efefef;
		}
	</style>
</head>

<body>
	<div class="container">
		<div id="main">
			<?php
			// データベースに接続する
			$pdo = new PDO("mysql:host=127.0.0.1;dbname=lesson;charset=utf8", "root", "");
			// print_r($_POST);

			// 受け取ったidのレコードの削除
			if (isset($_POST["delete_id"])) {
				$delete_id = $_POST["delete_id"];
				$sql  = "DELETE FROM bbs WHERE id = :delete_id;";
				$stmt = $pdo->prepare($sql);
				$stmt -> bindValue(":delete_id", $delete_id, PDO::PARAM_INT);
				$stmt -> execute();
			}

			// 受け取ったデータを書き込む
			if (isset($_POST["content"]) && isset($_POST["user_name"])) {
				$content   = $_POST["content"];
				$user_name = $_POST["user_name"];
				$sql  = "INSERT INTO bbs (content, user_name, updated_at) VALUES (:content, :user_name, NOW());";
				$stmt = $pdo->prepare($sql);
				$stmt -> bindValue(":content", $content, PDO::PARAM_STR);
				$stmt -> bindValue(":user_name", $user_name, PDO::PARAM_STR);
				$stmt -> execute();
			} ?>

			<h1>paiza掲示板</h1>

			<h2>投稿フォーム</h2>
			<form class="form" action="bbs.php" method="post">
				<div class="form-group">
					<label class="control-label">投稿内容</label>
					<input class="form-control" type="text" name="content">
				</div>
				<div class="form-group">
					<label class="control-label">投稿者</label>
					<input class="form-control" type="text" name="user_name">
				</div>
				<button class="btn btn-primary" type="submit">送信</button>
			</form>

			<h2>発言リスト</h2>
			<?php
			// データベースからデータを取得する
			$sql = "SELECT * FROM bbs ORDER BY updated_at;";
			$stmt = $pdo->prepare($sql);
			$stmt -> execute();
			?>
			<table class="table table-striped">
				<tr>
					<th>id</th>
					<th>日時</th>
					<th>投稿内容</th>
					<th>投稿者</th>
					<th></th>
				</tr>
				<?php
				// 取得したデータを表示する
				while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
						<td><?= $row["id"] ?></td>
						<td><?= $row["updated_at"] ?></td>
						<td><?= $row["content"] ?></td>
						<td><?= $row["user_name"] ?></td>
						<td>
							<form action="bbs.php" method="post">
								<input type="hidden" name="delete_id" value=<?= $row["id"] ?>>
								<button class="btn btn-danger" type="submit">削除</button>
							</form>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</body>

</html>
```



