<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                <x-user-profil>
                    {{ $slot }}
                </x-user-profil>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}"
                    class="dropdown-item inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    LogOut
                </a>
            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        {{ $slot }}
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
