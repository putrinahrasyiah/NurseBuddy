# Project Roadmap

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This roadmap defines the development plan for NurseBuddy Version 1.0.

Its purpose is to organize development into clear and manageable phases, ensuring that the project remains focused, maintainable, and achievable.

This roadmap also serves as a reference for tracking progress from planning to deployment.

---

# Project Goal

Develop a web-based learning companion for nursing students that helps users manage academic tasks, organize study materials, access verified medication information, and monitor personal well-being.

The first version prioritizes stability, usability, and learning experience over feature quantity.

---

# Development Strategy

The project follows an incremental development approach.

Each module will be completed independently before moving to the next module.

Every phase includes:

* Planning
* Development
* Testing
* Documentation
* Git Commit
* GitHub Push

A phase is considered complete only after all items above have been finished.

---

# Current Progress

| Phase                | Status        |
| -------------------- | ------------- |
| Project Planning     | ✅ Completed   |
| System Documentation | ✅ Completed   |
| UI Planning          | ✅ Completed   |
| Database Design      | ✅ Completed   |
| API Design           | ✅ Completed   |
| Laravel Development  | ⏳ In Progress |
| Task Management      | ✅ Completed   |
| Study Library        | ✅ Completed   |
| Obatpedia            | ✅ Completed   |
| Testing              | ⏳ Not Started |
| Deployment           | ⏳ Not Started |

---

# Phase 1 — Project Planning

Objective

Establish the project vision and technical foundation.

Deliverables

* Project Vision
* Software Requirement Specification
* User Flow
* Domain Model
* ERD
* Database Design
* System Flow
* UI Design
* API Design
* Project Roadmap

Status

✅ Completed

---

# Phase 2 — Laravel Project Setup

Objective

Prepare the Laravel project structure.

Tasks

* Configure Laravel project
* Configure MySQL database
* Configure environment (.env)
* Install authentication package
* Create Git repository structure
* Verify local development environment

Deliverables

* Running Laravel application
* Database connection
* Authentication ready

Status

✅ Completed

---

# Phase 3 — Authentication Module

Objective

Implement secure user authentication.

Tasks

* Login
* Register
* Logout
* Session Management
* Route Protection


Deliverables

* User authentication system

Status

✅ Completed

---

# Phase 4 — Task Management Module

Objective

Allow users to manage academic and clinical tasks.

Phase Goal

Deliver a complete task management workflow with secure CRUD operations, clear task states, and deadline-driven prioritization.

Scope

* User can create, view, update, and delete personal tasks.
* Each task supports priority, deadline, urgent flag, and status.
* Only authenticated users can access task management.
* Users can only access their own tasks.

Planned Features

* View Tasks
* Create Task
* Update Task
* Delete Task
* Priority (Low, Medium, High)
* Deadline
* Urgent Flag
* Task Status (Pending, In Progress, Done)
* Basic filtering by status and priority

Technical Tasks

* Create `tasks` migration and model relation with users
* Add `Task` model and `User -> hasMany(Task)` relation
* Build `TaskController` for CRUD actions
* Create Request Validation classes for store and update
* Define routes in `routes/web.php` with auth middleware
* Build Blade views for task list, create form, and edit form
* Add flash messages for create, update, and delete actions
* Implement query filtering for status and priority

Validation Rules (Minimum)

* Title: required, string, max length
* Description: nullable, text
* Priority: required, in allowed values
* Status: required, in allowed values
* Deadline: nullable, valid date
* Urgent: boolean

Testing Plan

* Feature tests for create/read/update/delete task
* Authorization tests to prevent cross-user task access
* Validation tests for invalid form input
* UI flow check for desktop and mobile layouts

Deliverables

* Fully functional Task Management module
* Protected task routes and ownership checks
* Passing feature tests for core task flows
* Updated documentation for task module usage

Definition of Done

* All task CRUD flows run without errors
* Data is stored correctly in database
* Unauthorized access is blocked
* Validation errors display properly in UI
* Tests for critical paths pass
* Changes committed and pushed to GitHub

Status

✅ Completed

---

# Phase 5 — Study Library Module

Objective

Provide verified learning resources.

Features

* Categories
* Study Materials
* Material Details
* PDF Resources
* External Links
* Images
* YouTube Resources
* Quizlet Resources

Deliverables

* Study Library

Status

✅ Completed

---

# Phase 6 — Obatpedia Module

Objective

Provide trusted medication information.

Features

* Drug List
* Search Drug
* Drug Details
* Drug Alias
* Community Upvote
* Community Downvote

Deliverables

* Obatpedia

Status

✅ Completed

---

# Phase 7 — Mood Tracker Module

Objective

Help users monitor emotional well-being.

Features

* Daily Mood Entry
* Reflection
* Mood History

Deliverables

* Mood Tracker

Status

⬜ Pending

---

# Phase 8 — Notes Module

Objective

Allow users to store personal learning notes.

Features

* Create Note
* Edit Note
* Delete Note
* View Notes
* Profile Page

Deliverables

* Personal Notes
* Profile Settings

Profile Module

- Edit Profile
- Upload Avatar
- Change Password
- Delete Account

Status

⬜ Pending

---

# Phase 9 — Dashboard Integration

Objective

Integrate all modules into a single dashboard.

Components

* Greeting
* Today's Tasks
* Mood Summary
* Study Progress
* Quick Access
* Recent Notes
* Reward Tree (UI only for Version 1.0)

Deliverables

* Dashboard

Status

⬜ Pending

---

# Phase 10 — Testing

Objective

Ensure system quality.

Testing Activities

* Functional Testing
* Form Validation
* CRUD Testing
* Authentication Testing
* Database Testing
* UI Testing
* Responsive Testing

Deliverables

* Stable Version

Status

⬜ Pending

---

# Phase 11 — Deployment

Objective

Publish NurseBuddy Version 1.0.

Tasks

* Production Configuration
* Database Migration
* Final Testing
* GitHub Repository Cleanup
* README Documentation
* Deployment
* Portfolio Screenshot

Deliverables

* Public NurseBuddy Website
* Complete GitHub Repository

Status

⬜ Pending

---

# Success Criteria

Version 1.0 is considered complete when:

* All planned modules are functional.
* Authentication works correctly.
* CRUD operations work without errors.
* Responsive layout functions properly.
* Database integrity is maintained.
* Documentation is complete.
* Source code is available on GitHub.
* Application is successfully deployed.

---

# Version 2 Backlog

The following ideas are intentionally postponed until after Version 1.0 is released:

* AI Learning Assistant
* Mobile Application
* Push Notifications
* Advanced Search
* Achievement System Expansion
* Resource Suggestions
* Community Discussion Forum
* Dark Mode
* Admin Dashboard
* Analytics Dashboard

These features are outside the scope of Version 1.0 and will only be considered after the successful completion and deployment of the first release.

---

# Development Principles

Throughout the project, the following principles will be maintained:

* Build one feature at a time.
* Complete before expanding.
* Prioritize functionality over visual perfection.
* Keep the code clean and maintainable.
* Follow Laravel best practices.
* Maintain complete documentation.
* Commit code regularly.
* Push every completed session to GitHub.

---

# Milestone Timeline

| Milestone                       | Status |
| ------------------------------- | ------ |
| Documentation Complete          | ✅      |
| Laravel Setup                   | ⬜      |
| Authentication                  | ⬜      |
| Task Management                 | ✅      |
| Study Library                   | ✅      |
| Obatpedia                       | ✅      |
| Mood Tracker                    | ⬜      |
| Notes                           | ⬜      |
| Dashboard                       | ⬜      |
| Testing                         | ⬜      |
| Deployment                      | ⬜      |
| NurseBuddy Version 1.0 Released | ⬜      |

---

# Conclusion

This roadmap provides a structured path from planning to deployment for NurseBuddy Version 1.0.

By following each phase sequentially and avoiding unnecessary scope expansion, the project will remain focused, maintainable, and achievable.

The ultimate objective is to deliver a fully functional, well-documented, and publicly deployed web application that demonstrates practical software engineering skills and serves as a professional portfolio project.