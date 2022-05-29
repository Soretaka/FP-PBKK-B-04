<!DOCTYPE html>
<html lang="en">

@include('layoutUser/head')

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layoutUser/sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layoutUser/topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('container')
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layoutUser/footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    @include('layoutUser/button-topbar')

    <!-- Logout Modal-->
    @include('layoutUser/logout-modal')

    <!-- Script-->
    @include('layoutUser/javascript')

</body>

</html>