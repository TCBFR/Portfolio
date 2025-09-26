<?php

include '../partials/header.php';
include '../partials/banner.php';

?>
    <section class="hero" id="accueil">
        <div class="hero-content">
            <h1>Vous en avez marre de faire vos devis et factures à la main ?</h1>
            <p><strong>Choisissez Odoo</strong> : un logiciel plus facile à utiliser qu'Excel, 
             aussi professionnel que Sage, et <strong>OpenSource</strong> !</p>
            <a href="#solution" class="cta-button">Découvrir la solution</a>
        </div>
    </section>

    <main class="main-content">
        <section class="section" id="solution">
            <div class="container">
                <h2>La Solution Odoo</h2>
                <div class="comparison-grid">
                    <div class="comparison-card fade-in">
                        <h3>❌ Avant : Gestion manuelle avec Excel</h3>
                        <img src="https://odoo.1ere-page.fr/wp-content/uploads/2023/11/Devis1-Excel.jpg" alt="Devis Excel" />
                        <p>Création manuelle, risques d'erreurs, perte de temps, pas de suivi automatique des clients...</p>
                    </div>
                    <div class="comparison-card fade-in">
                        <h3>✅ Après : Gestion intelligente avec Odoo</h3>
                        <img src="https://odoo.1ere-page.fr/wp-content/uploads/2023/11/Devis2-Odoo.jpg" alt="Devis Odoo" />
                        <p>Création automatisée, suivi client intégré, duplication facile, gestion professionnelle complète !</p>
                    </div>
                </div>
                
                <div class="container">
                    <p style="text-align: center; font-size: 1.2rem; color: #666; margin: 2rem 0;">
                        <strong>Nous proposons l'installation et le paramétrage d'Odoo :</strong><br>
                        • Sur votre ordinateur personnel<br>
                        • Sur le serveur de votre entreprise<br>
                        • Ou sur un serveur Cloud
                    </p>
                </div>
            </div>
        </section>

        <section class="section" id="fonctionnalites">
            <div class="container">
                <h2>Fonctionnalités Principales</h2>
                <div class="features">
                    <div class="feature-item fade-in">
                        <h4>👥 Gestion des Prospects et Clients</h4>
                        <p>Centralisez toutes les informations de vos contacts et suivez facilement vos opportunités commerciales.</p>
                    </div>
                    <div class="feature-item fade-in">
                        <h4>📦 Gestion des Produits et Services</h4>
                        <p>Cataloguez vos produits et services avec prix, descriptions et disponibilités en temps réel.</p>
                    </div>
                    <div class="feature-item fade-in">
                        <h4>📄 Création de Devis et Factures</h4>
                        <p>Générez vos documents commerciaux en quelques clics avec une mise en forme professionnelle.</p>
                    </div>
                    <div class="feature-item fade-in">
                        <h4>🔄 Duplication Intelligente</h4>
                        <p>Dupliquez vos devis et factures existants et modifiez seulement les éléments nécessaires.</p>
                    </div>
                    <div class="feature-item fade-in">
                        <h4>⚡ Création "À la Volée"</h4>
                        <p>Créez simultanément un devis, un client et des produits en une seule opération.</p>
                    </div>
                    <div class="feature-item fade-in">
                        <h4>📅 Facturation Récurrente</h4>
                        <p>Dupliquez vos factures mensuelles et modifiez seulement les quantités facturées.</p>
                    </div>
                </div>
                
                <div style="text-align: center; margin: 3rem 0;">
                    <img src="https://odoo.1ere-page.fr/wp-content/uploads/2023/11/odoo-dupliquer-devis-1024x218.jpg" 
                    alt="Duplication de devis Odoo" style="max-width: 100%; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);" />
                </div>
            </div>
        </section>

        <section class="section video-section" id="video">
            <div class="container">
                <h2>Découvrez Odoo en Action</h2>
                <p style="font-size: 1.2rem; margin-bottom: 3rem; opacity: 0.9;">
                    Regardez cette vidéo pour comprendre à quel point Odoo est un logiciel qui facilite la vie...
                </p>
                <div class="video-container fade-in">
                    <div class="video-placeholder">
                    <iframe width="800" height="500" src="https://www.youtube.com/embed/G5Ey_LkStXc" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>
        <section class="section cta-section" id="contact">
            <div class="container">
                <h2>Prêt à Simplifier Votre Gestion ?</h2>
                <p style="font-size: 1.3rem; margin-bottom: 2rem; opacity: 0.9;">
                    Appelez-nous si vous voulez tester Odoo gratuitement sans installation !
                </p>
                <a href="tel:+33000000000" class="contact-button">📞 Nous Contacter</a>
                <a href="https://odoo.1ere-page.fr/" class="contact-button">Pour plus d'informations</a>
                <div style="margin-top: 2rem;">
                    <p style="opacity: 0.8;">
                        ✅ Test gratuit • ✅ Sans engagement • ✅ Support expert
                    </p>
                </div>
            </div>
        </section>
    </main>
<?php
include '../partials/foot.php';
?>
