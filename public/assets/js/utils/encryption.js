// Encryption utilities for client-side validation
export function initEncryption() {
    const encryptionFields = document.querySelectorAll('[data-encryption]');
    
    encryptionFields.forEach(field => {
        field.addEventListener('input', () => {
            const value = field.value;
            if (value.length < 32 && value.length > 0) {
                const warning = document.getElementById('encryption-warning');
                if (warning) warning.style.display = 'block';
            }
        });
    });
}
