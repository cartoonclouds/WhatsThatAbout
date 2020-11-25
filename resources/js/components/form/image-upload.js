/* jshint undef: true, unused: true, esversion: 6 */
/* globals $, document */
(($) => {
    'use strict';

    const attr = {
        ui: 'data-wta-ui',
        ready: 'data-wta-ui-ready',
    };

    const childEls = {
        preview: '[data-iu-img-preview]',           // Image tag to display the preview
        label: '[data-iu-img-label]',               // Label to show if no image preview
        removePreview: '[data-iu-remove-preview]',  // Button to remove the image preview
        file: '[data-iu-file]',                     // File input which uploads the image
    }


    $.fn.ui = function() {
        const $el = $(this);

        let uiEls = $el.find('[' + attr.ui + ']');

        if ($el.attr(attr.ui)) uiEls.add($el);

        uiEls.each((i, el) => {
            var $el = $(el);
            if ($el.attr(attr.ready)) return; // already initialized
            else {
                $el.attr(attr.ready, 'true');

                // set elements
                let $imagePreview       = $el.find(childEls.preview);
                let $imageLabel         = $el.find(childEls.label);
                let $imageRemovePreview = $el.find(childEls.removePreview);
                let $inputFile          = $el.find(childEls.file);

                // render function
                let renderChanges = function()
                {
                    let hideElements = [];
                    let showElements = [];

                    if ($.trim($imagePreview.attr('src')) === '') {
                        hideElements.push($imageRemovePreview);
                        showElements.push($imageLabel);
                    } else {
                        hideElements.push($imageLabel);
                        showElements.push($imageRemovePreview);
                    }

                    hideElements.forEach(($el) => $el.hide());
                    showElements.forEach(($el) => $el.show());
                }

                // attach click event to remove preview
                $imageRemovePreview.on('click', (evt) => {
                    $imagePreview.attr('src', '');
                    renderChanges();
                });


                // instantiate file reader and events
                const reader = new FileReader();

                if (typeof (reader) != "undefined") {
                    reader.addEventListener('load', (evt) => {
                        $imagePreview.attr('src', reader.result);

                        renderChanges();
                    });


                    $inputFile.on('change', async (evt) => {
                        const fileInput = evt.target;

                        if (fileInput.files && fileInput.files[0]) {
                            await reader.readAsDataURL(fileInput.files[0])

                            renderChanges();
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.")
                }

                // render changes
                renderChanges();
            }
        });
    };

    // init all ui elements
    $(() => $(document.body).ui());
})($);
