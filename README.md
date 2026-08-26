# Fair Competition Tribunal (FCT) Website

A comprehensive Laravel 11 web application for the Fair Competition Tribunal of Tanzania. Features a dynamic frontend with content management and a fully-featured admin panel for managing all website content.

## Features

### Frontend
- **Three-layer header**: Government utility bar, identity bar with logos, navigation menu with dropdowns
- **Hero carousel** with leadership profiles (Chairperson & Registrar)
- **News & Events** section with article listing and detail pages
- **Information Center** with categorized resources
- **Publications** library with download capability
- **Team Members** display (Tribunal Members & Management)
- **Contact form** for public inquiries
- **Media Gallery** (Photo & Video)
- **Responsive design** using Bootstrap 5

### Admin Panel
- **Dashboard** with Chart.js visitor analytics
- **User Management** with role-based access control
- **Role Management** with customizable permissions
- **Pages Management** with parent-child hierarchy
- **News & Events** CRUD with featured images
- **Publications** upload (PDF/DOC) with cover images
- **Info Library** categorized document management
- **Hero Slides** management with sort ordering
- **Advertisements** with date range scheduling
- **Media Gallery** for photos and videos
- **Team Members** with categories and ordering
- **Contact Submissions** inbox with read/unread status
- **Site Settings** for configurable content
- **Visitor Reports** with daily/weekly/monthly analytics
- **Download Reports** tracking most downloaded files
- **Page View Reports** showing most visited pages

## Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade Templates, Bootstrap 5.3, Chart.js 4.x
- **Database**: PostgreSQL 16
- **Authentication**: Laravel Session-based Auth
- **File Storage**: Local disk

## Installation

### Prerequisites
- PHP 8.2+ (with the `pdo_pgsql` extension enabled)
- Composer
- PostgreSQL 16
- Node.js & NPM (optional, for asset building)

### Step 1: Clone and Install Dependencies
```bash
cd /path/to/project
composer install
```

### Step 2: Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and configure your database:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=fct_website
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Step 3: Create Database
```bash
psql -U postgres -c "CREATE DATABASE fct_website;"
```

### Step 4: Run Migrations and Seeders
```bash
php artisan migrate
php artisan db:seed
```

### Step 5: Create Storage Link
```bash
php artisan storage:link
```

### Step 6: Start the Application
```bash
php artisan serve
```

Visit `http://localhost:8000` for the frontend.

## Default Admin Credentials

| Role | Email | Password |
|------|-------|----------|
| Administrator | admin@fct.go.tz | password |
| Editor | editor@fct.go.tz | password |

Access the admin panel at: `http://localhost:8000/admin`

## Project Structure

```
fct/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Admin controllers
│   │   │   ├── Auth/           # Authentication
│   │   │   └── ...             # Frontend controllers
│   │   ├── Middleware/         # TrackVisitors, AdminAccess
│   │   └── Requests/           # Form request validations
│   ├── Models/                 # All Eloquent models
│   └── Providers/
├── database/
│   ├── migrations/             # 14 migration files
│   └── seeders/                # 11 seeders for initial data
├── resources/views/
│   ├── layouts/                # Frontend & Admin layouts
│   ├── components/             # Header, Footer, Sidebar
│   ├── auth/                   # Login page
│   ├── frontend/               # All frontend pages
│   └── admin/                  # All admin CRUD pages
├── routes/
│   ├── web.php                 # Frontend routes
│   └── admin.php               # Admin routes
└── public/
    ├── assets/images/          # FCT logo, profile images
    └── uploads/                # User-uploaded content
```

## Database Schema

The application includes 15 database tables:

- `roles` - User roles with permissions
- `users` - Admin users
- `pages` - CMS pages with parent-child hierarchy
- `news_events` - News articles and events
- `publications` - Downloadable publications
- `info_library` - Legal documents and case files
- `advertisements` - Scheduled banner ads
- `media_gallery` - Photos and videos
- `hero_slides` - Homepage carousel slides
- `team_members` - Tribunal staff profiles
- `contacts` - Contact form submissions
- `settings` - Configurable site settings
- `visitor_logs` - Detailed visitor tracking
- `visitor_stats_daily` - Aggregated daily visitor statistics

## Seeded Data

Running `php artisan db:seed` will populate:
- 3 roles (Admin, Editor, Viewer)
- 2 default users
- 11 site settings
- 30+ pages with parent-child hierarchy
- 6 team members
- 3 hero slides
- 5 news articles
- 5 publications
- 5 info library items
- 2 advertisements

## License

This project is proprietary software developed for the Fair Competition Tribunal of Tanzania.
