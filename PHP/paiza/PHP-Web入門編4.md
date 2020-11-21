# 01:Eloquentの役割と効果 
ここでは、PHPでデータベースを効率よく操作できるORマッパー「Eloquent」の役割と効果について学習します。

## Eloquentとは
Eloquentは、データベースのレコードをPHPのオブジェクトに割り当てる機能を持ったライブラリです。Eloquentを使うと、データベースのレコードをオブジェクトとして扱えるようになり、SQL（エスキューエル）を書かなくても、PHPのコードでデータベースが操作できます。

## Eloquentのインストール
- 素のPHPでEloquentを使う(illuminate/databaseパッケージの単体利用)
https://akamist.com/blog/archives/1041

# 02:Eloquentでデータを表示しよう 
ここでは、Eloquentを使ってMySQLに接続します。そして、データベースからデータを取り出して表示します。

## Eloquentで、データベースからデータを取り出すコード
public_html/sql.php
```
<?php

    // $pdo = new PDO('mysql:host=localhost; dbname=mydb; charset=utf8','root','');

    // DB接続情報の指定
    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    
    // DBをどこからでもアクセスできるようにするメソッド
    $db->setAsGlobal();
    
    // ORマッパー(Eloquent)の起動
    $db->bootEloquent();

    // DBから取り出したデータを格納するクラス(Player)を定義(Eloquentのモデルを継承)
    // クラス名を複数形にしたものが自動的にテーブル名になり、カラムなどの情報を自動で取得可能
    class Player extends Illuminate\Database\Eloquent\Model {
    }

    // $sql = 'SELECT * FROM players;';
    // $statement = $pdo->prepare($sql);
    // $statement->execute();
    //
    // $players = [];
    // while ($player = $statement->fetch(PDO::FETCH_ASSOC)) {
    //     $players[] = $row;
    // }
    //
    // $statement = null;
    // $pdo = null;

    $players = Player::all();
    $message = 'hello world';
    require_once 'views/content.tpl.php';
```

## データべースの値を表示するテンプレート
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <?php foreach ($players as $player) { ?>
            <p>
    			<?= $player['id'] ?>,
    			<?= $player['name'] ?>,
    			<?= $player['level'] ?>,
    		</p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

## Eloquentのインストール手順
```
$ cd public_html
$ composer require illuminate/database
```

# 03:Eloquentでデータベースを使ってみよう - いろんな読み出し 
ここでは、PHPとEloquentを使って、サンプルデータベースの中身を見ていきます。mydbデータベースの「players」テーブルから、色々な方法でデータを取り出しましょう。

```
// 全てのデータを取り出す
$players = Player::all();

$players = Player::select('*')->get();

// 条件に一致したデータだけを取り出す
$players = Player::where('level', '>=',  5)->get();

// 指定したidのデータを取り出す
$player = Player::find(1);

```

# 04:Eloquentでデータベースを使ってみよう - 追加・更新・削除 
ここでは、Eloquentを使って、データベースにデータを追加・更新・削除する方法を学んでいきます。この機能を使うことで、RPGのPlayersテーブルに新しいメンバーを追加したり、名前を変更したり、削除したりできます。

##  Eloquentで、データを追加する
public_html/sql.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    class Player extends Illuminate\Database\Eloquent\Model {
        public $timestamps = false;
    }

    $player = new Player;
    $player->name = '霧島1号';
    $player->level = 1;
    $player->job_id = 1;
    $player->save();

    $players = Player::all();
    $message = 'hello world';
    require_once 'views/content.tpl.php';
```


## Eloquentで、データを更新する
public_html/sql.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    class Player extends Illuminate\Database\Eloquent\Model {
        public $timestamps = false;
    }

    $player = Player::find(11);
    $player->level += 1;
    $player->save();

    $players = Player::all();
    $message = 'hello world';
    require_once 'views/content.tpl.php';
```

## Eloquentで、データを削除する
public_html/sql.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    class Player extends Illuminate\Database\Eloquent\Model {
        public $timestamps = false;
    }

    $player = Player::find(11);
    $player->delete();

    $players = Player::all();
    $message = 'hello world';
    require_once 'views/content.tpl.php';
```

# 05:Eloquentでテーブルを連結してデータを取り出す 
ここでは、Eloquentでテーブルを連結してデータを取り出す方法を学習します。 サンプルデータベースで、「players」テーブルの「job_id」と「jobs」テーブルの「id」を関連付けします。

# Eloquentでテーブルを連結する
public_html/sql.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    // 親クラスのパスを省略できるように宣言
    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
    }

    $players = Player::all();
    $message = 'hello world';
    require_once 'views/content.tpl.php';
```


## 連結したテーブルのカラムを表示するテンプレート
public_html/views/content.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

        <h1><?= $message ?></h1>

        <?php foreach ($players as $player) { ?>
            <p>
    			<?= $player->id ?>,
    			<?= $player->name ?>,
    			<?= $player->level ?>,
                <?= $player->job->job_name ?>
    		</p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 06:特定のプレイヤーを表示する - その1 
ここでは、PHPとEloquentを使った具体例として、簡単なWebアプリケーションを作ります。RPGのプレイヤー一覧から、各プレイヤーの詳細情報を表示しましょう。

## 特定のプレイヤー情報を取得するコード
動作確認のため、print_r()で、取得したデータを出力する。
$_REQUEST https://www.php.net/manual/ja/reserved.variables.request.php

public_html/show_player.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
    }

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $player = Player::find($id);
	$message = 'This is paiza';
    // require_once 'views/index.tpl.php';
    print_r($player);
```

# 07:特定のプレイヤーを表示する - その2 
ここでは、PHPとEloquentを使った具体例として、簡単なWebアプリケーションを作ります。RPGのプレイヤー一覧から、各プレイヤーの詳細情報を表示しましょう。今回は、先ほどの続きとして、特定のプレイヤー情報を表示するテンプレートを作成します。

## 特定プレイヤーの詳細情報を取得するコード
public_html/show_player.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
    }

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $player = Player::find($id);
	$message = 'This is paiza';
    require_once 'views/profile.tpl.php';
```

## プレイヤーの詳細情報を表示するテンプレート
public_html/views/profile.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

    	<h1>Player profile</h1>
    	<p><?= $message ?></p>

    	<ul>
    		<li>ID：<?= $player->id ?></li>
    		<li>名前:<?= $player->name ?></li>
    		<li>レベル：<?= $player->level ?></li>
    		<li>職業id：<?= $player->job_id ?></li>
    		<li>職業名：<?= $player->job->job_name ?></li>
    	</ul>

    	<p><a href='index.php'>リストに戻る</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

## プレイヤー一覧から詳細ページを呼び出す
public_html/views/index.tpl.php
```
<?php foreach ($players as $player) { ?>
    <p>
        <?= $player->id ?>,
        <?= $player->name ?>,
        <?= $player->level ?>,
        <?= $player->job->job_name ?>,
        <a href='show_player.php?id=<?= $player->id ?>'>表示</a>
    </p>
<?php } ?>
```

# 08:特定職業のプレイヤーインデックスを表示する - その1 
ここでは、PHPとEloquentの具体例として、特定の職業の詳細情報と、そこに属するプレイヤーを表示するページを作ります。まずは、職業一覧を作ってみましょう。

# プレイヤー一覧と職業一覧のコード
public_html/index.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
    }

    $players = Player::all();
    $jobs = Job::all();
    $message = 'hello world';
    require_once 'views/index.tpl.php';
```

## プレイヤー一覧と職業一覧のテンプレート
public_html/views/index.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

    	<h1>Player List</h1>
    	<p><?= $message ?></p>

        <?php foreach ($players as $player) { ?>
            <p>
                <?= $player->id ?>,
                <?= $player->name ?>,
                <?= $player->level ?>,
                <?= $player->job->job_name ?>,
                <a href='show_player.php?id=<?= $player->id ?>'>表示</a>
            </p>
        <?php } ?>

        <h2>Job List</h2>

        <?php foreach ($jobs as $job) { ?>
            <p>
    			<?= $job->id ?>,
    			<?= $job->job_name ?>,
    			<?= $job->vitality ?>,
                <?= $job->strength ?>
    		</p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

# 09:特定職業のプレイヤーインデックスを表示する - その2 
ここでは、2回に渡って、PHPとEloquentの具体例として、特定の職業の詳細情報と、そこに属するプレイヤーを表示するページを作っています。今回は、特定の職業に属するプレイヤー一覧を表示します。

## プレイヤー一覧と職業一覧のコード
public_html/index.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
    }

    $players = Player::all();
    $jobs = Job::all();
    $message = 'hello world';
    require_once 'views/index.tpl.php';
```

## プレイヤー一覧と職業一覧のテンプレート
public_html/views/index.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

    	<h1>Player List</h1>
    	<p><?= $message ?></p>

        <?php foreach ($players as $player) { ?>
            <p>
                <?= $player->id ?>,
                <?= $player->name ?>,
                <?= $player->level ?>,
                <?= $player->job->job_name ?>,
                <a href='show_player.php?id=<?= $player->id ?>'>表示</a>
            </p>
        <?php } ?>

        <h2>Job List</h2>

        <?php foreach ($jobs as $job) { ?>
            <p>
    			<?= $job->id ?>,
    			<?= $job->job_name ?>,
    			<?= $job->vitality ?>,
                <?= $job->strength ?>,
                <a href='show_job.php?id=<?= $job->id ?>'>表示</a>
    		</p>
        <?php } ?>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

## 特定のプレイヤー情報を表示するコード
public_html/show_player.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
    }

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $player = Player::find($id);
	$message = 'This is paiza';
    require_once 'views/profile.tpl.php';
```

## プレイヤーの詳細情報を表示するテンプレート
public_html/views/profile.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

    	<h1>Player profile</h1>
    	<p><?= $message ?></p>

    	<ul>
    		<li>ID：<?= $player->id ?></li>
    		<li>名前:<?= $player->name ?></li>
    		<li>レベル：<?= $player->level ?></li>
    		<li>職業id：<?= $player->job_id ?></li>
    		<li>職業名：<?= $player->job->job_name ?></li>
    	</ul>

    	<p><a href='index.php'>リストに戻る</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```

## 特定の職業情報を表示するコード
public_html/show_job.php
```
<?php

    require_once './vendor/autoload.php';
    $db = new Illuminate\Database\Capsule\Manager;
    $db->addConnection([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'mydb',
        'username'  => 'root',
        'password'  => ''
    ]);
    $db->setAsGlobal();
    $db->bootEloquent();

    use Illuminate\Database\Eloquent\Model;

    class Player extends Model {
        public $timestamps = false;
        public function job() {
            return $this->belongsTo('Job');
        }
    }

    class Job extends Model {
        public function player() {
            return $this->hasMany('Player');
        }
    }

    if(isset($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
    }

    $job = Job::find($id);
	$message = 'This is paiza';
    require_once 'views/job_profile.tpl.php';
```

## 特定の職業情報を表示するテンプレート
public_html/views/job_profile.tpl.php
```
<!DOCTYPE html>
<html lang='ja'>
    <?php include('header.inc.php'); ?>
    <body>

    	<h1>Job profile</h1>
    	<p><?= $message ?></p>

    	<ul>
    		<li>ID：<?= $job->id ?></li>
    		<li>職業名：<?= $job->job_name ?></li>
    		<li>体力:<?= $job->vitality ?></li>
    		<li>強さ：<?= $job->strength ?></li>
    	</ul>

    	<h2>Player</h2>
    	<?php foreach ($job->player as $player) { ?>
    	    <p>
    	        <?= $player->id .','.$player->name ?>
    	        <a href='show_player.php?id=<?= $player->id; ?>'>表示</a>
    	    </p>
    	<?php } ?>

    	<p><a href='index.php'>リストに戻る</a></p>

        <?php include('footer.inc.php'); ?>
    </body>
</html>
```
