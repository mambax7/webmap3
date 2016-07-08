/* ========================================================
 * $Id: gicon.js,v 1.1.1.1 2012/03/17 09:28:53 ohwada Exp $
 * ========================================================
 */

function webmap3_gicon_onchange(obj, ele) {
    var id = webmap3_gicon_getIdByObj(obj);
    var image = webmap3_gicon_getImageById(id);
    var element = document.getElementById(ele);
    if (element != null) {
        element.src = image;
    }
}

function webmap3_gicon_getIdByObj(obj) {
    if (obj == null) {
        return 0;
    }

    var index = obj.selectedIndex;
    if (index == 0) {
        return 0;
    }

    if (obj.options[index] == null) {
        return 0;
    }

    var id = obj.options[index].value;
    return id;
}

function webmap3_gicon_getImageById(id) {
    var icons = webmap3_gicon_get_icons();
    if (icons[id] == null) {
        return '';
    }
    var icon = icons[id];
    return icon;
}
