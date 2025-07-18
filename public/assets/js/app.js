// Digital Legacy Vault - Core JavaScript
import './bootstrap';
import '../css/app.css';

// Initialize encryption utilities
import { initEncryption } from './utils/encryption';

document.addEventListener('DOMContentLoaded', () => {
    // Initialize encryption for sensitive fields
    initEncryption();

    // Disable autocomplete on sensitive inputs
    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.setAttribute('autocomplete', 'off');
    });
});
