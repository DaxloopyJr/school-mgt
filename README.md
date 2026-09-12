# School Management System

A complete school management system built with **Laravel 11 (Blade) + Bootstrap 5 + MySQL**.

## Feature Map

| Area | Modules |
|---|---|
| Administration | Admission query, visitor book, phone call log, postal receive/dispatch, complaints, certificates & ID card generation |
| Student Info | Categories, add/list students, daily & subject-wise attendance + reports, groups, promotion, disable/enable |
| Academics | Classes, sections (bulk create), subjects, optional subjects, class teachers, subject assignment, rooms, class times, class routine |
| Study Material | Upload content (jpg/png/jpeg/pdf/doc/docx/mp4/mp3), assignments, study material, syllabus, other downloads |
| Lesson Plan | Lessons, topics, lesson plans |
| Fees | Groups, types, masters, discounts, collect fees + invoice printing, payment/dues search, bank payments, carry forward, collection & monthly reports |
| Accounts | Account dashboard (income/expense/profit), income, expense, account list, payment methods, bank accounts, payment history |
| HR | Staff directory, staff attendance + report, payroll + payroll report |
| Examination | Marks grades, exam types (final mark from multiple exams), exam setup, schedules, exam attendance, mark register, send marks by SMS |
| Online Exam | Question bank (MCQ / true-false / fill-in-the-blank), online exams, timed auto-graded attempts |
| Homework | Add, list, evaluation report |
| Chat | 1:1 chat (jQuery polling), invitations (teacher↔parent), admin open chat, student→admin/accounts, file upload, block/unblock, teacher pinned messages |
| Communicate | Notice board, internal messages, email/SMS log, events, holidays |
| Library | Categories, books, members, issue/return, issued list, card numbers |
| Inventory | Categories, items, stores, suppliers, receive, sell, issue |
| Transport | Routes, vehicles, assignment, schedules, student transport report |
| Dormitory | Dormitories, room types, rooms, assignments, rooms monitoring, student dormitory report |
| Reports | Student, guardian, history, login, fees statement, balance fees, class, routines, merit list, online exam, mark sheet, tabulation, progress card, user log, previous result |
| Settings | General, role permission matrix, email, SMS, payment methods, academic years, weekend, language, backup, user management |
| Front CMS | Menus, news, courses, testimonials, contact messages, social links, unlimited pages, footer widgets, public website |
| Panels | Teacher (homework, evaluation, uploads, students, marks, attendance), Parent (children marks/invoices/routine/attendance/results, teacher messaging), Student (routine, marks, attendance, materials, invoices + online pay, chat, online exam) |

## Requirements

- PHP 8.2+, Composer, MySQL 8 (or MariaDB 10.4+)

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Edit `.env` and set your MySQL credentials:

```
DB_DATABASE=school_mgt
DB_USERNAME=root
DB_PASSWORD=secret
```

Then:

```bash
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open http://localhost:8000 — the public site is at `/`, admin login at `/login`.

## Demo Accounts (password: `password`)

| Role | Email |
|---|---|
| Admin | admin@school.com |
| Accountant | accounts@school.com |
| Teacher | teacher@school.com |
| Student | student@school.com |
| Parent | parent@school.com |

## Docker (all-in-one, includes MySQL)

```bash
docker build -t school-mgt .
docker run -p 8000:8000 school-mgt
```

The container starts MariaDB, creates the database, migrates, seeds, and serves the app on port 8000.

## Notes

- Uploaded files are stored in `storage/app/public` (run `storage:link`).
- Chat uses jQuery polling; to use Pusher instead, broadcast `ChatMessage` creation and swap the poller in `resources/views/chat/index.blade.php`.
- The online payment page is a demo gateway — integrate Stripe/SSLCommerz/bKash in `FeeController::payOnlineSubmit`.
- SMS sending is logged to the Email/SMS module; connect a real gateway in `MarksController::sendSms`.
