<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>CRM</title>
	@include('layout/include/css')
  </head>
  <body class="sidebar-mini skin-blue-light">
   @include('layout/include/session')
	<div class="wrapper">

			@yield('content')

		
    </div>		 
		 @include('layout/include/js')
  </body>
</html>
