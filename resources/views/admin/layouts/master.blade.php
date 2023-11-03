<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin') }}/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Admin | @yield('page_title') </title>

    <meta name="description" content="" />

    @include('admin.layouts.inc.style')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            @include('admin.layouts.inc.menu')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.layouts.inc.navbar')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    {{-- <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-lg-12 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h4 class="card-title text-primary">Welcome to admin dashboard {{ Auth::user()->name}} 🎉</h4>
                                                <p class="mb-4">
                                                    You have signed in as an <span class="fw-bold">{{ Auth::user()->role->role_name }}</span> into this system.
                                                </p>
                                                <div class="div">
                                                    <strong>Date and time:</strong>
                                                </div>
                                                <a href="javascript:;" class="btn btn-sm btn-outline-primary" id="current-time"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="{{ asset('admin') }}/assets/img/illustrations/man-with-laptop-light.png"
                                                    height="140" alt="View Badge User"
                                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('admin_content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin.layouts.inc.footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('admin.layouts.inc.script')
    <script>
        // JavaScript code to display the current time
        function updateCurrentTime() {
            const currentTimeElement = document.getElementById('current-time');
            const currentTime = new Date();
            currentTimeElement.textContent = currentTime.toLocaleString();
        }

        // Update the current time immediately and set an interval to update it every second
        updateCurrentTime();
        setInterval(updateCurrentTime, 1000);
    </script>
</body>

</html>
