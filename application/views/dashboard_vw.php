<?php
if ($this->session->userdata('position') == "Admin Gudang") { ?>
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Supplier &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $supp ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Barang &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $item ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Transaksi Barang Masuk</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $inb ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Transaksi Barang Keluar</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $outs ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } else if ($this->session->userdata('position') == "PPIC") { ?>
  <div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Surat Perintah Kerja</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $spktot ?>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-9">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Permintaan Pembelian</p>
                <h5 class="font-weight-bolder mb-0">
                  <?= $prtot ?>
                </h5>
              </div>
            </div>
            <div class="col-3 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>
<?php
include('dash/' . $whodas . '_vw.php');
?>
</br>
</br>
</br>
<!-- 
<div class="row mt-4">
  <div class="col-lg-12 mb-lg-0 mb-12">
    <div class="card">
      <div class="card-header pb-0 px-3">
        <h6 class="mb-0">List Pekerjaan</h6>
      </div>
      <div class="card-body pt-4 p-3">
        <ul class="list-group">
          <?php if (empty($todo)) { ?>
            <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
              <div class="d-flex flex-column">
                <span class="mb-2 text-xs">(Tidak ada list pekerjaan)</span>
              </div>
            </li>
          <?php } ?>
          <?php foreach ((array)$todo as $key => $value) { ?>
            <li class="list-group-item border-0 d-flex p-4 mb-2 mt-3 bg-gray-100 border-radius-lg">
              <div class="d-flex flex-column">
                <h6 class="mb-3 text-sm"><?= $value['typ'] ?></h6>
                <span class="mb-2 text-xs">No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="text-dark font-weight-bold ms-sm-2"><?= $value['no'] ?></span></span>
                <span class="mb-2 text-xs">Tanggal <span class="text-dark ms-sm-2 font-weight-bold"><?= $value['dt'] ?></span></span>
              </div>
              <div class="ms-auto text-end">
                <a class="btn bg-gradient-primary active" href="<?= site_url($value['lk']) ?>">Proses</a>
              </div>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </div>
</div> -->

<script>
  const options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
  };

  function success(pos) {
    const crd = pos.coords;

    console.log('Your current position is:');
    console.log(`Latitude : ${crd.latitude}`);
    console.log(`Longitude: ${crd.longitude}`);
    console.log(`More or less ${crd.accuracy} meters.`);
  }

  function error(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
  }

  navigator.geolocation.getCurrentPosition(success, error, options);
</script>