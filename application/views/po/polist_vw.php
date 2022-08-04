<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?></h6>
          </div>
          <?php if ($this->session->userdata('position') == "Purchase") { ?>
            <div class="col-6 text-end">
              <a class="btn bg-gradient-dark mb-0" href="<?= site_url('po/create') ?>"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Buat PO</a>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="list" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">PO No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">PO Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">PR No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['po'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['pr'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['supplier'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['status'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('po/view/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Lihat</a>
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
            <h6 class="mb-0"><?= "Riwayat " . $title ?></h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="hist" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">PO No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">PO Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">PR No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($hist as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['po'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['po_date'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['pr'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['status'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('po/view/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Lihat</a>
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
              <div id="navlist"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#list').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#list tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navlist').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#list tbody tr').hide();
    $('#list tbody tr').slice(0, rowsShown).show();
    $('#navlist a:first').addClass('active');
    $('#navlist a').bind('click', function() {

      $('#navlist a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#list tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });
  });
</script>


<script>
  $(document).ready(function() {

    na = '<div class="card-body pt-4 p-3">\
        <ul class="list-group">\
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">\
            <div class="d-flex flex-column">\
              <div id="navhist"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#hist').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#hist tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navhist').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#hist tbody tr').hide();
    $('#hist tbody tr').slice(0, rowsShown).show();
    $('#navhist a:first').addClass('active');
    $('#navhist a').bind('click', function() {

      $('#navhist a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#hist tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });
  });
</script>