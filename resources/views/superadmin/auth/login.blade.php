 @include('superadmin.auth.inc.header')

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		
		<div class="wrapper-page">
			<div class="card-box">
				<div class="panel-heading">
					<h4 class="text-center"> Login </h4>
				</div>

					@if (session('error'))
					    
					   <div class="alert alert-danger">
								 {{ session('error') }}
							
					</div>
					@endif

				<div class="p-20">
					<form method="post" class="form-horizontal m-t-20" action="{{url('/login')}}">
						@csrf
						<div class="form-group ">
							<div class="col-12">
								<input class="form-control" type="text" name="login" value="{{old('login')}}"  placeholder="Email">
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

						<div class="form-group ">
							<div class="col-12">
								<div class="checkbox checkbox-primary">
									<input id="checkbox-signup" type="checkbox">
									<label for="checkbox-signup"> Remember me </label>
								</div>

							</div>
						</div>

						<div class="form-group text-center m-t-40">
							<div class="col-12">
								<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">
									Log In
								</button>
							</div>
						</div>

						<div class="form-group m-t-20 m-b-0">
							<div class="col-12">
								<a href="{{route('route.password')}}" class="text-dark"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
							</div>
						</div>
						
						<div class="form-group m-t-20 m-b-0">
							<div class="col-12 text-center">
								<h5 class="font-18"><b>Sign in with</b></h5>
							</div>
						</div>
						
						<div class="form-group m-b-0 text-center">
							<div class="col-12">
								<button type="button" class="btn btn-sm btn-facebook waves-effect waves-light m-t-20">
		                           <i class="fa fa-facebook m-r-5"></i> Facebook
		                        </button>

		                        <button type="button" class="btn btn-sm btn-twitter waves-effect waves-light m-t-20">
		                           <i class="fa fa-twitter m-r-5"></i> Twitter
		                        </button>

		                        <button type="button" class="btn btn-sm btn-googleplus waves-effect waves-light m-t-20">
		                           <i class="fa fa-google-plus m-r-5"></i> Google+
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