# Audit Logging Policy

## Log Types

1. **Access Logs**
   - User login/logout
   - Vault access attempts
   - API request logs

2. **Security Logs**
   - Failed login attempts
   - 2FA events
   - Inactivity alerts

3. **Data Logs**
   - Vault modifications
   - Beneficiary changes
   - Legacy release events

## Retention
- Logs retained for 7 years
- Encrypted at rest using AES-256
- Access to logs restricted to admins only
