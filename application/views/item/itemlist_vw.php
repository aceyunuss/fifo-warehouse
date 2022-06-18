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
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="datatebel" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Item Code</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Lebar (cm)</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Panjang (cm)</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($item as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['code'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['dsc'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['nm'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['wd'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['lg'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['qty'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('item/update/' . $value['stock_id']) ?>" class="badge badge-sm bg-gradient-success">Update Stock</a>
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