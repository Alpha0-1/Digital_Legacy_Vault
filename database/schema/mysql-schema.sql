-- Schema for Digital Legacy Vault (MySQL)

-- Users
CREATE TABLE users (
    id CHAR(36) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password BLOB NOT NULL,
    email_verified_at TIMESTAMP NULL,
    two_factor_secret TEXT NULL,
    last_activity_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_admin BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Vaults
CREATE TABLE vaults (
    id CHAR(36) PRIMARY KEY,
    user_id CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    security_level ENUM('low', 'medium', 'high') DEFAULT 'medium',
    encryption_key_hash BLOB NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Legacy Items
CREATE TABLE legacy_items (
    id CHAR(36) PRIMARY KEY,
    vault_id CHAR(36) NOT NULL,
    title VARCHAR(255) NOT NULL,
    content BLOB NOT NULL,
    type ENUM('document', 'message', 'account') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (vault_id) REFERENCES vaults(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Beneficiaries
CREATE TABLE beneficiaries (
    id CHAR(36) PRIMARY KEY,
    user_id CHAR(36) NOT NULL,
    vault_id CHAR(36) NOT NULL,
    access_level ENUM('view', 'edit', 'admin') NOT NULL,
    relationship VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (vault_id) REFERENCES vaults(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inactivity Settings
CREATE TABLE inactivity_settings (
    id CHAR(36) PRIMARY KEY,
    user_id CHAR(36) NOT NULL,
    threshold_days INT UNSIGNED DEFAULT 90,
    last_activity_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    release_status ENUM('pending', 'released', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Legacy Releases
CREATE TABLE legacy_releases (
    id CHAR(36) PRIMARY KEY,
    user_id CHAR(36) NOT NULL,
    beneficiary_id CHAR(36) NULL,
    vault_id CHAR(36) NULL,
    status ENUM('pending', 'released', 'failed') DEFAULT 'pending',
    release_date TIMESTAMP NULL,
    reason TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (beneficiary_id) REFERENCES beneficiaries(id) ON DELETE SET NULL,
    FOREIGN KEY (vault_id) REFERENCES vaults(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Indexes
CREATE INDEX idx_user_activity ON users(last_activity_at);
CREATE INDEX idx_vault_user ON vaults(user_id);
CREATE INDEX idx_item_vault ON legacy_items(vault_id);
CREATE INDEX idx_inactivity_user ON inactivity_settings(user_id);
CREATE INDEX idx_release_user ON legacy_releases(user_id);
