<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio - Théo CAVICCHINI</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    
    <!-- Script pour initialiser le thème avant le rendu -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('portfolio-theme') || 
                              (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="/" class="navbar-logo">T.CAVICCHINI</a>
            
            <ul class="navbar-menu">
                <li class="navbar-item dropdown">
                    <button class="dropdown-btn">
                        BTS SIO
                        <i class="fas fa-chevron-down dropdown-arrow"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="/presentation"><i class="fas fa-user"></i> Présentation</a>
                        <a href="/stage"><i class="fas fa-briefcase"></i> Stage</a>
                        <a href="/veille"><i class="fas fa-search"></i> Veille</a>
                    </div>
                </li>
                
                <li class="navbar-item">
                    <a href="/anim-projet" class="navbar-link">
                        <i class="fas fa-code"></i> Projets
                    </a>
                </li>
                
                <li class="navbar-item">
                    <a href="#contact" class="navbar-link contact-btn">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                </li>
                
                <li class="navbar-item">
                    <div class="theme-toggle">
                        <span class="theme-label">Thème :</span>
                        <div class="toggle-switch"></div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Script pour initialiser la navigation et le thème -->
    <script src="assets/script.js"></script>