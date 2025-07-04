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
    <button class="back-button" onclick="goBack()">
        <span class="arrow">←</span>
        <span>Kembali</span>
    </button>

    <div class="floating-pets pet-1">🐕</div>
    <div class="floating-pets pet-2">🐱</div>
    <div class="floating-pets pet-3">🐰</div>
    <div class="floating-pets pet-4">🦜</div>

    <div class="container">
        <div class="logo">
            <span class="paw-icon">🐾</span>
        <h1 class="title">Sedang Dalam Pengembangan!</h1>
            <span class="paw-icon">🐾</span>
        </div>
                
        <p class="subtitle">
            Website petshop terbaik untuk sahabat berbulu Anda sedang dalam tahap pengembangan. 
            Kami sedang menyiapkan pengalaman berbelanja yang luar biasa!
        </p>
                        
        {{-- <div class="contact-info">
            <h3>Hubungi Kami</h3>
            <p>📧 info@petcare.com</p>
            <p>📱 +62 812-3456-7890</p>
            <p>🕒 Launching Soon: Desember 2024</p>
        </div> --}}
        
        {{-- <div class="mobile-instruction">
            <strong>💡 Tips untuk HP:</strong><br>
            • Ketuk kartu fitur untuk info lebih lanjut<br>
            • Goyangkan HP untuk efek spesial! 🎉<br>
            • Sentuh layar untuk efek paw prints 🐾
        </div> --}}
    </div>


    <script>
        function goBack() {
            // Cek jika ada history sebelumnya
            if (window.history.length > 1) {
                window.history.back();
                showNotification('🔙 Kembali ke halaman sebelumnya...');
            } else {
                // Jika tidak ada history, beri opsi alternatif
                const userChoice = confirm('Tidak ada halaman sebelumnya. Apakah Anda ingin pergi ke halaman utama?');
                if (userChoice) {
                    // Redirect ke halaman utama (sesuaikan dengan URL website Anda)
                    window.location.href = '/';
                } else {
                    showNotification('🏠 Anda sudah berada di halaman utama!');
                }
            }
        }

        // Add random pet emojis animation
        setInterval(() => {
            const pets = ['🐕', '🐱', '🐰', '🦜', '🐹', '🐠', '🐢'];
            const randomPet = pets[Math.floor(Math.random() * pets.length)];
            
            const floatingPet = document.createElement('div');
            floatingPet.innerHTML = randomPet;
            floatingPet.style.position = 'fixed';
            floatingPet.style.fontSize = '2rem';
            floatingPet.style.left = Math.random() * 100 + '%';
            floatingPet.style.top = '-50px';
            floatingPet.style.opacity = '0.6';
            floatingPet.style.animation = 'float 4s ease-in-out forwards';
            floatingPet.style.pointerEvents = 'none';
            floatingPet.style.zIndex = '1';
            
            document.body.appendChild(floatingPet);
            
            setTimeout(() => {
                floatingPet.remove();
            }, 4000);
        }, 3000);

        // Interactive cursor effect for desktop
        if (window.innerWidth > 768) {
            document.addEventListener('mousemove', (e) => {
                const cursor = document.createElement('div');
                cursor.innerHTML = '🐾';
                cursor.style.position = 'fixed';
                cursor.style.left = e.clientX + 'px';
                cursor.style.top = e.clientY + 'px';
                cursor.style.fontSize = '12px';
                cursor.style.pointerEvents = 'none';
                cursor.style.opacity = '0.7';
                cursor.style.zIndex = '1000';
                cursor.style.transition = 'opacity 0.5s ease';
                
                document.body.appendChild(cursor);
                
                setTimeout(() => {
                    cursor.style.opacity = '0';
                    setTimeout(() => cursor.remove(), 500);
                }, 200);
            });
        }

        // Touch interaction for mobile
        if ('ontouchstart' in window) {
            document.addEventListener('touchstart', (e) => {
                const touch = e.touches[0];
                const ripple = document.createElement('div');
                ripple.innerHTML = '🐾';
                ripple.style.position = 'fixed';
                ripple.style.left = touch.clientX + 'px';
                ripple.style.top = touch.clientY + 'px';
                ripple.style.fontSize = '16px';
                ripple.style.pointerEvents = 'none';
                ripple.style.opacity = '0.8';
                ripple.style.zIndex = '1000';
                ripple.style.transform = 'scale(0)';
                ripple.style.transition = 'all 0.6s ease';
                
                document.body.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.style.transform = 'scale(1.5)';
                    ripple.style.opacity = '0';
                }, 10);
                
                setTimeout(() => ripple.remove(), 600);
            });
        }

        // Shake animation for mobile
        if (window.DeviceMotionEvent) {
            let lastShake = 0;
            window.addEventListener('devicemotion', (e) => {
                const acceleration = e.accelerationIncludingGravity;
                const curTime = new Date().getTime();
                
                if ((curTime - lastShake) > 1000) {
                    const x = Math.abs(acceleration.x);
                    const y = Math.abs(acceleration.y);
                    const z = Math.abs(acceleration.z);
                    
                    if (x > 12 || y > 12 || z > 12) {
                        lastShake = curTime;
                        createShakeEffect();
                    }
                }
            });
        }

        function createShakeEffect() {
            const container = document.querySelector('.container');
            container.style.animation = 'shake 0.5s ease-in-out';
            
            // Create multiple pet emojis
            const pets = ['🐕', '🐱', '🐰', '🦜', '🐹', '🐠', '🐢', '🐾'];
            for (let i = 0; i < 5; i++) {
                setTimeout(() => {
                    const pet = document.createElement('div');
                    pet.innerHTML = pets[Math.floor(Math.random() * pets.length)];
                    pet.style.position = 'fixed';
                    pet.style.fontSize = '2rem';
                    pet.style.left = Math.random() * 100 + '%';
                    pet.style.top = '-50px';
                    pet.style.opacity = '0.8';
                    pet.style.animation = 'float 3s ease-in-out forwards';
                    pet.style.pointerEvents = 'none';
                    pet.style.zIndex = '1';
                    
                    document.body.appendChild(pet);
                    
                    setTimeout(() => pet.remove(), 3000);
                }, i * 200);
            }
            
            showNotification('🎉 Wah! Kamu menggoyang perangkat! Hewan peliharaan senang!');
            
            setTimeout(() => {
                container.style.animation = '';
            }, 500);
        }
    </script>
</body>
</html>