<!DOCTYPE html>
<html lang="en">
  <head>
    <title>{{ $project->judul }} - JasaIbnu</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ $project->deskripsi_singkat }}">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('website/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
  </head>
  <body>
	  <div class="bg-top navbar-light">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-center align-items-stretch">
    			<div class="col-md-4 d-flex align-items-center py-4">
    				<a class="navbar-brand" href="{{ url('/') }}">JasaIbnu</a>
    			</div>
	    		<div class="col-lg-8 d-block">
		    		<div class="row d-flex">
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
					    	<div class="text">
					    		<span>Email</span>
						    	<span>info@jasaibnu.id</span>
						    </div>
					    </div>
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <div class="text">
						    	<span>Call</span>
						    	<span>Call Us: +62 xxx xxx</span>
						    </div>
					    </div>
					    <div class="col-md topper d-flex align-items-center justify-content-end">
					    	<p class="mb-0">
					    		<a href="{{ route('contact') }}" class="btn py-2 px-3 btn-primary d-flex align-items-center justify-content-center">
					    			<span>Free Consulting</span>
					    		</a>
					    	</p>
					    </div>
				    </div>
			    </div>
		    </div>
		  </div>
    </div>
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container d-flex align-items-center px-4">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
	        	<li class="nav-item"><a href="{{ url('/') }}" class="nav-link pl-0">Home</a></li>
	        	<li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
	        	<li class="nav-item active"><a href="{{ route('projects.index') }}" class="nav-link">Projects</a></li>
	        	<li class="nav-item"><a href="{{ route('services') }}" class="nav-link">Services</a></li>
	        	<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link">Blog</a></li>
	          <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('website/images/bg_1.jpg') }}');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">{{ $project->judul }}</h1>
            <p class="breadcrumbs">
              <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
              <span class="mr-2"><a href="{{ route('projects.index') }}">Projects <i class="ion-ios-arrow-forward"></i></a></span> 
              <span>{{ Str::limit($project->judul, 30) }} <i class="ion-ios-arrow-forward"></i></span>
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
			<div class="container">
				<div class="row">
          <div class="col-lg-8 ftco-animate">
            <!-- Project Title & Category -->
            <h2 class="mb-3">{{ $project->judul }}</h2>
            <p class="mb-4">
              <span class="badge badge-primary">{{ $project->kategori->nama ?? 'Uncategorized' }}</span>
            </p>

            <!-- Main Image -->
            @if($project->gambar_utama)
              <p>
                <img src="{{ asset('storage/' . $project->gambar_utama) }}" alt="{{ $project->judul }}" class="img-fluid">
              </p>
            @endif

            <!-- Short Description -->
            <p class="lead">{{ $project->deskripsi_singkat }}</p>

            <!-- Full Description -->
            <div class="project-description">
              {!! $project->deskripsi_lengkap !!}
            </div>

            <!-- Gallery -->
            @if($project->galeri && is_array($project->galeri) && count($project->galeri) > 0)
              <div class="mt-5">
                <h3 class="mb-4">Project Gallery</h3>
                <div class="row">
                  @foreach($project->galeri as $index => $image)
                    <div class="col-md-4 mb-4">
                      <a href="{{ asset('storage/' . $image) }}" class="image-popup img d-block" 
                         style="background-image: url('{{ asset('storage/' . $image) }}'); height: 250px; background-size: cover; background-position: center;">
                      </a>
                    </div>
                  @endforeach
                </div>
              </div>
            @endif

            <!-- Project Info Box -->
            <div class="about-author d-flex p-4 bg-light mt-5">
              <div class="desc w-100">
                <h3>Project Information</h3>
                <div class="row">
                  <div class="col-md-6">
                    <p><strong>Category:</strong> {{ $project->kategori->nama ?? 'Uncategorized' }}</p>
                    @if($project->klien)
                      <p><strong>Client:</strong> {{ $project->klien }}</p>
                    @endif
                  </div>
                  <div class="col-md-6">
                    @if($project->lokasi)
                      <p><strong>Location:</strong> {{ $project->lokasi }}</p>
                    @endif
                    @if($project->tanggal_proyek)
                      <p><strong>Date:</strong> {{ $project->tanggal_proyek->format('F Y') }}</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- .col-lg-8 -->

          <!-- Sidebar -->
          <div class="col-lg-4 sidebar pl-lg-5 ftco-animate">
            <!-- Category Widget -->
            <div class="sidebar-box ftco-animate">
              <h3 class="sidebar-heading">Categories</h3>
              <ul class="categories">
                @php
                  $allCategories = \App\Models\KategoriProject::withCount(['projects' => function($query) {
                    $query->where('status', true);
                  }])->get();
                @endphp
                @foreach($allCategories as $category)
                  <li>
                    <a href="{{ route('projects.index', ['kategori_id' => $category->id]) }}">
                      {{ $category->nama }} <span>({{ $category->projects_count }})</span>
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>

            <!-- Related Projects -->
            @if($relatedProjects->count() > 0)
              <div class="sidebar-box ftco-animate">
                <h3 class="sidebar-heading">Related Projects</h3>
                @foreach($relatedProjects as $related)
                  <div class="block-21 mb-4 d-flex">
                    <a class="blog-img mr-4" style="background-image: url('{{ $related->gambar_utama ? asset('storage/' . $related->gambar_utama) : asset('website/images/image_1.jpg') }}');"></a>
                    <div class="text">
                      <h3 class="heading">
                        <a href="{{ route('projects.show', $related->slug) }}">{{ Str::limit($related->judul, 40) }}</a>
                      </h3>
                      <div class="meta">
                        <div><span class="icon-folder"></span> {{ $related->kategori->nama ?? 'Uncategorized' }}</div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif

            <!-- CTA -->
            <div class="sidebar-box ftco-animate">
              <h3 class="sidebar-heading">Have a Project?</h3>
              <p>We'd love to hear about your project! Get in touch and let's discuss how we can help.</p>
              <p><a href="{{ route('contact') }}" class="btn btn-primary py-2 px-4">Contact Us</a></p>
            </div>
          </div><!-- END COL -->
        </div>
			</div>
		</section>

		
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2">Have Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Indonesia</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+62 xxx xxx</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@jasaibnu.id</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5 ml-md-4">
              <h2 class="ftco-heading-2">Links</h2>
              <ul class="list-unstyled">
                <li><a href="{{ url('/') }}"><span class="ion-ios-arrow-round-forward mr-2"></span>Home</a></li>
                <li><a href="{{ route('about') }}"><span class="ion-ios-arrow-round-forward mr-2"></span>About</a></li>
                <li><a href="{{ route('services') }}"><span class="ion-ios-arrow-round-forward mr-2"></span>Services</a></li>
                <li><a href="{{ route('projects.index') }}"><span class="ion-ios-arrow-round-forward mr-2"></span>Projects</a></li>
                <li><a href="{{ route('contact') }}"><span class="ion-ios-arrow-round-forward mr-2"></span>Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="ftco-footer-widget mb-5">
            	<h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
            	<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | JasaIbnu</p>
          </div>
        </div>
      </div>
    </footer>

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

  <script src="{{ asset('website/js/jquery.min.js') }}"></script>
  <script src="{{ asset('website/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('website/js/popper.min.js') }}"></script>
  <script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('website/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('website/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('website/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('website/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('website/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('website/js/aos.js') }}"></script>
  <script src="{{ asset('website/js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('website/js/scrollax.min.js') }}"></script>
  <script src="{{ asset('website/js/main.js') }}"></script>

  <script>
    // Initialize magnific popup for gallery
    $(document).ready(function() {
      $('.image-popup').magnificPopup({
        type: 'image',
        gallery: {
          enabled: true
        }
      });
    });
  </script>
    
  </body>
</html>
