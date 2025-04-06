<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Pro - Gestion des Tickets IT</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #f72585;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: var(--light);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            padding: 2rem;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://cdn.prod.website-files.com/5d6697e04531522c6b9ca2a8/61093d6307ac6e71e0d8ae88_article_logiciel_ticketing.png') center/cover no-repeat;
            opacity: 0.1;
            z-index: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content {
            animation: fadeInLeft 0.8s ease-out;
        }

        .hero-image {
            position: relative;
            animation: fadeInRight 0.8s ease-out;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.4));
            border-radius: 15px;
            transform: perspective(1000px) rotateY(-10deg);
        }

        .hero-image::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            background: radial-gradient(circle, rgba(67, 97, 238, 0.4) 0%, rgba(67, 97, 238, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #fff, #c1d3fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tagline {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .feature-icon {
            font-size: 1.5rem;
            color: var(--accent);
        }

        footer {
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 0.5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: white;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .btn-group {
                justify-content: center;
            }

            .tagline {
                margin-left: auto;
                margin-right: auto;
            }

            .features {
                grid-template-columns: 1fr;
            }
            
            .hero-image img {
                transform: none;
                margin-top: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Section Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>
                    <i class="fas fa-ticket-alt"></i> Helpdesk Pro
                </h1>
                <p class="tagline">
                    La solution tout-en-un pour gérer vos tickets IT avec efficacité et simplicité
                </p>
                
                <div class="btn-group">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">
                        <i class="fas fa-user-plus"></i> Inscription
                    </a>
                </div>

                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <div>
                            <h3>Rapide</h3>
                            <p>Résolution accélérée des incidents</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <h3>Efficace</h3>
                            <p>Suivi en temps réel</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div>
                            <h3>Sécurisé</h3>
                            <p>Données protégées</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-image">
                <img src="https://cdn.prod.website-files.com/5d6697e04531522c6b9ca2a8/61093d6307ac6e71e0d8ae88_article_logiciel_ticketing.png" alt="Interface moderne de gestion des tickets">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div>© 2025 Helpdesk Pro. Tous droits réservés.</div>
        <div class="footer-links">
            <a href="#">
                <i class="fas fa-file-contract"></i> Mentions légales
            </a>
            <a href="#">
                <i class="fas fa-shield-alt"></i> Confidentialité
            </a>
            <a href="#">
                <i class="fas fa-question-circle"></i> Aide
            </a>
            <a href="#">
                <i class="fas fa-envelope"></i> Contact
            </a>
        </div>
    </footer>

    <!-- Animation au chargement -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Effet de vague animée
            const hero = document.querySelector('.hero');
            if (hero) {
                const wave = document.createElement('div');
                wave.style.position = 'absolute';
                wave.style.bottom = '0';
                wave.style.left = '0';
                wave.style.width = '100%';
                wave.style.height = '100px';
                wave.style.background = 'url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1440 320\'%3E%3Cpath fill=\'rgba(255,255,255,0.03)\' d=\'M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\'%3E%3C/path%3E%3C/svg%3E")';
                wave.style.backgroundSize = 'cover';
                wave.style.animation = 'wave 10s linear infinite';
                hero.appendChild(wave);

                const style = document.createElement('style');
                style.textContent = `
                    @keyframes wave {
                        0% { transform: translateX(0) translateZ(0) scaleY(1); }
                        50% { transform: translateX(-25%) translateZ(0) scaleY(0.8); }
                        100% { transform: translateX(-50%) translateZ(0) scaleY(1); }
                    }
                `;
                document.head.appendChild(style);
            }

            // Effet de flottement pour l'image
            const heroImage = document.querySelector('.hero-image img');
            if (heroImage) {
                setInterval(() => {
                    heroImage.style.transform = `perspective(1000px) rotateY(-10deg) translateY(${Math.sin(Date.now() / 800) * 10}px)`;
                }, 50);
            }
        });
    </script>
</body>
</html>