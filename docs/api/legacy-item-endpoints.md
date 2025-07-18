# Legacy Item API Endpoints

## Authentication
All endpoints require Laravel Sanctum authentication:
```bash
Authorization: Bearer <token>
```

## Endpoints
*GET /api/vaults/{vault}/items*
Retrieve all legacy items in a vault

```json
{
  "data": [
    {
      "id": 1,
      "vault_id": 123,
      "title": "Will",
      "type": "document",
      "created_at": "2024-03-15T14:30:00Z"
    }
  ]
}
```

*POST /api/vaults/{vault}/items*
Create a new legacy item (requires valid encryption key)

```json
{
  "title": "My Last Will",
  "content": "Encrypted content",
  "type": "document",
  "encryption_key": "secure_key_1234567890"
}
```

*GET /api/vaults/{vault}/items/{item}*
Retrieve a specific legacy item

```json
{
  "data": {
    "id": 1,
    "vault_id": 123,
    "title": "Will",
    "content": "Decrypted content",
    "type": "document",
    "beneficiaries": ["john@example.com"],
    "created_at": "2024-03-15T14:30:00Z"
}
```
*PUT /api/vaults/{vault}/items/{item}*
Update a legacy item
```json
{
  "title": "Updated Will",
  "content": "Updated content",
  "encryption_key": "secure_key_1234567890"
}
```

*DELETE /api/vaults/{vault}/items/{item}*
Delete a legacy item (permanent, requires admin override)

```json
{
  "success": true,
  "message": "Legacy item deleted"
}
```

## Security
- All data encrypted with AES-256-CBC
- 2FA required for destructive operations
- Rate-limited to 50 requests/minute


