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
        <form role="form text-left" action="<?= site_url('item/upd_inp') ?>" method="POST" id="submitform">
          <div class="form-group row">
            <label class="col-sm-2 form-label">
              <h6 class="mb-1 text-dark text-sm">Item Code</h6>
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"><?= $itm['code'] ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-label">
              <h6 class="mb-1 text-dark text-sm">Supplier</h6>
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"><?= $itm['supp'] ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-label">
              <h6 class="mb-1 text-dark text-sm">Description</h6>
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"><?= $itm['dsc'] ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-label">
              <h6 class="mb-1 text-dark text-sm">Name</h6>
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"><?= $itm['nm'] ?></p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-label">
              <h6 class="mb-1 text-dark text-sm">Lebar</h6>
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"><?= $itm['wd'] ?> cm</p>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 form-label">
              <h6 class="mb-1 text-dark text-sm">Panjang</h6>
            </label>
            <div class="col-sm-6">
              <p class="form-control-static"><?= $itm['lg'] ?> cm</p>
            </div>
          </div>

          <hr class="horizontal dark mt-0">
          <br>

          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 item_table">
              <thead>
                <tr class="text-center">
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">No. Lot</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">Qty</th>
                  <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder ">UOM</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($lot as $key => $value) { ?>
                  <tr>
                    <td>
                      <center><?= $value['lot'] ?></center>
                    </td>
                    <td>
                      <center><input class="form-control w-50" type="number" value="<?= (int)$value['qty'] ?>" name="qty[<?= $value['lot_id'] ?>]"></center>
                    </td>
                    <td>
                      <center>Roll</center>
                    </td>
                  </tr>
                <?php } ?>
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