<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?></h6>
          </div>
          <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-0" href="<?= site_url('user/newuser') ?>"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Tambah User Baru</a>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="datatebel" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Posisi</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($userlist as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= ++$key ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['complete_name'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['position'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['username'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('user/edituser/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Ubah</a>
                    <a onclick="return confirm('Apakah ingin menghapus user ini?');" href="<?= site_url('user/deleteuser/' . $value['id']) ?>" class="badge badge-sm bg-gradient-warning">Hapus</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    na = '<div class="card-body pt-4 p-3">\
            <ul class="list-group">\
              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">\
                <div class="d-flex flex-column">\
                  <div id="nav"></div>\
                </div>\
              </li>\
            </ul>\
          </div>';

    $('#datatebel').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#datatebel tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#nav').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#datatebel tbody tr').hide();
    $('#datatebel tbody tr').slice(0, rowsShown).show();
    $('#nav a:first').addClass('active');
    $('#nav a').bind('click', function() {

      $('#nav a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#datatebel tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });
  });
</script>