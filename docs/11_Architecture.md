# System Architecture

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document describes the overall software architecture of NurseBuddy Version 1.0.

Its purpose is to explain how each component of the application communicates, how data flows through the system, and how Laravel organizes the application's structure.

The architecture follows the Laravel MVC (Model-View-Controller) pattern to ensure maintainability, scalability, and clean separation of responsibilities.

---

# Architecture Overview

NurseBuddy is a web-based application developed using Laravel.

The application follows a layered architecture consisting of:

* Presentation Layer
* Routing Layer
* Controller Layer
* Business Logic Layer
* Data Access Layer
* Database Layer

---

# High-Level Architecture

```text
+-------------------------------------------------------+
|                    User (Browser)                     |
+-------------------------------------------------------+
                        │
                        ▼
+-------------------------------------------------------+
|                Laravel Blade (View)                   |
+-------------------------------------------------------+
                        │
                        ▼
+-------------------------------------------------------+
|                    Laravel Routes                     |
+-------------------------------------------------------+
                        │
                        ▼
+-------------------------------------------------------+
|                    Middleware                         |
+-------------------------------------------------------+
                        │
                        ▼
+-------------------------------------------------------+
|                    Controllers                        |
+-------------------------------------------------------+
                        │
                        ▼
+-------------------------------------------------------+
|                Eloquent Models                        |
+-------------------------------------------------------+
                        │
                        ▼
+-------------------------------------------------------+
|                     MySQL Database                    |
+-------------------------------------------------------+
```

---

# MVC Architecture

## Model

Responsible for:

* Database interaction
* Data relationships
* Business data representation

Examples:

* User
* Task
* Drug
* DrugAlias
* Mood
* Note
* StudyMaterial

---

## View

Responsible for:

* Displaying information
* User interaction
* Blade Templates

Located in:

```text
resources/views
```

---

## Controller

Responsible for:

* Receiving requests
* Validation
* Calling Models
* Returning Views

Examples:

* DashboardController
* TaskController
* DrugController
* MoodController
* NoteController
* ProfileController

---

# Module Architecture

```text
Dashboard
│
├── Task Management
├── Study Library
├── Obatpedia
├── Mood Tracker
├── Notes
└── Profile
```

Each module operates independently while sharing authentication and user information.

---

# Request Lifecycle

```text
Browser
      │
      ▼
Route
      │
      ▼
Middleware
      │
      ▼
Controller
      │
      ▼
Validation
      │
      ▼
Model
      │
      ▼
Database
      │
      ▼
Blade View
      │
      ▼
Browser
```

---

# Authentication Flow

```text
User
      │
      ▼
Login Form
      │
      ▼
Authentication
      │
      ▼
Session Created
      │
      ▼
Dashboard
```

Only authenticated users can access protected modules.

---

# Module Communication

Dashboard retrieves information from:

* Tasks
* Mood Tracker
* Notes

Study Library operates independently.

Obatpedia retrieves medication data and community aliases.

Each module communicates through Controllers and Models without directly accessing other modules.

---

# Database Layer

The application uses MySQL.

Database access is performed exclusively through Laravel Eloquent ORM.

Direct SQL queries should be avoided unless absolutely necessary.

---

# Security Layer

Security is provided through:

* Authentication
* Authorization
* CSRF Protection
* Input Validation
* Password Hashing
* Session Management

---

# File Storage

Uploaded files include:

* Profile Images
* Study Material PDFs
* Learning Images

Laravel Storage will be used for file management.

---

# Logging

Laravel Log will record:

* Application errors
* Exceptions
* Failed requests

Logs help diagnose issues during development and production.

---

# Scalability Considerations

Although Version 1.0 focuses on a monolithic architecture, the design allows future expansion by:

* Adding REST API
* Mobile Application
* Admin Dashboard
* AI Assistant

without major structural changes.

---

# Development Principles

The architecture follows these principles:

* Single Responsibility Principle
* Separation of Concerns
* Reusable Components
* Clean Code
* Laravel Best Practices

---

# Conclusion

The NurseBuddy architecture is designed to provide a clean, maintainable, and scalable foundation for Version 1.0.

Using Laravel MVC ensures that each application layer has a clear responsibility while keeping future enhancements manageable.