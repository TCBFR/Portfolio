<?php

include __DIR__ . '/security.php';

// Configuration sécurisée
define('RECIPIENT_EMAIL', 'theo.cv03@gmail.com');
define('SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI'); // Clé publique reCAPTCHA test
define('SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'); // Clé secrète reCAPTCHA test

// Variables de feedback
$feedback = [
    'status' => '',
    'message' => ''
];

/**
 * Classe pour gérer les fonctionnalités de la page d'accueil
 */
class HomeController {
    
    /**
     * Validation du reCAPTCHA
     */
    public function validateRecaptcha($recaptcha_response) {
        if (empty($recaptcha_response)) {
            return false;
        }
        
        $data = [
            'secret' => SECRET_KEY,
            'response' => $recaptcha_response,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? ''
        ];
        
        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data),
                'timeout' => 10
            ]
        ];
        
        $context = stream_context_create($options);
        $result = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
        
        if ($result === false) {
            error_log("Erreur lors de la validation reCAPTCHA");
            return false;
        }
        
        $resultJson = json_decode($result, true);
        return isset($resultJson['success']) && $resultJson['success'] === true;
    }
    
    /**
     * Nettoyage et validation des données du formulaire
     */
    public function processFormData($post_data) {
        $data = [];
        $errors = [];
        
        // Nettoyage des données
        $data['nom'] = $this->sanitizeInput($post_data['nom'] ?? '', 'string', 2, 50);
        $data['entreprise'] = $this->sanitizeInput($post_data['entreprise'] ?? '', 'string', 0, 100);
        $data['email'] = $this->sanitizeInput($post_data['email'] ?? '', 'email');
        $data['telephone'] = $this->sanitizeInput($post_data['telephone'] ?? '', 'phone', 0, 20);
        $data['objet'] = $this->sanitizeInput($post_data['objet'] ?? '', 'string', 3, 100);
        $data['message'] = $this->sanitizeInput($post_data['message'] ?? '', 'text', 10, 1000);
        
        // Validation
        if (empty($data['nom']) || strlen($data['nom']) < 2) {
            $errors[] = "Le nom doit contenir au moins 2 caractères";
        }
        
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Une adresse e-mail valide est requise";
        }
        
        if (empty($data['objet']) || strlen($data['objet']) < 3) {
            $errors[] = "L'objet doit contenir au moins 3 caractères";
        }
        
        if (empty($data['message']) || strlen($data['message']) < 10) {
            $errors[] = "Le message doit contenir au moins 10 caractères";
        }
        
        // Protection anti-spam basique
        if ($this->isSpam($data)) {
            $errors[] = "Votre message ressemble à du spam";
        }
        
        return ['data' => $data, 'errors' => $errors];
    }
    
    /**
     * Nettoie les données d'entrée selon le type
     */
    private function sanitizeInput($input, $type, $minLength = 0, $maxLength = null) {
        $input = trim($input);
        
        switch ($type) {
            case 'email':
                return filter_var($input, FILTER_SANITIZE_EMAIL);
                
            case 'phone':
                return preg_replace('/[^0-9+\-\s\.]/', '', $input);
                
            case 'string':
                $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
                break;
                
            case 'text':
                $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
                $input = preg_replace('/\n{3,}/', "\n\n", $input);
                break;
        }
        
        // Appliquer les limites de longueur
        if ($maxLength && strlen($input) > $maxLength) {
            $input = substr($input, 0, $maxLength);
        }
        
        return strlen($input) >= $minLength ? $input : '';
    }
    
    /**
     * Détection basique de spam
     */
    private function isSpam($data) {
        $spamWords = ['viagra', 'casino', 'loan', 'money', 'free', 'win', 'lottery'];
        $text = strtolower($data['nom'] . ' ' . $data['message'] . ' ' . $data['objet']);
        
        foreach ($spamWords as $word) {
            if (strpos($text, $word) !== false) {
                return true;
            }
        }
        
        // Vérifier les liens suspects
        if (preg_match_all('/(https?:\/\/[^\s]+)/', $data['message'], $matches) > 2) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Envoi de l'email sécurisé
     */
    public function sendContactEmail($data) {
        $subject = "Nouveau message Portfolio: " . $data['objet'];
        
        $emailBody = "Nouveau message de contact\n\n";
        $emailBody .= "Nom: " . $data['nom'] . "\n";
        if (!empty($data['entreprise'])) $emailBody .= "Entreprise: " . $data['entreprise'] . "\n";
        $emailBody .= "Email: " . $data['email'] . "\n";
        if (!empty($data['telephone'])) $emailBody .= "Téléphone: " . $data['telephone'] . "\n";
        $emailBody .= "Objet: " . $data['objet'] . "\n\n";
        $emailBody .= "Message:\n" . $data['message'] . "\n\n";
        $emailBody .= "---\nMessage envoyé le " . date('d/m/Y à H:i:s');
        $emailBody .= "\nIP: " . ($_SERVER['REMOTE_ADDR'] ?? 'Non disponible');
        $emailBody .= "\nUser Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'Non disponible');
        
        $headers = [
            'From' => 'noreply@portfolio-theo.fr',
            'Reply-To' => $data['email'],
            'X-Mailer' => 'PHP/' . phpversion(),
            'Content-Type' => 'text/plain; charset=UTF-8',
            'MIME-Version' => '1.0',
            'X-Priority' => '3'
        ];
        
        return mail(RECIPIENT_EMAIL, $subject, $emailBody, implode("\r\n", array_map(
            function($k, $v) { return "$k: $v"; },
            array_keys($headers),
            $headers
        )));
    }
    
    /**
     * Obtient les données des compétences
     */
    public function getSkillsData() {
        return [
            ['name' => 'PHP', 'image' => '/assets/image/php.jpeg', 'tooltip' => 'Langage de scripts généraliste et Open Sources, <br> spécialement conçu pour le développement des <br>applications web.'],
            ['name' => 'HTML', 'image' => '/assets/image/html.png', 'tooltip' => '"HyperText Markup Language", <br>forment un langage informatique utilisé<br> pour structurer une page web et son contenu.'],
            ['name' => 'Linux', 'image' => '/assets/image/linux.jpeg', 'tooltip' => 'Linux est le nom du noyau de système <br>d exploitation libre, multitâche, multiplate-forme <br>et multi-utilisateur de type UNIX'],
            ['name' => 'CSS', 'image' => '/assets/image/css.png', 'tooltip' => '"Cascading Style Sheets",<br> forment un langage informatique qui décrit<br> la présentation des documents HTML et XML.'],
            ['name' => 'Git', 'image' => '/assets/image/git.webp', 'tooltip' => 'Un système de contrôle de version distribué,<br> signifiant un clone local du projet est un dépôt <br>de contrôle de version complet.'],
            ['name' => 'WordPress', 'image' => '/assets/image/wordpress.avif', 'tooltip' => 'Un système de gestion de contenu gratuit<br> et open-source qui permet à toute personne de créer et<br> de gérer facilement des sites internet.'],
            ['name' => 'Python', 'image' => '/assets/image/Python.jpeg', 'tooltip' => 'Langage de programmation informatique généraliste. <br>Aucune limite de fonctionnement pour le développement web<br> contrairement à plusieurs langages de programmation.'],
            ['name' => 'MySQL', 'image' => '/assets/image/mysql.png', 'tooltip' => 'Langage de programmation permettant de <br>manipuler les données et les systèmes de <br>bases de données relationnelles.'],
            ['name' => 'JavaScript', 'image' => '/assets/image/JS.png', 'tooltip' => 'Langage de programmation utilisé par <br>les développeurs pour concevoir <br>des sites web interactifs.']
        ];
    }
    
    /**
     * Obtient les données des projets
     */
    public function getProjectsData() {
        return [
            [
                'id' => 'velib',
                'title' => 'Landing Page',
                'description' => 'Page de publicité',
                'image' => '/assets/image/Landing.png',
                'tech' => ['HTML/CSS', 'JavaScript', 'PHP'],
                'link' => '/Projets/Landing/view/public/index.php',
                'presentation' => 'Un portfolio est un site web personnalisé pour le recrutement.',
                'features' => [
                    'Modification des informations quotidiennes',
                    'Avoir un max d\'infos sur mon sujet',
                    'Présentation optimale',
                    'Suivi sur mon parcours',
                    'Interface responsive et intuitive'
                ]
            ],
            [
                'id' => 'crygen',
                'title' => 'Thème enfant',
                'description' => 'Création d\'un thème enfant sur WP pour mon maître de stage',
                'image' => '/assets/image/wordpress.avif',
                'tech' => ['PHP', 'WordPress'],
                'link' => '#',
                'presentation' => 'Thème enfant WordPress développé pour personnaliser un site existant.',
                'features' => [
                    'Customisation avancée',
                    'Compatibilité WordPress',
                    'Code propre et documenté'
                ]
            ],
            [
                'id' => 'cruml',
                'title' => 'ALF',
                'description' => 'Création de site web d\'une association contre la protection des félins',
                'image' => '/assets/image/ALF.png',
                'tech' => ['HTML', 'PHP', 'CSS', 'MySQL'],
                'link' => '/projet/alf',
                'presentation' => 'ALF est un site web local que j\'ai réalisé en cours de ma 1ère année de BTS SIO.',
                'features' => [
                    'Maîtrise des différents langages de programmation',
                    'Visualisations interactives des données',
                    'Interface graphique moderne'
                ]
            ],
            [
                'id' => 'gsb',
                'title' => 'TechSolution',
                'description' => 'Site web d\'une entreprise informatique',
                'image' => '/assets/image/TechSolution.jpg',
                'tech' => ['PHP', 'MySQL', 'CSS'],
                'link' => '/projet/techsolution',
                'presentation' => 'Site web complet pour une entreprise de solutions technologiques.',
                'features' => [
                    'Gestion complète des services',
                    'Système d\'authentification sécurisé',
                    'Interface web responsive',
                    'Base de données optimisée'
                ]
            ],
            [
                'id' => 'doc2html',
                'title' => 'Hades',
                'description' => 'Présentation du jeu vidéo',
                'image' => '/assets/image/Hades.png',
                'tech' => ['HTML', 'CSS'],
                'link' => '/projet/hades',
                'presentation' => 'Hades est un jeu vidéo, et mon projet consistait à faire une présentation des personnages.',
                'features' => [
                    'Maîtrise HTML et CSS',
                    'Présentation des personnages',
                    'Interface responsive et intuitive'
                ]
            ]
        ];
    }
}

// Système de routage pour les projets
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

// Routes pour les projets
$projectRoutes = [
    '/projet/alf' => 'storage/Projets/Projet2',
    '/projet/techsolution' => 'storage/Projets/Projet_Tech', 
    '/projet/hades' => 'storage/Projets/Hades',
    '/projet/leviator' => 'storage/Projets/08-Leviator',
    '/projet/disney' => 'storage/Projets/14-Disney',
];

// Vérifier si c'est une route de projet
if (array_key_exists($uri, $projectRoutes)) {
    $projectPath = __DIR__ . '/' . $projectRoutes[$uri];
    
    // Chercher le fichier d'entrée
    $possibleFiles = ['index.html', 'index.php', 'main.html', 'home.html'];
    
    foreach ($possibleFiles as $filename) {
        $fullPath = $projectPath . '/' . $filename;
        if (file_exists($fullPath)) {
            if (pathinfo($fullPath, PATHINFO_EXTENSION) === 'html') {
                // Afficher le fichier HTML
                readfile($fullPath);
            } else {
                // Inclure le fichier PHP
                require_once $fullPath;
            }
            exit;
        }
    }
    
    // Si aucun fichier d'entrée trouvé, lister le contenu
    if (is_dir($projectPath)) {
        echo "<h1>Projet trouvé - Contenu du dossier :</h1>";
        echo "<p>Chemin: $projectPath</p><ul>";
        foreach (scandir($projectPath) as $file) {
            if ($file != '.' && $file != '..') {
                $fileLink = str_replace(__DIR__, '', $projectPath) . '/' . $file;
                echo "<li><a href='$fileLink' target='_blank'>$file</a></li>";
            }
        }
        echo "</ul>";
        exit;
    } else {
        echo "<h1>Erreur : Dossier introuvable</h1>";
        echo "<p>Chemin cherché : $projectPath</p>";
        exit;
    }
}

// Initialisation du contrôleur
$controller = new HomeController();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form_result = $controller->processFormData($_POST);
    $form_data = $form_result['data'];
    $form_errors = $form_result['errors'];
    
    if (empty($form_errors)) {
        // Vérification du reCAPTCHA
        if (!$controller->validateRecaptcha($_POST['g-recaptcha-response'] ?? '')) {
            $feedback = [
                'status' => 'error',
                'message' => 'Veuillez confirmer que vous n\'êtes pas un robot.'
            ];
        } else {
            // Tentative d'envoi de l'email
            if ($controller->sendContactEmail($form_data)) {
                $feedback = [
                    'status' => 'success',
                    'message' => 'Message envoyé avec succès ! Je vous répondrai dans les plus brefs délais.'
                ];
                // Nettoyer les données du formulaire après envoi réussi
                $form_data = [];
            } else {
                $feedback = [
                    'status' => 'error',
                    'message' => 'Erreur lors de l\'envoi. Veuillez réessayer plus tard.'
                ];
            }
        }
    } else {
        $feedback = [
            'status' => 'error',
            'message' => implode('<br>', $form_errors)
        ];
    }
}

// Données pour la vue
$skills_data = $controller->getSkillsData();
$projects_data = $controller->getProjectsData();
?>
<?php

include __DIR__ . '/../view/partials/banner.php';
?>

<body>
    <div id="container">
        <div class="holographic-grid"></div>
        
        <div class="code-matrix" id="codeMatrix"></div>
        
        <div class="floating-elements" id="floatingElements"></div>
        
        <div class="particle-system" id="particleSystem"></div>
        
        <div class="light-beams" id="lightBeams"></div>
        
        <div class="central-logo">
            <div class="logo-text">Theo CAVICCHINI</div>
        </div>
        <div class="subtitle">
            Développeur Web Full-Stack
        </div>
        <a href="#projets" class="cta-button">
            <i class="fas fa-rocket"></i> Découvrir mes projets
        </a>
    </div>

    <style>
        .cta-button{
            margin-top: 300px;
        }
    </style>

    <script>
        // Génération dynamique du code matrix
        function createCodeMatrix() {
            const matrix = document.getElementById('codeMatrix');
            const codeSnippets = [
                'const scene = new THREE.Scene();',
                'function animate() { requestAnimationFrame(animate); }',
                'import { WebGLRenderer } from "three";',
                'const camera = new PerspectiveCamera();',
                'mesh.rotation.x += 0.01;',
                'document.querySelector(".container")',
                'background: linear-gradient(45deg, #ff6b6b, #4a90e2);',
                'transform: rotateY(360deg);',
                'animation: fadeIn 2s ease-in-out;',
                'position: absolute; z-index: 100;',
                '{ display: flex; justify-content: center; }',
                'async function fetchData() { return await response.json(); }',
                'export default function Component() {',
                'useState(0); useEffect(() => {});',
                'npm install three.js react typescript',
                '<?php echo "Hello World"; ?>',
                '$controller = new HomeController();',
                'MySQL SELECT * FROM projects;',
                'git commit -m "Initial commit"',
                'class ProjectCard extends React.Component'
            ];

            for (let i = 0; i < 25; i++) {
                const codeLine = document.createElement('div');
                codeLine.className = 'code-line';
                codeLine.textContent = codeSnippets[Math.floor(Math.random() * codeSnippets.length)];
                codeLine.style.left = Math.random() * 100 + '%';
                codeLine.style.top = Math.random() * 100 + '%';
                codeLine.style.animationDelay = Math.random() * 15 + 's';
                codeLine.style.fontSize = (8 + Math.random() * 8) + 'px';
                codeLine.style.color = `hsl(${180 + Math.random() * 60}, 70%, 60%)`;
                matrix.appendChild(codeLine);
            }
        }

        // Création des cubes technologiques
        function createTechCubes() {
            const container = document.getElementById('floatingElements');
            const technologies = ['HTML', 'CSS', 'JS', 'PHP', 'WP', 'MySQL', 'Git', 'Linux'];
            
            technologies.forEach((tech, index) => {
                const cube = document.createElement('div');
                cube.className = 'tech-cube';
                cube.style.left = (5 + index * 11) + '%';
                cube.style.top = (15 + Math.random() * 70) + '%';
                cube.style.animationDelay = (index * 1.5) + 's';
                
                const faces = ['front', 'back', 'right', 'left', 'top', 'bottom'];
                faces.forEach(face => {
                    const faceDiv = document.createElement('div');
                    faceDiv.className = `cube-face ${face}`;
                    faceDiv.textContent = tech;
                    cube.appendChild(faceDiv);
                });
                
                container.appendChild(cube);
            });
        }

        // Système de particules
        function createParticles() {
            const particleSystem = document.getElementById('particleSystem');
            
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 8 + 's';
                particle.style.backgroundColor = `hsl(${180 + Math.random() * 60}, 70%, 60%)`;
                particleSystem.appendChild(particle);
            }
        }

        // Faisceaux lumineux
        function createLightBeams() {
            const beamsContainer = document.getElementById('lightBeams');
            
            for (let i = 0; i < 8; i++) {
                const beam = document.createElement('div');
                beam.className = 'beam';
                beam.style.left = (i * 12) + '%';
                beam.style.animationDelay = (i * 0.7) + 's';
                beam.style.background = `linear-gradient(to bottom, 
                    rgba(${100 + i * 20}, 255, 255, 0), 
                    rgba(${100 + i * 20}, 255, 255, 0.8), 
                    rgba(${100 + i * 20}, 255, 255, 0))`;
                beamsContainer.appendChild(beam);
            }
        }

        // Initialisation
        function init() {
            createCodeMatrix();
            createTechCubes();
            createParticles();
            createLightBeams();
            
            // Renouveler les particules périodiquement
            setInterval(() => {
                const particles = document.querySelectorAll('.particle');
                particles.forEach(particle => {
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                });
            }, 10000);
        }

        // Démarrer l'animation
        init();

        // Interaction au clic
        document.addEventListener('click', (e) => {
            // Créer une onde de choc au clic
            const ripple = document.createElement('div');
            ripple.style.position = 'absolute';
            ripple.style.width = '20px';
            ripple.style.height = '20px';
            ripple.style.borderRadius = '50%';
            ripple.style.border = '2px solid #0ff';
            ripple.style.left = e.clientX + 'px';
            ripple.style.top = e.clientY + 'px';
            ripple.style.transform = 'translate(-50%, -50%)';
            ripple.style.animation = 'rippleEffect 1s ease-out forwards';
            ripple.style.pointerEvents = 'none';
            
            document.body.appendChild(ripple);
            
            setTimeout(() => ripple.remove(), 1000);
        });

        // Animation de l'onde de choc
        const rippleStyle = document.createElement('style');
        rippleStyle.textContent = `
            @keyframes rippleEffect {
                0% {
                    transform: translate(-50%, -50%) scale(1);
                    opacity: 1;
                }
                100% {
                    transform: translate(-50%, -50%) scale(20);
                    opacity: 0;
                }
            }

            /* Responsive pour mobile */
            @media (max-width: 768px) {
                .logo-text {
                    font-size: 2.5rem;
                }
                
                .cta-button {
                    padding: 0.8rem 1.5rem;
                    font-size: 0.9rem;
                }
                
                .subtitle {
                    font-size: 1rem;
                }
                
                .tech-cube {
                    width: 60px;
                    height: 60px;
                }
                
                .cube-face {
                    width: 60px;
                    height: 60px;
                    font-size: 12px;
                }
            }
        `;
        document.head.appendChild(rippleStyle);
    </script>

    <!-- À propos -->
    <section class="section fade-in">
        <h2>A propos de moi</h2>
        <div class="cards-grid">
            <div class="card">
                <h3><i class="fas fa-user-graduate"></i> Présentation</h3>
                <p>J'ai débuté l'informatique dans une école privée basé sur le gaming en 2023, cela m'avait bien interessé suite a cela 
                    j'ai commencé a programmer quelques projets puis j'ai commencé a faire un BTS SIO sur Brive la Gaillarde en 2024.
                </p>
                <a href="/cv" class="cv-btn">
                    <i class="fas fa-file-download"></i> Consultez mon CV
                </a>
            </div>
        </div>
    </section>

    <!-- Parcours professionnel -->
    <section class="section fade-in">
        <h2 id="competence">Mes parcours professionnels</h2>
        <div class="cards-grid">
            <section class="timeline fade-in delay-3">
                <div class="header-row">
                    <span class="header-left">Parcours professionnel</span>
                    <span class="header-right">Expériences professionnelles</span>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">Stage de fin d'année BTS SIO</div>
                        <div class="timeline-title">Stage en télétravail avec l'entreprise 1ère Pages 2025</div>
                        <div class="timeline-desc">Installation de Linux, Apprentissage sur WP et installation d'un honeypot</div>
                    </div>
                    <div class="timeline-marker"></div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">1ère année de BTS SIO</div>
                        <div class="timeline-title">Lycée BAHUET 2024 - 2025</div>
                        <div class="timeline-desc">Apprentissage Back-end, PHP, Python et MySQL</div>
                    </div>
                    <div class="timeline-marker"></div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">Apprentissage Front-end</div>
                        <div class="timeline-title">École privée EGS 2023 - 2024</div>
                        <div class="timeline-desc">Apprentissage du HTML CSS</div>
                    </div>
                    <div class="timeline-marker"></div>
                </div>
            </section>
        </div>
    </section>

    <!-- Compétences -->
    <section class="section fade-in">
        <h2>Mes Compétences</h2>
        <div class="skills-container">
            <div class="skills-slider" id="skillsSlider">
                <!-- Les compétences seront générées par JavaScript -->
            </div>
        </div>
    </section>

    <style>
        .skills-slider {
            display: flex;
            animation: infiniteScroll 30s linear infinite;
            width: fit-content;
        }
        .skill-logo {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .skill-name {
            color: black;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* Animation de défilement infini */
        @keyframes infiniteScroll {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Effet de pause au survol de la section */
        .skills-container:hover .skills-slider {
            animation-play-state: paused;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .skills-section h2 {
                font-size: 2rem;
            }

            .skill-item {
                width: 150px;
                height: 150px;
            }

            .skill-logo {
                width: 60px;
                height: 60px;
            }

            .skill-name {
                font-size: 1rem;
            }

            .skill-tooltip {
                width: 200px;
                font-size: 0.8rem;
            }

            .skills-slider {
                animation-duration: 40s;
            }
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(100px);
                opacity: 0;
            }
        }
    </style>

    <script>
        const skillsData = [
            {
                name: 'PHP',
                image: '/assets/image/php.jpeg',
                tooltip: 'Langage de scripts généraliste et Open Source, <br> spécialement conçu pour le développement des <br>applications web.'
            },
            {
                name: 'HTML',
                image: '/assets/image/html.png',
                tooltip: '"HyperText Markup Language", <br>forment un langage informatique utilisé<br> pour structurer une page web et son contenu.'
            },
            {
                name: 'CSS',
                image: '/assets/image/css.png',
                tooltip: '"Cascading Style Sheets",<br> forment un langage informatique qui décrit<br> la présentation des documents HTML et XML.'
            },
            {
                name: 'JavaScript',
                image: '/assets/image/JS.png',
                tooltip: 'Langage de programmation utilisé par <br>les développeurs pour concevoir <br>des sites web interactifs.'
            },
            {
                name: 'Python',
                image: '/assets/image/Python.jpeg',
                tooltip: 'Langage de programmation informatique généraliste. <br>Aucune limite de fonctionnement pour le développement web<br> contrairement à plusieurs langages de programmation.'
            },
            {
                name: 'MySQL',
                image: '/assets/image/mysql.png',
                tooltip: 'Langage de programmation permettant de <br>manipuler les données et les systèmes de <br>bases de données relationnelles.'
            },
            {
                name: 'Git',
                image: '/assets/image/git.webp',
                tooltip: 'Un système de contrôle de version distribué,<br> signifiant un clone local du projet est un dépôt <br>de contrôle de version complet.'
            },
            {
                name: 'Linux',
                image: '/assets/image/linux.jpeg',
                tooltip: 'Linux est le nom du noyau de système <br>d\'exploitation libre, multitâche, multiplate-forme <br>et multi-utilisateur de type UNIX'
            },
            {
                name: 'WordPress',
                image: '/assets/image/wordpress.avif',
                tooltip: 'Un système de gestion de contenu gratuit<br> et open-source qui permet à toute personne de créer et<br> de gérer facilement des sites internet.'
            }
        ];

        // Générer les compétences
        function generateSkills() {
            const slider = document.getElementById('skillsSlider');
            
            // Créer plusieurs copies pour un défilement fluide
            for (let copy = 0; copy < 3; copy++) {
                skillsData.forEach((skill, index) => {
                    const skillItem = document.createElement('div');
                    skillItem.className = 'skill-item';
                    skillItem.innerHTML = `
                        <img src="${skill.image}" alt="${skill.name}" class="skill-logo">
                        <div class="skill-name">${skill.name}</div>
                        <div class="skill-tooltip">${skill.tooltip}</div>
                    `;
                    slider.appendChild(skillItem);
                });
            }
        } 

        // Initialisation
        document.addEventListener('DOMContentLoaded', () => {
            generateSkills();
        });
    </script>

    <!-- Projets -->
    <section class="section fade-in">
        <h2 id="projets">Mes derniers projets</h2>
        <div class="projects-grid-container">
            <div class="projects-grid">
                <?php foreach (array_slice($projects_data, 0, 5) as $project) : ?>
                    <div class="project-card" onclick="openModal('<?= htmlspecialchars($project['id']) ?>')">
                        <div class="project-image" style="background-image: url('<?= htmlspecialchars($project['image']) ?>');">
                            <div class="project-overlay">
                                <div class="play-icon">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>
                        <div class="project-info">
                            <div class="project-title"><?= htmlspecialchars($project['title']) ?></div>
                            <div class="project-description"><?= htmlspecialchars($project['description']) ?></div>
                            <div class="project-tech">
                                <?php foreach ($project['tech'] as $tech) : ?>
                                    <span class="tech-tag"><?= htmlspecialchars($tech) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <a href="/anim-projet" class="project-frame" onclick="redirectToProjects(event)">
                    <div class="arrow-container">
                        <div class="arrow">➵</div>
                        <div class="arrow-text">Voir tous les<br>autres projets</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Modals pour chaque projet -->
        <?php foreach ($projects_data as $project) : ?>
            <div id="<?= htmlspecialchars($project['id']) ?>Modal" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2><?= htmlspecialchars($project['title']) ?></h2>
                        <span class="close" onclick="closeModal('<?= htmlspecialchars($project['id']) ?>Modal')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <a href="<?= htmlspecialchars($project['link']) ?>" class="project-link" target="_blank">
                            <i class="fas fa-external-link-alt"></i> Accéder au projet
                        </a>
                        
                        <div class="project-presentation">
                            <h3><i class="fas fa-clipboard-list"></i> Présentation du projet</h3>
                            <p><?= htmlspecialchars($project['presentation']) ?></p>
                            
                            <h4><i class="fas fa-star"></i> Fonctionnalités principales :</h4>
                            <ul class="features-list">
                                <?php foreach ($project['features'] as $feature) : ?>
                                    <li><?= htmlspecialchars($feature) ?></li>
                                <?php endforeach; ?>
                            </ul>

                            <p><strong>Technologies utilisées :</strong> <?= implode(', ', array_map('htmlspecialchars', $project['tech'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <!-- Contact -->
    <section class="section fade-in">
        <h2 id="contact">Contact</h2>
        <div class="contact-wrapper">
            <!-- Section Formulaire -->
            <div class="form-section">
                <?php if ($feedback['status']) : ?>
                    <div id="<?= htmlspecialchars($feedback['status']) ?>Message" class="<?= htmlspecialchars($feedback['status']) ?>-message" style="display: block;">
                        <?= $feedback['message'] ?>
                    </div>
                    <script>
                        setTimeout(() => {
                            const messageEl = document.getElementById('<?= htmlspecialchars($feedback['status']) ?>Message');
                            if (messageEl) messageEl.style.display = 'none';
                        }, 5000);
                    </script>
                <?php endif; ?>
                
                <form id="contactForm" method="POST" action="">
                    <div class="form-group fade-in" style="animation-delay: 0.1s;">
                        <label for="nom">Nom <span class="required">*</span></label>
                        <input type="text" id="nom" name="nom" required value="<?= isset($form_data['nom']) ? htmlspecialchars($form_data['nom']) : '' ?>">
                    </div>
                    
                    <div class="form-group fade-in" style="animation-delay: 0.2s;">
                        <label for="entreprise">Entreprise</label>
                        <input type="text" id="entreprise" name="entreprise" value="<?= isset($form_data['entreprise']) ? htmlspecialchars($form_data['entreprise']) : '' ?>">
                    </div>
                    
                    <div class="form-group fade-in" style="animation-delay: 0.3s;">
                        <label for="email">Adresse e-mail <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required value="<?= isset($form_data['email']) ? htmlspecialchars($form_data['email']) : '' ?>">
                    </div>
                    
                    <div class="form-group fade-in" style="animation-delay: 0.4s;">
                        <label for="telephone">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" value="<?= isset($form_data['telephone']) ? htmlspecialchars($form_data['telephone']) : '' ?>">
                    </div>
                    
                    <div class="form-group fade-in" style="animation-delay: 0.5s;">
                        <label for="objet">Objet <span class="required">*</span></label>
                        <input type="text" id="objet" name="objet" required value="<?= isset($form_data['objet']) ? htmlspecialchars($form_data['objet']) : '' ?>">
                    </div>
                    
                    <div class="form-group fade-in" style="animation-delay: 0.6s;">
                        <label for="message">Message <span class="required">*</span></label>
                        <textarea id="message" name="message" required><?= isset($form_data['message']) ? htmlspecialchars($form_data['message']) : '' ?></textarea>
                    </div>
                    
                    <!-- reCAPTCHA -->
                    <div class="form-group fade-in" style="animation-delay: 0.7s;">
                        <div class="g-recaptcha" data-sitekey="<?= SITE_KEY ?>"></div>
                    </div>
                    
                    <div class="fade-in" style="animation-delay: 0.8s;">
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Envoyer
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Section Texte Design -->
            <div class="text-section">
                <div class="floating-elements">
                    <div class="floating-circle"></div>
                    <div class="floating-circle"></div>
                    <div class="floating-circle"></div>
                </div>
                
                <div class="design-text">
                    Pour plus d'<span class="highlight">information</span>, merci de compléter ce formulaire, 
                    je vous répondrai dans les plus <span class="highlight">brefs délais</span>.
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="/assets/js/script.js"></script>

    <script>
        // Fonction pour ouvrir les modals
        function openModal(modalId) {
            document.getElementById(modalId + 'Modal').style.display = 'block';
        }

        // Fonction pour fermer les modals
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Fermer la modal en cliquant à l'extérieur
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }

        // Fonction pour rediriger vers les projets
        function redirectToProjects(event) {
            event.preventDefault();
            window.location.href = '/anim-projet';
        }
    </script>
<?php

include __DIR__ . '/../view/partials/foot.php';
?>