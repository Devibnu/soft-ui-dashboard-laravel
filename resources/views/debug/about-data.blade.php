<!DOCTYPE html>
<html>
<head>
    <title>About Data Debug - jasaibnu.id</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f5f5f5; }
        .section { background: white; padding: 20px; margin: 20px 0; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .hero { background: linear-gradient(45deg, #007bff, #28a745); color: white; }
        .content { background: linear-gradient(45deg, #dc3545, #fd7e14); color: white; }
        .testimonial { background: linear-gradient(45deg, #6f42c1, #e83e8c); color: white; }
        .item { background: #f8f9fa; padding: 10px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #007bff; }
    </style>
</head>
<body>

<h1>🔍 ABOUT DATA DEBUG PAGE - jasaibnu.id</h1>
<p><strong>Generated at:</strong> {{ now() }}</p>

<!-- HERO SECTION DEBUG -->
<div class="section hero">
    <h2>📊 HERO SECTION DATA</h2>
    @if($heroSection)
        <div class="item">
            <h3>✅ HERO DATA FOUND</h3>
            <p><strong>ID:</strong> {{ $heroSection->id }}</p>
            <p><strong>Tagline:</strong> "{{ $heroSection->tagline }}"</p>
            <p><strong>Projects:</strong> {{ number_format($heroSection->projects_completed) }}</p>
            <p><strong>Customers:</strong> {{ number_format($heroSection->satisfied_customers) }}</p>
            <p><strong>Awards:</strong> {{ number_format($heroSection->awards_received) }}</p>
            <p><strong>Years:</strong> {{ number_format($heroSection->years_experience) }}</p>
            <p><strong>Updated:</strong> {{ $heroSection->updated_at }}</p>
        </div>
    @else
        <div class="item">
            <h3>❌ NO HERO DATA</h3>
            <p>Hero section data not found in database.</p>
        </div>
    @endif
</div>

<!-- CONTENT SECTIONS DEBUG -->
<div class="section content">
    <h2>📝 CONTENT SECTIONS DATA</h2>
    <p><strong>Total Count:</strong> {{ $contents->count() }}</p>
    
    @if($contents->count() > 0)
        @foreach($contents as $index => $content)
        <div class="item">
            <h3>✅ CONTENT #{{ $index + 1 }}</h3>
            <p><strong>ID:</strong> {{ $content->id }}</p>
            <p><strong>Title:</strong> "{{ $content->title }}"</p>
            <p><strong>Left Paragraph:</strong> {{ Str::limit($content->left_paragraph ?? 'Empty', 200) }}</p>
            <p><strong>Right Title:</strong> "{{ $content->right_title ?? 'Empty' }}"</p>
            <p><strong>Right Paragraph:</strong> {{ Str::limit($content->right_paragraph ?? 'Empty', 150) }}</p>
            <p><strong>CTA Text:</strong> "{{ $content->cta_text ?? 'Empty' }}"</p>
            <p><strong>CTA Link:</strong> "{{ $content->cta_link ?? 'Empty' }}"</p>
            <p><strong>Is Active:</strong> {{ $content->is_active ? '✅ YES' : '❌ NO' }}</p>
            <p><strong>Created:</strong> {{ $content->created_at }}</p>
            <p><strong>Updated:</strong> {{ $content->updated_at }}</p>
        </div>
        @endforeach
    @else
        <div class="item">
            <h3>❌ NO CONTENT DATA</h3>
            <p>No content sections found in database.</p>
        </div>
    @endif
</div>

<!-- TESTIMONIALS DEBUG -->
<div class="section testimonial">
    <h2>💬 TESTIMONIALS DATA</h2>
    <p><strong>Total Count:</strong> {{ $testimonials->count() }}</p>
    
    @if($testimonials->count() > 0)
        @foreach($testimonials as $index => $testimonial)
        <div class="item">
            <h3>✅ TESTIMONIAL #{{ $index + 1 }}</h3>
            <p><strong>ID:</strong> {{ $testimonial->id }}</p>
            <p><strong>Name:</strong> "{{ $testimonial->name ?? 'No Name' }}"</p>
            <p><strong>Position:</strong> "{{ $testimonial->position ?? 'No Position' }}"</p>
            <p><strong>Message:</strong> {{ Str::limit($testimonial->message ?? 'No message', 200) }}</p>
            <p><strong>Photo Path:</strong> {{ $testimonial->photo_path ?? 'No photo' }}</p>
            <p><strong>Is Active:</strong> {{ $testimonial->is_active ? '✅ YES' : '❌ NO' }}</p>
            <p><strong>Created:</strong> {{ $testimonial->created_at }}</p>
            <p><strong>Updated:</strong> {{ $testimonial->updated_at }}</p>
        </div>
        @endforeach
    @else
        <div class="item">
            <h3>❌ NO TESTIMONIALS DATA</h3>
            <p>No testimonials found in database.</p>
        </div>
    @endif
</div>

<div class="section">
    <h2>🔗 NAVIGATION</h2>
    <p><a href="/adminui/about" style="color: #007bff;">← Back to Admin About Page</a></p>
    <p><a href="/about" style="color: #28a745;">View Frontend About Page →</a></p>
</div>

</body>
</html>