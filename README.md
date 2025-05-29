# NDC Drug Lookup App

A Laravel-based web application that allows users to search for drug information using NDC codes, manage saved entries, and export data. This project supports user authentication, dark/light theme switching, and offers a clean and functional UI built using Livewire and TailwindCSS.

This project showcases integration with external APIs (OpenFDA), as well as full CRUD interaction with a local database.

---

## Features

- 🔐 **Authentication**
  - Register, log in, log out
  - Change personal details (name, email)
  - Change password
  - Delete account

- 🔎 **NDC Drug Search**
  - Enter one or multiple NDC codes
  - Results are retrieved first from the local database, then from the OpenFDA API if not found
  - Graceful message if no match is found
  - Results displayed in a clean, table-based layout
  - CSV export of search results

- 💾 **Saved Drugs Page**
  - Displays all locally saved drugs in a paginated table
  - CSV export option

- ⚙️ **Settings**
  - Update profile info
  - Switch between light/dark mode (dark mode support is currently limited)
  - Delete account



---

## Tech Stack

- **Backend:** Laravel 12.0 (PHP 8.4.7)
- **Frontend:** Tailwind CSS, Blade, Livewire
- **Runtime:** Node.js 24.1.0 (for Vite)
- **API:** OpenFDA (for external NDC code searches)
- **Build Tool:** Vite
- **Database:** MySQL (or any Laravel-compatible DB)

---

## Installation

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js >= 18 (tested with 24.1.0)
- MySQL
- Git

### Steps

1. **Clone the repository**

   ```bash
   git clone <your-repo-url>
   cd <project-folder>
   ```

2. **Install PHP dependencies**

   ```bash
   composer install
   ```

3. **Install Node dependencies**

   ```bash
   npm install
   ```

4. **Set up environment**

   Copy the `.env.example` and configure your database credentials:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Run migrations**

   ```bash
   php artisan migrate
   ```

   **(Optional) Seed the database with dummy data:**

   ```bash
   php artisan migrate --seed
   ```

6. **Build frontend assets**

   ```bash
   npm run build
   ```

7. **Start development server**



     ```bash
     php artisan serve
     ```



---

## CSV Export Details

Both the search results table and the saved drugs table include a button to export their respective contents as a downloadable `.csv` file.

This export functionality is fully handled server-side and provides clean, ready-to-use files compatible with spreadsheet tools like Excel or Google Sheets.

---

## Contact

If you have any questions or feedback, feel free to reach out:

- drenmorina321@gmail.com
