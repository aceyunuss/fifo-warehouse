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
        <form role="form text-left" action="<?= site_url('user/new_inp') ?>" method="POST">

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Supplier</h6>
            </label>
            <div class="col-sm-4">
              <select class="form-control select2" required name="supp">
                <option value="">-- Pilih --</option>
                <?php foreach ($supp as $key => $value) { ?>
                  <option value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-1">
            </div>
            <label class="col-sm-1 col-form-label">
              <h6 class="mb-1 text-dark text-sm">BPB No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="bpbno" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Delivery Order/Date</h6>
            </label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="dodate" required>
            </div>
            <div class="col-sm-1">
            </div>
            <label class="col-sm-1 col-form-label">
              <h6 class="mb-1 text-dark text-sm">BPB Date</h6>
            </label>
            <div class="col-sm-3">
              <input type="date" class="form-control" name="bpbdate" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">PO No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="po" required>
            </div>
          </div>
          <br>
          <hr class="horizontal dark mt-0">
          <br>


          <div class="form-group row">
            <!-- <label class="col-sm-2 col-form-label">
              <h6 class="mb-1 text-dark text-sm">Supplier</h6>
            </label> -->
            <div class="col-sm-5">
              <select class="form-control select2" required id="item">
                <option value="">-- Pilih Barang --</option>
                <?php foreach ($item as $key => $value) { ?>
                  <option value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-3">
              <a class="btn btn-outline-primary btn-sm mb-0 add">Tambah Barang</a>
            </div>
          </div>
          <br>
          <hr class="horizontal dark mt-0">
          <br>

          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Item Category</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Description</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Item Name</th>
                  <th colspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Size</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Qty</th>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">UOM</th>
                </tr>
                <tr>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Lebar</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Panjang</th>
                </tr>
              </thead>
              <tbody>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0">RML RMP DT</p>
                  </td>
                  <td>
                    <p class="text-sm mb-0">Chromo Backing Putih </p>
                  </td>
                  <td>
                    <p class="text-sm mb-0">LP.CC/GL P-A "CAMEL" </p>
                  </td>
                  <td>
                    <p class="text-sm mb-0">3</p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"> 20 </p>
                  </td>
                  <td>
                    <center>
                      <input type="number" class="form-control form-control-sm" style="width:100px">
                    </center>
                  </td>
                  <td>
                    <p class="text-sm mb-0">Roll</p>
                  </td>
                </tr>
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

    $('.add').click(function() {
      let counter = $('.item_table tr').length + 1;
      let item_id = $('#det_name').val()


      if (name == "" || weight == "" || type == "") {

        alert("Max value is 100")

      } else {

        tbody = '<tr>\
                    <td><center><i class="remove fa fa-trash-o"></i></center></td>\
                    <td>' + name + '</td>\
                    <input type="hidden" value="' + name + '" name="cr_name[]">\
                    <td>' + type + '</td>\
                    <input type="hidden" value="' + type + '" name="cr_type[]">\
                    <td><center>' + weight + '</center></td>\
                    <input class="wg" type="hidden" value="' + weight + '" name="cr_weight[]">\
                  </tr>';

        $('.item_table tbody').append(tbody)

      }
    })
  })


  $(document).on('click', '.remove', function() {
    if (confirm("Are you sure delete this item?")) {
      $(this).parent().parent().parent().remove();
    }
  })


  $("#submitform").submit(function(e) {

    if ($('.item_table tr').length == 1) {
      alert("Item can't be empty")
      e.preventDefault();
    }

    percent = 0;
    $('.wg').each(function(i, obj) {
      wg = parseInt($(this).val())
      percent += wg;
    });

    if (percent != 100) {
      alert("Total criteria weight must be 100");
      e.preventDefault();
    }

  })
</script>