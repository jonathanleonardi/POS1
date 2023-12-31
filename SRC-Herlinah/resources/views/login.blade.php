<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />

    <script src="https://code.iconify.design/1/1.0.6/iconify.min.js"></script>

    <title>SRC HERLINAH</title>

    <!-- <style>
        body {
            background-image:url("{{asset('/img/bg.jpg')}}");
        }
    </style> -->
</head>

<body>
    <div class="d-flex">
        <div class="col align-self-center mt-5">
            <h1 class="text-center text-dark">SRC</h1>
            <h1 class="text-center text-dark">HERLINAH</h1>
        </div>
        <div class="container col-5 mt-5">
            <form action="/login" method="post" id="login" autocomplete="off" class="p-3 w-75 mt-5">
                @csrf
                <h3 class="text-center">Sign In</h3>
                @if(session('error'))
                <div class="alert w-100 text-center text-danger" role="alert">
                    {{session('error')}}
                </div>
                @endif
                <div class="input-group mt-4">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="input-group mt-4">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                            <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4 w-25">Log In</button>

                <div class="mt-4 text-end text-primary">
                    <a data-toggle="modal" data-target="#ModalCenter">Lupa Password</a>
                </div>
            </form>
        </div>
    </div>

    <!-- LUPA PASSWORD -->
    <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="LupaPaswordModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="text-center mt-3">
                    <h3 class="modal-title"><strong>Lupa Password</strong></h3>
                </div>
                <div class="text-center mt-4">
                    <p class="modal-title">Masukkan Email Anda untuk memulihkan password Anda</p>
                </div>
                <div class="modal-body input-group mt-3">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                        </svg>
                    </span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="text-center mt-3 mb-3">
                    <button type="button" class="btn btn-primary ms-3" style="width: 100px;">KIRIM</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL SCRIPT  -->
    <script src=" https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
