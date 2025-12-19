# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the mobilesentrix.com Laravel e-commerce application for selling mobile device parts and repair supplies. The project replicates the design and functionality of mobilesentrix.com with a custom admin dashboard using AdminLTE.

### Key Features
- E-commerce storefront for mobile device parts
- Multi-level mega menu navigation
- Product catalog with categories
- Shopping cart functionality
- AdminLTE-powered admin dashboard
- Reusable Blade components architecture

## Development Setup

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

## Common Commands

### Application Management
- `php artisan serve` - Start the development server (http://localhost:8000)
- `php artisan migrate` - Run database migrations
- `php artisan migrate:fresh --seed` - Fresh migration with seeders
- `php artisan db:seed` - Run database seeders
- `php artisan optimize:clear` - Clear all caches (config, route, view, cache)

### Asset Compilation
- `npm run dev` - Compile assets for development with hot reload
- `npm run build` - Build assets for production
- `npm run watch` - Watch files and recompile on changes (deprecated, use `npm run dev`)

### Testing
- `php artisan test` - Run PHPUnit tests
- `php artisan test --filter TestName` - Run a specific test
- `php artisan test --parallel` - Run tests in parallel

### AdminLTE
- `php artisan adminlte:install` - Install AdminLTE assets (already done)
- Admin dashboard accessible at `/admin`

## Architecture Notes

### Project Structure

```
├── app/
│   └── Http/
│       └── Controllers/
│           └── Admin/          # Admin panel controllers
│               ├── DashboardController.php
│               ├── ProductController.php
│               ├── CategoryController.php
│               └── OrderController.php
├── resources/
│   ├── views/
│   │   ├── components/        # Reusable Blade components
│   │   │   ├── layout/        # Layout components (app, header, footer, hero, search-bar)
│   │   │   ├── navigation/    # Navigation components (mega-menu, dropdown)
│   │   │   ├── product/       # Product components (card, featured-section, category-grid)
│   │   │   └── cart/          # Cart components (mini-cart)
│   │   ├── admin/             # Admin panel views
│   │   │   └── dashboard.blade.php
│   │   └── home.blade.php     # Homepage
│   └── css/
│       └── app.css            # Tailwind CSS with custom styles
├── routes/
│   └── web.php                # Web routes (frontend + admin)
└── config/
    └── adminlte.php           # AdminLTE configuration
```

### Blade Components

The project uses a component-based architecture for reusability:

#### Layout Components (`resources/views/components/layout/`)
- `app.blade.php` - Main application layout wrapper
- `header.blade.php` - Site header with navigation
- `footer.blade.php` - Site footer
- `hero.blade.php` - Hero/banner section with slider
- `search-bar.blade.php` - Search functionality

#### Navigation Components (`resources/views/components/navigation/`)
- `mega-menu-item.blade.php` - Multi-level mega menu dropdown
- `dropdown-item.blade.php` - Simple dropdown menu

#### Product Components (`resources/views/components/product/`)
- `card.blade.php` - Individual product card with pricing, ratings, stock
- `featured-section.blade.php` - Featured products section
- `category-grid.blade.php` - Category grid display

#### Cart Components (`resources/views/components/cart/`)
- `mini-cart.blade.php` - Mini cart dropdown

### Component Usage Examples

```blade
{{-- Main layout wrapper --}}
<x-layout.app>
    <x-slot name="title">Page Title</x-slot>
    {{-- Content --}}
</x-layout.app>

{{-- Mega menu with categories --}}
<x-navigation.mega-menu-item
    title="Apple"
    :items="[
        ['name' => 'iPhone', 'subcategories' => ['iPhone 15', 'iPhone 14']],
        ['name' => 'iPad', 'subcategories' => ['iPad Pro', 'iPad Air']]
    ]"
/>

{{-- Product card --}}
<x-product.card :product="[
    'name' => 'iPhone 15 Screen',
    'price' => 299.99,
    'rating' => 5,
    'stock' => 25
]" />
```

### Routes

**Frontend Routes:**
- `/` - Homepage

**Admin Routes (prefix: `/admin`):**
- `/admin` - Dashboard
- `/admin/products` - Product management (CRUD)
- `/admin/categories` - Category management (CRUD)
- `/admin/orders` - Order management (CRUD)

### Styling

The project uses:
- **Tailwind CSS v3** for utility-first styling
- **Custom CSS** in `resources/css/app.css` with theme customization
- **Alpine.js** for interactive components (dropdowns, modals, cart)
- **AdminLTE v3** for admin dashboard styling

#### Color Scheme
- Primary: `#0066cc` (blue)
- Primary Dark: `#004c99`
- Primary Light: `#3385d6`
- Secondary: `#f5f5f5` (light gray)

#### Font
- **Inter** (Google Fonts) for all text

### Design Patterns

1. **Component-First Architecture**: All UI elements are broken into small, reusable Blade components
2. **Prop-Based Configuration**: Components accept data via props for flexibility
3. **Slot Usage**: Components use slots for dynamic content injection
4. **Utility-First CSS**: Tailwind utilities are preferred over custom CSS
5. **Alpine.js for Interactivity**: State management handled with Alpine.js `x-data`, `x-show`, etc.

### Admin Dashboard

The admin dashboard uses AdminLTE 3 with:
- Sidebar navigation configured in `config/adminlte.php`
- Dashboard widgets showing stats (products, orders, revenue)
- Chart.js for data visualization
- Responsive tables for data display
- Bootstrap 4 components

To customize the admin menu, edit the `'menu'` array in `config/adminlte.php`.

### Frontend State Management

- **Cart State**: Managed with Alpine.js `x-data` in mini-cart component
- **Navigation State**: Managed with Alpine.js for mobile menu and dropdowns
- **Search State**: Managed with Alpine.js for search dropdown

## Development Guidelines

### Adding New Components

1. Create component file in appropriate `resources/views/components/` subdirectory
2. Use props for data: `@props(['title', 'items'])`
3. Follow naming convention: kebab-case for component names
4. Include Alpine.js directives for interactivity if needed

### Adding Admin Pages

1. Create controller in `app/Http/Controllers/Admin/`
2. Add route in `routes/web.php` under admin group
3. Create view extending `@extends('adminlte::page')`
4. Add menu item in `config/adminlte.php`

### Styling Guidelines

- Use Tailwind utility classes for styling
- Custom classes defined in `resources/css/app.css` using `@layer components`
- Maintain consistent spacing and color usage
- Follow mobile-first responsive design

## Environment Configuration

Key `.env` variables:
- `APP_URL` - Application URL
- `DB_*` - Database configuration
- `MAIL_*` - Mail service configuration (for order notifications)

## Notes for Future Development

- Product models and database migrations need to be created
- Shopping cart persistence (session/database)
- User authentication for customer accounts
- Payment gateway integration
- Order processing workflow
- Inventory management system
- Email notifications for orders
- Product search and filtering
- Product reviews and ratings
- SEO optimization
