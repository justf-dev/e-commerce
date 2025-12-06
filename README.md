# e-commerce

# Laravel E-commerce Platform

A complete, full-featured e-commerce platform built with Laravel 12, featuring user authentication, role-based access control, shopping cart functionality, and comprehensive admin dashboard.

## 🚀 Features

### Customer Features
- **User Authentication** - Registration, login, email verification
- **Product Browsing** - Browse products by categories
- **Shopping Cart** - Add, update, remove items from cart
- **Checkout Process** - Complete order placement with address management
- **Order History** - View past orders and order details
- **Profile Management** - Update personal information and password

### Admin Features
- **Dashboard** - Overview with user information and statistics
- **Product Management** - CRUD operations for products with image uploads
- **Category Management** - Organize products into categories
- **Order Management** - View and update order statuses
- **User Role Management** - Admin and customer role-based access

### Technical Features
- **Laravel 12** - Latest Laravel framework
- **Role-based Middleware** - Secure admin access control
- **File Uploads** - Product image management with storage links
- **Database Migrations** - Complete database schema
- **Seeders** - Sample data for development
- **Responsive UI** - Tailwind CSS styling
- **RESTful API** - Well-structured controllers and routes

## 🛠️ Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/justf-dev/e-commerce.git
   cd e-commerce
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   # Configure your database in .env file
   php artisan migrate
   php artisan db:seed
   ```

5. **Storage link**
   ```bash
   php artisan storage:link
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

## 📋 Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite

## 🗂️ Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   ├── Auth/           # Authentication controllers
│   │   └── ...             # Customer controllers
│   ├── Models/             # Eloquent models
│   └── Middleware/         # Custom middleware
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   └── css/js/             # Frontend assets
├── routes/
│   └── web.php             # Route definitions
└── storage/
    └── app/public/         # File uploads
```

## 🔐 Default Admin Account

After seeding the database, you can login with:
- **Email:** admin@example.com
- **Password:** password
- **Role:** admin

## 📝 API Endpoints

### Public Routes
- `GET /` - Home page
- `GET /products` - Product listing
- `GET /categories/{category}` - Category products
- `GET /products/{slug}` - Product details

### Authenticated Routes
- `GET /cart` - Shopping cart
- `POST /checkout/process` - Process order
- `GET /orders` - Order history

### Admin Routes (Role: admin required)
- `GET /admin/dashboard` - Admin dashboard
- `GET /admin/products` - Product management
- `GET /admin/categories` - Category management
- `GET /admin/orders` - Order management

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

If you encounter any issues or have questions, please open an issue on GitHub.
=======
# e-commerce
>>>>>>> c6e853e8aef196d05fc1a8a26c88f6e31489af1f
