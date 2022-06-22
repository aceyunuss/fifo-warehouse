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
        <form role="form text-left" action="<?= site_url('outbound/new_inp') ?>" method="POST">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">STB No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="stb" readonly value="<?= $stb ?>">
            </div>
            <div class="col-sm-1">
            </div>
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Divisi</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="div" readonly value="Warehouse">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">STB Date</h6>
            </label>
            <div class="col-sm-3">
              <input type="date" class="form-control" name="stbdate" required>
            </div>
            <div class="col-sm-1">
            </div>
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">SPB No</h6>
            </label>
            <div class="col-sm-2">
              <input type="text" maxlength="255" class="form-control" name="spb" id="spb">
            </div>
            <div class="col-sm-1">
              <a href="#" class="btn bg-gradient-primary btn-md fin"><i class="fas fa-search"></i></a>
            </div>
          </div>

          <br>
          <hr class="horizontal dark mt-0">
          <br>


          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 item_table">
              <thead>
                <tr>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">No. Lot</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Item Code</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Description</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Item Name</th>
                  <th colspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Size</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Qty</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">UOM</th>
                </tr>
                <tr>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Lebar (cm)</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Panjang (cm)</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>


          <div class="text-center">
            <br>
            <button type="submit" id="submitform" class="btn bg-gradient-dark">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {

    $('.fin').click(function() {

      let spb = $("#spb").val()

      if (spb != "") {
        $.ajax({
          type: "POST",
          url: '<?= site_url('outbound/get_spb') ?>',
          data: {
            spb: spb,
          },
          success: function(data, textStatus, jQxhr) {
            $(".selec2").select2("destroy");

            cale = JSON.parse(data)
            let tbody = "";
            $('.item_table tbody').html('')

            for (let x in cale) {
              itm = cale[x];
              sel = "";
              for (let i in itm.lot) {
                l = itm.lot[i];
                sel += "<option value='" + l.lot_id + "'>" + l.lot + "(" + l.qty + ")</option>"
              }

              tbody += '<tr class="text-center">\
                  <td>\
                    <div class="col-sm-12">\
                      <select class="select2 selboy" name="lot[' + itm.stock_id + '][]" multiple="multiple" style=\'width:100%\'>\
                        ' + sel + '\
                      </select>\
                    </div>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.code + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.description + '</p>\
                    <input type="hidden" value="' + itm.stock_id + '" name="stock_id[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.name + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.length + '</p>\
                    <input type="hidden" value="' + itm.length + '" name="length[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.width + '</p>\
                    <input type="hidden" value="' + itm.width + '" name="width[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.qty + '</p>\
                    <input type="hidden" value="' + itm.qty + '" name="qty[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">Roll</p>\
                  </td>\
                </tr>'
            }

            $('.item_table tbody').append(tbody)
            $(".select2").select2();
          },
        });
      }
    })

  })
</script>