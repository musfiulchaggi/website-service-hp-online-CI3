 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="col-lg-5">
         <?= $this->session->flashdata('message'); ?>
     </div>

     <!-- tampilkan daftar permintaab service -->
     <div class="row">
         <?php foreach ($permintaan as $pt) : ?>

             <div class="card mr-3" style="width: 18rem;">
                 <?php if ($pt['servisan_ke'] == 'pertama') {
                        echo '<div class="alert
                      alert-success" role="alert">
                      Pelanggan Pertama Gratis Biaya Servis!
                      </div>';
                    } ?>
                 <img src="<?= base_url('assets/img/service/') . $pt['gambar'] ?>" class="card-img-top">
                 <div class="card-body">
                     <h5 class="card-title">Permintaan Servive</h5>
                     <p> Id service :<?= $pt['id_service'] ?><br>
                         Email :<?= $pt['email'] ?></br>
                         Alamat :<?= $pt['alamat'] ?></br>
                         Nomor WA :<?= $pt['nomor_wa'] ?></br>
                         Tipe :<?= $pt['tipe'] ?></br>
                         Kerusakan :<?= $pt['kerusakan'] ?></p>
                     <form action="<?= base_url('admin/permintaan_service/'); ?>" method="POST">
                         <div class="form-group row">
                             <label class="col-md-5 mt-1" for="biaya">Biaya : Rp.</label>
                             <input type="text" class="col-md-7 form-control " id="biaya" name="biaya">
                             <?= form_error('biaya', '<small class="text-danger" pl-3>', '</small>'); ?>
                         </div>
                         <div class="form-group">
                             <input type="text" class="form-control" id="id" name="id" value="<?= $pt['id_service'] ?>" hidden>
                         </div>

                         <div class="row justify-content-md-center ">
                             <button type="submit" class="btn btn-primary mr-5">Terima</button>
                             <a class="btn btn-danger" data-toggle="modal" data-target="#ditolak" onclick="$('#ditolak #button').attr('href', '<?= base_url('admin/konfirmasi/ditolak/' . $pt['id_service']); ?>')" role="button">Ditolak</a>
                         </div>

                     </form>
                 </div>
             </div>

         <?php endforeach; ?>
     </div>

     <div class="row mt-5 justify-content-md-center">
         <!-- membuat menu add -->
         <h4>Daftar Pengajuan Diterima</h4>
         <table class="table table-hover">
             <thead>
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Id Service</th>
                     <th scope="col">Email</th>
                     <th scope="col">Alamat</th>
                     <th scope="col">Nomor Wa</th>
                     <th scope="col">Tipe</th>
                     <th scope="col">Kerusakan</th>
                     <th scope="col">Biaya</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($diterima as $dt) : ?>
                     <tr>

                         <th scope="row"> <?= $i ?></th>
                         <td><?= $dt['id_service'] ?></td>
                         <td><?= $dt['email'] ?></td>
                         <td><?= $dt['alamat'] ?></td>
                         <td><?= $dt['nomor_wa'] ?></td>
                         <td><?= $dt['tipe'] ?></td>
                         <td><?= $dt['kerusakan'] ?></td>
                         <td><?= $dt['biaya'] ?></td>
                         <td>
                             <a href="<?= base_url('admin/konfirmasi/ditolak/') . $dt['id_service']; ?>" class="badge badge-danger">Batalkan Permintaan</a>
                         </td>
                         <?php $i++ ?>
                     </tr>
                 <?php endforeach; ?>
             </tbody>
         </table>
     </div>


     <div class="row mt-5 justify-content-md-center">
         <!-- membuat menu add -->
         <h4>Daftar Pengajuan Ditolak</h4>
         <table class="table table-hover">
             <thead>
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Id Service</th>
                     <th scope="col">Email</th>
                     <th scope="col">Alamat</th>
                     <th scope="col">Nomor Wa</th>
                     <th scope="col">Tipe</th>
                     <th scope="col">Kerusakan</th>
                     <th scope="col">Biaya</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($ditolak as $dtk) : ?>
                     <tr>

                         <th scope="row"> <?= $i ?></th>
                         <td><?= $dtk['id_service'] ?></td>
                         <td><?= $dtk['email'] ?></td>
                         <td><?= $dtk['alamat'] ?></td>
                         <td><?= $dtk['nomor_wa'] ?></td>
                         <td><?= $dtk['tipe'] ?></td>
                         <td><?= $dtk['kerusakan'] ?></td>
                         <td><?= $dtk['biaya'] ?></td>
                         <td>
                             <a href="<?= base_url('admin/konfirmasi/belum_dikonfirmasi/') . $dtk['id_service']; ?>" class="badge badge-success">Kembalikan</a>
                         </td>
                         <?php $i++ ?>
                     </tr>
                 <?php endforeach; ?>
             </tbody>
         </table>
     </div>


 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->


 <!--  untuk Button Add -->
 <!-- Button trigger modal -->
 <!-- Modal-->
 <div class="modal fade" id="submenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="submenuLabel">Add New Sub Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('menu/addsubmenu') ?>" method="post">
                 <div class="modal-body">
                     <div class="form-group">
                         <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
                     </div>

                     <div class="form-gruop">
                         <select name="menu_id" id="menu_id" class="form-control">
                             <option value="">Select Menu</option>
                             <?php foreach ($menu as $mn) : ?>
                                 <option value="<?= $mn['id']; ?>"><?= $mn['menu']; ?></option>
                             <?php endforeach; ?>
                         </select>
                     </div>

                     <div class="form-group mt-3">
                         <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
                     </div>
                     <div class="form-group">
                         <div class="form-check">
                             <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                             <label class="form-check-label" for="is_active">
                                 Is Active?
                             </label>
                         </div>

                     </div>
                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Add</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal Menolak Permintaan-->
 <div class="modal fade" id="ditolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Batalkan Pemesanan</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Yakin Ditolak?</div>
             <div class="modal-footer">
                 <a class="btn btn-danger" id="button" role="button" href="">Ditolak</a>
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>

             </div>
         </div>
     </div>
 </div>