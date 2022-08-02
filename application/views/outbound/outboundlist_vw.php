<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?></h6>
          </div>
          <?php if ($this->session->userdata('position') == "Admin Gudang") { ?>
            <div class="col-6 text-end">
              <a class="btn bg-gradient-dark mb-0" href="<?= site_url('outbound/create') ?>"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Buat STB</a>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="datatebel" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($logs as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['stb'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['stb_date'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['spb'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['status'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('outbound/view/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Lihat</a>
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

<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= ($this->session->userdata('position') == "Admin Gudang") ? "Riwayat Barang Keluar"  : "Riwayat Terima Barang" ?></h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="itemout" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($out as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['stb'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['stb_date'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['spb'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['status'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('outbound/view/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Lihat</a>
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
              <div id="navout"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#itemout').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#itemout tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navout').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#itemout tbody tr').hide();
    $('#itemout tbody tr').slice(0, rowsShown).show();
    $('#navout a:first').addClass('active');
    $('#navout a').bind('click', function() {

      $('#navout a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#itemout tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });
  });
</script>