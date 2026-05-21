# SYSTEM ARCHITECTURE: SURVEY KEPUASAN PORTABLE

## Data Flow Macro
1. **Presentation Layer:** 
   - Blade Templates + Alpine.js (Reactivity).
   - Tailwind CSS v4 (Styling via CDN).
   - Lucide Icons (Visual elements).
2. **Middleware Layer:**
   - `Authenticate.php`: Laravel default auth check.
   - `AdminMiddleware.php`: Custom role check for email `admin@survey.com`.
   - `VerifyCsrfToken.php`: Security against CSRF attacks.
3. **Business Logic Layer (Controllers):**
   - `SurveyController`: Handles public interactions (Form, Captcha).
   - `AdminController`: Handles administrative tasks (Dashboard, Users, Settings).
4. **Data Access Layer (Eloquent Models):**
   - `Survey`, `User`, `Setting` models communicating with SQLite.
5. **Storage Layer:**
   - `database/database.sqlite`: Local file-based database for portability.

## Environment Agnostic Strategy
- **Base URL:** Dynamic detection via Laravel's `URL` facade and relative asset paths.
- **Portability:** Bundled SQLite database and vendor dependencies (planned for distribution).
