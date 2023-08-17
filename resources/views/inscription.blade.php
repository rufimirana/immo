<!DOCTYPE html>
<html>
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('css/bootstrap.min.css') }}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{asset('css/font-awesome.min.css')}}"
        />
         <link
            rel="stylesheet"
            type="text/css"
            href="{{asset('css/font-awesome.css')}}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{asset('css/animate.css')}}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{asset('css/hamburgers.min.css')}}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{asset('css/select2.min.css')}}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{asset('css/util_login.css')}}"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="{{asset('css/main_login.css')}}"
        />
        <!--===============================================================================================-->

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}

  </div>
@endif
<style>.icon {
  width: 24px;
  height: 24px;
  margin-right: 8px;

}
</style>

<body>


     <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="{{ asset('images/logo.png') }}" alt="IMG" />
                    </div>
     <form method="POST" action="{{ route('register.custom') }}" class="login100-form validate-form">
                         @csrf
                        <span class="login100-form-title"> Ajout utilisateur </span>
  <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz" >

                            <input class="input100" type="text" name="name" placeholder="Votre identifiant" />

                              @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                            </span>
                        </div>
                        <div
                            class="wrap-input100 validate-input"
                            data-validate="Valid email is required: ex@abc.xyz"
                        >
                            <input
                                class="input100"
                                type="text"
                                name="email"
                                placeholder="Email"
                            />
                             @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                            </span>
                        </div>

                        <div
                            class="wrap-input100 validate-input"
                            data-validate="Password is required"
                        >
                            <input
                                class="input100"
                                type="password"
                                name="password"
                                placeholder="Password"
                            />
                             @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">

                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">S'inscrire</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!--===============================================================================================-->
        <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
        <!--===============================================================================================-->
        <script src="{{asset('js/popper.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <!--===============================================================================================-->
        <script src="{{asset('js/select2.min.js')}}"></script>
        <!--===============================================================================================-->
        <script src="{{asset('js/tilt.jquery.min.js')}}"></script>
        <script>
            $(".js-tilt").tilt({
                scale: 1.1,
            });
        </script>
        <!--===============================================================================================-->
        <script src="{{asset('js/main_login.js')}}"></script>
</body>
</html>

