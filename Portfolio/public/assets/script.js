

// ===== GESTION DU THÈME GLOBALE =====
class ThemeManager {
    constructor() {
        this.themeKey = 'portfolio-theme';
        this.init();
    }

    init() {
        // Charger le thème sauvegardé ou utiliser le thème système
        const savedTheme = localStorage.getItem(this.themeKey);
        const systemDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
        const initialTheme = savedTheme || (systemDarkMode ? 'dark' : 'light');
        
        this.setTheme(initialTheme);
        this.setupToggleButtons();
    }

    setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(this.themeKey, theme);
        
        // Mettre à jour tous les boutons de basculement
        const toggleButtons = document.querySelectorAll('.toggle-switch, .theme-toggle');
        toggleButtons.forEach(button => {
            if (button.classList.contains('toggle-switch')) {
                // Pour les toggle switch dans la navbar
                const handle = button;
                if (theme === 'dark') {
                    handle.classList.add('dark-mode');
                } else {
                    handle.classList.remove('dark-mode');
                }
            } else if (button.querySelector('.theme-icon')) {
                // Pour les boutons avec icône
                const icon = button.querySelector('.theme-icon');
                icon.textContent = theme === 'dark' ? '☀️' : '🌙';
            }
        });
    }

    toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        this.setTheme(newTheme);
    }

    setupToggleButtons() {
        // Setup pour les toggle switch
        document.querySelectorAll('.toggle-switch').forEach(toggle => {
            toggle.addEventListener('click', () => this.toggleTheme());
        });

        // Setup pour les boutons avec onclick="toggleTheme()"
        window.toggleTheme = () => this.toggleTheme();
    }
}

// ===== GESTION DE LA NAVIGATION =====
class NavigationManager {
    constructor() {
        this.init();
    }

    init() {
        this.setupDropdowns();
        this.setActiveLink();
        this.setupSmoothScroll();
    }

    setupDropdowns() {
        const dropdowns = document.querySelectorAll('.dropdown');
        
        dropdowns.forEach(dropdown => {
            const btn = dropdown.querySelector('.dropdown-btn');
            const content = dropdown.querySelector('.dropdown-content');

            if (btn && content) {
                // Toggle au clic
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    dropdown.classList.toggle('active');
                });

                // Fermer en cliquant ailleurs
                document.addEventListener('click', (e) => {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('active');
                    }
                });

                // Hover effects
                dropdown.addEventListener('mouseenter', () => {
                    dropdown.classList.add('active');
                });

                dropdown.addEventListener('mouseleave', () => {
                    dropdown.classList.remove('active');
                });
            }
        });
    }

    setActiveLink() {
        const currentPage = window.location.pathname.split('/').pop() || 'index.php';
        const links = document.querySelectorAll('.navbar-link');
        
        links.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            
            if (href === currentPage || 
                (currentPage === 'index.php' && href === '#') ||
                (currentPage === '' && href === '#')) {
                link.classList.add('active');
            }
        });
    }

    setupSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
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
    }
}
class PortfolioApp {
    constructor() {
        this.themeManager = null;
        this.navigationManager = null;
        this.visualEffectsManager = null;
        this.projectManager = null;
        this.contactFormManager = null;
        this.specialAnimationsManager = null;
        this.specialPagesManager = null;
    }

    init() {
        // Attendre que le DOM soit complètement chargé
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.initializeManagers());
        } else {
            this.initializeManagers();
        }
    }

    initializeManagers() {
        try {
            // Initialisation dans l'ordre de dépendance
            this.themeManager = new ThemeManager();
            this.navigationManager = new NavigationManager();
            this.visualEffectsManager = new VisualEffectsManager();
            this.projectManager = new ProjectManager();
            this.contactFormManager = new ContactFormManager();
            this.specialAnimationsManager = new SpecialAnimationsManager();
            this.specialPagesManager = new SpecialPagesManager();

            // Ajouter les styles nécessaires
            this.addRequiredStyles();

            console.log('Portfolio app initialized successfully');
        } catch (error) {
            console.error('Error initializing portfolio app:', error);
        }
    }

    addRequiredStyles() {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple-effect {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .field-error {
                color: #ff6b6b;
                font-size: 0.9rem;
                margin-top: 5px;
                animation: fadeIn 0.3s ease;
            }
        `;
        document.head.appendChild(style);
    }
}

// ===== FONCTIONS GLOBALES POUR COMPATIBILITÉ HTML =====
function redirectToProjects(event) {
    Utils.createRipple(event);
    setTimeout(() => {
        window.location.href = "/anim.projet.php";
    }, 200);
}

// ===== INITIALISATION =====
const portfolioApp = new PortfolioApp();
portfolioApp.init();

// Exposer certaines fonctions globalement pour les onclick HTML
window.redirectToProjects = redirectToProjects;

    // Matrix Rain Effect
    function createMatrixRain() {
        const matrixRain = document.getElementById('matrixRain');
        const columns = Math.floor(window.innerWidth / 20);
        
        for (let i = 0; i < columns; i++) {
            const column = document.createElement('div');
            column.className = 'matrix-column';
            column.style.left = i * 20 + 'px';
            column.style.animationDuration = (Math.random() * 5 + 5) + 's';
            column.style.animationDelay = Math.random() * 5 + 's';
            
            const chars = '01{}[]()</>!@#$%^&*';
            let text = '';
            for (let j = 0; j < 50; j++) {
                text += chars[Math.floor(Math.random() * chars.length)] + '\n';
            }
            column.textContent = text;
            
            matrixRain.appendChild(column);
        }
    }

    // Particles Effect
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        
        for (let i = 0; i < 20; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.top = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 20 + 's';
            particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
            particlesContainer.appendChild(particle);
        }
    }

    // Animate Counters
    function animateCounters() {
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px'
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const statCard = entry.target;
                    const numberElement = statCard.querySelector('.stat-number');
                    const finalValue = numberElement.textContent;
                    const isPercentage = finalValue.includes('%');
                    const numericValue = parseInt(finalValue);
                    
                    let currentValue = 0;
                    const increment = numericValue / 50;
                    const timer = setInterval(() => {
                        currentValue += increment;
                        if (currentValue >= numericValue) {
                            currentValue = numericValue;
                            clearInterval(timer);
                        }
                        numberElement.textContent = Math.floor(currentValue) + (isPercentage ? '%' : '');
                    }, 30);
                    
                    counterObserver.unobserve(statCard);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stat-card').forEach(card => {
            counterObserver.observe(card);
        });
    }
    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s ease';
        observer.observe(el);
    });

    // Progress bars animation
    const progressObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const progressBars = entry.target.querySelectorAll('.progress-fill');
                progressBars.forEach((bar, index) => {
                    setTimeout(() => {
                        bar.style.animation = 'progressAnimation 2s ease-out';
                    }, index * 200);
                });
                progressObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const progressSection = document.querySelector('.progress-section');
    if (progressSection) {
        progressObserver.observe(progressSection);
    }
                    /* Stage */
                    
    function createMatrixRain() {
        const container = document.getElementById('matrixBg');
        const chars = 'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン0123456789ABCDEF';
        const columns = Math.floor(window.innerWidth / 20);

        container.innerHTML = '';

        for (let i = 0; i < Math.min(columns, 50); i++) {
            const column = document.createElement('div');
            column.className = 'matrix-column';
            column.style.left = (i * 20) + 'px';
            column.style.animationDuration = (Math.random() * 3 + 2) + 's';
            column.style.animationDelay = Math.random() * 2 + 's';

            let text = '';
            for (let j = 0; j < 20; j++) {
                text += chars[Math.floor(Math.random() * chars.length)] + '<br>';
            }
            column.innerHTML = text;

            container.appendChild(column);
        }
    }  
// ===== TOUS MES PROJETS =====
 // Animation au scroll
 const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, observerOptions);

document.querySelectorAll('.project-card').forEach(card => {
    observer.observe(card);
});

// Effet de parallaxe sur les éléments flottants
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallax = document.querySelectorAll('.floating-circle');
    
    parallax.forEach((element, index) => {
        const speed = 0.5 + (index * 0.1);
        element.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

// ===== COMPETENCES =====

