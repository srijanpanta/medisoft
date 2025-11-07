<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
Medisoft Application

A secure, full-stack Laravel-based Electronic Health Record (EHR) system for streamlined digital medical record management. Patients, doctors, and admins each have custom dashboards and permissions. The project includes real-time chat, email notifications, and robust role-based authorization.

***

## Table of Contents
- [Project Overview](#project-overview)
- [Key Features](#key-features)
- [Architecture](#architecture)
- [Technology Stack](#technology-stack)
- [Data Model](#data-model-core-entities)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Roadmap & Future Enhancements](#roadmap--future-enhancements)
- [Contributing](#contributing)
- [License](#license)

***

## Project Overview
This web application securely digitizes the management of medical records. Patients can store, update, and share their reports; doctors can access authorized data; and admins oversee verification and security. Features include real-time chat and district-based disease alerts, all designed for usability, safety, and reliability.

- **Replace paper-based with digital, portable, and secure records**
- **Facilitate doctor–patient interaction**
- **Implement real-time disease outbreak alerts**
- **Enforce role-based security and privacy**

***

## Key Features
- **Authentication & Authorization**  
  Secure registration/login (email verified), encrypted passwords, roles (patient/doctor/admin), doctor verification by admin, Laravel Gates & Policies for authorization
- **Patient Portal**  
  Create, read, update, and delete reports; connect to doctors; live chat (via Pusher); location-based disease notifications
- **Doctor Dashboard**  
  Manage verified profile, see connected patients, view/share authorized reports, real-time chat
- **Admin Panel**  
  Doctor verification, manage/report users, monitor system
- **Notification System**  
  Email and in-app notifications for disease warnings, new messages, and doctor requests
- **Security**  
  Strict access controls, encrypted storage, permission checks

***

## Architecture
- **Backend:** Laravel MVC pattern, Eloquent ORM, RESTful resource controllers, Laravel Auth middleware, Gates/Policies
- **Frontend:** Blade templates, Bootstrap 5, jQuery
- **Database:** MySQL, designed with EER/ERD principles
- **Real-Time:** Pusher (WebSocket for chat)
- **Notifications:** Mailchimp API for email alerts
- **Version Control:** GitHub

***

## Technology Stack
| Layer        | Technology     | Purpose                                  |
| ------------ | ------------- | ----------------------------------------- |
| Backend      | Laravel        | MVC, ORM, REST APIs, authorization       |
| Frontend     | Bootstrap      | User interface, responsive design        |
| Frontend     | jQuery         | Dynamic UI, AJAX                        |
| Database     | MySQL          | Structured, relational data              |
| Real-Time    | Pusher         | Live chat, instant notifications         |
| Email        | Mailchimp API  | Automated email, mass notifications      |
| Prototyping  | Figma          | UI/UX mockups                            |
| Versioning   | GitHub         | Source control and collaboration         |

***

## Data Model (Core Entities)
- **User:** Central entity, with role (doctor, patient, admin)
- **MedicalReport:** Patient's uploaded reports
- **DoctorPatient:** Doctor-patient relationship (friendship), stores permissions
- **Notification:** In-app and email alerts
- **ChatMessage:** Real-time communication
- **District:** Geographical location for tracking diseases

*See `/docs/database-design/` for ER diagrams/code samples.*

***

## Installation
1. **Clone the repo:**
   ```bash
   git clone <repository_url>
   cd medical-reports-webapp
   ```
2. **Install server dependencies:**
   ```bash
   composer install
   npm install && npm run dev
   ```
3. **Configure environment variables:**
   - Duplicate `.env.example` as `.env`
   - Fill in DB, Mail, and Pusher credentials
4. **Run DB migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```
5. **Run server:**
   ```bash
   php artisan serve
   ```

***

## Usage
- Access `http://localhost:8000`
- Register as patient, doctor, or admin
- Patients: Upload reports, manage doctor connections, receive alerts
- Doctors: View/manage authorized patient data, chat in real time
- Admins: Verify doctors, monitor system

***

## Testing
- Unit and feature tests for CRUD, role access, chat, and notifications
- Black-box (feature testing) and white-box (code coverage)
- Run tests:
  ```bash
  php artisan test
  ```
- Sample cases in `/tests/`

***

## Roadmap & Future Enhancements
- Integration with hospital data and booking systems
- Family accounts, shared access controls
- Mobile app (Flutter/React Native)
- Real-time hospital finder/locator
- Appointment scheduling and payments
- AI-driven outbreak prediction dashboard

***

## Contributing
Pull requests and suggestions are welcome! Fork the repo and submit a PR, or open an issue for discussion.

***

## License
MIT License

> **Author:** Srijan Panta
>
> For documentation, wireframes, and ERDs, visit "/docs" folder.img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
