 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

     <div class="col-lg-5">
         <?= $this->session->flashdata('message'); ?>
     </div>
     <h5>Role : <?= $role['role'] ?></h5>
     <div class="row">
         <!-- membuat menu add -->

         <table class="table table-hover">
             <thead>
                 <tr>
                     <th scope="col">#</th>
                     <th scope="col">Menu</th>
                     <th scope="col">Access</th>
                 </tr>
             </thead>
             <tbody>
                 <?php $i = 1; ?>
                 <?php foreach ($menu as $mn) : ?>
                     <tr>

                         <th scope="row"> <?= $i ?></th>
                         <td><?= $mn['menu'] ?></td>
                         <td>
                             <div class="form-check">
                                 <input class="form-check-input" type="checkbox" <?= check_access($role['id_role'], $mn['id']); ?> data-role="<?= $role['id_role']; ?>" data-menu="<?= $mn['id'] ?>">
                             </div>
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