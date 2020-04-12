
// Check if Bootbox is available and not loaded => then load
// if(__webpack_modules__[require.resolveWeak("bootbox")] && !require.cache[require.resolveWeak("mod1")]) {
//     // Bootbox - alert/prompt replacement
//     require('bootbox');
// }
import bootbox from 'bootbox';

// http://bootboxjs.com/documentation.html
export default function(message, title = '', buttons = {}, options = {}) {

    if(typeof message === "object") {
        return bootbox.dialog(message);
    }


    options = Object.assign({
        title: title || '',
        message: message,
        buttons: buttons,
        scrollable: true,
        onEscape: true,
        backdrop: null
    }, options);


    return bootbox.dialog(options);
}
