# Mazzadk Auction Dashboard and RESTful API (Laravel)

Mazzadk is a full-stack Laravel-based auction platform offering both a RESTful API for mobile and web clients and a complete admin dashboard for managing the platform.

## Features
- User registration and authentication.
- RESTful API secured with Laravel Passport.
- Categories and product listings for auctions.
- Video uploads associated with products.
- Bidding system with real-time updates.
- Admin dashboard for managing users, categories, products, bids, and videos.
- Payment gateway integration (future scope).
- Role-based access control for admins and users.
- Notifications and alerts for bid status.

## Technologies Used
- Laravel 8+
- Laravel Passport (OAuth2 Authentication)
- MySQL Database
- RESTful API Architecture
- Bootstrap for Admin Dashboard UI

## Installation
1. Clone the repository.
2. Run `composer install`.
3. Set up `.env` file and configure database and other environment variables.
4. Run `php artisan migrate` and `php artisan db:seed` (optional dummy data).
5. Run `php artisan serve` to start the development server.

## Dummy Data
Includes seeder files for:
- Bids
- Categories
- Products
- Videos
- Admin users

## License
This project is licensed for demonstration and educational purposes.