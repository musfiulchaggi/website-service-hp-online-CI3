 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <div>
         <?= $this->session->flashdata('message'); ?>
     </div>

     <?php foreach ($service as $sv) : ?>

         <div class="col-lg">

             <?php if ($sv['servisan_ke'] == 'pertama') {
                    echo '<div class="alert
                      alert-success" role="alert">
                      Selamat Anda Akan Mendapatkan Gratis Biaya Servis dan Hanya Membayar Biaya Sparepart (Apabila ada part yang diganti).
                      </div>';
                } ?>


         </div>
         <div class="row">
             <div class="card mb-3 mr-4" style="width: 540px;">
                 <div class="row g-0">
                     <div class="col-md-4">
                         <img src="<?= base_url('assets/img/service/') . $sv['gambar']; ?>" class="img-fluid rounded-start">
                     </div>
                     <div class="col-md-8">
                         <div class="card-body">
                             <h5 class="card-title">Email :<?= $sv['email']; ?></h5>
                             <h5 class="card-title">Alamat :<?= $sv['alamat']; ?></h5>
                             <h5 class="card-title">Nmr. WA :<?= $sv['nomor_wa']; ?></h5>
                             <h5 class="card-title">Tipe :<?= $sv['tipe']; ?></h5>
                             <h5 class="card-title">Kerusakan :<?= $sv['kerusakan']; ?></h5>

                             <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $sv['date_created']); ?> </small></p>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="card mb-3" style="width: 500px;">
                 <div class="row g-0">
                     <div class="col-md-12">
                         <div class="form-group row">
                             <label for="email" class="col col-form-label pl-3">Biaya</label>
                             <label for="email" class="col col-form-label pl-3"><?= $sv['biaya'] ?></label>
                         </div>
                         <div class="form-group row">
                             <label for="email" class="col col-form-label pl-3">Diterima Servisanku.com</label>

                             <label for="email" class="col col-form-label pl-3"><?= $sv['dikirim'] ?></label>

                         </div>
                         <div class="form-group row">
                             <label for="email" class="col col-form-label pl-3">Selesai dikerjakan</label>

                             <label for="email" class="col col-form-label pl-3"><?= $sv['selesai'] ?></label>

                         </div>
                         <div class="form-group row">
                             <label for="email" class="col col-form-label pl-3">Lunas</label>

                             <label for="email" class="col col-form-label pl-3"><?= $sv['bayar'] ?></label>

                         </div>
                         <div class="form-group row">
                             <label for="email" class="col col-form-label pl-3">Konfirmasi Servis</label>

                             <label for="email" class="col col-form-label pl-3"><?= $sv['konfirmasi'] ?></label>

                         </div>
                         <div class="d-flex justify-content-around form-group row">
                             <?php
                                if ($sv['konfirmasi'] == "Belum Dikonfirmasi") {
                                    echo '<div class="col-sm-9  alert alert-warning" role="alert">
                                    Permntaan servis anda sedang diproses!<br>
                                    Mohon tunggu konfirmasi.
                                </div>';
                                } else {
                                    echo '<div class="col-lg-9 alert alert-success" role="alert">
                          Permintaan servis anda telah dikonfirmasi.
                          Jika anda setuju dengan biaya servis, klik lanjutkan!
                          </div>';
                                }
                                ?>
                         </div>
                     </div>

                 </div>

             </div>

         </div>
         <div class="col mb-5">
             <?php
                if ($sv['konfirmasi'] != "Belum Dikonfirmasi") {
                    echo '<a data-toggle="modal" data-target="#lanjutkirim" class="btn btn btn-success btn-xs" role="button" aria-pressed="true">Lanjutkan</a>';
                } else {
                    echo '<a href="#belumkonfirmasi" data-toggle="modal" class="btn btn-success btn-xs" role="button" aria-pressed="true">Lanjutkan</a>';
                }
                ?>
             <a href="#modalBatalkan" data-toggle="modal" onclick="$('#modalBatalkan #formBatalkan').attr('action', '<?= base_url('user/batalkanPesanan/' . $sv['id_service']); ?>')" class="btn btn-danger btn-xs" role="button" aria-pressed="true">Batalkan</a>
         </div>

     <?php endforeach; ?>
 </div>
 <!-- /.container-fluid -->

 <!-- User Lanjut Kirim-->
 <div class="modal fade" id="lanjutkirim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="lanjutkirimLabel">Lanjutkan</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="col-sm  alert alert-success" role="alert">
                     Jika Anda Menyetujui Biaya Jasa Pelayanan Kami,<br>
                     Segera Kirimkan Barang Anda Ketempat Servisan Kami Yang Beralamat:<br>
                     Jl. Kauman Bokor rt:01 rw:09 Turen Malang.
                     Atas Nama : Servisanku Cell.
                 </div>
             </div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                 <a class="btn btn-primary" href="<?= base_url('user/payment'); ?>">Mengerti</a>
             </div>
         </div>
     </div>
 </div>