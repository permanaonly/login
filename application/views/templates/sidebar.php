 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon ">
             <i class="fab fa-html5"></i>
         </div>
         <div class="sidebar-brand-text mx-3">kampang <sup>2</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider ">


     <!-- Query Menu -->
     <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = " SELECT `user_menu`.`id`, `menu`
                    FROM `user_menu` JOIN `user_access_menu` 
                    ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`role_id` = $role_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";
        $menu = $this->db->query($queryMenu)->result_array();

        ?>
     <!-- Looping Menu -->
     <?php foreach ($menu as $m) : ?>

         <!-- Heading -->
         <div class="sidebar-heading">
             <?= $m['menu']; ?>
         </div>


         <!-- Siapkan Sub-Menu Sesuai Menu  -->
         <?php
            $menuId = $m['id'];
            $querySubMenu = "SELECT *
                            FROM `user_sub_menu` JOIN `user_menu` 
                            ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                            WHERE `user_sub_menu`. `menu_id` = $menuId
                            AND `user_sub_menu`.`is_active` = 1
                            ";
            $submenu = $this->db->query($querySubMenu)->result_array();
            ?>

         <!-- Looping Sub Menu -->
         <?php foreach ($submenu as $sm) : ?>

             <!-- Nav Item - Dashboard -->
             <?php if ($title == $sm['title']) : ?>
                 <li class="nav-item active">
                 <?php else : ?>
                 <li class="nav-item ">

                 <?php endif; ?>
                 <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                     <i class="<?= $sm['icon']; ?>"></i>
                     <span><?= $sm['title']; ?></span></a>
                 </li>

             <?php endforeach; ?>

             <!-- Divider -->
             <hr class="sidebar-divider mt-3">

         <?php endforeach; ?>


         <!-- Sidebar Toggler (Sidebar) -->
         <div class="text-center d-none d-md-inline">
             <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>

 </ul>
 <!-- End of Sidebar -->