 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="col-lg-5">
         <?= $this->session->flashdata('message'); ?>
     </div>

     <div class="row">
         <!-- membuat menu add -->
         <div><a href="" class="btn btn-primary mb-3 " data-toggle="modal" data-target="#exampleModal">Add New Menu</a></div>

         <table class="table table-hover">
             <thead>
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Menu</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($menu as $mn) : ?>
                     <tr>

                         <th scope="row"> <?= $i ?></th>
                         <td><?= $mn['menu'] ?></td>
                         <td>
                             <a href="#" class="badge badge-success">Edit</a>
                             <a href="#" class="badge badge-danger">Delete</a>
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
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('menu/addmenu') ?>" method="post">
                 <div class="modal-body">
                     <div class="form-group">
                         <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
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