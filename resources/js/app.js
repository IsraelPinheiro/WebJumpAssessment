window.Popper = require('popper.js').default;
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;
require('bootstrap');
//JQuery Easing
require('jquery-easing')
//JQuery Validation
require('jquery-validation')
//SB Admin 2
require('./sb-admin-2')
//Chart.js
require('chart.js')
//Sweetalert
import swal from 'sweetalert';
window.Swal = swal;
//Datatables
require('./datatables')
//Pages handling
require('./pages')