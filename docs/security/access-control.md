# Access Control Policy

## Authentication
- All endpoints require Sanctum token authentication
- 2FA required for sensitive operations
- Password complexity: 12+ characters, mixed case, special characters

## Authorization
- Vault owners can only access their own vault
- Admins have limited access to user management only
- Beneficiaries have read-only access to their assigned legacy items

## Sessions
- Session timeout: 1 hour
- Secure cookies: HTTPS only, SameSite=strict
- Rate limiting: 60 requests/minute per user

## Audit Logs
- All access attempts recorded
- Logs retained for 7 years
- Logs include:
  - Timestamp
  - User ID
  - Action
  - IP address
  - User agent
