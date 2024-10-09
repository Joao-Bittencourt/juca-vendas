<x-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/multiple-select-js/dist/css/multiple-select.css">
    <script src="https://cdn.jsdelivr.net/npm/multiple-select-js/dist/js/multiple-select.js"></script>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <!-- Main Header -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ url('n0ZFaVM.jpeg') }}" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <p>{{ Auth::user()->name }}</p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat"> {{ __('Profile') }} </a>
                                <a href="#" class="btn btn-default btn-flat float-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Sign out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- Left side column. contains the logo and sidebar -->
            @include('layouts.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                @include('layouts.alerts')
                {{ $slot }}
            </div>
        </div>
    </body>
    <script>
        // Function to format the input as currency
        function formatCurrencyMask(value) {
            const cleanedValue = value.replace(/[^\d]/g, ''); // Remove non-numeric characters
            const formattedValue = (cleanedValue / 100).toFixed(2); // Convert to decimal currency format
            return formattedValue;
        }

        // Get the input elements
        const inputsToFormat = document.querySelectorAll('.maskMoney');
        // Event listener for input changes
        inputsToFormat.forEach(input => {
            input.addEventListener('input', function(e) {
                const currentValue = e.target.value;
                e.target.value = formatCurrencyMask(currentValue);
            });
        })
    </script>
</x-layout>