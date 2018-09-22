<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login Fukushop's at Administrator </title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginstyle.css') }}">
  </head>
  <body>
    <div class="loginbox">
        <img src="{{asset('avatar.jpg')}}" class="avatar">

        <form method="POST" action="{{ route('admin.login') }}" aria-label="{{ __('Login') }}">
           @csrf
          <h1>Fukushop's admin</h1>

           <div>
              <p for="">Email</p>

              <input id="email" type="text" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Enter Email">
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
           </div>
           <div>
              <p for="">Password</p>
              <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Enter Password">
               @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
           </div>
            <div class="form-check" style=" display:  inline-flex;">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <p class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                  </p>
            </div>
           
            <input type="submit" value="login" name=""></input>
            <a href="{{ route('password.request') }}">&loz; Forget your Password?</a><br>
            <a href="{{ route('admin_register') }}">&diams; Don't have account? Create Acount</a>
        </form>
    </div>
  </body>
</html> 