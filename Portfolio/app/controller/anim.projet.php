<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chargement projets</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0a0a0a;
            overflow: hidden;
            position: relative;
            height: 100vh;
        }

        /* =========================== */
        /*    ANIMATION CINÉMATIQUE    */
        /* =========================== */
        
        .cinematic-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #16213e 100%);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* Particules flottantes en arrière-plan */
        .particles-background {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            background: #00d4ff;
            border-radius: 50%;
            animation: float-particle 8s infinite linear;
            opacity: 0.1;
        }

        @keyframes float-particle {
            0% {
                transform: translateY(100vh) translateX(0) scale(0);
                opacity: 0;
            }
            10% {
                opacity: 0.3;
            }
            90% {
                opacity: 0.3;
            }
            100% {
                transform: translateY(-100vh) translateX(200px) scale(1);
                opacity: 0;
            }
        }

        /* Grille de code en arrière-plan */
        .code-matrix {
            position: absolute;
            width: 100%;
            height: 100%;
            font-family: 'Courier New', monospace;
            font-size: 16px;
            line-height: 1.2;
            color: #00ff41;
            opacity: 0.1;
            overflow: hidden;
        }

        .code-line {
            position: absolute;
            white-space: nowrap;
            animation: scroll-code 10s infinite linear;
        }

        @keyframes scroll-code {
            0% {
                transform: translateX(100vw);
            }
            100% {
                transform: translateX(-100%);
            }
        }

        /* Contenu principal de l'animation */
        .animation-content {
            text-align: center;
            z-index: 10;
            position: relative;
            max-width: 800px;
            padding: 20px;
        }

        /* Titre principal */
        .main-title {
            font-size: 5rem;
            font-weight: 800;
            background: linear-gradient(45deg, #00d4ff, #0099cc, #00ff88, #ff6b6b);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 2s ease-in-out infinite, title-appear 1.5s ease-out;
            margin-bottom: 20px;
            text-shadow: 0 0 30px rgba(0, 212, 255, 0.3);
        }

        @keyframes gradient-shift {
            0%, 100% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes title-appear {
            0% {
                opacity: 0;
                transform: translateY(-50px) scale(0.8);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Sous-titre */
        .subtitle {
            font-size: 1.8rem;
            color: #ffffff;
            margin-bottom: 40px;
            opacity: 0;
            animation: subtitle-appear 1.5s ease-out 0.5s forwards;
        }

        @keyframes subtitle-appear {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 0.8;
                transform: translateY(0);
            }
        }

        /* Conteneur des logos de langages */
        .languages-orbit {
            position: relative;
            width: 400px;
            height: 400px;
            margin: 0 auto;
            opacity: 0;
            animation: orbit-appear 1.5s ease-out 1s forwards;
        }

        @keyframes orbit-appear {
            0% {
                opacity: 0;
                transform: scale(0.5);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Centre de l'orbite */
        .orbit-center {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 0 30px rgba(102, 126, 234, 0.5);
            animation: pulse-center 1.5s ease-in-out infinite;
        }

        @keyframes pulse-center {
            0%, 100% {
                transform: translate(-50%, -50%) scale(1);
                box-shadow: 0 0 30px rgba(102, 126, 234, 0.5);
            }
            50% {
                transform: translate(-50%, -50%) scale(1.1);
                box-shadow: 0 0 50px rgba(102, 126, 234, 0.8);
            }
        }

        /* Logos des langages en orbite - MODIFIÉ POUR LES IMAGES */
        .language-icon {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            animation: rotate-orbit 8s infinite linear;
            transform-origin: 200px 200px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
        }

        /* Image à l'intérieur des icônes */
        .language-icon img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.3));
            transition: transform 0.3s ease;
        }

        /* Effet hover amélioré pour les images */
        .language-icon:hover {
            animation-play-state: paused;
            transform: scale(1.2);
            z-index: 20;
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .language-icon:hover img {
            transform: scale(1.1);
        }

        @keyframes rotate-orbit {
            0% {
                transform: rotate(0deg) translateX(180px) rotate(0deg);
            }
            100% {
                transform: rotate(360deg) translateX(180px) rotate(-360deg);
            }
        }

        /* Couleurs d'arrière-plan spécifiques pour chaque langage */
        .html { 
            background: linear-gradient(135deg, rgba(227, 76, 38, 0.3), rgba(240, 101, 41, 0.3));
            border-color: rgba(227, 76, 38, 0.5);
        }
        .css { 
            background: linear-gradient(135deg, rgba(21, 114, 182, 0.3), rgba(51, 169, 220, 0.3));
            border-color: rgba(21, 114, 182, 0.5);
        }
        .js { 
            background: linear-gradient(135deg, rgba(247, 223, 30, 0.3), rgba(255, 218, 68, 0.3));
            border-color: rgba(247, 223, 30, 0.5);
        }
        .php { 
            background: linear-gradient(135deg, rgba(119, 123, 180, 0.3), rgba(136, 146, 191, 0.3));
            border-color: rgba(119, 123, 180, 0.5);
        }
        .python { 
            background: linear-gradient(135deg, rgba(55, 118, 171, 0.3), rgba(75, 139, 190, 0.3));
            border-color: rgba(55, 118, 171, 0.5);
        }
        .java { 
            background: linear-gradient(135deg, rgba(237, 139, 0, 0.3), rgba(248, 152, 32, 0.3));
            border-color: rgba(237, 139, 0, 0.5);
        }
        .react { 
            background: linear-gradient(135deg, rgba(97, 218, 251, 0.3), rgba(33, 212, 253, 0.3));
            border-color: rgba(97, 218, 251, 0.5);
        }
        .vue { 
            background: linear-gradient(135deg, rgba(79, 192, 141, 0.3), rgba(66, 184, 131, 0.3));
            border-color: rgba(79, 192, 141, 0.5);
        }
        .angular { 
            background: linear-gradient(135deg, rgba(221, 0, 49, 0.3), rgba(195, 0, 47, 0.3));
            border-color: rgba(221, 0, 49, 0.5);
        }
        .node { 
            background: linear-gradient(135deg, rgba(51, 153, 51, 0.3), rgba(104, 204, 104, 0.3));
            border-color: rgba(51, 153, 51, 0.5);
        }
        .mysql { 
            background: linear-gradient(135deg, rgba(68, 121, 161, 0.3), rgba(0, 117, 143, 0.3));
            border-color: rgba(68, 121, 161, 0.5);
        }
        .mongodb { 
            background: linear-gradient(135deg, rgba(71, 162, 72, 0.3), rgba(77, 179, 61, 0.3));
            border-color: rgba(71, 162, 72, 0.5);
        }

        /* Positions initiales des icônes (réparties sur le cercle) */
        .language-icon:nth-child(2) { animation-delay: -0.7s; }
        .language-icon:nth-child(3) { animation-delay: -1.3s; }
        .language-icon:nth-child(4) { animation-delay: -2s; }
        .language-icon:nth-child(5) { animation-delay: -2.7s; }
        .language-icon:nth-child(6) { animation-delay: -3.3s; }
        .language-icon:nth-child(7) { animation-delay: -4s; }
        .language-icon:nth-child(8) { animation-delay: -4.7s; }
        .language-icon:nth-child(9) { animation-delay: -5.3s; }
        .language-icon:nth-child(10) { animation-delay: -6s; }
        .language-icon:nth-child(11) { animation-delay: -6.7s; }
        .language-icon:nth-child(12) { animation-delay: -7.3s; }
        .language-icon:nth-child(13) { animation-delay: -8s; }

        /* Texte de progression */
        .progress-text {
            position: absolute;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 500;
            opacity: 1;
            animation: progress-appear 1.5s ease-out 1.5s forwards;
        }

        @keyframes progress-appear {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(20px);
            }
            100% {
                opacity: 0.7;
                transform: translateX(-50%) translateY(0);
            }
        }

        /* Barre de progression */
        .progress-bar {
            position: absolute;
            bottom: 60px;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            opacity: 0;
            animation: progress-bar-appear 1.5s ease-out 2s forwards;
        }

        @keyframes progress-bar-appear {
            0% {
                opacity: 0;
                transform: translateX(-50%) scaleX(0);
            }
            100% {
                opacity: 1;
                transform: translateX(-50%) scaleX(1);
            }
        }

        .progress-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #00d4ff, #00ff88);
            border-radius: 2px;
            animation: progress-fill 2.5s ease-out 2s forwards;
            opacity: 1;
        }

        @keyframes progress-fill {
            0% {
                width: 0%;
            }
            100% {
                width: 100%;
            }
        }

        /* Bouton pour continuer */
        .continue-btn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 30px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.3rem;
            font-weight: 600;
            cursor: pointer;
            opacity: 0;
            animation: button-appear 1.5s ease-out 3.5s forwards;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        @keyframes button-appear {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        .continue-btn:hover {
            transform: translateX(-50%) translateY(-5px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            text-decoration: none;
        }

        /* Effet de fermeture */
        .cinematic-container.closing {
            animation: fade-out 0.8s ease-out forwards;
            pointer-events: none;
        }

        @keyframes fade-out {
            0% {
                opacity: 1;
                transform: scale(1);
                visibility: visible;
            }
            100% {
                opacity: 0;
                transform: scale(0.9);
                visibility: hidden;
            }
        }

        .cinematic-container.hidden {
            display: none !important;
            z-index: -1 !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-title {
                font-size: 3.5rem;
            }
            
            .subtitle {
                font-size: 1.5rem;
            }
            
            .languages-orbit {
                width: 300px;
                height: 300px;
            }
            
            .language-icon {
                width: 45px;
                height: 45px;
                transform-origin: 150px 150px;
                animation: rotate-orbit 6s infinite linear;
            }
            
            .language-icon img {
                width: 30px;
                height: 30px;
            }
            
            @keyframes rotate-orbit {
                0% {
                    transform: rotate(0deg) translateX(130px) rotate(0deg);
                }
                100% {
                    transform: rotate(360deg) translateX(130px) rotate(-360deg);
                }
            }
        }

        @media (max-width: 480px) {
            .main-title {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.3rem;
            }
            
            .continue-btn {
                font-size: 1.1rem;
            }
            
            .languages-orbit {
                width: 250px;
                height: 250px;
            }
            
            .language-icon {
                width: 40px;
                height: 40px;
                transform-origin: 125px 125px;
                animation: rotate-orbit 5s infinite linear;
            }
            
            .language-icon img {
                width: 25px;
                height: 25px;
            }
            
            @keyframes rotate-orbit {
                0% {
                    transform: rotate(0deg) translateX(105px) rotate(0deg);
                }
                100% {
                    transform: rotate(360deg) translateX(105px) rotate(-360deg);
                }
            }
        }
    </style>
</head>
<body>
    <div class="cinematic-container" id="cinematicContainer">
        <!-- Particules en arrière-plan -->
        <div class="particles-background" id="particlesBackground"></div>
        
        <!-- Matrice de code en arrière-plan -->
        <div class="code-matrix" id="codeMatrix"></div>
        
        <!-- Contenu principal de l'animation -->
        <div class="animation-content">
            <h1 class="main-title">Bienvenu dans mes projets</h1>
            <p class="subtitle">Exploration des projets effectués</p>
            
            <!-- Orbite des langages de programmation -->
            <div class="languages-orbit">
                <!-- Icônes des langages avec images -->
                <div class="language-icon html" title="HTML5">
                    <img src="/../assets/image/html.png" alt="HTML5" onerror="this.style.display='none'; this.parentNode.innerHTML='HTML';">
                </div>
                <div class="language-icon css" title="CSS3">
                    <img src="/../assets/image/css.png" alt="CSS3" onerror="this.style.display='none'; this.parentNode.innerHTML='CSS';">
                </div>
                <div class="language-icon js" title="JavaScript">
                    <img src="/../assets/image/JS.png" alt="JavaScript" onerror="this.style.display='none'; this.parentNode.innerHTML='JS';">
                </div>
                <div class="language-icon php" title="PHP">
                    <img src="/../assets/image/php.jpeg" alt="PHP" onerror="this.style.display='none'; this.parentNode.innerHTML='PHP';">
                </div>
                <div class="language-icon python" title="Python">
                    <img src="/../assets/image/Python.jpeg" alt="Python" onerror="this.style.display='none'; this.parentNode.innerHTML='PY';">
                </div>
                <div class="language-icon vue" title="Vue.js">
                    <img src="/../assets/image/linux.jpeg" alt="Vue.js" onerror="this.style.display='none'; this.parentNode.innerHTML='VUE';">
                </div>
                <div class="language-icon angular" title="Angular">
                    <img src="/../assets/image/wordpress.avif" alt="Angular" onerror="this.style.display='none'; this.parentNode.innerHTML='NG';">
                </div>
                <div class="language-icon mysql" title="MySQL">
                    <img src="/../assets/image/mysql.png" alt="MySQL" onerror="this.style.display='none'; this.parentNode.innerHTML='SQL';">
                </div>
                <div class="language-icon mongodb" title="MongoDB">
                    <img src="/../assets/image/git.webp" alt="MongoDB" onerror="this.style.display='none'; this.parentNode.innerHTML='🍃';">
                </div>
            </div>
            
            <!-- Texte de progression -->
            <div class="progress-text">Chargement des projets...</div>
            
            <!-- Barre de progression -->
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
            
            <!-- Bouton pour continuer -->
            <a href="/projet" class="continue-btn" id="continueBtn">Continuer vers mes projets</a>
        </div>
    </div>

    <script>
        // Génération des particules
        function createParticles() {
            const particlesContainer = document.getElementById('particlesBackground');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.width = Math.random() * 5 + 2 + 'px';
                particle.style.height = particle.style.width;
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.animationDuration = (Math.random() * 5 + 5) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Génération de la matrice de code
        function createCodeMatrix() {
            const codeContainer = document.getElementById('codeMatrix');
            const codeSnippets = [
                'function() { return true; }',
                'const data = await fetch(url);',
                'if (condition) { execute(); }',
                'class Component extends React {}',
                'SELECT * FROM users WHERE active = 1',
                'npm install package-name',
                'git commit -m "Update"',
                '<?php echo "Hello World"; ?>',
                'import { useState } from "react";',
                'background: linear-gradient();',
                'docker run -d --name myapp',
                'python manage.py migrate',
                'composer install --no-dev'
            ];

            for (let i = 0; i < 25; i++) {
                const codeLine = document.createElement('div');
                codeLine.className = 'code-line';
                codeLine.textContent = codeSnippets[Math.floor(Math.random() * codeSnippets.length)];
                codeLine.style.top = Math.random() * 100 + '%';
                codeLine.style.animationDelay = Math.random() * 10 + 's';
                codeLine.style.animationDuration = (Math.random() * 5 + 8) + 's';
                codeContainer.appendChild(codeLine);
            }
        }

        // Gestion du clic sur le bouton continuer
        document.getElementById('continueBtn').addEventListener('click', function(e) {
    e.preventDefault();
    const container = document.getElementById('cinematicContainer');
    container.classList.add('closing');
    
    setTimeout(() => {
        container.classList.add('hidden');
        container.style.zIndex = '-1';
        container.style.pointerEvents = 'none';
        // Changez cette ligne pour utiliser 'projets' au lieu de 'projet'
        window.location.href = 'projets'; // ← Changé ici pour correspondre à votre .htaccess existant
    }, 800);
});
        // Auto-highlight du bouton après un délai
        setTimeout(() => {
            const continueBtn = document.getElementById('continueBtn');
            if (continueBtn) {
                continueBtn.style.animation = 'button-appear 0.3s ease-out forwards, pulse-glow 1s ease-in-out infinite 0.3s';
            }
        }, 5000);

        // Animation de pulsation pour attirer l'attention
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulse-glow {
                0%, 100% {
                    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
                    transform: translateX(-50%) translateY(0) scale(1);
                }
                50% {
                    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.8);
                    transform: translateX(-50%) translateY(-2px) scale(1.05);
                }
            }
        `;
        document.head.appendChild(style);

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            createCodeMatrix();
        });

        // Nettoyage lors du déchargement de la page
        window.addEventListener('beforeunload', function() {
            const container = document.getElementById('cinematicContainer');
            if (container) {
                container.style.display = 'none';
            }
        });
    </script>
</body>
</html>