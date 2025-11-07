@php
    $footerSettings = \App\Models\FooterSetting::first();
@endphp

<footer class="ftco-footer ftco-bg-dark ftco-section">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md-6 col-lg-3">
        <div class="ftco-footer-widget mb-5">
          <h2 class="ftco-heading-2">Have a Questions?</h2>
          <div class="block-23 mb-3">
            <ul>
              <li><span class="icon icon-map-marker"></span><span class="text">{{ $footerSettings->alamat ?? '203 Fake St. Mountain View, San Francisco, California, USA' }}</span></li>
              <li><a href="tel:{{ str_replace(' ', '', $footerSettings->telepon ?? '+2392392921') }}"><span class="icon icon-phone"></span><span class="text">{{ $footerSettings->telepon ?? '+2 392 3929 210' }}</span></a></li>
              <li><a href="mailto:{{ $footerSettings->email ?? 'info@yourdomain.com' }}"><span class="icon icon-envelope"></span><span class="text">{{ $footerSettings->email ?? 'info@yourdomain.com' }}</span></a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="ftco-footer-widget mb-5">
          <h2 class="ftco-heading-2">Recent Blog</h2>
          @php
              $recentBlogs = \App\Models\Blog::orderBy('created_at', 'desc')->limit(2)->get();
          @endphp
          @forelse($recentBlogs as $blog)
          <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url({{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('website/images/image_1.jpg') }});"></a>
            <div class="text">
              <h3 class="heading"><a href="{{ route('blog.detail', $blog->slug) }}">{{ Str::limit($blog->judul, 40) }}</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> {{ $blog->created_at->format('M d, Y') }}</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
              </div>
            </div>
          </div>
          @empty
          <div class="block-21 mb-4 d-flex">
            <a class="blog-img mr-4" style="background-image: url({{ asset('website/images/image_1.jpg') }});"></a>
            <div class="text">
              <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
              <div class="meta">
                <div><a href="#"><span class="icon-calendar"></span> June 27, 2019</a></div>
                <div><a href="#"><span class="icon-person"></span> Admin</a></div>
              </div>
            </div>
          </div>
          @endforelse
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="ftco-footer-widget mb-5">
          <h2 class="ftco-heading-2">Quick Links</h2>
          <ul class="list-unstyled">
            <li><a href="{{ route('home') }}"><span class="icon-long-arrow-right mr-2"></span>Home</a></li>
            <li><a href="{{ route('about') }}"><span class="icon-long-arrow-right mr-2"></span>About</a></li>
            <li><a href="{{ route('services') }}"><span class="icon-long-arrow-right mr-2"></span>Services</a></li>
            <li><a href="{{ route('projects.index') }}"><span class="icon-long-arrow-right mr-2"></span>Projects</a></li>
            <li><a href="{{ route('blog.index') }}"><span class="icon-long-arrow-right mr-2"></span>Blog</a></li>
            <li><a href="{{ route('contact') }}"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="ftco-footer-widget mb-5">
          <h2 class="ftco-heading-2">Subscribe Us!</h2>
          <form action="{{ $footerSettings->tombol_subscribe_link ?? '#' }}" class="subscribe-form">
            <div class="form-group">
              <input type="text" class="form-control mb-2 text-center" placeholder="{{ $footerSettings->placeholder_subscribe ?? 'Enter email address' }}">
              <input type="submit" value="{{ $footerSettings->tombol_subscribe_text ?? 'Subscribe' }}" class="form-control submit px-3">
            </div>
          </form>
        </div>
        <div class="ftco-footer-widget mb-5">
          <h2 class="ftco-heading-2 mb-0">Connect With Us</h2>
          <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
            @if($footerSettings && $footerSettings->twitter_link)
              <li class="ftco-animate"><a href="{{ $footerSettings->twitter_link }}" target="_blank"><span class="icon-twitter"></span></a></li>
            @endif
            @if($footerSettings && $footerSettings->facebook_link)
              <li class="ftco-animate"><a href="{{ $footerSettings->facebook_link }}" target="_blank"><span class="icon-facebook"></span></a></li>
            @endif
            @if($footerSettings && $footerSettings->instagram_link)
              <li class="ftco-animate"><a href="{{ $footerSettings->instagram_link }}" target="_blank"><span class="icon-instagram"></span></a></li>
            @endif
            @if($footerSettings && $footerSettings->linkedin_link)
              <li class="ftco-animate"><a href="{{ $footerSettings->linkedin_link }}" target="_blank"><span class="icon-linkedin"></span></a></li>
            @endif
            @if($footerSettings && $footerSettings->youtube_link)
              <li class="ftco-animate"><a href="{{ $footerSettings->youtube_link }}" target="_blank"><span class="icon-youtube"></span></a></li>
            @endif
            @if(!$footerSettings || (!$footerSettings->twitter_link && !$footerSettings->facebook_link && !$footerSettings->instagram_link))
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            @endif
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <p>
          {!! $footerSettings->copyright_text ?? 'Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>' !!}
        </p>
      </div>
    </div>
  </div>
</footer>
