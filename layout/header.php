<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <h6 class="font-weight-bolder mb-0">
        <?php 
        foreach ($breadcrumb as $key=>$bread) {
          $bc[] = '<a href="'.$bread['link'].'" class="'.($key == count($breadcrumb)-1 ? 'text-primary':'').'">'.$bread['text'].'</a>';
        }
        echo implode(" <span style='padding:6px'>\</span> ",$bc);
        ?>
      </h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group" hidden>
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" class="form-control" placeholder="Type here...">
        </div>
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-flex align-items-center" style="padding-right: 12px;">
          <a href="#" class="nav-link text-body font-weight-bold px-0">
            <i class="fa fa-user me-sm-1"></i>
            <span class="d-sm-inline d-none"><?php echo $_SESSION['nama'] ?></span>
          </a>
        </li>
        <li class="nav-item d-flex align-items-center">
          <a class="btn bg-gradient-primary btn-sm mb-0 me-3" onclick="logout()">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>