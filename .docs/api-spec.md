# API & ROUTE SPECIFICATION: SURVEY KEPUASAN PORTABLE

## Public Routes
### 1. Landing Page
- **Route:** `GET /`
- **Controller:** `SurveyController@index`
- **Function:** Menampilkan Hero Split Screen dan Formulir Survey.

### 2. Submit Survey
- **Route:** `POST /survey`
- **Controller:** `SurveyController@store`
- **Parameters:**
  - `nama` (string, required)
  - `skor` (integer, 1-5, required)
  - `komentar` (string, nullable)
  - `captcha` (string, required)
- **Validation:** Case-Insensitive Captcha validation via session.
- **Success:** Redirect to `/` with Toast Success.

### 3. Captcha Generator
- **Route:** `GET /captcha`
- **Controller:** `SurveyController@generateCaptcha`
- **Output:** Image (PNG) with dynamic alphanumeric code stored in session.

## Admin Routes (Protected)
### 4. Admin Login
- **Route:** `GET /login`, `POST /login`
- **Controller:** `AdminController@showLogin`, `AdminController@login`
- **Middleware:** `guest`
- **Security:** Rate limiting (5 attempts/15 mins).

### 5. Admin Dashboard
- **Route:** `GET /dashboard`
- **Controller:** `AdminController@dashboard`
- **Middleware:** `auth`, `admin`
- **Output:** Stats summary & Chart.js visualization.

### 6. Export Data
- **Route:** `GET /admin/export`
- **Controller:** `AdminController@export`
- **Output:** CSV download with timestamped filename.

### 7. User Management
- **Route:** `GET /admin/users`, `POST /admin/users`, `DELETE /admin/users/{id}`
- **Controller:** `AdminController@users`, `AdminController@storeUser`, `AdminController@deleteUser`
- **Security:** CSRF Protected, Auth Guarded.
