@extends('frontend.layouts.app')

@section('title', 'Project - JasaIbnu')

@section('content')
    <!-- Hero Section -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('website/images/bg_1.jpg') }}');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Project</h1>
            <p class="breadcrumbs">
              <span class="mr-2"><a href="{{ url('/') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> 
              <span>Project <i class="ion-ios-arrow-forward"></i></span>
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Projects Grid Section -->
    <section class="ftco-section">
			<div class="container">
				<div class="row">
          @forelse($projects as $project)
            <div class="col-md-4">
              <div class="project mb-4 img ftco-animate d-flex justify-content-center align-items-center" 
                   style="background-image: url('{{ $project->gambar_utama ? asset('storage/' . $project->gambar_utama) : asset('website/images/project-1.jpg') }}');">
                <div class="overlay"></div>
                <a href="{{ route('projects.show', $project->slug) }}" 
                   class="btn-site d-flex align-items-center justify-content-center">
                  <span class="icon-subdirectory_arrow_right"></span>
                </a>
                <div class="text text-center p-4">
                  <h3><a href="{{ route('projects.show', $project->slug) }}">{{ $project->judul }}</a></h3>
                  <span>{{ $project->kategori->nama ?? 'Uncategorized' }}</span>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12">
              <div class="alert alert-info text-center">
                Belum ada project. Silakan cek kembali nanti!
              </div>
            </div>
          @endforelse
        </div>

        <!-- Pagination -->
        @if($projects->hasPages())
          <div class="row mt-5">
            <div class="col text-center">
              <div class="block-27">
                <ul>
                  @if ($projects->onFirstPage())
                    <li class="disabled"><span>&lt;</span></li>
                  @else
                    <li><a href="{{ $projects->previousPageUrl() }}">&lt;</a></li>
                  @endif

                  @foreach ($projects->getUrlRange(1, $projects->lastPage()) as $page => $url)
                    @if ($page == $projects->currentPage())
                      <li class="active"><span>{{ $page }}</span></li>
                    @else
                      <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                  @endforeach

                  @if ($projects->hasMorePages())
                    <li><a href="{{ $projects->nextPageUrl() }}">&gt;</a></li>
                  @else
                    <li class="disabled"><span>&gt;</span></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        @endif
			</div>
		</section>
@endsection
