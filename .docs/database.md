# DATABASE BLUEPRINT: SURVEY KEPUASAN PORTABLE

## Entity Relationship & Schema
### 1. Table: `users`
- `id` (Primary Key, BigInt)
- `name` (String)
- `email` (String, Unique)
- `password` (String, Hashed)
- `remember_token` (String, Nullable)
- `timestamps` (created_at, updated_at)

### 2. Table: `surveys`
- `id` (Primary Key, BigInt)
- `nama` (String)
- `skor` (Integer, 1-5)
- `komentar` (Text, Nullable)
- `timestamps` (created_at, updated_at)

### 3. Table: `settings`
- `id` (Primary Key, BigInt)
- `key` (String, Unique)
- `value` (Text)
- `timestamps` (created_at, updated_at)

## Initial Seeding Data
- **Admin:** admin@survey.com / admin123
- **Default Settings:** app_name, app_description, contact_email, footer_text.
- **Dummy Data:** 3+ realistic survey records for testing.
