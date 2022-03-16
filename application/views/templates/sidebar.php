       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

           <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
               <div class="sidebar-brand-icon rotate-n-15">
                   <i class="fas fa-laptop-medical"></i>
               </div>
               <div class="sidebar-brand-text mx-3">Servisanku.com</sup></div>
           </a>

           <!-- Divider -->
           <hr class="sidebar-divider">


           <!-- query menu -->
           <?php
            $role_id = $this->session->userdata('role_id');

            $query_menu = "select user_menu.id,menu
            from user_menu join user_access_menu
            on user_menu.id = user_access_menu.menu_id 
            where user_access_menu.role_id=" . $role_id .
                " order by user_access_menu.menu_id asc";

            $menu = $this->db->query($query_menu)->result_array();

            ?>

           <!-- LOOPING MENU -->
           <?php foreach ($menu as $submenu) : ?>

               <!-- Heading -->
               <div class="sidebar-heading">
                   <?= $submenu['menu']; ?>
               </div>

               <!-- siapkan menu sesuai dengan sub menunya  -->
               <?php
                $query_submenu = "select *
                from user_sub_menu join user_menu
                on user_sub_menu.menu_id = user_menu.id 
                where user_sub_menu.menu_id=" . $submenu['id'] .
                    " and user_sub_menu.is_active = 1";

                $sub_menu = $this->db->query($query_submenu)->result_array();
                ?>
               <?php foreach ($sub_menu as $sm) : ?>
                   <!-- Nav Item - Dashboard -->
                   <?php if ($title == $sm['title']) : ?>
                       <li class="nav-item active">
                       <?php else : ?>
                       <li class="nav-item">
                       <?php endif; ?>
                       <a class="nav-link pb-0" href="<?= base_url($sm['url']) ?>">
                           <i class="<?= $sm['icon'] ?>"></i>
                           <span><?= $sm['title'] ?></span></a>
                       </li>

                   <?php endforeach; ?>
                   <!-- Divider -->
                   <hr class="sidebar-divider mt-2">

               <?php endforeach; ?>



               <!-- Nav Item - My Profile -->
               <li class="nav-item">
                   <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
                       <i class="fas fa-fw fa-sign-out-alt"></i>
                       <span>Log Out</span></a>
               </li>

               <!-- Divider -->
               <hr class="sidebar-divider d-none d-md-block">

               <!-- Sidebar Toggler (Sidebar) -->
               <div class="text-center d-none d-md-inline">
                   <button class="rounded-circle border-0" id="sidebarToggle"></button>
               </div>

       </ul>
       <!-- End of Sidebar -->