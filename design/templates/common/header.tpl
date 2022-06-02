<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-warning navbar-light px-4 "> 
      <!-- Container wrapper -->
        <div class="container-fluid" >
            <ul class="navbar-nav d-flex flex-row me-1">
                <li> <a href="?action=show_mode_selection" class="font-weight-bold" style="color:black">Анализ кано</a></li>
                <li> <span class="ml-2" style="margin-left: 10px;">{$page_title}</span></li>
            </ul>
        </div>
        <!-- Navbar brand -->
        <a class="navbar-brand" href="#"><b></b></a>
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Icons -->
            <ul class="navbar-nav d-flex flex-row me-1">
              <!-- Notifications -->
              <a class="text-reset me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink1" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-bell fa-lg"></i>
              </a>
              
              <!-- ToDo -->
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink1">
                <li><a class="dropdown-item" href="#">test1<br>
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
                <li><a class="dropdown-item" href="#">test2<br>
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
                <li><a class="dropdown-item" href="#">test3<br>
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
                <li><a class="dropdown-item" href="#">test4<br>
                    <button class="" type="button" style="float:right;line-height:12px;"><i class="fas fa-times"></i></button>
                  </a></li>
              </ul>
            </ul>
            <ul class="navbar-nav d-flex flex-row me-1">
              <!-- Avatar -->
              <a class="dropdown-toggle d-flex align-items-center hidden-arrow text-reset" href="#" id="navbarDropdownMenuLink2" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <!-- <img src="img/user-24.png" class="rounded-circle" height="25" alt="" loading="lazy"/>-->
                <button type="button" class="btn btn-floating"><i class="fas fa-user-alt fa-lg"></i></button>
                
                <!-- ToDo -->
                <span class="text-reset ms-2">Антон Кузнецов</span>
                <!--<span class="text-reset ms-2"><?= $_SESSION['username'] ?></span>-->
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink2">
                <li><a class="dropdown-item" href="profile.php">Профиль</a></li>
                <li><a class="dropdown-item" href="?action=logout">Выйти</a></li>
              </ul>
            </ul>
        </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>