# API Design

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document defines the application endpoints used by NurseBuddy Version 1.0.

Although NurseBuddy is implemented using Laravel Blade (Server-Side Rendering), every feature still communicates with the backend through HTTP requests handled by Laravel Routes and Controllers.

This API Design serves as the blueprint for implementing routes, controllers, request validation, and business logic during development.

---

# Technology

| Item           | Technology             |
| -------------- | ---------------------- |
| Framework      | Laravel 12             |
| Language       | PHP 8.x                |
| Rendering      | Blade Template Engine  |
| Database       | MySQL                  |
| Authentication | Laravel Authentication |

---

# Request Flow

```text
Browser
     │
     ▼
Laravel Route
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
Model (Eloquent ORM)
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

# Authentication Module

## Login

| Item        | Value              |
| ----------- | ------------------ |
| Method      | GET                |
| URL         | /login             |
| Description | Display login page |

---

| Item        | Value             |
| ----------- | ----------------- |
| Method      | POST              |
| URL         | /login            |
| Description | Authenticate user |

Input

* Email
* Password

Response

* Success → Redirect Dashboard
* Failed → Validation Error

---

## Logout

| Item        | Value               |
| ----------- | ------------------- |
| Method      | POST                |
| URL         | /logout             |
| Description | Logout current user |

---

# Dashboard Module

## Dashboard

| Item        | Value                  |
| ----------- | ---------------------- |
| Method      | GET                    |
| URL         | /dashboard             |
| Description | Display user dashboard |

Displayed Information

* Today's Tasks
* Mood Status
* Recent Notes
* Study Progress
* Quick Access

---

# Task Management Module

## View Tasks

GET

```text
/tasks
```

Purpose

Display all user tasks.

---

## Create Task Form

GET

```text
/tasks/create
```

Purpose

Display task creation form.

---

## Save Task

POST

```text
/tasks
```

Input

* Title
* Description
* Priority
* Is Urgent
* Deadline

Response

Task saved successfully.

---

## Task Detail

GET

```text
/tasks/{id}
```

Purpose

Display selected task.

---

## Edit Task

GET

```text
/tasks/{id}/edit
```

Purpose

Display edit form.

---

## Update Task

PUT

```text
/tasks/{id}
```

Purpose

Update existing task.

---

## Delete Task

DELETE

```text
/tasks/{id}
```

Purpose

Delete selected task.

---

# Study Library Module

## View Categories

GET

```text
/study-library
```

Purpose

Display study categories.

---

## View Materials by Category

GET

```text
/study-library/category/{id}
```

Purpose

Display learning materials within the selected category.

---

## View Material Detail

GET

```text
/study-library/material/{id}
```

Purpose

Display detailed learning material.

---

# Obatpedia Module

## View Drug List

GET

```text
/drugs
```

Purpose

Display all verified medications.

---

## Search Drug

GET

```text
/drugs?search=keyword
```

Purpose

Search medication by generic name.

---

## Drug Detail

GET

```text
/drugs/{id}
```

Purpose

Display medication details.

Displayed Information

* Generic Name
* Brand Names
* Category
* Dosage
* Indications
* Side Effects
* Nursing Considerations
* Community Aliases

---

## Submit Drug Alias

POST

```text
/drugs/{id}/aliases
```

Input

* Hospital Name
* Department
* Province
* Brand Name
* Contributor Note

Purpose

Allow users to share hospital-specific drug names.

---

## Vote Drug Alias

POST

```text
/drug-aliases/{id}/vote
```

Input

* Vote (Upvote / Downvote)

Purpose

Allow community members to evaluate alias credibility.

Business Rules

* One user may only vote once.
* Users may update their vote.

---

# Mood Tracker Module

## View Mood History

GET

```text
/moods
```

Purpose

Display mood history.

---

## Save Mood

POST

```text
/moods
```

Input

* Mood
* Reflection

Business Rules

* One mood entry per day.

---

## Update Mood

PUT

```text
/moods/{id}
```

Purpose

Update today's mood entry.

---

# Notes Module

## View Notes

GET

```text
/notes
```

Purpose

Display personal notes.

---

## Create Note

POST

```text
/notes
```

Input

* Title
* Content

---

## View Note

GET

```text
/notes/{id}
```

Purpose

Display selected note.

---

## Update Note

PUT

```text
/notes/{id}
```

Purpose

Update note.

---

## Delete Note

DELETE

```text
/notes/{id}
```

Purpose

Delete note.

---

# Profile Module

## View Profile

GET

```text
/profile
```

Purpose

Display user profile.

---

## Update Profile

PUT

```text
/profile
```

Input

* Name
* Avatar
* Bio

---

# Route Protection

The following pages require authentication:

* Dashboard
* Tasks
* Notes
* Mood Tracker
* Profile
* Submit Drug Alias
* Vote Drug Alias

Guest users may only access:

* Login
* Register
* Public Drug Information (Future Version)

---

# Validation Rules

Examples of validation:

Task

* Title is required.
* Deadline cannot be in the past.
* Priority must be Low, Medium, or High.

Mood

* One mood entry per day.

Drug Alias

* Hospital Name is required.
* Brand Name is required.
* Province is required.

Profile

* Email must be unique.
* Avatar must be an image.

---

# HTTP Status Reference

| Status | Meaning                          |
| ------ | -------------------------------- |
| 200    | Request successful               |
| 201    | Resource successfully created    |
| 302    | Redirect after successful action |
| 401    | Unauthorized                     |
| 403    | Forbidden                        |
| 404    | Data not found                   |
| 422    | Validation failed                |
| 500    | Internal server error            |

---

# Laravel Controller Mapping

| Module         | Controller              |
| -------------- | ----------------------- |
| Authentication | AuthController          |
| Dashboard      | DashboardController     |
| Tasks          | TaskController          |
| Study Library  | StudyMaterialController |
| Obatpedia      | DrugController          |
| Drug Alias     | DrugAliasController     |
| Drug Vote      | DrugVoteController      |
| Mood Tracker   | MoodController          |
| Notes          | NoteController          |
| Profile        | ProfileController       |

---

# Future API (Version 2)

The following endpoints are planned for future releases:

* AI Assistant
* Achievement System
* Notifications
* Resource Suggestions
* Community Discussion
* Mobile API

These endpoints are intentionally excluded from Version 1.0 to maintain a focused and achievable scope.

---

# Conclusion

This API Design document defines how the frontend communicates with the backend in NurseBuddy Version 1.0.

It provides a clear specification for Laravel Routes, Controllers, and application logic while ensuring that every module follows consistent request handling and validation practices.

The API design supports the project's vision of delivering a simple, reliable, and maintainable learning platform for nursing students while remaining scalable for future enhancements.