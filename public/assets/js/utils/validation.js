// Form validation utilities
export function validateVaultForm(form) {
    form.addEventListener('submit', (e) => {
        const keyField = form.querySelector('[name="encryption_key"]');
        if (keyField && keyField.value.length < 32) {
            e.preventDefault();
            alert('Encryption key must be at least 32 characters for security');
            return false;
        }
        return true;
    });
}
