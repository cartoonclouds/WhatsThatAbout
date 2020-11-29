
(($) => {
    'use strict';

    $(document).on('click', '[data-bootbox="delete"]', function (event) {
        const $delButton = $(this)
        const modelType = $(this).data('model')
        const title = $(this).parents('tr').find('.title').text()

        if (!$delButton.data('url')) {
            return
        }

        bootbox.confirm({
            message: `Are you sure you want to delete the ${modelType} <br><strong class="ml-3">${title}</strong>?`,
            buttons: {
                confirm : {
                    label: `Delete ${modelType.ucfirst()}`,
                    className: 'btn-danger',
                },
            },
            callback (result) {
                if (result) {
                    axios.delete($delButton.data('url'))
                         .then(response => {
                             notify(response.data.message, 'Deletion Successful', 'success')

                             if (`${modelType}s-table` in DataTables) {
                                 DataTables[`${modelType}s-table`].ajax.reload()
                             }
                         })
                        .catch(error => {
                            notify(error.message, 'Deletion Unsuccessful', 'danger')
                        })
                }
            }
        })
    })
})($);
