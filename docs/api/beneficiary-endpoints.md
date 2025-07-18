# Beneficiary API Endpoints

## Manage Beneficiaries

### `GET /api/beneficiaries`

**Response:**
```json
[
    {
        "id": "string",
        "name": "string",
        "email": "string",
        "relationship": "string",
        "is_verified": "boolean",
        "created_at": "timestamp"
    }
]
