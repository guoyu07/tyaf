
/**
 * 获取scriptTag DOM元素
 * require异步加载对应JS文件
 * @type @exp;document@call;getElementById
 */
var scriptTag = document.getElementById('scriptTag');
var cdnUri = '../common/';
var cdncssUri = '../../css/';
/**
 * 必加载项
 * jquery
 * bootstrap
 * util
 * spinner
 * sweetAlert
 * metisMenu
 * slimScroll
 * inspinia
 * @param {type} param
 */
/**
 *     <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>
 */
if (scriptTag) {
    require.config({
        map: {  
            '*': {  
                'css': cdnUri+'css.min'  
            }  
        }, 
        paths: {
            jquery: cdnUri + 'jquery-2.1.1',
            jqueryUi: cdnUri + 'jquery-ui-1.10.4.min',
            bootstrap: cdnUri + 'bootstrap.min',
            Util: cdnUri + 'inspinia',
            Spinner: cdnUri + 'plugins/spinner/spinner.min',
            sweetAlert: cdnUri + 'plugins/sweetalert/sweetalert.min',
            metisMenu: cdnUri + 'plugins/metisMenu/jquery.metisMenu',
            slimScroll: cdnUri + 'plugins/slimscroll/jquery.slimscroll.min',
            inspinia: cdnUri + 'inspinia',
            uploadify: cdnUri + 'plugins/uploadify/jquery.uploadify.min',
            chosen: cdnUri + 'plugins/chosen/chosen.jquery',
            pagination: cdnUri + 'plugins/jquery-pagination/jquery.pagination',
            jQtmpl: cdnUri + 'plugins/jquery-tmpl/jquery.tmpl.min',
            datePicker: cdnUri + 'plugins/datapicker/bootstrap-datepicker',
            dateRangePicker: cdnUri + 'plugins/daterangepicker/daterangepicker',
            moment: cdnUri + 'plugins/fullcalendar/moment.min',
            fooTable: cdnUri + 'plugins/footable/footable.all.min',
            Chart: cdnUri + 'plugins/chartJs/Chart.min',
            jQColor: cdnUri + 'plugins/color//jquery.color',
            pace:cdnUri + 'plugins/pace/pace.min',
            flot:cdnUri + 'plugins/flot/jquery.flot',
            flotTooltip:cdnUri + 'plugins/flot/jquery.flot.tooltip.min',
            flotSpline:cdnUri + 'plugins/flot/jquery.flot.spline',
            flotResize:cdnUri + 'plugins/flot/jquery.flot.resize',
            flotPie:cdnUri + 'plugins/flot/jquery.flot.pie',
            toastr:cdnUri + 'plugins/toastr/toastr.min',
        },
        shim: {
            'jquery': {
                exports: '$'
            },
            'jqueryUi': {
                deps: ['jquery']
            },
            'bootstrap': {
                deps: ['jquery']
            },
            'metisMenu': {
                deps: ['jquery'],
                exports: 'metisMenu'
            },
            'sweetAlert': {
                deps: ['jquery']
            },
            'toastr':
            {
                deps: ['jquery','css!'+cdncssUri+'plugins/toastr/toastr.min.css'],
                exports: 'toastr' 
            },
            'slimScroll': {
                deps: ['jquery'],
                exports: 'slimScroll'
            },
            'flot':{
                deps: ['jquery'],
                exports: 'flot'
            },
            'inspinia': {
                deps: ['jquery','jqueryUi','bootstrap','metisMenu','slimScroll','toastr']
            },
            'uploadify': {
                deps: ['jquery']
            },
            'chosen': {
                deps: ['jquery']
            },
            'pagination': {
                deps: ['jquery']
            },
            'jQtmpl': {
                deps: ['jquery']
            },
            'moment': {
                deps: ['jquery']
            },
            'datePicker': {
                deps: ['jquery', 'moment']
            },
            'dateRangePicker': {
                deps: ['jquery', 'moment']
            },
            'fooTable': {
                deps: ['jquery']
            },
            'Chart': {
                exports: 'Chart'
            },
            'jQColor': {
                deps: ['jquery']
            }
        },
        // urlArgs: "bust=1.0.0",
       urlArgs: "bust=" + Date.parse(new Date()),
        xhtml: true
    });
    require([scriptTag.innerHTML]);
}


