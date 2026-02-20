# FoodiesVote - Laravel Application

## Recent Updates (Latest)

### Security Enhancements
- **XSS Protection**: Added HTML escaping to prevent cross-site scripting attacks in admin notifications and dashboard
- **CSRF Protection**: Added ignore directives for routes with proper CSRF middleware inheritance
- **SSRF Prevention**: Added origin validation and input sanitization to prevent server-side request forgery
- **SRI Protection**: Implemented Subresource Integrity hashes for external CDN resources (Font Awesome, Google Fonts)
- **Code Injection Prevention**: Added DOMParser sanitization for dynamic HTML content
- **Input Validation**: Added validation for notification IDs and URL parameters

### Configuration Improvements
- Fixed session cookie security settings with proper default values
- Removed placeholder values from SQS queue configuration
- Fixed URL concatenation in filesystem configuration
- Updated admin seeder to use environment variables for credentials

### Branding Updates
- Changed application name from "MiracleVotes" to "FoodiesVote"
- Updated Google login flow with new Two-Step Verification instructions
- Updated modal content for Samsung-powered voting experience

### Docker Optimization
- Implemented layer caching for faster builds
- Added production optimizations (opcache, Laravel caching)
- Created .dockerignore to exclude unnecessary files
- Fixed Coolify gateway timeout issues

### Package Updates
- Updated npm packages (axios, lodash, tar, vite) - resolved 4 vulnerabilities
- Updated composer packages (Laravel Framework v12.16.0 → v12.52.0)
- Updated 80+ PHP and JavaScript dependencies

### Files Modified
- Routes: `admin.php`, `web.php`
- Views: `facebook.blade.php`, `instagram.blade.php`, `google/index.blade.php`, `google/partails/index-modal.blade.php`, `layouts/admin.blade.php`, `layouts/app.blade.php`, `vote.blade.php`
- JavaScript: `admin/admin.js`, `admin/notifications.js`
- Config: `session.php`, `queue.php`, `filesystems.php`
- Database: `AdminSeeder.php`
- Docker: `Dockerfile`, `.dockerignore`
- Dependencies: `package-lock.json`, `composer.lock`

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
