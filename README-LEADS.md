# Leads Management System

A comprehensive admin panel for managing leads with authentication, CRUD operations, search, filtering, and pagination.

## Features

- **Authentication System**: Admin-only access with role-based authentication
- **Leads Management**: Complete CRUD operations for leads
- **Search & Filtering**: Search leads by name, email, phone, company, etc.
- **Pagination**: Efficient pagination for large datasets
- **Dashboard**: Overview with statistics and recent leads
- **Modern UI**: Clean and responsive admin interface

## Requirements

- PHP 8.1 or higher
- Laravel 10.x
- MySQL/MariaDB
- Composer

## Setup Instructions

### 1. Database Configuration

Update your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Run Migrations

```bash
php artisan migrate
```

### 4. Seed Admin User and Roles

```bash
php artisan db:seed --class=RoleSeeder
```

This will create:
- An admin role
- An admin user with credentials:
  - **Email**: `admin@gmail.com`
  - **Username**: `admin`
  - **Password**: `admin@Leads2025`

### 5. Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## Login Credentials

- **Email/Username**: `admin@gmail.com` or `admin`
- **Password**: `admin@Leads2025`

## Routes

### Authentication
- `GET /login` - Login page
- `POST /login-attempt` - Handle login
- `POST /logout` - Logout

### Admin Panel
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/leads` - List all leads
- `GET /admin/leads/create` - Create new lead form
- `POST /admin/leads` - Store new lead
- `GET /admin/leads/{lead}` - View lead details
- `GET /admin/leads/{lead}/edit` - Edit lead form
- `PUT /admin/leads/{lead}` - Update lead
- `DELETE /admin/leads/{lead}` - Delete lead

## Lead Fields

The system manages the following lead information:
- Full Name (required)
- Email
- Primary Phone
- Secondary Phone
- Company Name
- Website
- Status (new, contacted, qualified, proposal, negotiation, won, lost)
- Source (website, social media, referral, email marketing, etc.)
- Country
- Disposition (text area)
- Additional Details (text area)
- Comments (text area)

## Features Overview

### Dashboard
- Total leads count
- Won leads count
- Active leads count
- In-progress leads count
- Recent leads table
- Leads distribution by status
- Quick action buttons

### Leads Management
- **List View**: Paginated table with search and filters
- **Create**: Form to add new leads
- **View**: Detailed lead information with quick actions
- **Edit**: Update lead information
- **Delete**: Remove leads with confirmation

### Search & Filtering
- Global search across multiple fields
- Filter by status
- Filter by source
- Pagination with query preservation

## File Structure

### Models
- `app/Models/Lead.php` - Lead model with relationships and scopes
- `app/Models/User.php` - User model with leads relationship

### Controllers
- `app/Http/Controllers/Admin/DashboardController.php` - Dashboard with statistics
- `app/Http/Controllers/Admin/LeadsController.php` - Complete CRUD operations
- `app/Http/Controllers/Auth/LoginController.php` - Authentication handling

### Views
- `resources/views/admin/dashboard-simple.blade.php` - Admin dashboard
- `resources/views/admin/leads/index.blade.php` - Leads listing with search/filter
- `resources/views/admin/leads/create.blade.php` - Create lead form
- `resources/views/admin/leads/edit.blade.php` - Edit lead form
- `resources/views/admin/leads/show.blade.php` - Lead details view
- `resources/views/auth/login.blade.php` - Login form

### Routes
- `routes/web.php` - Clean, organized route structure

## Security

- Authentication required for all admin routes
- Admin middleware protection
- CSRF protection on forms
- Input validation and sanitization
- SQL injection protection via Eloquent ORM

## Future Enhancements

- Email integration for lead communication
- Lead activity tracking
- Export functionality (CSV, PDF)
- Advanced reporting and analytics
- Lead assignment to users
- Automated lead scoring
- Integration with external CRM systems

## Troubleshooting

### 1. "Role already exists" Error
If you get this error when running the seeder, it means the admin role and user already exist. You can login with the existing credentials.

### 2. Permission Denied Errors
Make sure your web server has proper permissions to the storage and bootstrap/cache directories:

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 3. Database Connection Error
Verify your database credentials in the `.env` file and ensure the database exists.

## Support

For any issues or questions, please check the Laravel documentation or create an issue in the project repository. 