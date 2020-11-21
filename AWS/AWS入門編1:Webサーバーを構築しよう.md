
# 02:AWSアカウントを作ろう
AWSアカウント作成の流れ
https://aws.amazon.com/jp/register-flow/

# 03:Linux仮想マシンを起動しよう

1. コンソールにアクセス
2. EC2を選択
3. 東京リージョンを選択
4. Linuxディストリビューションを選択
5. インスタンスとして、t2.microを選択
6. キーペアを保存
7. インスタンスを作成

・Linux 仮想マシンの起動
　https://aws.amazon.com/jp/getting-started/launch-a-virtual-machine/

・インスタンスタイプ - Amazon EC2
　https://aws.amazon.com/jp/ec2/instance-types/

# 04:パブリックIPアドレスを設定しよう
・ドメインを取得する
　https://aws.amazon.com/jp/getting-started/get-a-domain/
1. EC2ダッシュボード→セキュリティグループ→Elastic IP
2. Elastic IP アドレスの割り当て
3. この Elastic IP アドレスを関連付ける
4. インスタンスで起動したインスタンスIDを選択. 
5. EC2ダッシュボード→セキュリティグループ→今回作成したセキュリティグループを選択
6. アクション→インバウンドルールを編集
7. ルールの追加
8. タイプでhttpを選択→ルールを保存



# 05:リモートアクセスしよう

```
$ pwd
$ ls
$ ls -a -l

$ mkdir .ssh

$ mv ~/Desktop/FirstKey.pem ~/.ssh
$ chmod 400 ~/.ssh/FirstKey.pem

$ ssh -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP)

$$ exit

※記号の意味
コマンドをローカル環境で実行
$ (コマンド)

コマンドをLinux仮想マシンで実行
$$ (コマンド)
```

・Linux インスタンスへの接続 - Amazon Elastic Compute Cloud
https://docs.aws.amazon.com/ja_jp/AWSEC2/latest/UserGuide/AccessingInstances.html

・SSH を使用した Linux インスタンスへの接続 - Amazon Elastic Compute Cloud
http://docs.aws.amazon.com/ja_jp/AWSEC2/latest/UserGuide/AccessingInstancesLinux.html

・ネットワーク管理の基本Tips - ＠IT - SSHサーバにログインするには？ sshコマンド
http://www.atmarkit.co.jp/ait/articles/1503/23/news004.html

・端末エミュレータ - Wikipedia
https://ja.wikipedia.org/wiki/%E7%AB%AF%E6%9C%AB%E3%82%A8%E3%83%9F%E3%83%A5%E3%83%AC%E3%83%BC%E3%82%BF

・今さら聞けない！ターミナルの使い方【初心者向け】
　TechAcademyマガジン
　http://techacademy.jp/magazine/5155

・Mac OS Xターミナル(コマンドライン)の基本
　 [Mac OSの使い方] All About
　http://allabout.co.jp/gm/gc/2962/

# 06:Webサイトを公開しよう
パブリックIPアドレスなど、適時自分の環境に合わせて修正。

```
$ ssh -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP)

$$ sudo yum -y update
$$ sudo yum -y install httpd
$$ sudo service httpd start
$$ sudo chkconfig httpd on

$$ ls /var/www/html
$$ sudo vi /var/www/html/index.html

※記号の意味
コマンドをローカル環境で実行
$ (コマンド)

コマンドをLinux仮想マシンで実行
$$ (コマンド)
```

・チュートリアル
　Amazon Linux への LAMP ウェブサーバーのインストール
　- Amazon Elastic Compute Cloud
　http://docs.aws.amazon.com/ja_jp/AWSEC2/latest/UserGuide/install-LAMP.html

vi (ファイル名) 指定ファイルを読み込み、viを起動する
i テキストを編集できる状態にする
escキー コマンドを入力できる状態にする
:wq ファイルを保存して終了
:q! ファイルを保存しないで終了

# 07:ファイルを転送しよう

```
$ scp -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP):/var/www/html/index.html ~/Desktop

$ scp -i ~/.ssh/FirstKey.pem ~/Desktop/index.html ec2-user@(パブリックIP):~
$ ssh -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP)
$$ ls
$$ sudo mv ~/index.html /var/www/html
$$ exit

$ ssh -i ~/.ssh/FirstKey.pem ec2-user@(パブリックIP)

##一度のscpコマンドで直接ファイルを転送できるように設定する
$$ sudo groupadd www
$$ sudo usermod -a -G www ec2-user
$$ exit

$$ groups

$$ sudo chown -R root:www /var/www
$$ sudo chmod 2775 /var/www
$$ find /var/www -type d -exec sudo chmod 2775 {} \;
$$ find /var/www -type f -exec sudo chmod 0664 {} \;
$$ exit

$ scp -i ~/.ssh/FirstKey.pem ~/Desktop/index.html ec2-user@(パブリックIP):/var/www/html

※記号の意味
コマンドをローカル環境で実行
$ (コマンド)

コマンドをLinux仮想マシンで実行
$$ (コマンド)
```

・Linuxコマンド集 - 【 scp 】 リモート・マシン間でファイルをコピーする
　ITpro
　http://itpro.nikkeibp.co.jp/article/COLUMN/20060227/230878/

・ネットワーク管理の基本Tips - ＠IT
　バッチなどでファイルのやり取りを安全に実行するには？ scpコマンド
　http://www.atmarkit.co.jp/ait/articles/1505/13/news006.html

・【AWS】EC２上のAmazon Linux AMIへのWinscp接続 - toto_1212
　http://toatoshi.hatenablog.com/entry/2012/11/02/185635
