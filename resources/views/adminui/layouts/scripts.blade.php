<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

<!-- SweetAlert2 for Toast Notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('js')

<script>
    // Function to activate tab in About page
    function activateTab(tabId) {
        // Check if we're on the about page
        if (window.location.pathname.includes('/adminui/about')) {
            // If already on about page, just click the tab
            var tabElement = document.getElementById(tabId);
            if (tabElement) {
                var tab = new bootstrap.Tab(tabElement);
                tab.show();
                // Scroll to top
                window.scrollTo(0, 0);
            }
        } else {
            // If not on about page, redirect with hash
            window.location.href = '/adminui/about#' + tabId;
        }
    }

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<!-- Fixed Plugin JavaScript -->
<script>
    // Fixed Plugin Functions
    function sidebarColor(elem) {
        var color = elem.getAttribute("data-color");
        var sidebar = document.querySelector(".sidenav");
        var badges = document.querySelectorAll(".badge.filter");
        
        // Remove active class from all badges
        badges.forEach(function(badge) {
            badge.classList.remove("active");
        });
        
        // Add active class to clicked badge
        elem.classList.add("active");
        
        // Update sidebar color
        if (sidebar) {
            sidebar.setAttribute("data-color", color);
        }
    }

    function sidebarType(elem) {
        var className = elem.getAttribute("data-class");
        var sidebar = document.querySelector(".sidenav");
        var buttons = document.querySelectorAll("button[data-class]");
        
        // Remove active class from all buttons
        buttons.forEach(function(button) {
            button.classList.remove("active");
        });
        
        // Add active class to clicked button
        elem.classList.add("active");
        
        // Update sidebar type
        if (sidebar) {
            sidebar.className = sidebar.className.replace(/bg-\w+/, className);
        }
    }

    function navbarFixed(elem) {
        var navbar = document.querySelector(".navbar-main");
        if (elem.checked) {
            navbar.classList.add("position-sticky", "top-1", "z-index-sticky");
        } else {
            navbar.classList.remove("position-sticky", "top-1", "z-index-sticky");
        }
    }

    // Fixed Plugin Toggle
    document.addEventListener("DOMContentLoaded", function() {
        var fixedPlugin = document.querySelector(".fixed-plugin");
        var fixedPluginButton = document.querySelector(".fixed-plugin-button");
        var fixedPluginClose = document.querySelector(".fixed-plugin-close-button");
        
        if (fixedPluginButton) {
            fixedPluginButton.addEventListener("click", function() {
                if (fixedPlugin) {
                    fixedPlugin.classList.toggle("show");
                }
            });
        }
        
        if (fixedPluginClose) {
            fixedPluginClose.addEventListener("click", function() {
                if (fixedPlugin) {
                    fixedPlugin.classList.remove("show");
                }
            });
        }
    });
</script>

<!-- Toast Notification System -->
<script>
    // SweetAlert2 Toast Configuration for Soft UI Dashboard
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        background: '#fff',
        color: '#344767',
        iconColor: '#fff',
        customClass: {
            popup: 'soft-ui-toast',
            icon: 'soft-ui-toast-icon',
            title: 'soft-ui-toast-title'
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    // Success Notification
    @if(session('success'))
        Toast.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            background: 'linear-gradient(87deg, #17ad37 0, #98ec2d 100%)',
            color: '#fff'
        });
    @endif

    // Error/Warning Notification  
    @if(session('error'))
        Toast.fire({
            icon: 'warning',
            title: 'Peringatan!',
            text: '{{ session('error') }}',
            background: 'linear-gradient(87deg, #f53939 0, #fbcf33 100%)',
            color: '#fff',
            timer: 5000
        });
    @endif

    // Validation Errors Notification
    @if($errors->any())
        // Skip toast notification on login page (already has inline alert)
        @if(!Request::is('adminui/login'))
            Toast.fire({
                icon: 'error',
                title: 'Validasi Gagal!',
                html: '<ul style="text-align: left; margin: 0; padding-left: 20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                background: 'linear-gradient(87deg, #f53939 0, #f56565 100%)',
                color: '#fff',
                timer: 6000
            });
        @endif
    @endif
</script>

<!-- Custom CSS for Toast -->
<style>
    .soft-ui-toast {
        border-radius: 12px !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        font-family: 'Open Sans', sans-serif !important;
    }
    
    .soft-ui-toast-title {
        font-weight: 600 !important;
        font-size: 14px !important;
    }
    
    .soft-ui-toast-icon {
        border: none !important;
    }
    
    /* Form validation styles */
    .form-control.is-invalid {
        border-color: #f53939 !important;
        box-shadow: 0 0 0 0.2rem rgba(245, 57, 57, 0.25) !important;
    }
    
    .form-control.is-invalid:focus {
        border-color: #f53939 !important;
        box-shadow: 0 0 0 0.2rem rgba(245, 57, 57, 0.25) !important;
    }
    
    .field-required {
        color: #f53939 !important;
        font-weight: 600;
    }
</style>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>