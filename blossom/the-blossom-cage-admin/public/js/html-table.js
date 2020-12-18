"use strict";
var KTDatatableHtmlTableDemo = {
    init: function () {
        var t;
        t = $(".kt-datatable").KTDatatable({
            data: {
                saveState: {
                    cookie: !1
                }
            }
        });
    }
};
jQuery(document).ready(function () {
    KTDatatableHtmlTableDemo.init()
});