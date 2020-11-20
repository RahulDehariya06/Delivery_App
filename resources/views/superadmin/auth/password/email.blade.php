 @include('superadmin/auth.inc.header')
 <div class="wrapper-page">
			<div class=" card-box">
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
					<form method="post" action="{{route('route.email')}}" role="form" class="text-center">
						@csrf
						<div class="">
							
							Login (Email or Phone):
						</div>
						<div class="form-group m-b-0">
							<div class="input-group">
								<input type="text" class="form-control" name="login" placeholder="Email or Phone" >

								<span class="input-group-append">
									<button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
										Reset
									</button> 
								</span>
								@error('login')
									<p class="error">{{ $message }}</p>
								@enderror
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	@include('superadmin/layouts.inc.footer')