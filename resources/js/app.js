try {
    window.$ = window.jQuery = require('jquery');
    require('./bootstrap');
    require('bootstrap/dist/js/bootstrap.bundle');
    require('admin-lte/dist/js/adminlte.min');
    require('datatables.net');
    require('datatables.net-bs4');
    require('bootstrap-datepicker');
    require('bootstrap-daterangepicker');
    require('eonasdan-bootstrap-datetimepicker');
    require('bootstrap-colorpicker');
    require('select2');
    require('moment');
    require('dropify');
    require('summernote');
    require('lightbox2');
    require('./jquery.inputmask.bundle');
} catch (e) {console.log(e)}
