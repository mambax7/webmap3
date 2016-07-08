<?php
// $Id: admin.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

// === define begin ===
if( !defined("_AM_WEBMAP3_LANG_LOADED") ) 
{

define("_AM_WEBMAP3_LANG_LOADED" , 1 ) ;

// menu
define("_AM_WEBMAP3_MYMENU_TPLSADMIN","テンプレート管理");
define("_AM_WEBMAP3_MYMENU_BLOCKSADMIN","ブロック管理/アクセス権限");
define("_AM_WEBMAP3_MYMENU_GOTO_MODULE" , "モジュールへ" ) ;

// index
define("_AM_WEBMAP3_CHK_SERVER" , "サーバー環境" ) ;
define("_AM_WEBMAP3_CHK_PHP" , "PHP設定" ) ;
define("_AM_WEBMAP3_CHK_DIR" , "ディレクトリ設定" ) ;
define("_AM_WEBMAP3_CHK_BOTH_OK" , "両方 ok" ) ;
define("_AM_WEBMAP3_CHK_NEED_ON" , "要 on" ) ;
define("_AM_WEBMAP3_CHK_RECOMMEND_OFF" , "推奨 off" ) ;
define("_AM_WEBMAP3_CHK_MB_LINK" , "文字コード変換が動くかどうかのチェック" ) ;
define("_AM_WEBMAP3_CHK_MB_DSC" , "（このリンク先が正常に表示されなければ、文字コード変換が動かないようです）" ) ;
define("_AM_WEBMAP3_CHK_MB_SUCCESS" , "この文が文字化けせずに表示されていますか？" ) ;
define("_AM_WEBMAP3_CHK_GD_LINK" , "GD2(truecolor)モードが動くかどうかのチェック" ) ;
define("_AM_WEBMAP3_CHK_GD_DSC" , "（このリンク先が正常に表示されなければ、GD2モードでは動かないものと諦めてください）" ) ;
define("_AM_WEBMAP3_CHK_GD_SUCCESS" , "成功しました!<br />おそらく、このサーバのPHPでは、GD2(true color)モードで画像を生成可能です。" ) ;
define("_AM_WEBMAP3_CHK_GD_FAILED" , "失敗しました!<br />おそらく、このサーバのPHPでは、GD2モードは動作しません。") ;
define("_AM_WEBMAP3_CHK_ERR_CHAR_FIRST_NEED" , "エラー: 最初の文字は'/'でなければなりません" ) ;
define("_AM_WEBMAP3_CHK_ERR_CHAR_FIRST_NOT" , "エラー: 最初の文字は'/'は必要ありません" ) ;
define("_AM_WEBMAP3_CHK_ERR_CHAR_LAST_NEED" , "エラー: 最後の文字は'/'でなければなりません" ) ;
define("_AM_WEBMAP3_CHK_ERR_CHAR_LAST_NOT" , "エラー: 最後の文字の'/'は必要ありません" ) ;
define("_AM_WEBMAP3_CHK_ERR_DIR_PERM" , "エラー: まずこのディレクトリをつくって下さい。その上で、書込可能に設定して下さい。Unixではchmod 777、Windowsでは読み取り専用属性を外します" ) ;
define("_AM_WEBMAP3_CHK_ERR_DIR_NOT" , "エラー: 指定されたディレクトリがありません." ) ;
define("_AM_WEBMAP3_CHK_ERR_DIR_WRITE" , "エラー: 指定されたディレクトリは読み出せないか書き込めないかのいずれかです。その両方を許可する設定にして下さい。Unixではchmod 777、Windowsでは読み取り専用属性を外します" ) ;
define("_AM_WEBMAP3_CHK_WARN_DIR_GEUST" ,  "このディレクトリはゲストも読むことが出来ます" ) ;
define("_AM_WEBMAP3_CHK_WARN_DIR_RECOMMEND" ,  "ドキュメント・ルート以外に設定することをお勧めします" ) ;

// location
define("_AM_WEBMAP3_LOCATION", "緯度・経度の設定");
define("_AM_WEBMAP3_ADDRESS", "住所の設定");
define("_AM_WEBMAP3_ICON", "マーカーのアイコン");
define("_AM_WEBMAP3_ICON_SELECT", "アイコンの選択");

// gicon list
define("_AM_WEBMAP3_GICON_ADD" , "アイコンを新規追加" ) ;
define("_AM_WEBMAP3_GICON_LIST_IMAGE" , "アイコン" ) ;
define("_AM_WEBMAP3_GICON_LIST_SHADOW" , "シャドー" ) ;
define("_AM_WEBMAP3_GICON_ANCHOR" , "アンカーポイント" ) ;
define("_AM_WEBMAP3_GICON_WINANC" , "ウィンドウアンカー" ) ;
define("_AM_WEBMAP3_GICON_LIST_EDIT" , "アイコンの編集" ) ;

// gicon form
define("_AM_WEBMAP3_GICON_MENU_NEW" ,  "アイコンの新規作成" ) ;
define("_AM_WEBMAP3_GICON_MENU_EDIT" , "アイコンの編集" ) ;
define("_AM_WEBMAP3_GICON_IMAGE_SEL" ,  "アイコン画像の選択" ) ;
define("_AM_WEBMAP3_GICON_SHADOW_SEL" , "アイコンシャドーの選択" ) ;
define("_AM_WEBMAP3_GICON_SHADOW_DEL" , "アイコンシャドーを削除" ) ;
define("_AM_WEBMAP3_GICON_DELCONFIRM" , "アイコン %s を削除してよろしいですか？ " ) ;
define("_AM_WEBMAP3_CAP_MAXPIXEL","画像サイズ上限");
define("_AM_WEBMAP3_CAP_MAXSIZE","ファイルサイズ上限 (byte)");
define("_AM_WEBMAP3_DSC_RESIZE", "これ以上大きい画像はリサイズします");

// === define end ===
}

?>