@extends('layout.layoutlogin')

@section('content')
			
    <div class="login-main">  	
    	 <div class="login-head">
				<h1>Login</h1>
			</div>
			<div class="login-block">
				<form method="POST" action="/login" id="login">
				@csrf
					<input type="text" name="username" placeholder="Username" required>
					<input type="password" name="password" class="lock" placeholder="Password" required>
					
					<input type="submit" name="Sign In" value="Login">	
					<h3>Not a user?<a href="/register"> Sign up now</a></h3>				
				</form>
				@if(session('success'))
					<div class="alert alert-success">
						<p style="text-align: center"><b>{{ session('success') }}</b></p>
					</div>
				@elseif(session('warning'))
					<div class="alert alert-warning">
						<p style="text-align: center"><b>{{ session('warning') }}</b></p>
					</div>
				@elseif(session('danger'))
					<div class="alert alert-danger">
						<p style="text-align: center"><b>{{ session('danger') }}</b></p>
					</div>
				@endif
			</div>
      </div>
@endsection