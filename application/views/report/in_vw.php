<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?> Barang Masuk</h6>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="inbound" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">BPB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Supplier</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">BPB Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Delivery Order Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">PO No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($in as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['bpb'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['supp_name'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= substr($value['bpb_date'], 0, 10) ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= substr($value['do_date'], 0, 10) ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['po'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['status'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('inbound/view/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Lihat</a>
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
  });
</script>