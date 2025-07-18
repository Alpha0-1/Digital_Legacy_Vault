# Vault API Endpoints

## Vault Management

### `GET /api/vaults/{id}`
Retrieve vault details (requires authentication)

**Response:**
```json
{
  "id": "string",
  "title": "string",
  "description": "string",
  "security_level": "low|medium|high",
  "created_at": "timestamp",
  "updated_at": "timestamp"
}
