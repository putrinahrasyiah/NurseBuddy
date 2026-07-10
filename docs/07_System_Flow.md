# System Flow

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document describes how the NurseBuddy system processes user requests internally.

Unlike the User Flow document, which focuses on user interactions, the System Flow explains what happens inside the application after a user performs an action.

The purpose of this document is to provide a clear understanding of the interaction between the Browser, Laravel Framework, Controllers, Models, Database, and Views.

---

# System Architecture Overview

```text
User
   │
   ▼
Browser
   │
   ▼
Laravel Routes
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
MySQL Database
   │
   ▼
Controller
   │
   ▼
Blade View
   │
   ▼
Browser
```

---

# 1. User Authentication Flow

## Objective

Authenticate a registered user before granting access to the application.

### System Flow

```text
User
   │
   ▼
Open Login Page
   │
   ▼
Enter Email & Password
   │
   ▼
POST Request
   │
   ▼
Laravel Route
   │
   ▼
Authentication Controller
   │
   ▼
Validate Input
   │
   ▼
Find User by Email
   │
   ▼
Verify Password Hash
   │
   ▼
Authentication Success?
   │
 ┌─┴───────────────┐
 │                 │
Yes               No
 │                 │
 ▼                 ▼
Create Session   Return Error
 │
 ▼
Redirect Dashboard
```

---

# 2. Dashboard Flow

## Objective

Display personalized information after successful login.

### System Flow

```text
User
   │
   ▼
Dashboard Request
   │
   ▼
Authentication Middleware
   │
   ▼
Dashboard Controller
   │
   ▼
Load Tasks
Load Notes
Load Mood
   │
   ▼
Return Dashboard View
```

---

# 3. Task Management Flow

## Create Task

```text
User
   │
   ▼
Task Form
   │
   ▼
POST Request
   │
   ▼
Task Controller
   │
   ▼
Validate Input
   │
   ▼
Task Model
   │
   ▼
Insert into Database
   │
   ▼
Redirect Task List
```

---

## Update Task

```text
User
   │
   ▼
Edit Task
   │
   ▼
PUT Request
   │
   ▼
Task Controller
   │
   ▼
Validate Input
   │
   ▼
Update Record
   │
   ▼
Redirect Task List
```

---

## Delete Task

```text
User
   │
   ▼
Delete Button
   │
   ▼
DELETE Request
   │
   ▼
Task Controller
   │
   ▼
Find Task
   │
   ▼
Delete Record
   │
   ▼
Redirect Task List
```

---

# 4. Study Library Flow

## Objective

Display educational resources.

### System Flow

```text
User
   │
   ▼
Study Library
   │
   ▼
Study Material Controller
   │
   ▼
Retrieve Materials
   │
   ▼
Filter by Category
   │
   ▼
Return Blade View
```

---

# 5. Obatpedia Flow

## Search Drug

```text
User
   │
   ▼
Search Keyword
   │
   ▼
GET Request
   │
   ▼
Drug Controller
   │
   ▼
Search Database
   │
   ▼
Retrieve Drug
Retrieve Drug Aliases
   │
   ▼
Return Result Page
```

---

## Submit Drug Alias

```text
User
   │
   ▼
Drug Detail Page
   │
   ▼
Submit Alias Form
   │
   ▼
POST Request
   │
   ▼
DrugAlias Controller
   │
   ▼
Validate Input
   │
   ▼
Store Alias
   │
   ▼
Redirect Drug Detail
```

---

## Vote Drug Alias

```text
User
   │
   ▼
Click Upvote / Downvote
   │
   ▼
POST Request
   │
   ▼
DrugVote Controller
   │
   ▼
Check Existing Vote
   │
 ┌─┴──────────────┐
 │                │
Exists          Not Exists
 │                │
 ▼                ▼
Update Vote    Create Vote
 │
 ▼
Update Vote Count
 │
 ▼
Return Response
```

---

# 6. Mood Tracker Flow

```text
User
   │
   ▼
Select Mood
   │
   ▼
POST Request
   │
   ▼
Mood Controller
   │
   ▼
Check Existing Entry
   │
 ┌─┴──────────────┐
 │                │
Exists          Not Exists
 │                │
 ▼                ▼
Update Mood     Create Entry
 │
 ▼
Save Reflection
 │
 ▼
Redirect History
```

---

# 7. Personal Notes Flow

```text
User
   │
   ▼
Create Note
   │
   ▼
POST Request
   │
   ▼
Note Controller
   │
   ▼
Validate Input
   │
   ▼
Store Note
   │
   ▼
Return Notes Page
```

---

# Error Handling Flow

```text
User Request
   │
   ▼
Laravel Validation
   │
 ┌─┴───────────────┐
 │                 │
Valid           Invalid
 │                 │
 ▼                 ▼
Continue      Return Validation Error
```

---

# Authorization Flow

```text
Request
   │
   ▼
Authentication Middleware
   │
 ┌─┴──────────────┐
 │                │
Logged In      Guest
 │                │
 ▼                ▼
Continue      Redirect Login
```

---

# Database Interaction Summary

| Module          | Main Table                        |
| --------------- | --------------------------------- |
| Authentication  | users                             |
| Dashboard       | users, tasks, notes, mood_entries |
| Task Management | tasks                             |
| Study Library   | study_materials                   |
| Obatpedia       | drugs, drug_aliases, drug_votes   |
| Mood Tracker    | mood_entries                      |
| Notes           | notes                             |

---

# Laravel Components Mapping

| Component  | Responsibility                                 |
| ---------- | ---------------------------------------------- |
| Route      | Receives incoming HTTP requests                |
| Middleware | Handles authentication and request filtering   |
| Controller | Processes business logic                       |
| Validation | Validates user input                           |
| Model      | Interacts with the database using Eloquent ORM |
| Blade View | Displays HTML pages                            |
| MySQL      | Stores application data                        |

---

# Conclusion

The System Flow illustrates how NurseBuddy processes each user request from the browser to the database and back to the user interface. It serves as a reference for implementing Laravel routes, controllers, middleware, models, and Blade views while ensuring a clear separation of responsibilities and maintainable application architecture.