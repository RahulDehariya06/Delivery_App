 @include('superadmin.auth.inc.header')

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		
		<div class="wrapper-page">
			<div class="card-box">
				<div class="panel-heading">
					<h4 class="text-center"> Reset Password </h4>
				</div>

					@if (session('error'))
					    
					   <div class="alert alert-danger">
						{{ session('error') }}
							
					</div>
					@endif
					@if (session('success')) 
					   <div class="alert alert-success">
						 {{ session('success') }}
							
					</div>
					@endif

				<div class="p-20">
					<form method="post" class="form-horizontal m-t-20" action="{{route('password.update')}}">
						@csrf
						<input type="hidden" name="token" value="{{ $token }}">
						<div class="form-group ">
							<div class="col-12">
								<input class="form-control" type="text" name="login"  placeholder="Email">
								@error('login')
									<p class="error">{{ $message }}</p>
								@enderror
							</div>
						</div>

						<div class="form-group">
							<div class="col-12">
								<input class="form-control" type="password" name="password"  placeholder="Password">
								@error('password')
									<p class="error">{{ $message }}</p>
								@enderror
							</div>
						</div>
						<div class="form-group">
							<div class="col-12">
								<input class="form-control" type="password" name="cpassword"  placeholder="Confirm Password">
								@error('cpassword')
									<p class="error">{{ $message }}</p>
								@enderror
							</div>
						</div>
						

						<div class="form-group text-center m-t-40">
							<div class="col-12">
								<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
									Reset
								</button>
							</div>
						</div>

						
						
						
					</form>

				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
					<p>
						Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b>Sign Up</b></a>
					</p>
				</div>
			</div>

		</div>

		 @include('superadmin.layouts.inc.footer')