require('./bootstrap');
require('admin-lte');

import $ from 'jquery';
window.$ = window.jQuery = $;
window.toastr = require("toastr");

require('jquery-validation');
require('jquery-blockui');

import 'admin-lte/plugins/datatables/jquery.dataTables.min.js';
import 'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js';
import 'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js';
import 'admin-lte/plugins/bootstrap/js/bootstrap.min.js';
import 'admin-lte/plugins/sweetalert2/sweetalert2.min.js';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function () {
        $.blockUI({
            message: $(
                '<div class="fa-3x"><i class="fas fa-spinner fa-spin"></i></div>'
            ),
            baseZ: 1100
        });
    },
    error: function (jqXHR, textStatus, errorThrown) {
        switch (jqXHR.status) {
            case 400:
                // TODO handel
                break;
            case 401:
                toastr.error(jqXHR.responseJSON.message);
                break;
            case 500:
                toastr.error(jqXHR.responseJSON.message);
                break;
            case 419:
                // TODO show message
                window.location.reload();
                break;
            case 422:
                toastr.error(Object.values(jqXHR.responseJSON.errors));
                break;
        }
    },
});

// build method jquery validation
$.validator.addMethod("regex", function (value, element, regexp) {
    const regex = new RegExp(regexp);
    return this.optional(element) || regex.test(value);
});
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');
$.validator.addMethod( "extension", function( value, element, param ) {
	param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g|gif";
	return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
}, $.validator.format( "Please enter a value with a valid extension." ) );

toastr.options = {
    maxOpened: 1,
    preventDuplicates:1,
    autoDismiss: true
};

// setting global datatable
$.fn.dataTable.ext.errMode = 'none';
$.extend($.fn.dataTable.defaults, {
    lengthMenu: [ [100, 200, 300, -1], [100, 200, 300, "??????"] ],
    pageLength: 100,
    language: {
        emptyTable: "??????????????????????????????????????????",
        lengthMenu: "_MENU_ ???????????? 1  ?????????",
        loadingRecords: "???????????????...",
        processing: "?????????...",
        search: "??????:",
        zeroRecords: "??????????????????????????????????????????",
        infoEmpty: "??????????????????????????????????????????",
        paginate: {
            first: "??????",
            last: "??????",
            next: "???",
            previous: "???",
        },
        info: "_START_ - _END_ / _TOTAL_??????",
        infoFiltered:""
    },
    processing: true,
    serverSide: true,
    paging: true,
    responsive: true,
    width: "100%",
    pagingType: "full_numbers",
    orderCellsTop: true,
    scrollX: true,
    scrollCollapse: true,
});

$(function() {
    $(document).on('show.bs.modal', '.modal', function() {
        const zIndex = 1040 + 10 * $('.modal:visible').length;
        $(this).css('z-index', zIndex);
        setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
    });
})
