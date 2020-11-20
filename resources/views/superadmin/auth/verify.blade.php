@include('superadmin.auth.inc.header')
<!-- HOME -->
		<section class="home bg-dark" id="home">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 text-center">
						<div class="home-wrapper">
							<h1 class="icon-main text-custom"><i class="md md-album"></i></h1>
							<h1 class="home-text"><span class="rotate">{{$response}}</span></h1>
							
						</div>
					</div>
				</div>
			</div>
		</section>

@include('superadmin.layouts.inc.footer')