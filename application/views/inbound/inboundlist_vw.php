<div class="row">
  <div class="col-12">
    <div class="card mb-4">
      <div class="card-header pb-0">
        <div class="row">
          <div class="col-6 d-flex align-items-center">
            <h6 class="mb-0"><?= $title ?></h6>
          </div>
          <div class="col-6 text-end">
            <a class="btn bg-gradient-dark mb-0" href="<?= site_url('inbound/create') ?>"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Pembuatan BPB</a>
          </div>
        </div>
      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table id="datatebel" class="table align-items-center mb-0">
            <thead>
              <tr>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Posisi</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Username</th>
                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($logs as $key => $value) { ?>
                <tr class="text-center">
                  <td>
                    <p class="text-sm mb-0"><?= ++$key ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['complete_name'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['position'] ?></p>
                  </td>
                  <td>
                    <p class="text-sm mb-0"><?= $value['username'] ?></p>
                  </td>
                  <td>
                    <a href="<?= site_url('user/edituser/' . $value['id']) ?>" class="badge badge-sm bg-gradient-success">Ubah</a>
                    <a onclick="return confirm('Apakah ingin menghapus user ini?');" href="<?= site_url('user/deleteuser/' . $value['id']) ?>" class="badge badge-sm bg-gradient-warning">Hapus</a>
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
