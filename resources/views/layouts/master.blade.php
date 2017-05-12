<!DOCTYPE html>
<html>
	  <head>
		    <title>
            @yield('title', 'Lifestyle Buddy')
				</title>

				<meta charset='utf-8'>
		    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
		    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
		    <link href='css/styles.css' rel='stylesheet'>

        @stack('head')
	  </head>

	  <body>
			<nav class="navbar navbar-default">
		<div class="container-fluid">
				<div class="navbar-header">
						<button aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand">Lifestyle Buddy</a>
				</div>
			<div class="collapse navbar-collapse" id="navbar">
								@if(Auth::check())
													<ul class="nav navbar-nav">
															<li><a href="/home">Home</a></li>
															<li><a href="/bmi">BMI</a></li>
															<li><a href="/food">Food</a></li>
															<li><a href="/exercise">Exercise</a></li>
															<li><a href="/virtualcoach">Virtual Coach</a></li>
													</ul>
													<ul class="nav navbar-nav navbar-right">
															<form method='POST' id='logout' action='/logout'>
																{{ csrf_field() }}
																<a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
															</form>
													</ul>
											@else
													<ul class="nav navbar-nav navbar-right">
															<li><a href="/register">Register</a></li>
															<li><a href="/login">Log In</a></li>
													</ul>
											@endif
									</div>
							</div>
					</nav>
  	    <div class='container'>
						<section>
                @yield('content')
            </section>
				</div>
				@stack('body')
		</body>
</html>
