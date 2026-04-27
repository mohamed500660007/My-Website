@extends('layouts.app')

@section('title', 'Projects Portfolio')

@section('styles')
<style>
/* Project Showcase Styles */
.projects-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 6rem 0;
    position: relative;
    overflow: hidden;
}

.projects-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,106.7C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
    background-size: cover;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    opacity: 0;
    animation: fadeInUp 0.8s ease forwards;
}

.hero-subtitle {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    opacity: 0;
    animation: fadeInUp 0.8s ease 0.2s forwards;
}

/* Featured Projects Carousel */
.featured-section {
    padding: 4rem 0;
    background: #f8fafc;
}

.featured-carousel {
    position: relative;
    overflow: hidden;
    border-radius: 1rem;
}

.featured-track {
    display: flex;
    transition: transform 0.5s ease;
}

.featured-item {
    min-width: 100%;
    position: relative;
    border-radius: 1rem;
    overflow: hidden;
    background: white;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

.featured-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.featured-item:hover .featured-image {
    transform: scale(1.05);
}

.featured-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    color: white;
    padding: 2rem;
}

.featured-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.featured-description {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 1rem;
}

/* Project Filters */
.filters-section {
    padding: 3rem 0;
    background: white;
    position: sticky;
    top: 0;
    z-index: 40;
    border-bottom: 1px solid #e2e8f0;
}

.filter-container {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.5rem 1.5rem;
    border: 2px solid #e2e8f0;
    background: white;
    color: #64748b;
    border-radius: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: 500;
}

.filter-btn:hover {
    border-color: #3b82f6;
    color: #3b82f6;
    transform: translateY(-2px);
}

.filter-btn.active {
    background: #3b82f6;
    border-color: #3b82f6;
    color: white;
}

/* Project Grid */
.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    padding: 4rem 0;
}

.project-card {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.project-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15);
}

.project-image {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-card:hover .project-image {
    transform: scale(1.1);
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    display: flex;
    align-items: flex-end;
    padding: 1.5rem;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.overlay-content {
    color: white;
}

.overlay-title {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.overlay-actions {
    display: flex;
    gap: 0.75rem;
}

.action-btn {
    padding: 0.5rem 1rem;
    background: rgba(255,255,255,0.2);
    border: 1px solid rgba(255,255,255,0.3);
    color: white;
    border-radius: 0.5rem;
    text-decoration: none;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.action-btn:hover {
    background: rgba(255,255,255,0.3);
    transform: translateY(-2px);
}

.project-content {
    padding: 1.5rem;
}

.project-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
}

.project-description {
    color: #64748b;
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 1rem;
}

.technology-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tech-tag {
    padding: 0.25rem 0.75rem;
    background: #f1f5f9;
    color: #475569;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Carousel Controls */
.carousel-controls {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 1rem;
    pointer-events: none;
}

.carousel-btn {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    background: rgba(255,255,255,0.9);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    pointer-events: all;
}

.carousel-btn:hover {
    background: white;
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .projects-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 2rem 0;
    }
    
    .featured-image {
        height: 300px;
    }
    
    .filter-container {
        gap: 0.5rem;
    }
    
    .filter-btn {
        padding: 0.375rem 1rem;
        font-size: 0.875rem;
    }
}
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="projects-hero">
    <div class="container mx-auto px-4">
        <div class="hero-content">
            <h1 class="hero-title">My Projects Portfolio</h1>
            <p class="hero-subtitle">Showcasing innovative solutions and creative development work</p>
        </div>
    </div>
</section>

<!-- Featured Projects Carousel -->
@if($featuredProjects->count() > 0)
<section class="featured-section">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Featured Projects</h2>
        <div class="featured-carousel">
            <div class="featured-track" id="featuredTrack">
                @foreach($featuredProjects as $project)
                <div class="featured-item">
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="featured-image">
                    <div class="featured-content">
                        <h3 class="featured-title">{{ $project->title }}</h3>
                        <p class="featured-description">{{ Str::limit($project->short_description, 150) }}</p>
                        <div class="overlay-actions">
                            <a href="{{ route('projects.show', $project->slug) }}" class="action-btn">View Project</a>
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="action-btn">Live Demo</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="carousel-controls">
                <button class="carousel-btn" onclick="moveCarousel(-1)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <button class="carousel-btn" onclick="moveCarousel(1)">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Filters Section -->
<section class="filters-section">
    <div class="container mx-auto px-4">
        <div class="filter-container">
            <button class="filter-btn active" data-filter="all">All Projects</button>
            <button class="filter-btn" data-filter="web">Web Development</button>
            <button class="filter-btn" data-filter="mobile">Mobile Apps</button>
            <button class="filter-btn" data-filter="design">UI/UX Design</button>
            <button class="filter-btn" data-filter="featured">Featured Only</button>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="projects-section">
    <div class="container mx-auto px-4">
        <div class="projects-grid" id="projectsGrid">
            @foreach($projects as $project)
            <div class="project-card" data-categories="{{ implode(',', $project->technologies->pluck('name')->map(fn($tech) => strtolower($tech))->toArray()) }} {{ $project->is_featured ? 'featured' : '' }}">
                <div style="position: relative; overflow: hidden;">
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="project-image">
                    <div class="project-overlay">
                        <div class="overlay-content">
                            <h4 class="overlay-title">{{ $project->title }}</h4>
                            <div class="overlay-actions">
                                <a href="{{ route('projects.show', $project->slug) }}" class="action-btn">View Details</a>
                                @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" class="action-btn">Live Demo</a>
                                @endif
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="action-btn">GitHub</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title">{{ $project->title }}</h3>
                    <p class="project-description">{{ Str::limit($project->short_description, 100) }}</p>
                    <div class="technology-tags">
                        @foreach($project->technologies->take(4) as $technology)
                        <span class="tech-tag">{{ $technology->name }}</span>
                        @endforeach
                        @if($project->technologies->count() > 4)
                        <span class="tech-tag">+{{ $project->technologies->count() - 4 }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
// Carousel functionality
let currentSlide = 0;
const track = document.getElementById('featuredTrack');
const slides = track?.children || [];
const totalSlides = slides.length;

function moveCarousel(direction) {
    if (totalSlides <= 1) return;
    
    currentSlide += direction;
    if (currentSlide < 0) currentSlide = totalSlides - 1;
    if (currentSlide >= totalSlides) currentSlide = 0;
    
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
}

// Auto-advance carousel
if (totalSlides > 1) {
    setInterval(() => moveCarousel(1), 5000);
}

// Filter functionality
const filterButtons = document.querySelectorAll('.filter-btn');
const projectCards = document.querySelectorAll('.project-card');

filterButtons.forEach(button => {
    button.addEventListener('click', () => {
        // Update active button
        filterButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');
        
        const filter = button.dataset.filter;
        
        // Filter projects
        projectCards.forEach(card => {
            if (filter === 'all') {
                card.style.display = 'block';
                setTimeout(() => card.style.opacity = '1', 10);
            } else if (filter === 'featured') {
                const isFeatured = card.dataset.categories.includes('featured');
                card.style.display = isFeatured ? 'block' : 'none';
                if (isFeatured) setTimeout(() => card.style.opacity = '1', 10);
            } else {
                const categories = card.dataset.categories;
                const hasCategory = categories.includes(filter);
                card.style.display = hasCategory ? 'block' : 'none';
                if (hasCategory) setTimeout(() => card.style.opacity = '1', 10);
            }
        });
    });
});

// Smooth reveal animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe project cards
projectCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(card);
});
</script>
@endsection
