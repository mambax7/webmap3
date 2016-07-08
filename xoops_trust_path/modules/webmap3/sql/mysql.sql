# $Id: mysql.sql,v 1.1.1.1 2012/03/17 09:28:10 ohwada Exp $

# =========================================================
# webphoto module
# 2012-03-01 K.OHWADA
# =========================================================

#
# Table structure for table `gicon`
#

CREATE TABLE gicon (
  gicon_id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  gicon_time_create INT(10) UNSIGNED NOT NULL DEFAULT '0',
  gicon_time_update INT(10) UNSIGNED NOT NULL DEFAULT '0',
  gicon_title VARCHAR(255) NOT NULL DEFAULT '',
  gicon_image_path  VARCHAR(255) NOT NULL DEFAULT '',
  gicon_image_name  VARCHAR(255) NOT NULL DEFAULT '',
  gicon_image_ext   VARCHAR(10)  NOT NULL DEFAULT '',
  gicon_shadow_path VARCHAR(255) NOT NULL DEFAULT '',
  gicon_shadow_name VARCHAR(255) NOT NULL DEFAULT '',
  gicon_shadow_ext  VARCHAR(10)  NOT NULL DEFAULT '',
  gicon_image_width   INT(4) NOT NULL DEFAULT '0',
  gicon_image_height  INT(4) NOT NULL DEFAULT '0',
  gicon_shadow_width  INT(4) NOT NULL DEFAULT '0',
  gicon_shadow_height INT(4) NOT NULL DEFAULT '0',
  gicon_anchor_x INT(4) NOT NULL DEFAULT '0',
  gicon_anchor_y INT(4) NOT NULL DEFAULT '0',
  gicon_info_x   INT(4) NOT NULL DEFAULT '0',
  gicon_info_y   INT(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (gicon_id)
) ENGINE=MyISAM;

#
# gicon table
#

INSERT INTO gicon VALUES (1, 0, 0, 'aqua 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_aqua.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (2, 0, 0, 'blue 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_blue.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (3, 0, 0, 'gray 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_gray.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (4, 0, 0, 'green 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_green.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (5, 0, 0, 'maroon 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_maroon.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (6, 0, 0, 'pink 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_pink.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (7, 0, 0, 'purple 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_purple.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (8, 0, 0, 'red 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_red.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (9, 0, 0, 'white 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_white.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
INSERT INTO gicon VALUES (10, 0, 0, 'yellow 18x28', 'modules/{DIRNAME}/images/markers/icon_1828_yellow.png', '', 'png', '', '', '', 18, 28, 0, 0, 9, 28, 9, 3);
