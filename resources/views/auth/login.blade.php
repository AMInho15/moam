<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Helpdesk Pro</title>
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
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
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

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            background: rgba(15, 32, 39, 0.8);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.6s ease-out;
            transform-style: preserve-3d;
            transform: perspective(1000px);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, #fff, #c1d3fe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .login-header p {
            font-size: 0.95rem;
            opacity: 0.8;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .form-control {
            width: 100%;
            padding: 0.85rem 1.25rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: var(--light);
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(72, 149, 239, 0.3);
            background: rgba(255, 255, 255, 0.15);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remember-me input {
            accent-color: var(--accent);
        }

        .forgot-password {
            color: var(--accent);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            text-decoration: underline;
            color: var(--success);
        }

        .btn-login {
            width: 100%;
            padding: 0.85rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        }

        .btn-login:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(67, 97, 238, 0.4);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .login-footer a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .login-footer a:hover {
            color: var(--success);
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px) perspective(1000px) rotateX(10deg);
            }
            to {
                opacity: 1;
                transform: translateY(0) perspective(1000px) rotateX(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .floating-icon {
            position: absolute;
            opacity: 0.1;
            z-index: -1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-icon:nth-child(1) {
            top: 10%;
            left: 10%;
            font-size: 3rem;
            animation-delay: 0s;
        }

        .floating-icon:nth-child(2) {
            top: 70%;
            right: 15%;
            font-size: 4rem;
            animation-delay: 1s;
        }

        .floating-icon:nth-child(3) {
            bottom: 20%;
            left: 20%;
            font-size: 2.5rem;
            animation-delay: 2s;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 1.75rem;
                margin: 0 1rem;
            }
            
            .login-header h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <!-- Icônes flottantes décoratives -->
    <i class="fas fa-ticket-alt floating-icon"></i>
    <i class="fas fa-headset floating-icon"></i>
    <i class="fas fa-server floating-icon"></i>

    <!-- Conteneur de connexion -->
    <div class="login-container">
        <div class="login-header">
            <h1>
                <i class="fas fa-sign-in-alt"></i> Helpdesk Pro
            </h1>
            <p>Connectez-vous à votre espace de gestion des tickets</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="votre@email.com" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember_me">
                    Se souvenir de moi
                </label>
                <a href="{{ route('password.request') }}" class="forgot-password">
                    Mot de passe oublié ?
                </a>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-arrow-right-to-bracket"></i> Se connecter
            </button>
        </form>

        <div class="login-footer">
            <p>Nouveau sur Helpdesk Pro ? <a href="{{ route('register') }}">Créer un compte</a></p>
        </div>
    </div>

    <!-- Animation dynamique -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Effet de parallaxe sur le conteneur
            const loginContainer = document.querySelector('.login-container');
            
            document.addEventListener('mousemove', (e) => {
                const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
                const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
                loginContainer.style.transform = `perspective(1000px) rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            });
            
            // Reset animation when mouse leaves
            document.addEventListener('mouseleave', () => {
                loginContainer.style.transform = 'perspective(1000px) rotateY(0) rotateX(0)';
            });
            
            // Effet de vague animée en arrière-plan
            const wave = document.createElement('div');
            wave.style.position = 'absolute';
            wave.style.bottom = '0';
            wave.style.left = '0';
            wave.style.width = '100%';
            wave.style.height = '100px';
            wave.style.background = 'url("data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1440 320\'%3E%3Cpath fill=\'rgba(67,97,238,0.1)\' d=\'M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\'%3E%3C/path%3E%3C/svg%3E")';
            wave.style.backgroundSize = 'cover';
            wave.style.animation = 'wave 10s linear infinite';
            wave.style.zIndex = '0';
            document.body.appendChild(wave);

            const style = document.createElement('style');
            style.textContent = `
                @keyframes wave {
                    0% { transform: translateX(0) translateZ(0) scaleY(1); }
                    50% { transform: translateX(-25%) translateZ(0) scaleY(0.8); }
                    100% { transform: translateX(-50%) translateZ(0) scaleY(1); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>