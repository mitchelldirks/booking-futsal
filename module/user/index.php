<div class="row">
  <div class="col-sm-12">
    <?php 
    if (isset($_SESSION['flash'])): ?>
      <div class="<?php echo $_SESSION['flash']['class']; ?> mt-3 mb-3 alert-dismissible fade show"> 
        <i class="<?php echo $_SESSION['flash']['icon'] ?>"></i> <?php echo $_SESSION['flash']['label']; ?>
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
    <?php endif ?>
  </div>
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#createModal">Tambah <?php echo ucwords($_GET['module']) ?></button>
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo ucwords($_GET['module']) ?> Create</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <?php include 'module/'.$_GET['module'].'/modal_create.php'; ?>
              </div>
            </div>
          </div>
        </div>
        <!-- <h5>Zero Configuration</h5>
        <span>DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code>$().DataTable();</code>.</span>
        <span>Searching, ordering and paging goodness will be immediately added to the table, as shown in this example.</span> -->
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
         <table class="table display" id="basic-1">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Phone</th>
              <th>Email</th>
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
                <td><?php echo $row['no_telp'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['level'] ?></td>
                <td class="d-print-none text-right">
                  <a class="btn btn-primary btn-xs" href="?module=<?php echo $_GET['module'] ?>&act=edit&id=<?php echo $row['id']; ?>"><i data-feather="edit"></i></a>
                  <a class="btn btn-danger btn-xs" onclick="return confirm('Hapus data?')" href="<?php echo $aksi ?>?module=<?php echo $_GET['module'] ?>&act=delete&id=<?php echo $row['id']; ?>">Delete<i data-feather="delete"></i></a>
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