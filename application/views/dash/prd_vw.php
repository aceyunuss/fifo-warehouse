<div class="row mt-4">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0">List Surat Perintah Kerja</h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="todo_spk" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPK No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPK Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($spktodo as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['spk'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['spk_date'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['description'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('spk/process/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Proses</a>
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

<div class="row mt-4">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0">List Serah Terima Barang</h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="todo_stb" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($outtodo as $key => $value) { ?>
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
                    <a href="<?= site_url('outbound/process/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Proses</a>
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
            <h6 class="mb-0">Riwayat Surat Perintah Kerja</h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="spkhist" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPK No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPK Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($spk as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['spk'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['spk_date'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['description'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['status'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('spk/view/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Lihat</a>
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

<div class="row mt-4">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0">Riwayat Serah Terima Barang</h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="stbhist" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPB No</th>
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
          <div id="navtspk"></div>\
        </div>\
      </li>\
    </ul>\
  </div>';

    $('#todo_spk').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#todo_spk tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navtspk').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#todo_spk tbody tr').hide();
    $('#todo_spk tbody tr').slice(0, rowsShown).show();
    $('#navtspk a:first').addClass('active');
    $('#navtspk a').bind('click', function() {

      $('#navtspk a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#todo_spk tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });

    na = '<div class="card-body pt-4 p-3">\
        <ul class="list-group">\
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">\
            <div class="d-flex flex-column">\
              <div id="navtstb"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#todo_stb').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#todo_stb tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navtstb').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#todo_stb tbody tr').hide();
    $('#todo_stb tbody tr').slice(0, rowsShown).show();
    $('#navtstb a:first').addClass('active');
    $('#navtstb a').bind('click', function() {

      $('#navtstb a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#todo_stb tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
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
              <div id="navin"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#inbound').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#inbound tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navin').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#inbound tbody tr').hide();
    $('#inbound tbody tr').slice(0, rowsShown).show();
    $('#navin a:first').addClass('active');
    $('#navin a').bind('click', function() {

      $('#navin a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#inbound tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });


    ne = '<div class="card-body pt-4 p-3">\
        <ul class="list-group">\
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">\
            <div class="d-flex flex-column">\
              <div id="navstb"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#stbhist').after(ne);
    var rowsShown = 5;
    var rowsTotal = $('#stbhist tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navstb').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#stbhist tbody tr').hide();
    $('#stbhist tbody tr').slice(0, rowsShown).show();
    $('#navstb a:first').addClass('active');
    $('#navstb a').bind('click', function() {

      $('#navstb a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#stbhist tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });


    nx = '<div class="card-body pt-4 p-3">\
        <ul class="list-group">\
          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">\
            <div class="d-flex flex-column">\
              <div id="navspk"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#spkhist').after(nx);
    var rowsShown = 5;
    var rowsTotal = $('#spkhist tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navspk').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#spkhist tbody tr').hide();
    $('#spkhist tbody tr').slice(0, rowsShown).show();
    $('#navspk a:first').addClass('active');
    $('#navspk a').bind('click', function() {

      $('#navspk a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#spkhist tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });
  });
</script>