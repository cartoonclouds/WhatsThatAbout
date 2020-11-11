
// Import Bootstrap Notify
require('bootstrap-notify');

// also need jquery & bootstrap

// http://bootstrap-notify.remabledesigns.com/
// https://developer.mozilla.org/en-US/docs/Web/CSS/@media/prefers-reduced-motion

const defaultLevelIcons = {
    success: 'far fa-comment-check',
    danger: 'far fa-comment-times',
    warning: 'far fa-comment-exclamation',
    info: 'far fa-comment-dots',
};

const levels = [
    'minimalist',
    'primary',
    'secondary',
    'success',
    'danger',
    'warning',
    'info',
    'light',
    'dark'
];


export default function(message, title = '', level = 'info', icon, options = {}, settings = {}) {

    if (!levels.includes(level)) {
        throw new ReferenceError('"level" parameter must be one of "' + levels.join('", "') + '"');
    }


    if (!icon) {
        icon = defaultLevelIcons[level];
    }


    // options
    options = Object.assign({
        icon: icon || '',
        title: title || '',
        message: message
        //url: '',
        //target: '_blank'
    }, options);


    // settings
    settings = Object.assign({
        type: level,
        template: `
         <div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">
             <button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss">×</button>
         ` + (
             title ?
                `<span data-notify="title">
                    <h5 class="mt-0">
                        <i data-notify="icon" class="${icon ? 'mr-2' : ''}"></i>{1}
                    </h5>
                 </span>
                 <span data-notify="message">{2}</span>`
             :
                `<span data-notify="message"><i data-notify="icon" class="${icon ? 'mr-2' : ''}"></i>{2}</span>`
            ) +
             `<div class="progress" data-notify="progressbar">
                <div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;"></div>
             </div>
             <a href="{3}" target="{4}" data-notify="url" class="stretched-link"></a>
         </div>
        `
    }, settings);


    if (level === 'minimalist') {
        settings = Object.assign(settings, {
            template: `
                <div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">
                    <div class="media">
                        <img alt="notify-icon" data-notify="icon" class="img-circle mr-3 d-block">
                        <div class="media-body">
                            <span data-notify="title">
                                <h5 class="mt-0">{1}</h5>
                            </span>
                            <span data-notify="message">{2}</span>
                        </div>
                    </div>
                </div>
            `
        });
    }

    return $.notify(options, settings);
}

