<?php
// $Id: admin.php,v 1.1.1.1 2012/03/17 09:28:11 ohwada Exp $

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

// === define begin ===
if (!defined('_AM_WEBMAP3_LANG_LOADED')) {
    define('_AM_WEBMAP3_LANG_LOADED', 1);

    // menu
    define('_AM_WEBMAP3_MYMENU_TPLSADMIN', '�ƥ�ץ졼�ȴ���');
    define('_AM_WEBMAP3_MYMENU_BLOCKSADMIN', '�֥�å�����/������������');
    define('_AM_WEBMAP3_MYMENU_GOTO_MODULE', '�⥸�塼���');

    // index
    define('_AM_WEBMAP3_CHK_SERVER', '�����С��Ķ�');
    define('_AM_WEBMAP3_CHK_PHP', 'PHP����');
    define('_AM_WEBMAP3_CHK_DIR', '�ǥ��쥯�ȥ�����');
    define('_AM_WEBMAP3_CHK_BOTH_OK', 'ξ�� ok');
    define('_AM_WEBMAP3_CHK_NEED_ON', '�� on');
    define('_AM_WEBMAP3_CHK_RECOMMEND_OFF', '�侩 off');
    define('_AM_WEBMAP3_CHK_MB_LINK', 'ʸ���������Ѵ���ư�����ɤ����Υ����å�');
    define('_AM_WEBMAP3_CHK_MB_DSC', '�ʤ��Υ���褬�����ɽ������ʤ���С�ʸ���������Ѵ���ư���ʤ��褦�Ǥ���');
    define('_AM_WEBMAP3_CHK_MB_SUCCESS', '����ʸ��ʸ������������ɽ������Ƥ��ޤ�����');
    define('_AM_WEBMAP3_CHK_GD_LINK', 'GD2(truecolor)�⡼�ɤ�ư�����ɤ����Υ����å�');
    define('_AM_WEBMAP3_CHK_GD_DSC', '�ʤ��Υ���褬�����ɽ������ʤ���С�GD2�⡼�ɤǤ�ư���ʤ���Τ�����Ƥ���������');
    define('_AM_WEBMAP3_CHK_GD_SUCCESS', '�������ޤ���!<br >�����餯�����Υ����Ф�PHP�Ǥϡ�GD2(true color)�⡼�ɤǲ�����������ǽ�Ǥ���');
    define('_AM_WEBMAP3_CHK_GD_FAILED', '���Ԥ��ޤ���!<br >�����餯�����Υ����Ф�PHP�Ǥϡ�GD2�⡼�ɤ�ư��ޤ���');
    define('_AM_WEBMAP3_CHK_ERR_CHAR_FIRST_NEED', "���顼: �ǽ��ʸ����'/'�Ǥʤ���Фʤ�ޤ���");
    define('_AM_WEBMAP3_CHK_ERR_CHAR_FIRST_NOT', "���顼: �ǽ��ʸ����'/'��ɬ�פ���ޤ���");
    define('_AM_WEBMAP3_CHK_ERR_CHAR_LAST_NEED', "���顼: �Ǹ��ʸ����'/'�Ǥʤ���Фʤ�ޤ���");
    define('_AM_WEBMAP3_CHK_ERR_CHAR_LAST_NOT', "���顼: �Ǹ��ʸ����'/'��ɬ�פ���ޤ���");
    define('_AM_WEBMAP3_CHK_ERR_DIR_PERM', '���顼: �ޤ����Υǥ��쥯�ȥ��Ĥ��äƲ����������ξ�ǡ������ǽ�����ꤷ�Ʋ�������Unix�Ǥ�chmod 777��Windows�Ǥ��ɤ߼������°���򳰤��ޤ�');
    define('_AM_WEBMAP3_CHK_ERR_DIR_NOT', '���顼: ���ꤵ�줿�ǥ��쥯�ȥ꤬����ޤ���.');
    define('_AM_WEBMAP3_CHK_ERR_DIR_WRITE', '���顼: ���ꤵ�줿�ǥ��쥯�ȥ���ɤ߽Ф��ʤ����񤭹���ʤ����Τ����줫�Ǥ�������ξ������Ĥ�������ˤ��Ʋ�������Unix�Ǥ�chmod 777��Windows�Ǥ��ɤ߼������°���򳰤��ޤ�');
    define('_AM_WEBMAP3_CHK_WARN_DIR_GEUST', '���Υǥ��쥯�ȥ�ϥ����Ȥ��ɤळ�Ȥ�����ޤ�');
    define('_AM_WEBMAP3_CHK_WARN_DIR_RECOMMEND', '�ɥ�����ȡ��롼�Ȱʳ������ꤹ�뤳�Ȥ򤪴��ᤷ�ޤ�');

    // location
    define('_AM_WEBMAP3_LOCATION', '���١����٤�����');
    define('_AM_WEBMAP3_ADDRESS', '���������');
    define('_AM_WEBMAP3_ICON', '�ޡ������Υ�������');
    define('_AM_WEBMAP3_ICON_SELECT', '�������������');

    // gicon list
    define('_AM_WEBMAP3_GICON_ADD', '��������򿷵��ɲ�');
    define('_AM_WEBMAP3_GICON_LIST_IMAGE', '��������');
    define('_AM_WEBMAP3_GICON_LIST_SHADOW', '����ɡ�');
    define('_AM_WEBMAP3_GICON_ANCHOR', '���󥫡��ݥ����');
    define('_AM_WEBMAP3_GICON_WINANC', '������ɥ����󥫡�');
    define('_AM_WEBMAP3_GICON_LIST_EDIT', '����������Խ�');

    // gicon form
    define('_AM_WEBMAP3_GICON_MENU_NEW', '��������ο�������');
    define('_AM_WEBMAP3_GICON_MENU_EDIT', '����������Խ�');
    define('_AM_WEBMAP3_GICON_IMAGE_SEL', '�����������������');
    define('_AM_WEBMAP3_GICON_SHADOW_SEL', '�������󥷥�ɡ�������');
    define('_AM_WEBMAP3_GICON_SHADOW_DEL', '�������󥷥�ɡ�����');
    define('_AM_WEBMAP3_GICON_DELCONFIRM', '�������� %s �������Ƥ�����Ǥ����� ');
    define('_AM_WEBMAP3_CAP_MAXPIXEL', '�������������');
    define('_AM_WEBMAP3_CAP_MAXSIZE', '�ե����륵������� (byte)');
    define('_AM_WEBMAP3_DSC_RESIZE', '����ʾ��礭�������ϥꥵ�������ޤ�');
    // === define end ===
}
