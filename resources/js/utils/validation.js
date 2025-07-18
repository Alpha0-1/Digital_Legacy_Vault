/**
 * Validación de datos para el sistema de legado digital
 */

export const validateEmail = (email) => {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
};

export const validatePassword = (password) => {
    return password.length >= 12;
};

export const validateEncryptionKey = (key) => {
    return key.length >= 32 && /[A-Z]/.test(key) && /[a-z]/.test(key) && /[0-9]/.test(key);
};

export const validateFileSize = (size, maxSizeMB) => {
    return size <= maxSizeMB * 1024 * 1024;
};

export const validateVaultTitle = (title) => {
    return title.length >= 3 && title.length <= 255;
};
