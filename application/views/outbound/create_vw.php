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
              <input type="datetime-local" class="form-control neds" name="stbdate" required>
            </div>
            <div class="col-sm-1">
            </div>
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">SPB No</h6>
            </label>
            <div class="col-sm-3">
              <select class="form-control" name="spb" id="spb">
                <option value="">-- Pilih --</option>
                <?php foreach ($spb as $v) { ?>
                  <option value="<?= $v ?>"><?= $v ?></option>
                <?php } ?>
              </select>
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
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder">Waktu</th>
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
    $('.stbdate').attr("min", today)


    $('#spb').change(function() {

      let spb = $("#spb").val()

      if (spb != "") {
        $.ajax({
          type: "POST",
          url: '<?= site_url('outbound/get_spbb') ?>',
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

              tbody += '<tr class="text-center">\
                  <td>\
                    <p class="text-sm mb-0">' + itm.lot + '</p>\
                    <input type="hidden" name="lot[]" value="' + itm.lot + '">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.lot_date + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.item_code + '</p>\
                    <input type="hidden" name="item_code[]" value="' + itm.item_code + '">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.description + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.item_name + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.width + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.length + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + itm.qty + '</p>\
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