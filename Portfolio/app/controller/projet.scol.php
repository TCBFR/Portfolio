<?php
include __DIR__ . '/../view/partials/banner.php';
?>
    <style>
        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .floating-circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-circle:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 20%;
            left: 70%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .header {
            text-align: center;
            margin-bottom: 50px;
            color: white;
        }

        .header h1 {
            font-size: 3em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
            margin-bottom: 100px;
        }

        .project-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            position: relative;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .project-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
        }

        .project-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
        }

        .project-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .ALF-bg {
            background-image: url('/assets/image/ALF.png');
        }

        .TechSolution-bg {
            background-image: url('/assets/image/TechSolution.jpg');
        }

        .Hades-bg {
            background-image: url('/assets/image/Hades.png');
        }

        .Leviator-bg {
            background-image: url('/assets/image/Leviator.png');
        }

        .Bip-Bip-bg {
            background-image: url('/assets/image/Bip-Bip.png');
        }

        .project-card:hover .project-image::before {
            opacity: 1;
        }

        .project-content {
            padding: 30px;
        }

        .project-title {
            font-size: 1.8em;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .project-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 1em;
        }

        .tech-tags {
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tech-tag {
            background: lightgray;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 500;
            box-shadow: 0 4px 8px rgba(102,126,234,0.3);
        }

        .project-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            cursor: pointer;
            font-size: 0.95em;
        }

        .btn-primary {
            background: lightgray;
            color: white;
            box-shadow: 0 8px 16px rgba(102,126,234,0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(102,126,234,0.6);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .back-to-projects-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: lightgray;
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(102,126,234,0.4);
            transition: all 0.3s ease;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-to-projects-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(102,126,234,0.6);
        }

        /* Modal pour l'affichage détaillé */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.8);
            backdrop-filter: blur(5px);
            margin-top: 75px;
        }

        .modal-content {
            background: white;
            margin: 5% auto;
            padding: 0;
            border-radius: 20px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            animation: modalSlideIn 0.4s ease;
        }

        @keyframes modalSlideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            height: 250px;
            background-size: cover;
            background-position: center;
            position: relative;
            border-radius: 20px 20px 0 0;
        }

        .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 20px 20px 0 0;
        }

        .close {
            position: absolute;
            right: 20px;
            top: 20px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .close:hover {
            background: rgba(255,255,255,0.3);
            transform: rotate(90deg);
        }

        .modal-body {
            padding: 30px;
        }

        .modal-title {
            font-size: 2.2em;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .modal-description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 25px;
            font-size: 1.1em;
        }

        .modal-tech-tags {
            margin-bottom: 30px;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .projects-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .header h1 {
                font-size: 2.2em;
            }
            
            .back-to-projects-btn {
                bottom: 20px;
                right: 20px;
                padding: 12px 20px;
                font-size: 0.9em;
            }
            
            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }
    </style>
</head>
<body>
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>

    <div class="container">
        <div class="header">
            <h1>Mes Projets Scolaires</h1>
            <p>Découvrez tous mes projets réalisés pendant mon cursus scolaire</p>
        </div>

        <div class="projects-grid">
            <!-- ALF -->
            <div class="project-card" onclick="openModal('alf')">
                <div class="project-image ALF-bg"></div>
                <div class="project-content">
                    <h3 class="project-title">ALF</h3>
                    <p class="project-description">Site web d'une association d'adoption pour les félins.</p>
                    <div class="tech-tags">
                        <span class="tech-tag">HTML/CSS</span>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">PHP</span>
                    </div>
                    <div class="project-actions">
                        <a href="/storage/Projets/Projet2" class="btn btn-primary" onclick="event.stopPropagation()">Voir le projet</a>
                    </div>
                </div>
            </div>

            <!-- TechSolution -->
            <div class="project-card" onclick="openModal('techsolution')">
                <div class="project-image TechSolution-bg"></div>
                <div class="project-content">
                    <h3 class="project-title">TechSolution</h3>
                    <p class="project-description">Création d'un site d'une entreprise informatique.</p>
                    <div class="tech-tags">
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">CSS</span>
                    </div>
                    <div class="project-actions">
                        <a href="/projet/techsolution" class="btn btn-primary" onclick="event.stopPropagation()">Voir le projet</a>
                    </div>
                </div>
            </div>

            <!-- Hades -->
            <div class="project-card" onclick="openModal('hades')">
                <div class="project-image Hades-bg"></div>
                <div class="project-content">
                    <h3 class="project-title">Hades</h3>
                    <p class="project-description">Création d'une vitrine d'un jeu vidéo.</p>
                    <div class="tech-tags">
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">CSS</span>
                    </div>
                    <div class="project-actions">
                        <a href="/storage/Projets/hades" class="btn btn-primary" onclick="event.stopPropagation()">Voir le projet</a>
                    </div>
                </div>
            </div>

            <!-- Léviator -->
            <div class="project-card" onclick="openModal('leviator')">
                <div class="project-image Leviator-bg"></div>
                <div class="project-content">
                    <h3 class="project-title">Léviator</h3>
                    <p class="project-description">Création d'une image sur l'évolution de magicarpe dans Pokémon.</p>
                    <div class="tech-tags">
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">CSS</span>
                    </div>
                    <div class="project-actions">
                        <a href="/projet/leviator" class="btn btn-primary" onclick="event.stopPropagation()">Voir le projet</a>
                    </div>
                </div>
            </div>

            <!-- Bip-Bip -->
            <div class="project-card" onclick="openModal('bipbip')">
                <div class="project-image Bip-Bip-bg"></div>
                <div class="project-content">
                    <h3 class="project-title">Bip-Bip</h3>
                    <p class="project-description">Création d'une image animée, sur le thème Disney.</p>
                    <div class="tech-tags">
                        <span class="tech-tag">HTML</span>
                        <span class="tech-tag">CSS</span>
                    </div>
                    <div class="project-actions">
                        <a href="/projet/disney" class="btn btn-primary" onclick="event.stopPropagation()">Voir le projet</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="/projets" class="back-to-projects-btn">
        ← Retour aux projets
    </a>

    <!-- Modal pour affichage détaillé -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="modalHeader">
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <h2 class="modal-title" id="modalTitle"></h2>
                <p class="modal-description" id="modalDescription"></p>
                <div class="modal-tech-tags" id="modalTechTags"></div>
                <div class="modal-actions" id="modalActions"></div>
            </div>
        </div>
    </div>

    <script>
        // Données des projets avec les nouvelles routes propres
        const projectsData = {
            'alf': {
                title: 'ALF - Association des Félins',
                description: 'Développement complet du site web d\'une association dédiée à la protection des félins. Le projet comprend un système de gestion des membres, une base de données des animaux, un système de donations et un espace d\'adoption en ligne avec toutes les fonctionnalités administratives nécessaires.',
                techTags: ['HTML', 'CSS', 'PHP', 'MySQL'],
                backgroundClass: 'ALF-bg',
                link: '/projet/alf'
            },
            'techsolution': {
                title: 'TechSolution',
                description: 'Site web corporatif moderne pour une entreprise informatique spécialisée dans les solutions technologiques. Le projet inclut une présentation détaillée des services, un portfolio interactif, un système de contact avancé et une interface d\'administration complète.',
                techTags: ['PHP', 'HTML', 'MySQL', 'CSS'],
                backgroundClass: 'TechSolution-bg',
                link: '/projet/techsolution'
            },
            'hades': {
                title: 'Hades - Présentation de jeu',
                description: 'Site de présentation immersif du jeu vidéo Hades avec un design inspiré de l\'univers du jeu. Le projet comprend des animations interactives, des effets visuels avancés, une galerie de screenshots et une présentation détaillée des personnages et de l\'histoire.',
                techTags: ['HTML', 'CSS'],
                backgroundClass: 'Hades-bg',
                link: '/projet/hades'
            },
            'leviator': {
                title: 'Léviator - Évolution Pokémon',
                description: 'Création d\'une page interactive présentant l\'évolution de Magicarpe en Léviator dans l\'univers Pokémon. Le projet met en avant les transformations visuelles avec des animations CSS et une présentation détaillée des caractéristiques de chaque forme.',
                techTags: ['HTML', 'CSS'],
                backgroundClass: 'Leviator-bg',
                href: '/storage/Projets/Hades'
            },
            'bipbip': {
                title: 'Bip-Bip - Animation Disney',
                description: 'Création d\'une page animée sur le thème Disney mettant en scène le personnage Bip-Bip. Le projet inclut des animations CSS fluides, des effets visuels colorés et une interface ludique dans l\'esprit des productions Disney.',
                techTags: ['HTML', 'CSS'],
                backgroundClass: 'Bip-Bip-bg',
                link: '/projet/disney'
            }
        };

        function openModal(projectId) {
            const project = projectsData[projectId];
            const modal = document.getElementById('projectModal');
            
            // Mise à jour du contenu
            document.getElementById('modalTitle').textContent = project.title;
            document.getElementById('modalDescription').textContent = project.description;
            document.getElementById('modalHeader').className = `modal-header ${project.backgroundClass}`;
            
            // Tags techniques
            const techTagsContainer = document.getElementById('modalTechTags');
            techTagsContainer.innerHTML = '<div class="tech-tags">' + 
                project.techTags.map(tag => `<span class="tech-tag">${tag}</span>`).join('') + 
                '</div>';
            
            // Actions avec le bon lien
            document.getElementById('modalActions').innerHTML = `
                <a href="${project.link}" class="btn btn-primary">Voir le projet</a>
            `;
            
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('projectModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Fermer le modal en cliquant à l'extérieur
        window.onclick = function(event) {
            const modal = document.getElementById('projectModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Fermer le modal avec la touche Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>
