<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Document </title>
  </head>
  <body>
    <div class='container'>
      @yield('content')
      @if (Auth::check())
        <a href='/auth/logout'> Log out </a>

      @endif
    </div>

    @if ($errors->any())
      <ul>
          @foreach ($errors->all() as $error)
            <li> {{ $error }} </li>
          @endforeach
      </ul>
    @endif
  </body>
</html>
