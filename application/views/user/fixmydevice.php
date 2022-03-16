 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="row">
         <div class="card mb-3 mr-4 justify-content-md-center" style="width: 800px;">
             <div class="col-lg">

                 <?= form_open_multipart('user/fixmydevice'); ?>

                 <div class="form-group row mt-3">
                     <label for="email" class="col-sm-2 col-form-label">Email</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Isikan alamat sesuai KTP.">
                         <?= form_error('alamat', '<small class="text-danger" pl-3>', '</small>'); ?>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="nomor_wa" class="col-sm-2 col-form-label">Nomor WA</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" placeholder="+62">
                         <?= form_error('nomor_wa', '<small class="text-danger" pl-3>', '</small>'); ?>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="email" class="col-sm-2 col-form-label">Tipe</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Misal. Redmi note 8 Pro">
                         <?= form_error('tipe', '<small class="text-danger" pl-3>', '</small>'); ?>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="email" class="col-sm-2 col-form-label">Jenis Kerusakan</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" id="kerusakan" name="kerusakan" placeholder="Misal. Mati total,Layar retak,dll.">
                         <?= form_error('kerusakan', '<small class="text-danger" pl-3>', '</small>'); ?>
                     </div>
                 </div>
                 <div class="form-group row">
                     <div class="col-sm-2">Upload Foto Device anda</div>
                     <div class="col-sm-10">
                         <div class="row">
                             <div class="col-sm-9">
                                 <div class="custom-file">
                                     <input type="file" class="custom-file-input" id="image" name="image">
                                     <label class="custom-file-label" for="image">Choose file</label>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="form-group row justify-content-end">
                     <div class="col-sm-10">
                         <button type="submit" class="btn btn-primary">
                             Kirim
                         </button>
                     </div>
                 </div>
                 </form>
             </div>
         </div>

     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->