 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="col-lg-5">
         <?= $this->session->flashdata('message'); ?>
     </div>

     <div class="row">
         <!-- membuat menu add -->
         <div><a href="" class="btn btn-primary mb-3 " data-toggle="modal" data-target="#submenu">Add New Sub Menu</a></div>

         <table class="table table-hover">
             <thead>
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Title</th>
                     <th scope="col">Menu</th>
                     <th scope="col">Url</th>
                     <th scope="col">Icon</th>
                     <th scope="col">Active</th>
                     <th scope="col">Action</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($submenu as $sm) : ?>
                     <tr>

                         <th scope="row"> <?= $i ?></th>
                         <td><?= $sm['title'] ?></td>
                         <td><?= $sm['menu'] ?></td>
                         <td><?= $sm['url'] ?></td>
                         <td><?= $sm['icon'] ?></td>
                         <td><?= $sm['is_active'] ?></td>
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