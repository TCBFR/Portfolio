<?php

include __DIR__ . '/../view/partials/banner.php';
?> 

<style>
   
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        margin-top: 40px;
    }

    .project-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        height: auto;
        min-height: 280px;
    }

    .project-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s;
    }

    .project-card:hover::before {
        left: 100%;
    }

    .project-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(0,0,0,0.2);
    }

    .project-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        transition: all 0.3s ease;
    }

    .personal .project-icon {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        color: white;
    }

    .school .project-icon {
        background: linear-gradient(135deg, #4834d4, #686de0);
        color: white;
    }

    .professional .project-icon {
        background: linear-gradient(135deg, #00d2d3, #54a0ff);
        color: white;
    }

    .project-card:hover .project-icon {
        transform: rotate(360deg) scale(1.1);
    }

    .project-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #2c3e50;
        text-align: center;
    }

    .project-description {
        font-size: 0.95rem;
        color: #7f8c8d;
        line-height: 1.4;
        margin-bottom: 20px;
        text-align: center;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 6px;
        margin-bottom: 20px;
    }

    .tech-tag {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: #495057;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .tech-tag:hover {
        background: linear-gradient(135deg, #495057, #343a40);
        color: white;
        transform: translateY(-2px);
    }

    .project-link {
        display: inline-block;
        background: linear-gradient(135deg, #2c3e50, #34495e);
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        width: 100%;
        text-align: center;
    }

    .project-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #3498db, #2980b9);
        transition: left 0.3s ease;
        z-index: -1;
    }

    .project-link:hover::before {
        left: 0;
    }

    .project-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.2);
    }

    .floating-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        animation: float 6s ease-in-out infinite;
    }

    .shape:nth-child(1) {
        width: 100px;
        height: 100px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 150px;
        height: 150px;
        top: 70%;
        right: 10%;
        animation-delay: 2s;
    }

    .shape:nth-child(3) {
        width: 80px;
        height: 80px;
        top: 50%;
        left: 5%;
        animation-delay: 4s;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    .section {
        padding: 40px 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .section h2 {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 15px;
        background: linear-gradient(135deg, #2c3e50, #34495e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    @media (max-width: 768px) {
        .section h2 {
            font-size: 2rem;
        }
        
        .projects-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .project-card {
            padding: 20px;
            min-height: 250px;
        }

        .project-icon {
            width: 50px;
            height: 50px;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .project-title {
            font-size: 1.3rem;
        }

        .project-description {
            font-size: 0.9rem;
            -webkit-line-clamp: 2;
        }
    }


</style>

<div class="matrix-bg" id="matrixBg"></div>
<div class="floating-shapes">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<section class="section fade-in">
    <h2 id="projets">Mes projets</h2>
    <div class="projects-grid">
        <!-- Projets Personnels -->
        <div class="project-card personal">
            <div class="project-icon">🚀</div>
            <h2 class="project-title">Projets Personnels</h2>
            <p class="project-description">
                Explorez mes créations personnelles, mes expérimentations et mes projets passion développés sur mon temps libre.
            </p>
            <div class="tech-stack">
                <span class="tech-tag">PHP</span>
                <span class="tech-tag">JavaScript</span>
                <span class="tech-tag">HTML/CSS</span>
            </div>
            <a href="/projet-perso" class="project-link">
                Voir mes projets personnels
            </a>
        </div>

        <!-- Projets Scolaires -->
        <div class="project-card school">
            <div class="project-icon">🎓</div>
            <h2 class="project-title">Projets Scolaires</h2>
            <p class="project-description">
                Découvrez les projets réalisés durant ma formation, témoins de mon apprentissage et de ma progression.
            </p>
            <div class="tech-stack">
                <span class="tech-tag">PHP</span>
                <span class="tech-tag">MySQL</span>
                <span class="tech-tag">HTML/CSS</span>
            </div>
            <a href="/projet-scol" class="project-link">
                Voir mes projets scolaires
            </a>
        </div>

        <!-- Projets Professionnels -->
        <div class="project-card professional">
            <div class="project-icon">💼</div>
            <h2 class="project-title">Projets Professionnels</h2>
            <p class="project-description">
                Consultez mes réalisations professionnelles et les solutions développées en entreprise.
            </p>
            <div class="tech-stack">
                <span class="tech-tag">PHP</span>
                <span class="tech-tag">Wordpress</span>
                <span class="tech-tag">HTML / CSS</span>
            </div>
            <a href="/projet-pro" class="project-link">
                Voir mes projets professionnels
            </a>
        </div>
    </div>
</section>

<script>
    // Animation des cartes au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                entry.target.style.animationDelay = `${index * 0.2}s`;
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.project-card').forEach(card => {
        observer.observe(card);
    });

    // Effet de parallaxe sur les formes flottantes
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const shapes = document.querySelectorAll('.shape');
        
        shapes.forEach((shape, index) => {
            const speed = 0.5 + (index * 0.1);
            shape.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Effet de survol avancé
    document.querySelectorAll('.project-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-10px) scale(1.02)`;
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });

    // Animation Matrix
    function createMatrixRain() {
        const matrixBg = document.getElementById('matrixBg');
        const chars = '01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
        
        for (let i = 0; i < 50; i++) {
            const column = document.createElement('div');
            column.className = 'matrix-column';
            column.style.left = Math.random() * 100 + '%';
            column.style.animationDuration = (Math.random() * 3 + 2) + 's';
            column.style.animationDelay = Math.random() * 2 + 's';
            
            let text = '';
            for (let j = 0; j < 20; j++) {
                text += chars[Math.floor(Math.random() * chars.length)] + '<br>';
            }
            column.innerHTML = text;
            
            matrixBg.appendChild(column);
        }
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        createMatrixRain();
    });

    // Smooth scrolling pour les liens internes
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
</script>
</body>
</html>