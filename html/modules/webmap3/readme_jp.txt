$Id: readme_jp.txt,v 1.2 2012/04/09 11:52:19 ohwada Exp $

=================================================
Version: 1.10
Date:    2012-04-02
Author:  Kenichi OHWADA
URL:     https://linux.ohwada.jp/
Email:   webmaster@ohwada.jp
=================================================

1. API
(1) geocoding
Web Geocoding API ����Ѥ��ơ����꤫����ٷ��٤򸡺�����API���ɲä���

(2) get_location
���ٷ��٤��������API���ɲä���

2. JavaScript
(1) ���ٷ��٤μ����ΤȤ������Ǥ��ͤ����ꤵ��Ƥ���С��濴�˥ޡ�������ɽ������
(2) �Х��к�: IE9��ư��ʤ�

3. �֥�å�ɽ��
(1) �Ͽޤι⤵ �� �����ॢ���Ȼ��� ���ɲä���


=================================================
Version: 1.00
Date:    2012-03-01
=================================================

Google Maps API �����Ѥ����Ͽޤ�ɽ������⥸�塼��Ǥ���
����� webmap �⥸�塼��� Google Maps API V3 ���б�������ΤǤ���
V3 ���礭�������Ȥ��� API���� �����פˤʤ�ޤ�����

�� ��ʵ�ǽ
1. �桼����ǽ
(1) �Ͽޤθ��������꤫���Ͽޤ򸡺�����
(2) �Ͽޤ�ɽ�������ٷ��٤���ꤷ������ξ����Ͽޤ�ɽ������
    KML ���������ɤ��ơ�GoogleEarth �Ǹ���
(3) GeoRSS��GeoRSS ���б����� RSS ������ٷ��٤�������ơ��Ͽ޾��ɽ������

2. �����Ե�ǽ
(1) �Ͽޤ�����١����٤�������ơ��ǡ����١����˳�Ǽ����
(2) Google �ޥåץ�������򥢥åץ��ɤ���

3. API��ǽ
¾�Υ⥸�塼�뤬�Ͽޤ�ɽ�����뤿��Υ��󥿥ե��������󶡤���
��ñ�ʥǥ���Ѱդ��Ƥ��ޤ���
modules/webmap3/demo.php


�� ���󥹥ȡ���
1. ���� ( xoops 2.0.16a JP ����� XOOPS Cube 2.1.x )
���ह��ȡ�html �� xoops_trust_path �Σ��ĥǥ��쥯�ȥ꤬����ޤ���
���줾�졢XOOPS �γ�������ǥ��쥯�ȥ�˳�Ǽ����������

����ȡ�����˲����Τ褦�� Warning ���Фޤ�����
ư��ˤϻپ�ʤ��Τǡ�̵�뤷�Ƥ���������
-----
Warning [Xoops]: Smarty error: unable to read resource: "db:_inc_marker_js.html" in file class/smarty/Smarty.class.php line 1095
-----

2. xoops 2.0.18
�嵭�˲ä���
(1) preload �ե�������͡��ह��
XOOPS_TRUST_PATH/modules/webmap/preload/_constants.php (��������С�����)
 -> constants.php (��������С��ʤ�)

(2) _C_WEBMAP_PRELOAD_XOOPS_2018 ��ͭ���ˤ���
��Ƭ�� // ��������
-----
//define("_C_WEBBMAP_PRELOAD_XOOPS_2018", 1 ) ;
-----
