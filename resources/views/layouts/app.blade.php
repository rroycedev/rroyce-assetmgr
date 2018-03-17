<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Asset Manager Template</title>
  
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/users.css') }}" rel="stylesheet">        
    <link href="{{ asset('mdbootstrap/css/bootstrap.css') }}" rel="stylesheet">  
    <link href="{{ asset('mdbootstrap/css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-template/css/bootstrap-template.css') }}" rel="stylesheet">   
    <link href="/css/modal.css" rel="stylesheet">   
    <link href="/css/assetmgr.css" rel="stylesheet">   

    <script>
      window.laravel = { 
        csrfToken: "<?php echo csrf_token(); ?>"
      } 

      var b = 1;
    </script>
         
</head>
<body>


    <!-- assetmgr.blade.php -->
    <div id="app">

<?php

    if (isset(Auth::user()->first_name)) {
      $username = Auth::user()->first_name . " " . Auth::user()->last_name;
      $isLoggedIn = 1;
    }
    else {
      $username = "";
      $isLoggedIn = 0;
    }

    if (isset(Auth::user()->group_name)) {
      $groupname = Auth::user()->group_name;
     }
     else {
       $groupname = "";
     } 
?>
    <!-- Navbar-->
 
  <div id="app-header">
    <?php echo json_encode($isLoggedIn) . "<br>"; ?>
    <app-header :user="{{ json_encode(Auth::user())}}"></app-header>
  </div>

  

  <div id="side-bar">
    <side-bar :user="{{ json_encode(Auth::user()) }}" :groupname="{{ json_encode($groupname) }}"></side-bar>
  </div>

  
  
  <main id="main-div" class="app-content">
       @yield('content')
  </main>

</div>

<!-- Asset manager template js includes -->


    <script src="{{ asset('js/app.js') }}"></script>

      <script src="{{ asset('mdbootstrap/js/mdb.js') }}"></script>
      <script src="{{ asset('metismenu/js/metisMenu.js') }}"></script>     
      <script src="{{ asset('bootstrap-template/js/bootstrap-template.js') }}"></script>
  
  

<script>
  @yield('js-content')
</script>

</body>
</html>
