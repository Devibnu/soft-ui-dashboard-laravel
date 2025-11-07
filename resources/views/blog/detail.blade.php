@extends('frontend.layouts.app')

@section('title', $artikel->judul . ' - Blog Jasa Digital Marketing')

@section('content')
    <!-- Hero Wrap -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('website/images/bg_1.jpg') }}');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">{{ Str::limit($artikel->judul, 60) }}</h1>
            <p class="breadcrumbs">
                <span class="mr-2"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
                <span class="mr-2"><a href="{{ route('blog.index') }}">Blog <i class="ion-ios-arrow-forward"></i></a></span> 
                <span>{{ Str::limit($artikel->judul, 30) }} <i class="ion-ios-arrow-forward"></i></span>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Blog Content Section -->
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 ftco-animate">
                    <h2 class="mb-3">{{ $artikel->judul }}</h2>
                    
                    <!-- Featured Image -->
                    @if($artikel->gambar)
                    <p>
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}" class="img-fluid">
                    </p>
                    @endif

                    <!-- Article Summary -->
                    @if($artikel->ringkasan)
                    <p><strong>{{ $artikel->ringkasan }}</strong></p>
                    @endif

                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $artikel->isi !!}
                    </div>

                    <!-- Tags Widget -->
                    <div class="tag-widget post-tag-container mb-5 mt-5">
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">Digital Marketing</a>
                            <a href="#" class="tag-cloud-link">SEO</a>
                            <a href="#" class="tag-cloud-link">Social Media</a>
                            <a href="#" class="tag-cloud-link">Content</a>
                        </div>
                    </div>
                    
                    <!-- About Author -->
                    <div class="about-author d-flex p-4 bg-light">
                        <div class="bio mr-5">
                            <img src="{{ asset('website/images/person_1.jpg') }}" alt="Admin" class="img-fluid mb-4">
                        </div>
                        <div class="desc">
                            <h3>Admin Jasa Digital Marketing</h3>
                            <p>Tim profesional kami berpengalaman dalam memberikan solusi digital marketing terbaik untuk mengembangkan bisnis Anda. Kami berkomitmen untuk membantu kesuksesan online Anda.</p>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="pt-5 mt-5">
                        <h3 class="mb-5 h4 font-weight-bold">{{ $komentars->count() }} Komentar</h3>
                        
                        @if($komentars->count() > 0)
                        <ul class="comment-list">
                            @foreach($komentars as $komentar)
                            <li class="comment">
                                <div class="vcard bio">
                                    <img src="{{ asset('website/images/person_1.jpg') }}" alt="{{ $komentar->nama }}">
                                </div>
                                <div class="comment-body">
                                    <h3>{{ $komentar->nama }}</h3>
                                    <div class="meta mb-2">{{ $komentar->tanggal_dibuat->format('F d, Y') }} at {{ $komentar->tanggal_dibuat->format('g:ia') }}</div>
                                    <p>{{ $komentar->isi }}</p>
                                </div>

                                @if($komentar->balasan->count() > 0)
                                <ul class="children">
                                    @foreach($komentar->balasan as $balasan)
                                    <li class="comment">
                                        <div class="vcard bio">
                                            <img src="{{ asset('website/images/person_1.jpg') }}" alt="{{ $balasan->nama }}">
                                        </div>
                                        <div class="comment-body">
                                            <h3>{{ $balasan->nama }}</h3>
                                            <div class="meta mb-2">{{ $balasan->tanggal_dibuat->format('F d, Y') }} at {{ $balasan->tanggal_dibuat->format('g:ia') }}</div>
                                            <p>{{ $balasan->isi }}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        <!-- END comment-list -->
                        
                        <!-- Comment Form -->
                        <div class="comment-form-wrap pt-5">
                            <h3 class="mb-5 h4 font-weight-bold">Tinggalkan Komentar</h3>
                            <form id="commentForm" action="{{ route('blog.komentar.store', $artikel->slug) }}" method="POST" class="p-5 bg-light">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama *</label>
                                    <input type="text" class="form-control" id="name" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Pesan</label>
                                    <textarea name="isi" id="message" cols="30" rows="10" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Kirim Komentar" class="btn py-3 px-4 btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->

                <!-- Sidebar -->
                <div class="col-lg-4 sidebar ftco-animate">
                    <!-- Search Form -->
                    <div class="sidebar-box">
                        <form action="{{ route('blog.index') }}" method="GET" class="search-form">
                            <div class="form-group">
                                <span class="icon icon-search"></span>
                                <input type="text" name="search" class="form-control" placeholder="Cari artikel...">
                            </div>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="sidebar-box ftco-animate">
                        <h3>Kategori</h3>
                        <ul class="categories">
                            <li><a href="#">SEO <span>(6)</span></a></li>
                            <li><a href="#">Social Media <span>(8)</span></a></li>
                            <li><a href="#">Content Marketing <span>(5)</span></a></li>
                            <li><a href="#">Web Development <span>(4)</span></a></li>
                            <li><a href="#">Digital Advertising <span>(3)</span></a></li>
                        </ul>
                    </div>

                    <!-- Popular Articles -->
                    <div class="sidebar-box ftco-animate">
                        <h3>Artikel Populer</h3>
                        @php
                            $recentArticles = App\Models\Artikel::aktif()
                                ->where('id', '!=', $artikel->id)
                                ->orderBy('tanggal_dibuat', 'desc')
                                ->limit(3)
                                ->get();
                        @endphp
                        
                        @foreach($recentArticles as $recent)
                        <div class="block-21 mb-4 d-flex">
                            <a href="{{ route('blog.detail', $recent->slug) }}" class="blog-img mr-4" 
                               style="background-image: url({{ $recent->gambar ? asset('storage/' . $recent->gambar) : asset('website/images/image_1.jpg') }});"></a>
                            <div class="text">
                                <h3 class="heading"><a href="{{ route('blog.detail', $recent->slug) }}">{{ Str::limit($recent->judul, 60) }}</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> {{ $recent->tanggal_dibuat->format('F d, Y') }}</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> {{ $recent->komentars->count() }}</a></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tag Cloud -->
                    <div class="sidebar-box ftco-animate">
                        <h3>Tag Cloud</h3>
                        <ul class="tagcloud m-0 p-0">
                            <a href="#" class="tag-cloud-link">SEO</a>
                            <a href="#" class="tag-cloud-link">Marketing</a>
                            <a href="#" class="tag-cloud-link">Website</a>
                            <a href="#" class="tag-cloud-link">Content</a>
                            <a href="#" class="tag-cloud-link">Social Media</a>
                            <a href="#" class="tag-cloud-link">Advertising</a>
                            <a href="#" class="tag-cloud-link">Analytics</a>
                        </ul>
                    </div>

                    <!-- Archives -->
                    <div class="sidebar-box ftco-animate">
                        <h3>Arsip</h3>
                        <ul class="categories">
                            <li><a href="#">Desember 2024 <span>(12)</span></a></li>
                            <li><a href="#">November 2024 <span>(15)</span></a></li>
                            <li><a href="#">Oktober 2024 <span>(10)</span></a></li>
                            <li><a href="#">September 2024 <span>(8)</span></a></li>
                        </ul>
                    </div>

                    <!-- About Section -->
                    <div class="sidebar-box ftco-animate">
                        <h3>Tentang Kami</h3>
                        <p>Kami adalah tim profesional yang berfokus pada digital marketing, membantu bisnis Anda berkembang di dunia digital dengan strategi yang tepat dan hasil yang terukur.</p>
                    </div>
                </div><!-- END COL -->
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const commentForm = document.getElementById('commentForm');
    
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('input[type="submit"]');
            const originalValue = submitButton.value;
            
            // Show loading state
            submitButton.value = 'Mengirim...';
            submitButton.disabled = true;
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        location.reload();
                    });
                    
                    // Reset form
                    commentForm.reset();
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: error.message || 'Terjadi kesalahan saat mengirim komentar',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            })
            .finally(() => {
                // Reset button
                submitButton.value = originalValue;
                submitButton.disabled = false;
            });
        });
    }
});
</script>
@endpush
