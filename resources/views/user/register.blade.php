@extends('layout.layoutlogin')

@section('content')
     <div class="signup-main">  	
    	 <div class="signup-head">
				<h1>Sign Up</h1>
			</div>
			<div class="signup-block">
				<form method="post" action="/register" role="form">
					{{ csrf_field() }}
					<input type="text" name="nik" placeholder="NIK" required="">
					<input type="text" name="nama" placeholder="Nama" required="">
					<input type="text" name="username" placeholder="Username" required="">
					<input type="password" name="password" class="lock" placeholder="Password">				
					<select class="form-control" name="user_role" require="">
						<option value="">-Pilih-</option>
						<option value="1">Pengelola Simpanan</option>
						<option value="2">Pengelola Pinjaman</option>
						<option value="3">Admin</option>
					</select>

					<div class="forgot-top-grids">
						
					</div>
					<input type="submit" class="btn btn-success" value="Sing Up">														
				</form>
				<div class="sign-down">
					<h4>Already have an account? <a href="/login"> Login here.</a></h4>
				</div>
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