$Id: readme_jp.txt,v 1.2 2012/04/09 11:52:19 ohwada Exp $

=================================================
Version: 1.10
Date:    2012-04-02
Author:  Kenichi OHWADA
URL:     http://linux.ohwada.jp/
Email:   webmaster@ohwada.jp
=================================================

1. API
(1) geocoding
Web Geocoding API を使用して、住所から緯度経度を検索するAPIを追加した

(2) get_location
緯度経度を取得するAPIを追加した

2. JavaScript
(1) 緯度経度の取得のとき、すでに値が設定されていれば、中心にマーカーを表示する
(2) バグ対策: IE9で動作しない

3. ブロック表示
(1) 地図の高さ と タイムアウト時間 を追加した


=================================================
Version: 1.00
Date:    2012-03-01
=================================================

Google Maps API を利用して地図を表示するモジュールです。
従来の webmap モジュールを Google Maps API V3 に対応したものです。
V3 の大きな利点として APIキー が不要になりました。

● 主な機能
1. ユーザ機能
(1) 地図の検索：住所から地図を検索する
(2) 地図の表示：緯度経度を指定して特定の場所の地図を表示する
    KML をダウンロードして、GoogleEarth で見る
(3) GeoRSS：GeoRSS に対応した RSS から緯度経度を取得して、地図上に表示する

2. 管理者機能
(1) 地図から緯度・経度を取得して、データベースに格納する
(2) Google マップアイコンをアップロードする

3. API機能
他のモジュールが地図を表示するためのインタフェースを提供する
簡単なデモを用意しています。
modules/webmap3/demo.php


● インストール
1. 共通 ( xoops 2.0.16a JP および XOOPS Cube 2.1.x )
解凍すると、html と xoops_trust_path の２つディレクトリがあります。
それぞれ、XOOPS の該当するディレクトリに格納ください。

イントール時に下記のような Warning が出ますが、
動作には支障ないので、無視してください。
-----
Warning [Xoops]: Smarty error: unable to read resource: "db:_inc_marker_js.html" in file class/smarty/Smarty.class.php line 1095
-----

2. xoops 2.0.18
上記に加えて
(1) preload ファイルをリネームする
XOOPS_TRUST_PATH/modules/webmap/preload/_constants.php (アンダーバーあり)
 -> constants.php (アンダーバーなし)

(2) _C_WEBMAP_PRELOAD_XOOPS_2018 を有効にする
先頭の // を削除する
-----
//define("_C_WEBBMAP_PRELOAD_XOOPS_2018", 1 ) ;
-----
