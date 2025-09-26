<?php

include __DIR__ . '/../view/partials/banner.php';
?>
<?php
// Page de Veille Technologique
// Configuration
$page_title = "Plateforme d'affiliation";
$last_update = date('d/m/Y');

// Données de veille (vous pouvez les remplacer par une base de données)
$veille_data = [
    [
        'category' => 'Crypto',
        'title' => '« Neque porro quisquam est qui do lorem Ipsum quia dolor sit amet, consectetur, adipisci v elit… »',
        'source' => 'Anthropic',
        'date' => '14/08/2025',
        'url' => 'https://anthropic.com',
        'description' => '« Neque porro quisquam est qui do lorem Ipsum quia dolor sit amet, consectetur, adipisci v elit… »',
        'tags' => ['IA', 'Conversationnel', 'Innovation'],
        'priority' => 'high'
    ],
    [
        'category' => 'Marketing',
        'title' => 'Qu’est-ce-que l’affiliation marketing? Le guide 2025',
        'source' => 'Shopify',
        'date' => '17/03/2025',
        'url' => 'https://www.shopify.com/fr/blog/comment-mettre-en-place-un-programme-d-affiliation-pour-votre-boutique-shopify',
        'description' => 'Marques et créateurs de contenu tirent profit en faisant une collaboration mutuelle puis accèdent aux audiences engagées 
        des blogueurs ou tous types de créateurs de contenu et alors les créateurs perçoivent une commission sur les 
        ventes ou recommandations,...',
        'tags' => ['Marketing', 'Conseil', 'Infos'],
        'priority' => 'medium'
    ],
    [
        'category' => 'Monétisation',
        'title' => 'TikTok va faciliter l’insertion de liens affiliés dans les vidéos organiques',
        'source' => 'LEPTIDIGITAL',
        'date' => '15/11/2024',
        'url' => 'https://www.leptidigital.fr/actualites/ajout-liens-affiliation-commentaires-videos-tiktok-68993/',
        'description' => 'Tiktok permet aux créateurs d’ajouter des liens d’affiliation directement dans les commentaires de leurs vidéos, 
        cette fonctionnalité offre aux créateurs un nouveau moyen de monétiser leur contenu, de plus TikTok renforce son ambition de devenir 
        une plateforme de commerce social.',
        'tags' => ['Infos', 'Monétisation', 'réseau social'],
        'priority' => 'medium'
    ],
    [
        'category' => 'Programme',
        'title' => 'Twitch va ouvrir son programme de monétisation',
        'source' => 'rbf.be',
        'date' => '28/02/2025',
        'url' => 'https://www.rtbf.be/article/twitch-va-ouvrir-son-programme-de-monetisation-a-presque-tout-le-monde-11511145',
        'description' => 'Le PDG de Twitch souhaite créé des contenus sponsorisés par des marques, l’interaction avec les spectateurs et
        l’édition de vidéos mais aussi collaboré entre les streameurs et organisé plus d’événements promotionnels.',
        'tags' => ['Infos', 'réseau social', 'programme'],
        'priority' => 'medium'
    ],
    [
        'category' => 'Classement',
        'title' => 'Programme Affiliation Crypto – Les Meilleurs sites en 2025',
        'source' => '99 Bitcoins',
        'date' => '02/06/2025',
        'url' => 'https://99bitcoins.com/fr/crypto-monnaie/programme-affiliation-crypto/',
        'description' => ' Top programmes crypto MEXC avec jusqu’à 70 % de commissions à vie, Margex avec 
        40 % de commissions sur le trading à effet de levier, OKX et ses boîtes mystères jusqu’à 10 000 $, 
        Binance leader mondial, jusqu’à 40 %, ...',
        'tags' => ['Infos', 'Meilleurs sites'],
        'priority' => 'low'
    ],
    [
        'category' => 'Classement',
        'title' => 'Zero Trust : Architecture de sécurité moderne',
        'source' => 'NIST',
        'date' => '08/08/2025',
        'url' => 'https://nist.gov',
        'description' => 'Guide complet sur l\'implémentation de l\'architecture Zero Trust dans les entreprises modernes.',
        'tags' => ['Sécurité', 'Architecture', 'Enterprise'],
        'priority' => 'high'
    ],
    [
        'category' => 'Crypto',
        'title' => 'Zero Trust : Architecture de sécurité moderne',
        'source' => 'NIST',
        'date' => '08/08/2025',
        'url' => 'https://nist.gov',
        'description' => 'Guide complet sur l\'implémentation de l\'architecture Zero Trust dans les entreprises modernes.',
        'tags' => ['Sécurité', 'Architecture', 'Enterprise'],
        'priority' => 'high'
    ],
    [
        'category' => 'Crypto',
        'title' => 'Zero Trust : Architecture de sécurité moderne',
        'source' => 'NIST',
        'date' => '08/08/2025',
        'url' => 'https://nist.gov',
        'description' => 'Guide complet sur l\'implémentation de l\'architecture Zero Trust dans les entreprises modernes.',
        'tags' => ['Sécurité', 'Architecture', 'Enterprise'],
        'priority' => 'high'
    ],
    [
        'category' => 'Programme',
        'title' => 'Zero Trust : Architecture de sécurité moderne',
        'source' => 'NIST',
        'date' => '08/08/2025',
        'url' => 'https://nist.gov',
        'description' => 'Guide complet sur l\'implémentation de l\'architecture Zero Trust dans les entreprises modernes.',
        'tags' => ['Sécurité', 'Architecture', 'Enterprise'],
        'priority' => 'high'
    ],
    [
        'category' => 'Marketing',
        'title' => 'Zero Trust : Architecture de sécurité moderne',
        'source' => 'NIST',
        'date' => '08/08/2025',
        'url' => 'https://nist.gov',
        'description' => 'Guide complet sur l\'implémentation de l\'architecture Zero Trust dans les entreprises modernes.',
        'tags' => ['Sécurité', 'Architecture', 'Enterprise'],
        'priority' => 'high'
    ],
    [
        'category' => 'Marketing',
        'title' => 'Zero Trust : Architecture de sécurité moderne',
        'source' => 'NIST',
        'date' => '08/08/2025',
        'url' => 'https://nist.gov',
        'description' => 'Guide complet sur l\'implémentation de l\'architecture Zero Trust dans les entreprises modernes.',
        'tags' => ['Sécurité', 'Architecture', 'Enterprise'],
        'priority' => 'high'
    ],
    [
        'category' => 'Monétisation',
        'title' => 'Zero Trust : Architecture de sécurité moderne',
        'source' => 'NIST',
        'date' => '08/08/2025',
        'url' => 'https://nist.gov',
        'description' => 'Guide complet sur l\'implémentation de l\'architecture Zero Trust dans les entreprises modernes.',
        'tags' => ['Sécurité', 'Architecture', 'Enterprise'],
        'priority' => 'high'
    ]

];

// Fonction pour obtenir la classe CSS selon la priorité
function getPriorityClass($priority) {
    switch($priority) {
        case 'high': return 'priority-high';
        case 'medium': return 'priority-medium';
        case 'low': return 'priority-low';
        default: return 'priority-medium';
    }
}

// Fonction pour obtenir les catégories uniques
function getCategories($data) {
    $categories = array_unique(array_column($data, 'category'));
    sort($categories);
    return $categories;
}

$categories = getCategories($veille_data);
?>
    <style>
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .filters {
            padding: 20px 30px;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 1px solid #dee2e6;
            background: white;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }

        .veille-grid {
            padding: 30px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 25px;
        }

        .veille-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border-left: 5px solid #007bff;
            position: relative;
        }

        .veille-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #dee2e6;
        }

        .card-category {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .card-body {
            padding: 20px;
        }

        .card-description {
            color: #495057;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .card-tags {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .tag {
            background: #e9ecef;
            color: #495057;
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .card-footer {
            padding: 15px 20px;
            background: #f8f9fa;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .source-link {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .source-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .priority-indicator {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .priority-high {
            border-left-color: #dc3545;
        }

        .priority-high .priority-indicator {
            background: #dc3545;
        }

        .priority-medium {
            border-left-color: #ffc107;
        }

        .priority-medium .priority-indicator {
            background: #ffc107;
        }

        .priority-low {
            border-left-color: #28a745;
        }

        .priority-low .priority-indicator {
            background: #28a745;
        }

        .stats {
            padding: 20px 30px;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            gap: 40px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            display: block;
            font-size: 1.5rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .veille-grid {
                grid-template-columns: 1fr;
                padding: 15px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .header-info {
                flex-direction: column;
                gap: 10px;
            }

            .stats {
                flex-direction: column;
                gap: 20px;
            }

            .filter-buttons {
                justify-content: center;
            }
        }
    </style>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><?php echo $page_title; ?></h1>
            <div class="header-info">
                <span>📅 Dernière mise à jour : <?php echo $last_update; ?></span>
            </div>
        </div>

        <!-- Filtres -->
        <div class="filters">
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterByCategory('all')">Tous</button>
                <?php foreach($categories as $category): ?>
                    <button class="filter-btn" onclick="filterByCategory('<?php echo htmlspecialchars($category); ?>')">
                        <?php echo htmlspecialchars($category); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="stats">
            <div class="stat-item">
                <span class="stat-number"><?php echo count($veille_data); ?></span>
                <span>Articles</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo count($categories); ?></span>
                <span>Catégories</span>
            </div>
            <div class="stat-item">
                <span class="stat-number"><?php echo count(array_filter($veille_data, function($item) { return $item['priority'] === 'high'; })); ?></span>
                <span>Priorité haute</span>
            </div>
        </div>

        <!-- Grille de veille -->
        <div class="veille-grid" id="veilleGrid">
            <?php foreach($veille_data as $item): ?>
                <div class="veille-card <?php echo getPriorityClass($item['priority']); ?>" data-category="<?php echo htmlspecialchars($item['category']); ?>">
                    <div class="priority-indicator"></div>
                    
                    <div class="card-header">
                        <div class="card-category"><?php echo htmlspecialchars($item['category']); ?></div>
                        <h3 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                        <div class="card-meta">
                            <span>📰 <?php echo htmlspecialchars($item['source']); ?></span>
                            <span><?php echo $item['date']; ?></span>
                        </div>
                    </div>

                    <div class="card-body">
                        <p class="card-description"><?php echo htmlspecialchars($item['description']); ?></p>
                        
                        <div class="card-tags">
                            <?php foreach($item['tags'] as $tag): ?>
                                <span class="tag"><?php echo htmlspecialchars($tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="<?php echo htmlspecialchars($item['url']); ?>" class="source-link" target="_blank" rel="noopener">
                            Lire l'article →
                        </a>
                        <span style="font-size: 0.8rem; color: #6c757d;">
                            Priorité: <?php echo ucfirst($item['priority']); ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        function filterByCategory(category) {
            const cards = document.querySelectorAll('.veille-card');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Mettre à jour les boutons actifs
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filtrer les cartes
            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                    // Animation d'apparition
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 100);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }

        // Animation initiale des cartes
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.veille-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
