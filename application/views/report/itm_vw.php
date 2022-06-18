<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?> Stok Barang</h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="itemstock" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Item Code</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Lebar (cm)</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Panjang (cm)</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($item as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['code'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['dsc'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['nm'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['wd'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['lg'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['qty'] ?></p>
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
              <div id="navstock"></div>\
            </div>\
          </li>\
        </ul>\
      </div>';

    $('#itemstock').after(na);
    var rowsShown = 5;
    var rowsTotal = $('#itemstock tbody tr').length;
    var numPages = rowsTotal / rowsShown;
    for (i = 0; i < numPages; i++) {
      var pageNum = i + 1;
      $('#navstock').append('<a  class="btn bg-gradient-primary" href="#" rel="' + i + '">' + pageNum + '</a> ');
    }
    $('#itemstock tbody tr').hide();
    $('#itemstock tbody tr').slice(0, rowsShown).show();
    $('#navstock a:first').addClass('active');
    $('#navstock a').bind('click', function() {

      $('#navstock a').removeClass('active');
      $(this).addClass('active');
      var currPage = $(this).attr('rel');
      var startItem = currPage * rowsShown;
      var endItem = startItem + rowsShown;
      $('#itemstock tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).
      css('display', 'table-row').animate({
        opacity: 1
      }, 300);
    });
  });
</script>