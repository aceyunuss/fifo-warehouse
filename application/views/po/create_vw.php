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
        <form role="form text-left" action="<?= site_url('po/new_inp') ?>" method="POST" id="submitform">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">PO No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="po" readonly value="<?= $po ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">PO Date</h6>
            </label>
            <div class="col-sm-3">
              <input type="datetime-local" class="form-control neds" name="podate" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">PR No</h6>
            </label>
            <div class="col-sm-3">
              <select class="form-control" name="pr" id="pr">
                <option value="">--Pilih--</option>
                <?php foreach ($pr as $v) { ?>
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
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">PR No</th>
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
    $('.prdate').attr("min", today)


    $('#pr').change(function() {
      let pr = $(this).val()

      if (pr == "") {
        alert("Nomor PR harap diisi")
      } else {
        $.ajax({
          type: "POST",
          url: '<?= site_url('po/get_pr') ?>',
          data: {
            pr: pr,
          },
          success: function(data, textStatus, jQxhr) {
            cale = JSON.parse(data)
            tbody = ""
            $(".tbody").empty();
            for (let x in cale) {
              tbody += '<tr class="text-center">\
                  <td>\
                    <p class="text-sm mb-0">' + cale[x].pr + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + cale[x].supplier + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + cale[x].description + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + cale[x].item_name + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + cale[x].width + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + cale[x].length + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">' + cale[x].qty + '</p>\
                  </td>\
                  <td>\
                    <p class="text-sm mb-0">Roll</p>\
                  </td>\
                </tr>'
            }

            $('.item_table tbody').append(tbody)

          },
        });
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