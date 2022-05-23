<!DOCTYPE html>
<html lang="en">

@include('layout/head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout/sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout/topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('container')
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layout/footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('layout/button-topbar')

    <!-- Logout Modal-->
    @include('layout/logout-modal')

    <!-- Script-->
    @include('layout/javascript')

</body>

</html>