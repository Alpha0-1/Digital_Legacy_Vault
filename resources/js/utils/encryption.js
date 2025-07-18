/**
 * Secure encryption utilities for the Digital Legacy Vault
 */

// Generate a secure random key
export function generateSecureKey(length = 32) {
    const array = new Uint8Array(length);
    window.crypto.getRandomValues(array);
    return array.map(b => b.toString(16)).join('');
}

// Encrypt data using AES-256-GCM
export async function encryptData(data, key) {
    const encoder = new TextEncoder();
    const keyBuffer = encoder.encode(key);
    
    const cryptoKey = await window.crypto.subtle.importKey(
        'raw',
        keyBuffer,
        { name: 'AES-GCM' },
        false,
        ['encrypt', 'decrypt']
    );
    
    const iv = window.crypto.getRandomValues(new Uint8Array(12));
    const encrypted = await window.crypto.subtle.encrypt(
        { name: 'AES-GCM', iv },
        cryptoKey,
        encoder.encode(data)
    );
    
    return {
        iv: arrayBufferToBase64(iv),
        encrypted: arrayBufferToBase64(encrypted)
    };
}

// Convert array buffer to base64
function arrayBufferToBase64(buffer) {
    return btoa(String.fromCharCode.apply(null, new Uint8Array(buffer)));
}
