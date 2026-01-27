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

// Hero Slider - Working Version
let currentSlideIndex = 0;
let sliderInterval;

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initHeroSlider();
});

function initHeroSlider() {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    
    if (slides.length === 0) {
        console.log('No slides found');
        return;
    }
    
    console.log('Found', slides.length, 'slides');
    
    // Show first slide
    showSlide(0);
    
    // Start auto-advance
    startAutoSlide();
    
    // Add event listeners
    setupEventListeners();
    
    // Animate counters for Global Impact when in view
        setTimeout(() => {
            setupImpactCounterAnimation();
        }, 500);
// === GLOBAL IMPACT COUNTER ANIMATION ===
function setupImpactCounterAnimation() {
    const section = document.getElementById('global-impact');
    if (!section) return;
    let animated = false;
    function onScroll() {
        const rect = section.getBoundingClientRect();
        if (!animated && rect.top < window.innerHeight - 80 && rect.bottom > 80) {
            animateImpactCounters();
            animated = true;
            window.removeEventListener('scroll', onScroll);
        }
    }
    window.addEventListener('scroll', onScroll);
    // In case already in view
    onScroll();
}

function animateImpactCounters() {
    document.querySelectorAll('.global-impact-stat .stat-number').forEach(el => {
        const target = parseInt(el.getAttribute('data-count'), 10) || 0;
        animateCountUp(el, target, 1200);
    });
}

function animateCountUp(element, target, duration) {
    let start = 0;
    const step = Math.ceil(target / (duration / 16));
    function update() {
        start += step;
        if (start >= target) {
            element.textContent = target.toLocaleString();
        } else {
            element.textContent = start.toLocaleString();
            requestAnimationFrame(update);
        }
    }
    update();
}
}

function showSlide(index) {
    const slides = document.querySelectorAll('.slide');
    const indicators = document.querySelectorAll('.indicator');
    
    // Remove active class from all slides and indicators
    slides.forEach(slide => slide.classList.remove('active'));
    indicators.forEach(indicator => indicator.classList.remove('active'));
    
    // Add active class to current slide and indicator
    if (slides[index]) {
        slides[index].classList.add('active');
        currentSlideIndex = index;
    }
    
    if (indicators[index]) {
        indicators[index].classList.add('active');
    }
    
    // Animate counters after slide change
    setTimeout(() => animateCounters(), 300);
}

function nextSlide() {
    const slides = document.querySelectorAll('.slide');
    currentSlideIndex = (currentSlideIndex + 1) % slides.length;
    showSlide(currentSlideIndex);
    restartAutoSlide();
}

function prevSlide() {
    const slides = document.querySelectorAll('.slide');
    currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
    showSlide(currentSlideIndex);
    restartAutoSlide();
}

function changeSlide(direction) {
    if (direction > 0) {
        nextSlide();
    } else {
        prevSlide();
    }
}

function currentSlide(index) {
    showSlide(index - 1); // Convert to 0-based index
    restartAutoSlide();
}

function startAutoSlide() {
    sliderInterval = setInterval(() => {
        nextSlide();
    }, 6000);
}

function stopAutoSlide() {
    if (sliderInterval) {
        clearInterval(sliderInterval);
    }
}

function restartAutoSlide() {
    stopAutoSlide();
    startAutoSlide();
}

function setupEventListeners() {
    // Mouse hover events
    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider) {
        heroSlider.addEventListener('mouseenter', stopAutoSlide);
        heroSlider.addEventListener('mouseleave', startAutoSlide);
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') prevSlide();
        if (e.key === 'ArrowRight') nextSlide();
    });
    
    // Touch events for mobile
    let startX = 0;
    let endX = 0;
    
    if (heroSlider) {
        heroSlider.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });
        
        heroSlider.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            const deltaX = startX - endX;
            
            if (Math.abs(deltaX) > 50) {
                if (deltaX > 0) {
                    nextSlide();
                } else {
                    prevSlide();
                }
            }
        });
    }
    
    // Visibility API
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopAutoSlide();
        } else {
            startAutoSlide();
        }
    });
}

function animateCounters() {
    const activeSlide = document.querySelector('.slide.active');
    if (!activeSlide) return;
    
    const counters = activeSlide.querySelectorAll('.stat-number[data-count]');
    
    counters.forEach(counter => {
        const target = parseInt(counter.dataset.count);
        let current = 0;
        const increment = target / 60; // 60 frames for smooth animation
        
        const updateCounter = () => {
            current += increment;
            if (current >= target) {
                counter.textContent = target;
            } else {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            }
        };
        
        counter.textContent = '0';
        setTimeout(updateCounter, 200);
    });
}

// Button hover effects
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-primary, .btn-secondary').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});

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
            }, 7000); // Longer duration for reading content
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
        slider.addEventListener('touchstart', (e) => { 
            touchStartX = e.changedTouches[0].screenX; 
        }, {passive: true});
        
        slider.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            const diff = touchStartX - touchEndX;
            if (Math.abs(diff) > 80) {
                if (diff > 0) nextSlide(); 
                else prevSlide();
            }
        }, {passive: true});

        // Initialize
        showSlide(current);
        startAutoSlide();

        // Animate metrics on load
        setTimeout(() => {
            const metrics = slides[0].querySelectorAll('.metric-number[data-count]');
            metrics.forEach(metric => {
                const target = parseInt(metric.dataset.count);
                animateCounter(metric, target);
            });
        }, 800);
    }

    // Enhanced counter animation
    function animateCounter(element, target, duration = 2000) {
        let start = 0;
        const increment = target / (duration / 16);
        const suffix = element.textContent.includes('+') ? '+' : '';
        
        function updateCounter() {
            start += increment;
            if (start < target) {
                element.textContent = Math.floor(start) + suffix;
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + suffix;
            }
        }
        
        updateCounter();
    }
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
    const animateElements = document.querySelectorAll('.stat-item, .vision-card, .mission-card, .faculty-card, .who-card');
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

// People modal: open on card click / Enter key, populate content, trap focus
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('people-modal');
    if (!modal) return;
    const panel = modal.querySelector('.people-modal-panel');
    const titleEl = modal.querySelector('#people-modal-title');
    const roleEl = modal.querySelector('.people-modal-role');
    const photoEl = modal.querySelector('.people-modal-photo');
    const bioEl = modal.querySelector('.people-modal-bio');
    const contactsEl = modal.querySelector('.people-modal-contacts');
    const closeButtons = modal.querySelectorAll('[data-action="close"]');
    const closeBtn = modal.querySelector('.people-modal-close');
    const mainEl = document.querySelector('main');

    let lastFocused = null;

    function openModal(data, triggerEl) {
        lastFocused = triggerEl || document.activeElement;
        titleEl.textContent = data.name;
        roleEl.textContent = data.role;
        photoEl.src = data.photo;
        photoEl.alt = data.name;
        bioEl.textContent = data.bio;
        // populate contacts
        if (contactsEl) {
            contactsEl.innerHTML = '';
            if (data.email) {
                const a = document.createElement('a');
                a.href = 'mailto:' + data.email;
                a.textContent = 'Email';
                a.className = 'modal-contact-email';
                contactsEl.appendChild(a);
            }
            if (data.linkedin) {
                const a2 = document.createElement('a');
                a2.href = data.linkedin;
                a2.textContent = 'LinkedIn';
                a2.target = '_blank';
                a2.rel = 'noopener';
                a2.className = 'modal-contact-linkedin';
                contactsEl.appendChild(a2);
            }
        }
        modal.setAttribute('aria-hidden', 'false');
        // hide main from AT and set focus to close button
        if (mainEl) mainEl.setAttribute('aria-hidden', 'true');
        if (closeBtn) closeBtn.focus();
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.setAttribute('aria-hidden', 'true');
        if (mainEl) mainEl.removeAttribute('aria-hidden');
        document.body.style.overflow = '';
        if (lastFocused && typeof lastFocused.focus === 'function') lastFocused.focus();
    }

    // Click handlers for close
    closeButtons.forEach(btn => btn.addEventListener('click', closeModal));

    // Backdrop click closes
    modal.addEventListener('click', (e) => {
        if (e.target.classList.contains('people-modal-backdrop')) closeModal();
    });

    // Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.getAttribute('aria-hidden') === 'false') closeModal();
        // focus trap: if modal open, manage Tab/Shift+Tab
        if (modal.getAttribute('aria-hidden') === 'false' && (e.key === 'Tab')) {
            const focusable = panel.querySelectorAll('a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])');
            const focusableArray = Array.prototype.slice.call(focusable);
            if (!focusableArray.length) {
                e.preventDefault();
                return;
            }
            const first = focusableArray[0];
            const last = focusableArray[focusableArray.length - 1];
            if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            } else if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            }
        }
    });

    // Open modal when a person-card is clicked or activated via keyboard
    document.querySelectorAll('.person-card').forEach(card => {
        card.addEventListener('click', () => {
            openModal({
                name: card.dataset.personName,
                role: card.dataset.personRole,
                photo: card.dataset.personPhoto,
                bio: card.dataset.personBio
                ,
                email: card.dataset.personEmail,
                linkedin: card.dataset.personLinkedin
            }, card);
        });
        card.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                card.click();
            }
        });
    });
});

// Lightweight CTA tracking for events
document.addEventListener('click', function(e) {
    const target = e.target.closest('[data-evt-action]');
    if (!target) return;
    try {
        const action = target.getAttribute('data-evt-action');
        const id = target.getAttribute('data-evt-id');
        const href = target.getAttribute('href');
        const label = target.textContent.trim();
        const payload = { event: 'cce_event_cta', action, id, label, href };
        // console log for local debugging
        console.info('CTA click:', payload);
        // push to dataLayer if available (non-fatal)
        if (window.dataLayer && typeof window.dataLayer.push === 'function') {
            window.dataLayer.push(payload);
        }

        // send to local analytics endpoint if present
        try {
            const endpoint = '/analytics/log.php';
            const body = JSON.stringify(payload);
            const headers = { type: 'application/json' };
            if (navigator.sendBeacon) {
                const blob = new Blob([body], { type: 'application/json' });
                navigator.sendBeacon(endpoint, blob);
            } else {
                fetch(endpoint, { method: 'POST', headers: { 'Content-Type': 'application/json' }, body }).catch(() => {});
            }
        } catch (sErr) {
            // ignore analytics failure
        }
    } catch (err) {
        // swallow errors to avoid breaking other scripts
        console.warn('CTA tracking error', err);
    }
});