// Clean & Professional Hero Slider - ILO Style
let currentSlide = 0;
let slideInterval;

// Initialize hero slider when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initHeroSlider();
});

function initHeroSlider() {
    const slides = document.querySelectorAll('.hero-slide');
    const contentSlides = document.querySelectorAll('.hero-content-slide');
    const controls = document.querySelectorAll('.hero-control');
    
    if (slides.length === 0) return;
    
    console.log('Hero slider initialized with', slides.length, 'slides');
    
    // Show first slide
    showSlide(0);
    
    // Auto advance slides
    startAutoSlide();
    
    // Add click handlers to controls
    controls.forEach((control, index) => {
        control.addEventListener('click', () => {
            showSlide(index);
            restartAutoSlide();
        });
    });
    
    // Pause on hover
    const heroSection = document.querySelector('.hero-section');
    if (heroSection) {
        heroSection.addEventListener('mouseenter', pauseSlider);
        heroSection.addEventListener('mouseleave', resumeSlider);
    }
}

function showSlide(index) {
    const slides = document.querySelectorAll('.hero-slide');
    const contentSlides = document.querySelectorAll('.hero-content-slide');
    const controls = document.querySelectorAll('.hero-control');
    
    // Remove active class from all elements
    slides.forEach(slide => slide.classList.remove('active'));
    contentSlides.forEach(content => content.classList.remove('active'));
    controls.forEach(control => control.classList.remove('active'));
    
    // Add active class to current elements
    if (slides[index]) slides[index].classList.add('active');
    if (contentSlides[index]) contentSlides[index].classList.add('active');
    if (controls[index]) controls[index].classList.add('active');
    
    currentSlide = index;
}

function nextSlide() {
    const slides = document.querySelectorAll('.hero-slide');
    const nextIndex = (currentSlide + 1) % slides.length;
    showSlide(nextIndex);
}

function startAutoSlide() {
    slideInterval = setInterval(nextSlide, 6000); // 6 seconds
}

function pauseSlider() {
    if (slideInterval) {
        clearInterval(slideInterval);
    }
}

function resumeSlider() {
    startAutoSlide();
}

function restartAutoSlide() {
    pauseSlider();
    startAutoSlide();
}

// General Coordinator Modal Functions
function openGCModal() {
    const modal = document.getElementById('gc-modal');
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeGCModal() {
    const modal = document.getElementById('gc-modal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
}

function closeGCModalOnOutside(event) {
    if (event.target.id === 'gc-modal') {
        closeGCModal();
    }
}

// Close modal on Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeGCModal();
    }
});

// Enhanced carousel functionality for people and companies sections
document.addEventListener('DOMContentLoaded', function() {
    // People Carousel Auto-scroll
    const peopleCarousel = document.getElementById('cce-people-carousel');
    if (peopleCarousel) {
        setInterval(() => {
            const scrollAmount = 340; // Card width + gap
            const maxScroll = peopleCarousel.scrollWidth - peopleCarousel.clientWidth;
            
            if (peopleCarousel.scrollLeft >= maxScroll - 10) {
                peopleCarousel.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                peopleCarousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        }, 4000);
    }
    
    // Companies Carousel Infinite Scroll
    const companiesCarousel = document.getElementById('companies-carousel');
    if (companiesCarousel) {
        const cards = companiesCarousel.querySelectorAll('.company-carousel-card');
        if (cards.length > 0) {
            const cardCount = cards.length / 2; // Original count (duplicated for infinite effect)
            const cardWidth = cards[0].offsetWidth + 32; // Card width + gap
            
            setInterval(() => {
                companiesCarousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
                
                setTimeout(() => {
                    if (companiesCarousel.scrollLeft >= cardWidth * cardCount - 50) {
                        companiesCarousel.scrollTo({ left: 0, behavior: 'auto' });
                    }
                }, 600);
            }, 4000);
        }
    }
    
    // Manual carousel controls
    const carouselBtns = document.querySelectorAll('.carousel-control-btn');
    carouselBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const carouselId = this.getAttribute('data-carousel');
            const carousel = document.getElementById(carouselId);
            if (!carousel) return;
            
            const scrollAmount = 340;
            
            if (this.classList.contains('prev')) {
                carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
            } else {
                carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
            }
        });
    });
});