# Git入門編(paiza)で学習したことまとめ
  
## 02:リポジトリを作ろう

### 簡易ヘルプの表示
オプションを付けないで実行すると、簡易ヘルプが表示される
```
git
```

### バージョンを表示
```
git --version
```

### 名前とメールアドレスを登録
作業履歴の記録時に、この名前が使われる。
```
git config --global user.name "kirishima"
git config --global user.email "kirishima@paiza.jp"
```

### 登録情報を確認
```
git config --list
```

### リポジトリの作成
myworkディレクトリを作って、そこにリポジトリを作成
作業履歴は、このディレクトリの「.git」という隠しディレクトリに記録される。
```
mkdir mywork
cd mywork
git init
```
  
## 03:リポジトリにファイルを追加してみよう

### 状態の確認
リポジトリやステージングエリア(インデックス)の状態を確認する
```
git status
```

### ステージングエリアに仮登録
```
git add readme.txt
```

### ステージングエリアの内容をコミット
vimが起動するので、コミットメッセージを入力する。
コミットを中断するには、コミットメッセージのところで「:q!」を入力する
```
git commit
```
>■vimの使い方  
>- vimは、シェルで利用できるテキストエディタです。  
> - Gitでコミットしようとすると、コミットメッセージの入力のために、自動的に起動します。  
> - 次のように、コマンドモードと編集モードを切り替えて使用します。　　
>
>■編集モード
> - a 現在のカーソル位置の右から入力する
> - A 現在の行の末尾に入力する  
>
>■コマンドモード  
> - u 元に戻す  
> - :wq 保存して終了  
> - :q! 保存しないで終了  


### コミット履歴を確認
```
git log
```

## 04:もう一度、コミットしてみよう

### ステージングエリアにまとめて仮登録
```
git add .
```
### 仮登録とコミットを同時に実行
```
git commit -a
```
### コミットメッセージを同時に指定
```
git commit -m "commit message"
```
### 仮登録とコミットを同時に実行+コミットメッセージを同時に指定
```
git commit -a -m "commit message"
```
  
## 05:作業履歴を確認する

### コミットメッセージだけを表示
```
git log --oneline
```
### 指定した件数だけコミットログを表示
```
git log -2
```
### ステータスをシンプルな形式で表示
```
git status -s
```

### ステージングとワーキングディレクトリを比較
ただし、ステージングに仮登録されていない新規ファイルは表示されない。
```
git diff
```
### 最新コミットとステージングエリアを比較
```
git diff --cached
```
### 最新コミットとワーキングディレクトリを比較
```
git diff HEAD
```
## 06:作業履歴を取り消そう

### ワーキングディレクトリのファイルを前の状態に戻す
```
git checkout readme.txt
```
### ステージング上の特定ファイルを一つ前の状態に戻す
```
git reset readme.txt
```
### 最新のコミットを打ち消す(＋vimを:wqで終了)
```
git revert HEAD
```
## 07:ブランチを作って作業しよう

### ブランチを確認
```
git branch
```
### ブランチを作る
```
git branch add_html
```
### ブランチを切り替える
```
git checkout add_html
```
## 09:ブランチをマージしよう

### ブランチをmasterにマージする
```
git checkout master
git merge add_html
```
### ブランチを削除する
```
git branch -d add_html
```
### ブランチを作って、切り替える
```
git checkout -b add_html2
```  

## 10:衝突を解決しよう

### 衝突箇所の表示
衝突しているファイルをエディタで開くと、衝突個所が次のようになっています。  
不等号で囲まれた部分が、衝突している個所です。  
修正するには、どちらかを選ぶか、新しいコードを記述します。  
今回は、新しいコードに書き換えてしまいましょう。  
不等号やイコールの行も削除しましょう。  
```
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>hello git</title>
  </head>
  <body>
    <h1>hello git</h1>
<<<<<<< HEAD
    <p>ここはmasterです。</p>
=======
    <p>ここはadd_htmlです。</p>
>>>>>>> add_html
  </body>
</html>
```    
### 修正した内容をコミットする
衝突したファイルを修正できたら、仮登録してコミットします。  
コミットすると、自動的にエディタが立ち上がり、コミットメッセージと衝突の情報が入力されています。  
そこで、「:wq」で、このままメッセージを保存しましょう。  
```
git add index.html
git commit
```  

## 11:プロジェクトをクローンしよう

### 共同リポジトリを複製する(クローン)
```
mkdir neko_work
cd neko_work
git clone /tmp/project_A.git
```
### 複製した共同リポジトリの情報を表示する
```
git remote -v
```
### コミットを共有リポジトリに反映する
```
git push origin master
```  

## 12:プロジェクトの変更を取り込む

### 変更を取り込む
```
git pull /tmp/project_A.git
```
