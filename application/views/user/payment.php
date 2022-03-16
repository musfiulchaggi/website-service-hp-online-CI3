 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="col-lg mb-3">
         <div><?= $this->session->flashdata('pesan'); ?></div>

     </div>

     <?php foreach ($service as $sv) : ?>
         <?php if ($sv['dikirim'] == 'Belum Dikirim') {
                echo '<div class="col-lg mb-3">
                    <div class="alert
                    alert-warning" role="alert">
                    Apakah Device Anda Telah Dikirm Ke Servisanku cell, jl Kauman rt 01 rw 09 Turen Malang ?
                    </div>
                </div>';
                echo '<div class="form-group row justify-content-end">
                <div class="col-sm-7">
                    <a href="' . base_url('user/kirim_barang/') . $sv['id_service'] . '" class="btn btn-primary" >
                        Sudah Dikirimkan
                    </a>
                </div>
            </div>';
            } else if ($sv['dikirim'] == 'Sudah Dikirimkan') {
                echo '<div class="col-lg mb-3">
                <div class="alert
                alert-success" role="alert">
                Device Telah Dikirm Ke alamat jl Kauman rt 01 rw 09 Turen Malang, Servisanku cell.
                </div>
            </div>';
            }
            ?>
         <div class="col-lg">
             <table class="table table-striped table-dark">
                 <thead>
                     <tr>
                         <th scope="col">#</th>
                         <th scope="col">Tipe</th>
                         <th scope="col">Kerusakan</th>
                         <th scope="col">Biaya</th>
                         <th scope="col">Keterangan</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $id = 1; ?>

                     <tr>
                         <th scope="row"><?= $id++; ?></th>
                         <td><?= $sv['tipe']; ?></td>
                         <td><?= $sv['kerusakan']; ?></td>
                         <td><?= $sv['biaya']; ?></td>
                         <td><?php if ($sv['bukti_pembayaran'] == 'default.jpg') {
                                    echo 'Belum Dibayar';
                                } else if ($sv['bukti_pembayaran'] != 'default.jpg' && $sv['bayar'] != 'Belum Dibayar' && $sv['bayar'] != 'Lunas') {
                                    echo 'Tunggu Validasi';
                                } else if ($sv['bayar'] == 'Lunas') {
                                    echo 'Lunas';
                                }  ?></td>

                     </tr>
                 </tbody>
             </table>

             <?php
                if ($sv['bukti_pembayaran'] != 'default.jpg' && $sv['bayar'] == 'Belum Dibayar') {
                    echo '<div class="col-lg mb-3">
                             <div>' . $this->session->flashdata('pesan1') . '</div>
                        </div>';
                } else if ($sv['bukti_pembayaran'] != 'default.jpg' && $sv['bayar'] == 'Lunas') {
                    echo '<div class="col-lg mb-3">
                             <div>' . $this->session->flashdata('pesan2') . '</div>
                        </div>';
                }
                ?>

             <div class="col-lg mb-3">
                 <div><?= $this->session->flashdata('message'); ?></div>

             </div>
             <div class="card mt-4 mb-3">
                 <div class="card-header">
                     Total Biaya
                 </div>
                 <div class="card-body">
                     <h5 class="card-title">Total Biaya Service</h5>
                     <h4><?= $sv['biaya']; ?></h4>
                     <br>

                     <div class="form-group row">

                         <div class="col-md-4">
                             <img src="<?= base_url('assets/img/pembayaran/') . $sv['bukti_pembayaran'] ?>" class="img-fluid rounded-start">
                         </div>

                         <div class="col-sm-8">
                             <div class="form-group row justify-content">
                                 <div class="col-sm-3 mt-7">
                                     <a href="" data-toggle="modal" data-target="#buktipembayaran" class="btn btn-primary" onclick="$('#pilih #id').attr('value', '<?= $sv['id_service'] ?>');$('#pilih #old_image').attr('value', '<?= $sv['bukti_pembayaran'] ?>');
                                     $('#buktigambar').attr('src', '<?= base_url('assets/img/pembayaran/') . $sv['bukti_pembayaran'] ?>');">
                                         Upload Bukti Pembayaran
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     <?php endforeach; ?>
 </div>

 <!-- Modal Pengiriman Barang-->

 <div class="modal fade" id="buktipembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="buktipembayaranLabel">Bukti Pembayaran</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>

             <div class="modal-body">
                 <?php echo form_open_multipart('user/payment') ?>
                 <div class="form-group row">

                     <div class="col-md-4">
                         <img id="buktigambar" src="" class="img-fluid rounded-start">
                     </div>

                     <div class="col-sm-8">
                         <div class="col-sm-5">Upload Bukti Pembayaran Anda</div>
                         <div class="row">
                             <div class="col-sm-9" id="pilih">
                                 <div>
                                     <input type="text" name="id" id="id" value="" hidden>
                                 </div>
                                 <div>
                                     <input type="text" name="old_image" id="old_image" value="" hidden>
                                 </div>
                                 <div class="custom-file">
                                     <input type="file" class="custom-file-input" id="image" name="image">
                                     <label class="custom-file-label" for="image">Choose file</label>
                                 </div>
                             </div>
                         </div>
                     </div>
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