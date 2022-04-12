<meta charset="utf-8" />
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="assets/img/favicon.png">
<title><?php echo isset($_GET['module']) ? ucwords(str_replace("_"," ",$_GET['module']))." | ".TITLE : " Dashboard "." | ".TITLE ?></title>

<!-- <link rel="canonical" href="https://www.creative-tim.com/product/soft-ui-dashboard" /> -->
  <!-- <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Soft UI Dashboard bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, free dashboard, free admin dashboard, free bootstrap 5 admin dashboard">
    <meta name="description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">-->
  <!-- <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Soft UI Dashboard by Creative Tim">
  <meta name="twitter:description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you.">
  <meta name="twitter:creator" content="@creativetim"> -->
  <!-- <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Soft UI Dashboard by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="http://demos.creative-tim.com/soft-ui-dashboard/examples/dashboard.html" />
  <meta property="og:description" content="Soft UI Dashboard is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful and organized. If you are looking for a tool to manage and visualize data about your business, this dashboard is the thing for you." />
  <meta property="og:site_name" content="Creative Tim" /> -->
  <?php 
  $css = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',
    'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',
    'assets/css/nucleo-icons.css',
    'assets/css/nucleo-svg.css',
    'assets/css/soft-ui-dashboard.min3447.css?v=1.0.5',
  );
  foreach ($css as $key => $value) { ?>
    <link href="<?= $value ?>" rel="stylesheet"/>
    <?php
  }
  ?>
  <style>
    .async-hide {
      opacity: 0 !important
    }
  </style>