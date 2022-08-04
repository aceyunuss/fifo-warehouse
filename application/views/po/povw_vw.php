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

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">
            <h6 class="mb-1 text-dark text-sm">PO No</h6>
          </label>
          <div class="col-sm-3">
            <p class="form-control-static"><?= $po['po'] ?></p>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">
            <h6 class="mb-1 text-dark text-sm">PO Date</h6>
          </label>
          <div class="col-sm-3">
            <p class="form-control-static"><?= $po['po_date'] ?></p>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">
            <h6 class="mb-1 text-dark text-sm">PR No</h6>
          </label>
          <div class="col-sm-3">
            <p class="form-control-static"><?= $po['pr'] ?></p>
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
            <?php foreach ($itm as $key => $value) { ?>
              <tr class="text-center">
                <td>
                  <p class="text-sm mb-0"><?= $value['pr'] ?></p>
                </td>
                <td>
                  <p class="text-sm mb-0"><?= $value['supplier'] ?></p>
                </td>
                <td>
                  <p class="text-sm mb-0"><?= $value['description'] ?></p>
                </td>
                <td>
                  <p class="text-sm mb-0"><?= $value['item_name'] ?></p>
                </td>
                <td>
                  <p class="text-sm mb-0"><?= $value['width'] ?></p>
                </td>
                <td>
                  <p class="text-sm mb-0"><?= $value['length'] ?></p>
                </td>
                <td>
                  <p class="text-sm mb-0"><?= $value['qty'] ?></p>
                </td>
                <td>
                  <p class="text-sm mb-0">ROLL</p>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>


        <div class="text-center">
          <br>
          <button onclick="window.history.back()" class="btn btn-secondary">Kembali</button>
        </div>
      </div>
    </div>
  </div>
</div>