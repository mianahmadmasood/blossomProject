"use strict";
var KTDatatablesBasicBasic = {
    init: function () {
        var e;
        (e = $("#kt_table_1")).DataTable({
            responsive: !0,
            dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            "paging": false,
            "ordering": false,
            "info": false,
            language: {
                lengthMenu: "Display _MENU_"
            },
        }), e.on("change", ".kt-group-checkable", function () {
            var e = $(this).closest("table").find("td:first-child .kt-checkable"),
                    t = $(this).is(":checked");
            $(e).each(function () {
                t ? ($(this).prop("checked", !0), $(this).closest("tr").addClass("active")) : ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
            })
        }), e.on("change", "tbody tr .kt-checkbox", function () {
            $(this).parents("tr").toggleClass("active")
        })
    }
};
jQuery(document).ready(function () {
    KTDatatablesBasicBasic.init()
});