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
      <div class="card-body">
        <form role="form text-left" action="<?= site_url('spk/new_inp') ?>" method="POST" id="submitform">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">SPK No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="spk" readonly value="<?= $spk ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">SPK Date</h6>
            </label>
            <div class="col-sm-3">
              <input type="datetime-local" class="form-control neds" name="spkdate" spkuired>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Item Category</h6>
            </label>
            <div class="col-sm-3">
              <select class="form-control" id="cat" name="cat">
                <option value="">-- Pilih --</option>
                <?php foreach ($cat as $key => $value) { ?>
                  <option value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <br>
          <hr class="horizontal dark mt-0">
          <br>


          <div class="table-responsive p-0">
            <table id="list" class="table align-items-center mb-0 item_table">
              <thead>
                <tr>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Item Code</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Supplier</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Description</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Item Name</th>
                  <th colspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Size</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Qty</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Pemakaian</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Kebutuhan</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">UOM</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Permintaan Pembelian</th>
                </tr>
                <tr>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Lebar (cm)</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Panjang (cm)</th>
                </tr>
              </thead>
              <tbody class="tbody">
              </tbody>
            </table>
          </div>


          <div class="text-center">
            <br>
            <button type="submit" class="btn bg-gradient-dark">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function() {


    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd
    }
    if (mm < 10) {
      mm = '0' + mm
    }
    today = mm + '/' + dd + '/' + yyyy;
    console.log(today)
    $('.spkdate').attr("min", today)


    $('#cat').change(function() {
      let cat = $(this).val()
      $.ajax({
        type: "POST",
        url: '<?= site_url('item/get_item') ?>',
        data: {
          cat: cat,
        },
        success: function(data, textStatus, jQxhr) {
          cale = JSON.parse(data)

          $(".tbody").empty();
          let tbody = ""
          for (let x in cale) {
            lot = cale[x].lot == null ? "" : cale[x].lot;
            tbody += `<tr class="text-center">
                        <td>
                          <p class="text-sm mb-0">` + lot + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].supp_name + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].description + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].name + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].width + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].length + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].qty + `</p>
                        </td>
                        <td>
                          <input type="checkbox" class="used" value="1" name="used[` + cale[x].id + `]">
                        </td>
                        <td>
                          <input style="width: 50px;" type="number" min="0"name="needed[` + cale[x].id + `]">
                        </td>
                        <td>
                          <p class="text-sm mb-0">ROLL</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">3</p>
                        </td>
                      </tr>`
          }

          $('.item_table tbody').append(tbody)


        },
      });
    })

  })

  $(document).on('submit', "#submitform", function(e) {

    va = 0;
    $('input:checkbox.used').each(function() {
      tv = (this.checked ? $(this).val() : 0);
      va = parseInt(tv) + parseInt(va);
    });

    if (va != 1) {
      e.preventDefault();
      alert("Harap pilih hanya satu barang")
    }

  })
</script>


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