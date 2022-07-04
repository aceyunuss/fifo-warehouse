<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?></h6>
          </div>
          <?php if ($this->session->userdata('position') == "Admin Gudang") { ?>
            <div class="col-6 text-end">
              <a class="btn bg-gradient-dark mb-0" href="<?= site_url('outbound/create') ?>"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Buat STB</a>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="datatebel" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">STB Date</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">SPB No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($logs as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= $value['stb'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['stb_date'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['spb'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['status'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('outbound/view/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Lihat</a>
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