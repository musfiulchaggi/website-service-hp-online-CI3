 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="col-lg-5">
         <?= $this->session->flashdata('pesan'); ?>
     </div>

     <!-- tampilkan daftar permintaab service -->
     <div class="row">
         <?php foreach ($selesai_dikerjakan as $sdk) : ?>

             <div class="card ml-4 " style="width: 18rem;">

                 <?php
                    if ($sdk['bukti_pembayaran'] == 'default.jpg') {
                        echo '<div class="alert
                            alert-warning" role="alert">
                            Pelanggan Belum Mengirimkan Bukti Pembayaran!
                            </div>';
                        echo '<img src="' . base_url('assets/img/service/') . $sdk['gambar'] . '" class="card-img-top"><br><br>';
                        echo '<div class="card-body justify-content-around">';
                        echo '<h5 class="card-title justify-content-md-center">Servisan</h5>';
                        echo '<p> Id service :' . $sdk['id_service'] . '<br>';
                        echo 'Email :' . $sdk['email'] . '</br>';
                        echo 'Alamat :' . $sdk['alamat'] . '</br>';
                        echo 'Nomor WA :' . $sdk['nomor_wa'] . '</br>';
                        echo 'Tipe :' . $sdk['tipe'] . '</br>';
                        echo 'Kerusakan :' . $sdk['kerusakan'] . '</br>';
                        echo 'Biaya :' . $sdk['biaya'] . '</p>';
                    } else {
                        echo '<div class="alert
                            alert-success" role="alert">
                            Bukti Pembayaran Telah Dikirim!
                            </div>';
                        echo '<img class="card mb-3" src="' . base_url('assets/img/service/') . $sdk['gambar'] . '" class="card-img-top">';
                        echo '<div class="card"><a onclick="$(' . "'#gambar #bukti').attr('src','" . base_url('assets/img/pembayaran/') . $sdk['bukti_pembayaran'] . "'" . ')"' . 'data-toggle="modal" data-target="#gambar"><img src="' . base_url('assets/img/pembayaran/') . $sdk['bukti_pembayaran'] . '" class="card-img-top"></a></div>';
                        echo '<div class="card-body justify-content-around">';
                        echo '<h5 class="card-title justify-content-md-center">Servisan</h5>';
                        echo '<p> Id service :' . $sdk['id_service'] . '<br>';
                        echo 'Email :' . $sdk['email'] . '</br>';
                        echo 'Alamat :' . $sdk['alamat'] . '</br>';
                        echo 'Nomor WA :' . $sdk['nomor_wa'] . '</br>';
                        echo 'Tipe :' . $sdk['tipe'] . '</br>';
                        echo 'Kerusakan :' . $sdk['kerusakan'] . '</br>';
                        echo 'Biaya :' . $sdk['biaya'] . '</p>';
                        echo '<div class="row justify-content-md-center ">';
                        echo '<button onclick="$(' . "'#validasi #id').attr('value','" . $sdk['id_service'] . "'" . ')"' . 'data-toggle="modal" data-target="#validasi" class="btn btn-success">Validasi</button>
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
     <h4>Daftar Barang Siap Dikirim Kepelanggan</h4>
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
                 <th scope="col">Pembayaran</th>
                 <th scope="col">Action</th>
             </tr>
         </thead>
         <tbody>
             <?php $i = 1; ?>
             <?php foreach ($lunas as $ln) : ?>
                 <tr>

                     <th scope="row"> <?= $i ?></th>
                     <td><?= $ln['id_service'] ?></td>
                     <td><?= $ln['email'] ?></td>
                     <td><?= $ln['alamat'] ?></td>
                     <td><?= $ln['nomor_wa'] ?></td>
                     <td><?= $ln['tipe'] ?></td>
                     <td><?= $ln['kerusakan'] ?></td>
                     <td><?= $ln['biaya'] ?></td>
                     <td><?= $ln['bayar'] ?></td>

                     <td>
                         <button onclick="$('#kirim #id').attr('value','<?= $ln['id_service'] ?>')" data-toggle="modal" data-target="#kirim" class="btn btn-success">Kirimkan</button>
                     </td>
                     <?php $i++ ?>
                 </tr>
             <?php endforeach; ?>
         </tbody>
     </table>
 </div>


 <div class="row mt-5 justify-content-md-center">
     <!-- membuat menu add -->
     <h4>Daftar Barang Yang Sudah Dikirimkan Kepelanggan</h4>
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
                 <th scope="col">Pembayaran</th>
             </tr>
         </thead>
         <tbody>
             <?php $i = 1; ?>
             <?php foreach ($dikirimkan as $dk) : ?>
                 <tr class="justify-content">

                     <th scope="row"> <?= $i ?></th>
                     <td><?= $dk['id_service'] ?></td>
                     <td><?= $dk['email'] ?></td>
                     <td><?= $dk['alamat'] ?></td>
                     <td><?= $dk['nomor_wa'] ?></td>
                     <td><?= $dk['tipe'] ?></td>
                     <td><?= $dk['kerusakan'] ?></td>
                     <td><?= $dk['biaya'] ?></td>
                     <td class="bg-success"><?= $dk['bayar'] ?></td>

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
 <div class="modal fade" id="validasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="validasiLabel">Validasi Pembayaran</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('admin/pembayaran') ?>" method="POST">
                 <div class="modal-body">
                     <div>
                         Pembayaran Valid?
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control" id="id" name="id" value="" hidden>
                     </div>

                     <div class="form-group">
                         <input type="text" class="form-control" id="method" name="method" value="validasi" hidden>
                     </div>


                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Validasi</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal Pengiriman Barang-->

 <div class="modal fade" id="kirim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="validasiLabel">Kirim Barang Servisan</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('admin/pembayaran') ?>" method="POST">
                 <div class="modal-body">
                     <div>
                         Mengirimkan Barang Servisan?
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control" id="id" name="id" value="" hidden>
                     </div>

                     <div class="form-group">
                         <input type="text" class="form-control" id="method" name="method" value="kirim" hidden>
                     </div>


                 </div>

                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-success">Kirimkan</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Modal Lihat Bukti Pembayaran-->
 <div class="modal" id="gambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content ">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body justify-content-md-center">
                 <img id="bukti" src="" width="450px">
             </div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Kembali</button>

             </div>
         </div>
     </div>
 </div>