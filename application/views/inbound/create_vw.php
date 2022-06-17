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
        <form role="form text-left" action="<?= site_url('inbound/new_inp') ?>" method="POST" id="submitform">

          <div class="form-group row">
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">Supplier</h6>
            </label>
            <div class="col-sm-4">
              <select class="form-control select2" required name="supp">
                <option value="">-- Pilih --</option>
                <?php foreach ($supp as $key => $value) { ?>
                  <option value="<?= $value['id'] ?>"><?= $value['code'] . ' - ' . $value['supp_name'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-1">
            </div>
            <label class="col-sm-1 control-label">
              <h6 class="mb-1 text-dark text-sm">BPB No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="bpb" readonly value="<?= $bpb ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">Delivery Order Date</h6>
            </label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="dodate" required>
            </div>
            <div class="col-sm-1">
            </div>
            <label class="col-sm-1 control-label">
              <h6 class="mb-1 text-dark text-sm">BPB Date</h6>
            </label>
            <div class="col-sm-3">
              <input type="date" class="form-control" name="bpbdate" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">PO No</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" maxlength="255" class="form-control" name="po" required>
            </div>
            <div class="col-sm-2">
            </div>
            <label class="col-sm-1 control-label">
              <h6 class="mb-1 text-dark text-sm">Note</h6>
            </label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="note" required>
            </div>
          </div>
          <br>
          <hr class="horizontal dark mt-0">
          <br>



          <div class="form-group row">
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">Item</h6>
            </label>
            <div class="col-sm-8">
              <select class="form-control select2" id="itm">
                <option value="">-- Pilih Barang --</option>
                <?php foreach ($item as $key => $value) { ?>
                  <option value="<?= $value['id'] ?>"><?= $value['description'] . ' | ' . $value['name'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">Category</h6>
            </label>
            <div class="col-sm-3">
              <select class="form-control" id="cat">
                <option value="">-- Pilih --</option>
                <?php foreach ($cat as $key => $value) { ?>
                  <option value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-sm-1"></div>
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">Panjang</h6>
            </label>
            <div class="col-sm-2">
              <input type="number" maxlength="255" class="form-control" id="le">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">Qty</h6>
            </label>
            <div class="col-sm-2">
              <input type="number" maxlength="255" class="form-control" id="qty">
            </div>
            <div class="col-sm-2"></div>
            <label class="col-sm-2 control-label">
              <h6 class="mb-1 text-dark text-sm">Lebar</h6>
            </label>
            <div class="col-sm-2">
              <input type="number" maxlength="255" class="form-control" id="wi">
            </div>
          </div>

          <center>
            <div class="col-sm-3">
              <a class="btn btn-outline-primary btn-sm mb-0 add">Tambah Barang</a>
            </div>
          </center>

          <br>
          <hr class="horizontal dark mt-0">
          <br>

          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 item_table">
              <thead>
                <tr>
                  <th rowspan="2" class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">#</th>
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

              </tbody>
            </table>
          </div>

          <br>
          <br>
          <div class="text-center">
            <button type="submit" class="btn bg-gradient-dark">Submit</button>
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
      let item_id = $('#itm').val()
      let item = $('#itm option:selected').text()
      let desc = item.split('|')[0]
      let name = item.split('|')[1]
      let cat = $('#cat').val()
      let qty = $('#qty').val()
      let le = $('#le').val()
      let wi = $('#wi').val()

      if (item_id == "" || cat == "" || qty == "" || le == "" || wi == "") {

        alert("Form item harus dilelngkapi")

      } else {

        tbody = '<tr class="text-center">\
                  <td>\
                    <i class="fa fa-trash text-danger remove"></i>\
                    <input type="hidden" value="' + item_id + '" name="item_id[]">\
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
                    <p class="text-sm mb-0">' + qty + '</p>\
                    <input type="hidden" value="' + qty + '" name="qty[]">\
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
                    <p class="text-sm mb-0">Roll</p>\
                  </td>\
                </tr>'

        $('.item_table tbody').append(tbody)

        $('#itm').val('')
        $('#cat').val('')
        $('#qty').val('')
        $('#le').val('')
        $('#wi').val('')
        $('#itm').trigger('change')

      }
    })
  })


  $(document).on('click', '.remove', function() {
    if (confirm("Are you sure delete this item?")) {
      $(this).parent().parent().parent().remove();
    }
  })


  $("#submitform").submit(function(e) {

    if ($('.item_table tr').length == 2) {
      alert("List barang tidak boleh kosong")
      e.preventDefault();
    }


  })
</script>