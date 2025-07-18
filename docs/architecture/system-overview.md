# System Architecture Overview

## High-Level Architecture

The Digital Legacy Vault follows a standard MVC architecture with Laravel, utilizing the following components:

+---------------------+
| Frontend |
| (Tailwind CSS) |
+----------+----------+
|
| API Requests
v
+----------+----------+
| Backend |
| (Laravel) |
+----------+----------+
|
| Database
v
+----------+----------+
| Database |
| (MySQL) |
+---------------------+


## Core Components

1. **Vault Management** - Secure storage of digital assets with AES-256 encryption
2. **Inactivity Monitoring** - Tracks user activity and triggers legacy release
3. **Beneficiary Management** - Handles recipient configuration and notifications
4. **Security Layer** - Includes encryption, access control, and audit logging

## Security

- All data is encrypted at rest using AES-256-CBC
- Two-factor authentication required for sensitive operations
- Activity logging with 7-year retention
