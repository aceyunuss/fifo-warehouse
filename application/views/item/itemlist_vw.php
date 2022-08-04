<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?></h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="list" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No Lot</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Item Code</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Supplier</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Lebar (cm)</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Panjang (cm)</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aktual</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">UOM</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Update Terakhir</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($item as $key => $value) { ?>
                <tr class="text-center">
                  <form method="POST" action="<?= site_url('item/update') ?>">
                    <td>
                      <p class="text-sm mb-0"><?= $value['lot'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['code'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['supp_name'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['description'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['name'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['width'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['length'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['qty'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['act'] ?></p>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= "ROLL" ?></p>
                    </td>
                    <td>
                      <a href="<?= site_url('item/update/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Simpan</a>
                    </td>
                    <td>
                      <p class="text-sm mb-0"><?= $value['updated'] ?></p>
                    </td>
                    <td>
                      <input type="text" class="form-control" name="note" value="<?= $value['note'] ?>">
                      <input type="hidden" class="form-control" name="id" value="<?= $value['id'] ?>">
                    </td>
                  </form>
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
    var rowsShown = 10;
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
