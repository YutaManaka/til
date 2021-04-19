https://v3.ja.vuejs.org/guide/introduction.html#vue-js-%E3%81%A8%E3%81%AF

# 1.基本的な使い方
## 1-1.インストール
## 1-2.はじめに
### Vue.js とは？
### はじめに
### 宣言的レンダリング
- v-bind
### ユーザー入力の制御
- v-on
- v-model
### 条件分岐とループ
- v-if
- v-for
### コンポーネントによる構成
- components
### カスタム要素との関係
### 準備ができましたか？

## 1-3.アプリケーションインスタンス
### インスタンスの作成
- createApp
- mount
### データとメソッド
### インスタンスライフサイクルフック
### ライフサイクルダイアグラム

## 1-4.テンプレート構文
### 展開
#### テキスト
- v-once
#### 生の HTML
- v-html
#### 属性
- v-bind
#### JavaScript 式の使用
### ディレクティブ
#### 引数
#### 動的引数
#### 修飾子
### 省略記法
#### v-bind 省略記法
「v-bind:」→「:」
#### v-on 省略記法
「v-on:」→「@」
#### 注意事項

## 1-5.算出プロパティとウォッチャ
### 算出プロパティ
#### 基本的な例
- getter
#### 算出プロパティ vs メソッド
- computed vs method
#### 算出 Setter 関数
### ウォッチャ
- watch
#### 算出プロパティ vs 監視プロパティ

## 1-6.クラスとスタイルのバインディング
### HTML クラスのバインディング
- :class (v-bind:class の略)
#### オブジェクト構文
#### 配列構文
#### コンポーネントにおいて
- $attrs
### インラインスタイルのバインディング
#### オブジェクト構文
- :style (v-bind:style の略)
#### 配列構文
#### 自動プリフィックス
#### 複数の値

## 1-7.条件付きレンダリング
### v-if
#### <template> での v-if による条件グループ
#### v-else
#### v-else-if
### v-show
### v-if vs v-show
### v-if と v-for
v-forはv-ifより優先される

## 1-8.リストレンダリング
### v-for で配列に要素をマッピングする
- v-for
- item in items
- item of items(イテレータ構文)
### オブジェクトの v-for
### 状態の維持
### 配列の変化を検出
#### 変更メソッド
- push()
- pop()
- shift()
- unshift()
- splice()
- sort()
- reverse()
#### 配列の置き換え
- filter()
- concat()
- slice()
### フィルタ/ソートされた結果の表示
### 範囲付き v-for
### <template> での v-for
### v-for と v-if
### コンポーネントと v-for
- 単純な ToDo リストの完全な例

## 1-9.イベントハンドリング
### イベントの購読
v-on:click="methodName"もしくは@click="methodName"
### イベントの購読
### メソッドイベントハンドラ
### インラインメソッドハンドラ
### 複数イベントハンドラ
### イベント修飾子
- event.preventDefault() 
- event.stopPropagation() 
- .stop
- .prevent
- .capture
- .self
- .once
- .passive
### キー修飾子
#### キーコード
- .enter
- .tab
- .delete ("Delete" と "Backspace" キー両方をキャプチャします)
- .esc
- .space
- .up
- .down
- .left
- .right
### システム修飾子キー
- .ctrl
- .alt
- .shift
- .meta
#### .exact 修飾子
#### マウスボタンの修飾子
- .left
- .right
- .middle
### なぜ HTML にリスナを記述するのですか

## 1-10.フォーム入力バインディング
### 基本的な使い方
- v-model
#### テキスト
#### 複数行テキスト
#### チェックボックス
#### ラジオ
#### セレクト
### 値のバインディング
#### チェックボックス
#### ラジオ
#### セレクトオプション
### 修飾子
#### .lazy
#### .number
#### .trim
### コンポーネントのv-model

## 1-11.コンポーネントの基本
### 基本例
### コンポーネントの再利用
### コンポーネントの構成
### プロパティを用いた子コンポーネントへのデータの受け渡し
### 子コンポーネントのイベントを購読する
#### イベントと値を送出する
#### コンポーネントで v-model を使う
### スロットによるコンテンツ配信
- <slot>
### 動的なコンポーネント
- component :is
### DOM テンプレートパース時の警告
- v-is

# 2.コンポーネントの詳細
## 2-1.コンポーネントの登録
### コンポーネント名
#### 命名のケース (Name Casing)
- ケバブケースvsパスカルケース
### グローバル登録
- app.component
### ローカル登録
- components オプション
### モジュールシステム
#### モジュールシステム内のローカル登録
- import/require

## 2-2.プロパティ
### プロパティの型
-props:
### 静的あるいは動的なプロパティの受け渡し
-v-vind(もしくは：)
#### 数値の受け渡し
#### 真偽値の受け渡し
#### 配列の受け渡し
#### オブジェクトの受け渡し
#### オブジェクトのプロパティの受け渡し
-:prop-nameの代わりにv-bindが使える
### 単方向データフロー
### プロパティのバリデーション
#### 型の検査
- instanceof
### プロパティの形式 (キャメルケース vs ケバブケース)

## 2-3.プロパティでない属性
- class
- style
- id
### 属性の継承
### 属性の継承の無効化
- inheritAttrs: false
- $attrs
### ルート要素が複数の場合の属性の継承

## 2-4.カスタムイベント
### イベント名
### カスタムイベントの定義
### 発行されたイベントを検証する
### v-model の引数
### 複数の v-model のバインディング
### v-model 修飾子の処理
- .trim
- .number
- .lazy

## 2-5.スロット
### スロットコンテンツ
- <slot>
### 描画スコープ
### フォールバックコンテンツ
### 名前付きスロット
- nameのないスロットは暗黙的に「default」という名前を持つ
- v-slot
- v-slot は（一つの例外 を除き） <template> にしか指定できない
### スコープ付きスロット
#### デフォルトスロットしかない場合の省略記法
#### スロットプロパティの分割代入
### 動的なスロット名
### 名前付きスロットの省略記法
- v-slot:の省略→#

## 2-6.Provide / inject
### リアクティブと連携する

## 2-7.動的 & 非同期コンポーネント
### 的コンポーネントにおける keep-alive の利用
- keep-alive
### 非同期コンポーネント
- defineAsyncComponent
#### Suspense との併用
- <Suspense>
- suspensible: false

## 2-8.テンプレート参照について
- ref

## 2-9.特別な問題に対処する
### 更新をコントロールする
#### 強制更新
- $forceUpdate
#### v-once を使用するチープスタティックコンポーネント

# 3.トランジションとアニメーション
## 3-1.概要
- <transition>
- <transition-group> 
- watchers
### クラスベースのアニメーションとトランジション
### パフォーマンス
#### 変形と不透明度
- transform
#### ハードウェアアクセラレーション
- perspective
- backface-visibility
- transform：translateZ（x）
### タイミング
### イージング
- ease-in
- ease-out

## 3-2.Enter & Leave トランジション
### 単一要素/コンポーネントのトランジション
#### トランジションクラス
- v-enter-from
- v-enter-active
- v-enter-to
- v-leave-from
- v-leave-active
- v-leave-to
#### CSS トランジション
#### CSS アニメーション
#### カスタムトランジションクラス
- enter-from-class
- enter-active-class
- enter-to-class (2.1.8+)
- leave-from-class
- leave-active-class
- leave-to-class (2.1.8+)
#### トランジションとアニメーションの併用
#### 明示的なトランジション期間の設定
- duration
#### JavaScript フック
### 初期描画時のトランジション
- appear
### 要素間のトランジション
#### トランジションモード
- in-out
- out-in
### コンポーネント間のトランジション

## 3-3.リストのトランジション
- <transition-group>
- tag
- v-move
- move-class
### 再利用可能なトランジション
### 動的なトランジション

## 3-4.状態のトランジション
### ウォッチャによる状態のアニメーション
### 動的な状態のトランジション
### コンポーネント内のトランジションの整理
### デザインに命を吹き込む

# 4.再利用と構成
## 4-1.Composition API
### はじめに
#### なぜコンポジション API なのか？
#### コンポジション API の基本
- setup
##### setup コンポーネントオプション
##### ref によるリアクティブな変数
- ref
##### ライフサイクルフックを setup の中に登録する
- on
- onMounted
##### watch で変化に反応する
- toRefs
- watch
##### スタンドアロンな computed プロパティ
### セットアップ
#### 引数
- props
- context
##### プロパティ
- toRefs
##### コンテキスト
- .attrs
- .slots
- .emit
#### コンポーネントプロパティへのアクセス
#### テンプレートでの使用
#### 描画関数での使用
#### this の使用
### ライフサイクルフック
- beforeCreate
- created
- onBeforeMount
- onMounted
- onBeforeUpdate
- onUpdated
- onBeforeUnmount
- onUnmounted
- onErrorCaptured
- onRenderTracked
- onRenderTriggered
### Provide / Inject
#### シナリオの背景
#### Provide の使い方
#### Inject の使い方
#### リアクティブ
##### リアクティブの追加
##### リアクティブプロパティの変更
- readonly
### テンプレート参照

## 4-2.ミックスイン
- mixin
### 基本
### オプションのマージ
### グローバルミックスイン
### カスタムオプションのマージストラテジ
- app.config.optionMergeStrategies

## 4-3.カスタムディレクティブ
### 基本
### フック関数
- beforeMount
- mounted
- beforeUpdate
- updated
- beforeUnmount
- unmounted
#### 動的なディレクティブ引数
### 関数による省略記法
### オブジェクトリテラル
### コンポーネントにおける使用法

## 4-4.Teleport
### Vue コンポーネントと使う
### 複数の teleport のターゲットを同じにして使う

## 4-5.Render 関数
- render()
### DOM ツリー
### 仮想 DOM ツリー
### h() の引数
### 完全な例
### 制約
#### Node は一意でなければならない
### テンプレートの機能をプレーンな JavaScript で置き換える
#### v-if と v-for
#### v-model
#### v-on
- .passive
- .capture
- .once
- .stop
- .prevent
- .self
- .enter
- .ctrl
- .alt
- .shift
- .meta
#### スロット
### JSX
### テンプレートのコンパイル

## 4-6.プラグイン
### プラグインを書く
### プラグインを使う
- use

# 5.高度な使い方
## 5-1.リアクティビティ 
### リアクティブの探求
#### Vue がこれらの変更を追跡する方法
- new Proxy(target, handler)
- Reflect
- track
- effect
- trigger
#### プロキシされたオブジェクト
#### プロキシとオリジナルの同一性
#### ウォッチャ
### リアクティブの基礎
#### リアクティブな状態の宣言
- reactive
#### 独立したリアクティブな値を 参照 として作成する
##### ref のアンラップ
##### リアクティブオブジェクト内でのアクセス
#### リアクティブな状態の分割代入
#### readonly でリアクティブオブジェクトの変更を防ぐ
### 算出プロパティとウォッチ
#### 算出プロパティ
- computed
- get
- set
#### watchEffect
##### 監視の停止
- stop
##### 副作用の無効化
- onInvalidate
##### 作用フラッシュのタイミング
##### Watcher のデバッグ
- onTrack
- onTrigger
#### watch
##### 単一のデータソースの監視
##### 複数のデータソースの監視
##### watchEffect との振る舞いの共有

## 5-2.レンダリングのメカニズムと最適化
### 仮想 DOM

## 5-3.Vue 2 での変更検出の注意事項

# 6.ツール
## 6-1.単一ファイルコンポーネント
### 前書き
#### 関心の分離について
### はじめる
#### サンドボックスの例
#### JavaScript でモジュールビルドシステムが初めてなユーザ向け
#### 上級ユーザ向け

## 6-2.テスト
### はじめに
#### 単体テスト
#### 導入
#### フレームワークの選定
#### フレームワーク
### コンポーネントテスト
#### 導入
#### フレームワークの選択
#### 推奨ツール
### End-to-End (E2E) テスト
#### 導入
#### フレームワークの選定
#### 推奨ツール

## 6-3.TypeScript のサポート

# 7.スケールアップ
## 7-1.ルーティング
### 公式ルータ
### スクラッチからのシンプルなルーティング
### サードパーティ製ルータとの統合

## 7-2.状態管理
### 公式の Flux ライクな実装
#### React 開発者向けの情報
### ゼロから作るシンプルな状態管理

## 7-3.サーバサイドレンダリング
### 完全な SSR ガイド
### Nuxt.js
### Quasar Framework SSR + PWA

# 8.アクセシビリティ
## 8-1.基礎
### スキップリンク
### コンテンツの構造
#### 見出し
#### ランドマーク

## 8-2.セマンティクス
### フォーム
- <form> 
- <label> 
- <input> 
- <textarea> 
- <button>
#### ラベル
- aria-label
- aria-labelledby
- aria-describedby
#### プレースホルダ
#### 説明
#### コンテンツの非表示
- aria-hidden="true"
#### ボタン

## 8-3.標準
## 8-4.リソース
