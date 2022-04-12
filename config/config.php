<?php 
define(	"TITLE",	"Futsal");
define(	"BASE_URL",	"http://brainy.monev-unsada.my.id");
// assets css
$css = array(
	'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',
	'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
	'assets/css/animate.css',
	'assets/css/chartist.css',
	'assets/css/datatables.css',
	'assets/css/flag-icon.css',
	'assets/css/feather-icon.css',
	'assets/css/flaticon.css',
	'assets/css/fontawesome.css',
	'assets/css/icofont.css',
	'assets/css/nucleo-icons.css',
	'assets/css/nucleo-svg.css',
	'assets/css/owlcarousel.css',
	'assets/css/soft-ui-dashboard.min3447.css?v=1.0.5',
	'assets/css/themify.css',
);
// assets javascript
$js = array(
	'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js',
	'https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js',
	'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js',
	// 'assets/js/plugins/perfect-scrollbar.min.js',
	// 'assets/js/plugins/smooth-scrollbar.min.js',
	// 'assets/js/soft-ui-dashboard.min3447.js?v=1.0.5',
	'https://cdn.jsdelivr.net/npm/sweetalert2@11',
	'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js',
);
//breadcrumb
$breadcrumb = array();
$breadcrumb[] = ['text'=>'<i class="fa fa-home"></i>','link'=>'?'];
$breadcrumb[] = isset($_GET['module']) ? ['text'=>ucwords(str_replace("_"," ",$_GET['module'])),'link'=>'?module='.$_GET['module']] : ['text'=>"Dashboard",'link'=>'?'];
if (isset($_GET['act'])) { 
	$breadcrumb[] = ['text'=>ucwords(str_replace("_"," ",$_GET['act'])),'link'=>'?module='.$_GET['module'].'&act='.$_GET['act']]; 
}
?>