
// Hero Slider Functionality
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.hero-slider');
    if (slider) {
        const slides = slider.querySelectorAll('.slide');
        const prevBtn = slider.querySelector('.slider-btn.prev');
        const nextBtn = slider.querySelector('.slider-btn.next');
        const indicators = slider.querySelectorAll('.indicator');
        let current = 0;
        let autoSlideInterval = null;
        let isPaused = false;

        function updateIndicators(idx) {
            indicators.forEach((btn, i) => {
                btn.classList.toggle('active', i === idx);
                btn.setAttribute('aria-selected', i === idx ? 'true' : 'false');
            });
        }

        function showSlide(idx) {
            slides.forEach((slide, i) => {
                const isActive = i === idx;
                slide.classList.toggle('active', isActive);
                slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
            });
            updateIndicators(idx);
            // Update live region for screen readers
            const live = slider.querySelector('.sr-live');
            const title = slides[idx].querySelector('.hero-title') || slides[idx].querySelector('h1');
            if (live && title) {
                live.textContent = `Slide ${idx + 1} of ${slides.length}: ${title.textContent.trim()}`;
            }
        }

        function goTo(idx) {
            current = (idx + slides.length) % slides.length;
            showSlide(current);
        }

        function nextSlide() {
            goTo(current + 1);
        }

        function prevSlide() {
            goTo(current - 1);
        }

        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);

        indicators.forEach(btn => {
            btn.addEventListener('click', (e) => {
                const idx = parseInt(e.currentTarget.dataset.slideTo, 10);
                goTo(idx);
            });
        });

        // Auto-slide with pause on hover/focus
        function startAutoSlide() {
            stopAutoSlide();
            autoSlideInterval = setInterval(() => {
                if (!isPaused) nextSlide();
            }, 6000); // keep 6s to allow crossfade
        }

        function stopAutoSlide() {
            if (autoSlideInterval) clearInterval(autoSlideInterval);
            autoSlideInterval = null;
        }

        slider.addEventListener('mouseenter', () => { isPaused = true; });
        slider.addEventListener('mouseleave', () => { isPaused = false; });
        slider.addEventListener('focusin', () => { isPaused = true; });
        slider.addEventListener('focusout', () => { isPaused = false; });

        // Keyboard navigation
        slider.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') nextSlide();
            if (e.key === 'ArrowLeft') prevSlide();
        });

        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;
        slider.addEventListener('touchstart', (e) => { touchStartX = e.changedTouches[0].screenX; }, {passive:true});
        slider.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 50) {
                if (diff > 0) nextSlide(); else prevSlide();
            }
        }, {passive:true});

        // init
        showSlide(current);
        startAutoSlide();
    }
});
// Powerful Homepage JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Animate numbers in impact stats
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        
        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start) + '+';
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + '+';
            }
        }
        
        updateCounter();
    }
    
    // Observer for animations on scroll
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                
                // Trigger counter animation for stats
                if (entry.target.classList.contains('stat-number')) {
                    const target = parseInt(entry.target.dataset.count);
                    animateCounter(entry.target, target);
                    observer.unobserve(entry.target);
                }
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    const animateElements = document.querySelectorAll('.stat-item, .vision-card, .mission-card, .faculty-card');
    animateElements.forEach(el => observer.observe(el));
    
    // Observe stat numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(el => observer.observe(el));
    
    // Smooth scroll for CTA buttons
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Scroll indicator functionality
    const scrollIndicator = document.querySelector('.scroll-indicator');
    if (scrollIndicator) {
        scrollIndicator.addEventListener('click', () => {
            window.scrollTo({
                top: window.innerHeight,
                behavior: 'smooth'
            });
        });
    }
    
    // Parallax effect for hero section
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.hero-logo, .floating-elements');
        
        parallaxElements.forEach(element => {
            const speed = 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
        
        // Hide scroll indicator when scrolling
        if (scrollIndicator) {
            scrollIndicator.style.opacity = scrolled > 100 ? '0' : '1';
        }
    });
    
    // Add hover effects for cards
    const cards = document.querySelectorAll('.vision-card, .mission-card, .faculty-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Dynamic floating elements
    function createFloatingElements() {
        const container = document.querySelector('.floating-elements');
        if (!container) return;
        
        const icons = ['🎓', '📚', '🌟', '💡', '🔬', '🎯'];
        
        icons.forEach((icon, index) => {
            const element = document.createElement('div');
            element.className = 'float-element';
            element.textContent = icon;
            element.setAttribute('data-float', index + 1);
            element.style.color = 'rgba(255, 152, 0, 0.6)';
            container.appendChild(element);
        });
    }
    
    // Create network visualization for CTA section
    function createNetworkVisualization() {
        const container = document.querySelector('.network-visualization');
        if (!container) return;
        
        // Create nodes
        for (let i = 0; i < 20; i++) {
            const node = document.createElement('div');
            node.className = 'network-node';
            node.style.left = Math.random() * 100 + '%';
            node.style.top = Math.random() * 100 + '%';
            node.style.animationDelay = Math.random() * 4 + 's';
            container.appendChild(node);
        }
        
        // Create connections
        for (let i = 0; i < 15; i++) {
            const connection = document.createElement('div');
            connection.className = 'network-connection';
            connection.style.left = Math.random() * 100 + '%';
            connection.style.top = Math.random() * 100 + '%';
            connection.style.width = Math.random() * 200 + 50 + 'px';
            connection.style.transform = `rotate(${Math.random() * 360}deg)`;
            connection.style.animationDelay = Math.random() * 3 + 's';
            container.appendChild(connection);
        }
    }
    
    // Initialize dynamic elements
    createFloatingElements();
    createNetworkVisualization();
    
    // Add typing effect to hero title
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.innerHTML = '';
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }
    
    // Start typing effect after a delay
    setTimeout(() => {
        const heroTitle = document.querySelector('.hero-title');
        if (heroTitle) {
            const originalText = heroTitle.textContent;
            typeWriter(heroTitle, originalText, 80);
        }
    }, 500);
    
    // Add CSS for animation states
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            animation: slideInUp 0.8s ease-out forwards;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-item:nth-child(2) { animation-delay: 0.2s; }
        .stat-item:nth-child(3) { animation-delay: 0.4s; }
        .stat-item:nth-child(4) { animation-delay: 0.6s; }
        
        .faculty-card:nth-child(2) { animation-delay: 0.2s; }
        .faculty-card:nth-child(3) { animation-delay: 0.4s; }
        .faculty-card:nth-child(4) { animation-delay: 0.6s; }
    `;
    document.head.appendChild(style);
});

// Mobile touch effects
if ('ontouchstart' in window) {
    document.addEventListener('touchstart', function() {}, {passive: true});
}