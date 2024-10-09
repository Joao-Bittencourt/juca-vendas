<x-layout>
    <style>
        body {
            background-image: url("n0ZFaVM.jpeg");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>

</x-layout>