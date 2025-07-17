<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/telapak-kaki-kucing.png') }}" type="image/x-icon">
    <title>Enha Petshop - Sedang Dikembangkan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg,rgb(161, 159, 40), #E67514 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

            .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            background: linear-gradient(135deg,rgb(255, 186, 107), #ffa500);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.4);
        }

        .back-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(255, 107, 107, 0.3);
        }

        .back-button .arrow {
            transition: transform 0.3s ease;
        }

        .back-button:hover .arrow {
            transform: translateX(-3px);
        }

        .container {
            text-align: center;
            background: #7B4019;
            padding: 60px 40px;
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            max-width: 600px;
            width: 90%;
            position: relative;
            z-index: 10;
        }

        .logo {
            font-size: 3rem;
            font-weight: bold;
            color: #4a90e2;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .paw-icon {
            font-size: 2rem;
            color: #ff6b6b;
            animation: bounce 2s infinite;
            margin: 0 10px;
        }

        .title {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 20px;
            font-weight: 700;
        }

        .subtitle {
            font-size: 1.3rem;
            color: white;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .progress-container {
            background: #e0e0e0;
            border-radius: 25px;
            padding: 4px;
            margin: 30px 0;
            overflow: hidden;
        }

        .progress-bar {
            height: 20px;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4);
            border-radius: 20px;
            width: 75%;
            animation: progress 3s ease-in-out infinite;
            position: relative;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin: 40px 0;
        }

        .feature {
            background: linear-gradient(135deg, #A16D28, #E67514);
            color: white;
            padding: 20px;
            border-radius: 15px;
            transform: translateY(0);
            transition: all 0.3s ease;
            cursor: pointer;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
        }

        .feature:hover, .feature:active {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .feature:active {
            transform: translateY(-5px) scale(0.98);
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .feature-text {
            font-size: 1rem;
            font-weight: 600;
        }

        .contact-info {
            margin-top: 40px;
            padding: 20px;
            background: linear-gradient(135deg, #ff6b6b, #ffa500);
            border-radius: 15px;
            color: white;
        }

        .contact-info h3 {
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .contact-info p {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .floating-pets {
            position: absolute;
            font-size: 3rem;
            animation: float 6s ease-in-out infinite;
            opacity: 0.7;
        }

        .pet-1 {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .pet-2 {
            top: 20%;
            right: 10%;
            animation-delay: 1s;
        }

        .pet-3 {
            bottom: 20%;
            left: 15%;
            animation-delay: 2s;
        }

        .pet-4 {
            bottom: 10%;
            right: 15%;
            animation-delay: 3s;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #4ecdc4;
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            font-weight: 600;
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .notification.show {
            transform: translateX(0);
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        @keyframes progress {
            0% { width: 70%; }
            50% { width: 85%; }
            100% { width: 70%; }
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(5deg); }
            50% { transform: translateY(-40px) rotate(-5deg); }
            75% { transform: translateY(-20px) rotate(3deg); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px) rotate(-1deg); }
            50% { transform: translateX(5px) rotate(1deg); }
            75% { transform: translateX(-3px) rotate(-0.5deg); }
        }

        .mobile-instruction {
            display: none;
            background: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #666;
            border: 2px dashed #4ecdc4;
        }

        @media (max-width: 768px) {
            .container {
                padding: 40px 20px;
            }
            
            .title {
                font-size: 2rem;
            }
            
            .subtitle {
                font-size: 1.1rem;
            }
            
            .features {
                grid-template-columns: 1fr;
                gap: 15px;
            }
            
            .feature {
                padding: 25px 20px;
                font-size: 1.1rem;
            }
            
            .feature-icon {
                font-size: 2.5rem;
            }
            
            .floating-pets {
                font-size: 2rem;
            }
            
            .mobile-instruction {
                display: block;
            }
            
            .contact-info {
                margin-top: 30px;
                padding: 25px 20px;
            }
            
            .contact-info h3 {
                font-size: 1.3rem;
            }
            
            .contact-info p {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    hallo
</html>