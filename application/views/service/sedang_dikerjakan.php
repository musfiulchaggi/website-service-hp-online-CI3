 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="col-lg-5">
         <?= $this->session->flashdata('pesan1'); ?>
     </div>

     <!-- tampilkan daftar permintaab service -->
     <div class="row">
         <?php foreach ($belum_dikerjakan as $bk) : ?>

             <div class="card ml-4 " style="width: 18rem;">
                 <img src="<?= base_url('assets/img/service/') . $bk['gambar'] ?>" class="card-img-top">
                 <div class="card-body justify-content-around">
                     <h5 class="card-title justify-content-md-center">Servisan</h5>
                     <p> Id service :<?= $bk['id_service'] ?><br>
                         Email :<?= $bk['email'] ?></br>
                         Alamat :<?= $bk['alamat'] ?></br>
                         Nomor WA :<?= $bk['nomor_wa'] ?></br>
                         Tipe :<?= $bk['tipe'] ?></br>
                         Kerusakan :<?= $bk['kerusakan'] ?></p>
                     <?php
                        if ($bk['dikirim'] == 'Belum Dikirim') {
                            echo '<div class="alert
                            alert-warning" role="alert">
                            Menunggu Pelanggan Mengirimkan Barang!
                            </div>';
                        } else {
                            echo '<div class="alert
                            alert-success" role="alert">
                            Barang Telah Dikirm!
                            </div>';
                            echo '<form action="' . base_url('admin/sedang_dikerjakan') . '" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control" id="id" name="id" value="' . $bk['id_service'] . '" hidden>
                                <input type="text" class="form-control" id="method" name="method" value="kerjakan" hidden>
                            </div>
   
                            <div class="row justify-content-md-center ">
                                <button type="submit" class="btn btn-primary">Kerjakan</button>
                            </div>
   
                        </form>';
                        }
                        ?>

                 </div>
             </div>
         <?php endforeach; ?>
     </div>

     <div class="row mt-5 justify-content-md-center">
         <!-- membuat menu add -->
         <h4>Daftar Barang Dikerjakan</h4>
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
                 <?php foreach ($dikerjakan as $dk) : ?>
                     <tr>

                         <th scope="row"> <?= $i ?></th>
                         <td><?= $dk['id_service'] ?></td>
                         <td><?= $dk['email'] ?></td>
                         <td><?= $dk['alamat'] ?></td>
                         <td><?= $dk['nomor_wa'] ?></td>
                         <td><?= $dk['tipe'] ?></td>
                         <td><?= $dk['kerusakan'] ?></td>
                         <td><?= $dk['biaya'] ?></td>
                         <td>
                             <button onclick="$('#selesai #id').attr('value','<?= $dk['id_service'] ?>')" data-toggle="modal" data-target="#selesai" class="badge badge-success">Selesai Mengerjakan</button>
                         </td>
                         <?php $i++ ?>
                     </tr>
                 <?php endforeach; ?>
             </tbody>
         </table>
     </div>


     <div class="row mt-5 justify-content-md-center">
         <!-- membuat menu add -->
         <h4>Daftar Barang Selesai Dikerjakan</h4>
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
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($selesai_dikerjakan as $sdk) : ?>
                     <tr>

                         <th scope="row"> <?= $i ?></th>
                         <td><?= $sdk['id_service'] ?></td>
                         <td><?= $sdk['email'] ?></td>
                         <td><?= $sdk['alamat'] ?></td>
                         <td><?= $sdk['nomor_wa'] ?></td>
                         <td><?= $sdk['tipe'] ?></td>
                         <td><?= $sdk['kerusakan'] ?></td>
                         <td><?= $sdk['biaya'] ?></td>

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
 <div class="modal fade" id="selesai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="selesaiLabel">Pengerjaan Se</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('admin/sedang_dikerjakan') ?>" method="POST">
                 <div class="modal-body">
                     <div>
                         Selesai Mengerjakan Servisan?
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control" id="id" name="id" value="" hidden>
                     </div>

                     <div class="form-group">
                         <input type="text" class="form-control" id="method" name="method" value="selesai" hidden>
                     </div>


                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Selesai</button>
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