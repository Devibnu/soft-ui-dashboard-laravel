<!-- Hero Section Form -->
<div class="row">
    <div class="col-12">
        <h6 class="text-primary mb-3">
            <i class="ni ni-chart-bar-32 me-2"></i>Hero Section - Statistik Perusahaan
        </h6>
        <p class="text-sm text-muted mb-4">Kelola tagline dan statistik yang ditampilkan di bagian atas halaman About</p>
    </div>
</div>

<form id="heroSectionForm" method="POST" action="{{ route('adminui.about.hero.store') }}">
    @csrf
    @if(isset($heroSection) && $heroSection->id)
        @method('PUT')
        <input type="hidden" name="hero_id" value="{{ $heroSection->id }}">
    @endif
    
    <!-- Tagline -->
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label class="form-control-label" for="tagline">Tagline <span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="tagline" name="tagline" 
                       value="{{ $heroSection->tagline ?? '' }}" 
                       placeholder="Contoh: Professional Consulting Services" 
                       maxlength="255" required>
                <small class="form-text text-muted">Tagline utama yang akan ditampilkan di hero section</small>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row">
        <div class="col-12">
            <h6 class="text-secondary mb-3">Statistik Perusahaan</h6>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-control-label" for="projects_completed">Projects Completed <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="projects_completed" name="projects_completed" 
                       value="{{ $heroSection->projects_completed ?? 705 }}" 
                       min="0" required>
                <small class="form-text text-muted">Jumlah proyek yang telah selesai</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-control-label" for="satisfied_customers">Satisfied Customers <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="satisfied_customers" name="satisfied_customers" 
                       value="{{ $heroSection->satisfied_customers ?? 809 }}" 
                       min="0" required>
                <small class="form-text text-muted">Jumlah pelanggan yang puas</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-control-label" for="awards_received">Awards Received <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="awards_received" name="awards_received" 
                       value="{{ $heroSection->awards_received ?? 335 }}" 
                       min="0" required>
                <small class="form-text text-muted">Jumlah penghargaan yang diterima</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-control-label" for="years_experience">Years of Experience <span class="text-danger">*</span></label>
                <input class="form-control" type="number" id="years_experience" name="years_experience" 
                       value="{{ $heroSection->years_experience ?? 35 }}" 
                       min="0" required>
                <small class="form-text text-muted">Tahun pengalaman perusahaan</small>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('about') }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="ni ni-world me-1"></i>Lihat Halaman
                </a>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="ni ni-send me-2"></i>Simpan Hero Section
                </button>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const heroForm = document.getElementById('heroSectionForm');
    
    if (heroForm) {
        heroForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ni ni-settings-gear-65 rotate me-2"></i>Menyimpan...';
            
            // Determine if this is update or create
            const heroId = formData.get('hero_id');
            const url = heroId 
                ? `{{ route('adminui.about.hero.index') }}/${heroId}`
                : '{{ route('adminui.about.hero.store') }}';
            
            if (heroId) {
                formData.append('_method', 'PUT');
            }
            
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('success', data.message);
                    // Update form with new ID if it was a create operation
                    if (data.data && data.data.id && !heroId) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'hero_id';
                        hiddenInput.value = data.data.id;
                        heroForm.appendChild(hiddenInput);
                        
                        // Change form method to PUT for future updates
                        heroForm.method = 'PUT';
                    }
                } else {
                    let errorMessage = 'Terjadi kesalahan saat menyimpan.';
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat();
                        errorMessage = errorList.join('<br>');
                    } else if (data.message) {
                        errorMessage = data.message;
                    }
                    showNotification('error', errorMessage);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('error', 'Terjadi kesalahan jaringan. Silakan coba lagi.');
            })
            .finally(() => {
                // Restore button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    }
});
</script>
@endpush