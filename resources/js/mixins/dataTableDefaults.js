
$.extend(true, $.fn.dataTable.defaults, {
    dom: "<'row mb-4'<'col-sm-12 col-md-3'l><'col-sm-12 col-md-6'B><'col-sm-12 col-md-3'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row mt-4'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // https://datatables.net/reference/option/dom
    autoWidth: false, // https://datatables.net/reference/option/autoWidth
    pagingType: 'full_numbers', // https://datatables.net/reference/option/pagingType
    hover: true, // https://datatables.net/manual/styling/classes#hover
    language: { // https://datatables.net/reference/option/language
        search: "<i class='fa fa-search'></i>",
    }
});
