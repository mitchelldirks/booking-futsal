<div class="row">
  <div class="col-sm-12">
    <?php 
    if (isset($_SESSION['flash'])): ?>
      <div class="<?php echo $_SESSION['flash']['class']; ?> mt-3 mb-3 alert-dismissible fade show"> 
        <span class="text-white">
          <i class="<?php echo $_SESSION['flash']['icon'] ?>"></i> 
          <?php echo $_SESSION['flash']['label']; ?>  
        </span>
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
    <?php endif ?>
  </div>
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <a class="btn btn-primary" href="?module=<?php echo $_GET['module'];?>&act=create">Tambah <?php echo ucwords($_GET['module']) ?></a>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table display" id="datatables">
            <thead>
              <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telp</th>
                <th>Level</th>
                <th class="d-print-none"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=0;
              $query = mysqli_query($conn,"SELECT * from users order by id desc");

              foreach ($query as $row): $no++;?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['username'] ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo $row['email'] ?></td>
                  <td><?php echo $row['no_telp'] ?></td>
                  <td><?php echo ucwords($row['level']) ?></td>
                  <td class="d-print-none text-right">
                    <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Edit" href="?module=<?php echo $_GET['module'] ?>&act=edit&id=<?php echo $row['id']; ?>"><i class="fa fa-pencil"></i></a>
                    <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete" onclick="swal_delete('<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=delete&id=<?php echo $row['id']; ?>')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>