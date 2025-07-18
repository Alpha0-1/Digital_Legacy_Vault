# SSL Configuration Guide

## Nginx Configuration

server {
    listen 443 ssl;
    server_name legacy-vault.example.com;

    ssl_certificate /etc/ssl/certs/legacy-vault.crt;
    ssl_certificate_key /etc/ssl/private/legacy-vault.key;
    
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers HIGH:!aNULL:!MD5:!RC4:!DH;
    ssl_prefer_server_ciphers on;
    
    ssl_stapling on;
    ssl_stapling_verify on;
    resolver 8.8.8.8 8.8.4.4 valid=300s;
    resolver_timeout 5s;

    location / {
        proxy_pass http://localhost:8000;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
    }
}
