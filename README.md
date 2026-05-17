# 🗳️ PECC Leader Election System

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**A full-stack web-based voting platform for organizational leader elections — built with Laravel 11, Livewire, and a modern frontend stack.**

[📸 Features](#-features) · [🧠 Tech Stack](#-tech-stack) · [🚀 Quick Start](#-quick-start) · [🏗️ Architecture](#%EF%B8%8F-architecture) · [📂 Project Structure](#-project-structure)

</div>

---

## 📖 About The Project

**PECC Leader Election** is a secure, role-based digital voting system built for PECC (an organization), enabling members to participate in structured, transparent leader elections online. The system replaces manual paper-based processes with a modern, auditable web platform.

This project demonstrates real-world software engineering practices including **role-based access control (RBAC)**, **reactive UI components**, **relational database design**, and **clean MVC architecture** — all within the Laravel ecosystem.

> 💡 **Why this project matters:** Digital voting systems are critical infrastructure for organizations of all sizes. Building one that is secure, user-friendly, and maintainable requires careful design decisions at every layer of the stack.

---

## ✨ Features

### 👤 For Voters (Members)
- 🔐 **Secure Authentication** — Login & registration powered by Laravel Breeze
- 🗳️ **Cast Votes** — One member, one vote enforcement via database-level constraints
- 📊 **Live Results** — Real-time vote tallies with ApexCharts visualizations
- 📅 **Election Timeline** — Calendar-based awareness of voting periods

### 🛠️ For Administrators
- 📋 **Candidate Management** — Create, update, and manage election candidates
- 🗓️ **Election Period Control** — Set and manage voting windows
- 👥 **Member & Role Management** — Assign roles with Spatie Laravel Permission
- 📈 **Dashboard Analytics** — At-a-glance statistics and interactive data tables
- 🔍 **Filterable Data Tables** — Powered by Rappasoft Laravel Livewire Tables

### 🔒 Security & Integrity
- Role-based access control (Admin, Voter roles)
- CSRF protection on all forms
- Vote deduplication at the database level
- Protected routes with Laravel middleware

---

## 🧠 Tech Stack

### Backend
| Technology | Version | Purpose |
|---|---|---|
| **Laravel** | 11.x | Core MVC framework |
| **PHP** | 8.2+ | Server-side language |
| **Spatie Permission** | 6.x | Role & permission management (RBAC) |
| **Rappasoft Livewire Tables** | 3.x | Dynamic, server-side data tables |
| **Laravel Breeze** | 2.x | Auth scaffolding (login, register) |
| **Laravel Tinker** | 2.x | REPL for debugging & seeding |

### Frontend
| Technology | Version | Purpose |
|---|---|---|
| **Blade** | Laravel 11 | Server-side templating (94.5% of codebase) |
| **Livewire** | 3.x | Reactive UI without writing JavaScript |
| **Alpine.js** | 3.x | Lightweight JS reactivity |
| **Tailwind CSS** | 4.x | Utility-first styling |
| **Flowbite** | 3.x | Tailwind UI component library |
| **ApexCharts** | 3.x | Interactive chart visualizations |
| **Simple DataTables** | 10.x | Client-side table enhancement |
| **Vite** | 6.x | Asset bundler |

### Icon Libraries
A rich set of Blade icon packs including **Feather Icons**, **Bootstrap Icons**, **Font Awesome**, **Carbon Icons**, **EOS Icons**, and more — enabling a consistent and expressive UI.

---

## 🗃️ Database Design

The application uses a **relational database** with the following core entities:

```
users           ─── id, name, email, password, ...
roles           ─── id, name, guard_name
permissions     ─── id, name, guard_name
model_has_roles ─── role_id ↔ model_id (pivot)

candidates      ─── id, name, vision, mission, photo, ...
elections       ─── id, title, start_date, end_date, status
votes           ─── id, user_id (FK), candidate_id (FK), election_id (FK)
```

> 🧩 **Database Constraint Insight:** The `votes` table enforces uniqueness on `(user_id, election_id)` so a voter can only cast one vote per election — this is a data-integrity pattern commonly used in real voting systems.

---

## 🏗️ Architecture

This project follows the **MVC (Model-View-Controller)** pattern as enforced by Laravel, extended with Livewire for reactive components.

```
Request → Route (routes/web.php)
            ↓
        Middleware (Auth, Role Check)
            ↓
        Controller (app/Http/Controllers)
            ↓
        Service / Model (Eloquent ORM)
            ↓
        Blade View / Livewire Component
            ↓
        Response (HTML / JSON)
```

**Key patterns used:**
- **RBAC (Role-Based Access Control)** via Spatie — separating admin and voter capabilities
- **Livewire Components** — keeping UI reactive without a separate SPA framework
- **Eloquent Relationships** — `hasMany`, `belongsTo`, `belongsToMany` for clean data access
- **Database Migrations & Seeders** — reproducible schema and test data

---

## 📂 Project Structure

```
PECC-Leader-Election/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Request handlers (MVC Controllers)
│   │   └── Middleware/         # Auth, role-based access guards
│   ├── Livewire/               # Reactive Livewire components
│   └── Models/                 # Eloquent models
├── database/
│   ├── migrations/             # Schema version control
│   └── seeders/                # Demo data for testing
├── resources/
│   └── views/
│       ├── components/         # Reusable Blade components
│       ├── admin/              # Admin panel views
│       └── voter/              # Voter-facing views
├── routes/
│   └── web.php                 # All named routes
├── tailwind.config.js          # Tailwind design tokens
├── vite.config.js              # Asset bundling config
└── composer.json               # PHP dependencies
```

---

## 🚀 Quick Start

### Prerequisites

Make sure you have the following installed:
- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm**
- **MySQL** or **SQLite**

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/Aiyon860/PECC-Leader-Election.git
cd PECC-Leader-Election

# 2. Install PHP dependencies
composer install

# 3. Install JavaScript dependencies
npm install

# 4. Configure environment
cp .env.example .env
php artisan key:generate

# 5. Set up database (edit .env with your DB credentials first)
php artisan migrate --seed

# 6. Build frontend assets
npm run build

# 7. Start the development server
php artisan serve
```

Visit `http://localhost:8000` 🎉

### Development Mode (Hot Reload)

```bash
# Terminal 1 — Laravel server
php artisan serve

# Terminal 2 — Vite dev server (hot module replacement)
npm run dev
```

---

## 🔑 Default Roles & Access

After seeding, the following roles are available:

| Role | Access |
|---|---|
| `admin` | Full dashboard, candidate & election management |
| `voter` | Browse candidates, cast vote, view results |

> You can assign roles via Tinker: `php artisan tinker` → `$user->assignRole('admin')`

---

## 🧪 Running Tests

```bash
# Run all feature and unit tests
php artisan test

# Run with coverage report
php artisan test --coverage
```

Tests are written with **PHPUnit** and located in the `tests/` directory.

---

## 📦 Key Dependencies Explained

| Package | What It Does | Why It Matters |
|---|---|---|
| `spatie/laravel-permission` | RBAC — roles & permissions per model | Industry-standard authorization layer |
| `rappasoft/laravel-livewire-tables` | Server-rendered, filterable data tables | Avoids heavy JS frameworks for CRUD UIs |
| `laravel/breeze` | Minimal auth scaffolding | Clean, customizable auth without Jetstream's bloat |
| `flowbite` | Tailwind component library | Pre-built accessible UI components |
| `apexcharts` | Chart library | Rich election result visualizations |

---

## 🤝 Contributing

Contributions are welcome! Here's how:

1. Fork the project
2. Create your feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add: your feature description'`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

Please make sure your code follows **PSR-12** coding standards and includes tests where appropriate.

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 👨‍💻 Author

Built by **[Aiyon860](https://github.com/Aiyon860)** as a practical full-stack project demonstrating:
- Real-world Laravel application architecture
- Role-based access control implementation
- Reactive UI with Livewire & Alpine.js
- Clean database design for integrity-critical systems

---

<div align="center">

⭐ If you found this project helpful or interesting, consider giving it a star!

</div>
