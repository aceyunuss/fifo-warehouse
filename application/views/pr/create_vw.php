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
        <form role="form text-left" action="<?= site_url('pr/new_inp') ?>" method="POST" id="submitform">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">PR No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="pr" readonly value="<?= $pr ?>">
            </div>
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">SPK Date</h6>
            </label>
            <div class="col-sm-3">
              <input type="date" class="form-control spkdate" name="spkdate" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">PR Date</h6>
            </label>
            <div class="col-sm-3">
              <input type="date" class="form-control" name="prdate" required>
            </div>
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Item Category</h6>
            </label>
            <div class="col-sm-3">
              <select class="form-control cat" id="cat" name="cat">
                <option value="">-- Pilih --</option>
                <?php foreach ($cat as $key => $value) { ?>
                  <option value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-1">
              <a href="#" id="fnd" class="btn btn-outline-primary btn-sm mb-0 add">Cari</a>
            </div>
          </div>
          <br>
          <hr class="horizontal dark mt-0">
          <br>

          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 item_table">
              <thead>
                <tr>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Kebutuhan</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">SPK No</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Item Code</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Supplier</th>
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
              <tbody id="tbo">
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
    $('.prdate').attr("min", today)


    $('#fnd').click(function() {
      let spkdate = $('.spkdate').val()
      let cat = $('.cat').val()

      if (spkdate == "" || cat == "") {
        alert("SPK Date dan Item Category harap diisi");
      } else {
        $.ajax({
          type: "POST",
          url: '<?= site_url('pr/get_spk') ?>',
          data: {
            cat: cat,
            spkdate: spkdate,
          },
          success: function(data, textStatus, jQxhr) {
            cale = JSON.parse(data)
            $("#tbo").empty();
            tbody = "";
            for (let x in cale) {
              cd = cale[x].item_code == null ? "" : cale[x].item_code;
              tbody += `<tr class="text-center">
                        <td>
                          <input type="checkbox" class="used" value="1" name="used[` + cale[x].id + `]">
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].spk + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cd + `</p>
                        </td>
                        <td>
                          <p class="text-sm mb-0">` + cale[x].supplier + `</p>
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
                          <p class="text-sm mb-0">ROLL</p>
                        </td>
                      </tr>`
            }

            $('.item_table tbody').append(tbody)
          },
        });
      }
    })

    $('.add').click(function() {
      let counter = $('.item_table tr').length + 1;
      let stock_id = $('#itm').val()
      let item = $('#itm option:selected').text()
      let desc = item.split('|')[0]
      let name = item.split('|')[1]
      let cat = $('#cat').val()
      let qty = $('#qty').val()
      let size = item.split('|')[2]
      let le = size.split('x')[0]
      let wi = size.split('x')[1]

      if (stock_id == "" || cat == "" || qty == "" || le == "" || wi == "") {

        alert("Form item harus dilelngkapi")

      } else {

        tbody = '<tr class="text-center">\
                  <td>\
                    <i class="fa fa-trash text-danger remove"></i>\
                    <input type="hidden" value="' + stock_id + '" name="stock_id[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + cat + '</p>\
                    <input type="hidden" value="' + cat + '" name="cat[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + desc + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + name + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + le + '</p>\
                    <input type="hidden" value="' + le + '" name="length[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + wi + '</p>\
                    <input type="hidden" value="' + wi + '" name="width[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + qty + '</p>\
                    <input type="hidden" value="' + qty + '" name="qty[]">\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">Roll</p>\
                  </td>\
                </tr>'

        $('.item_table tbody').append(tbody)

        $('#itm').val('')
        $('#qty').val('')
        $('#itm').trigger('change')

      }
    })
  })


  $(document).on('click', '.remove', function() {
    if (confirm("Are you sure delete this item?")) {
      $(this).parent().parent().remove();
    }
  })


  // $("#submitform").submit(function(e) {

  //   if ($('.item_table tr').length == 2) {
  //     alert("List barang tidak boleh kosong")
  //   }


  // })
</script>