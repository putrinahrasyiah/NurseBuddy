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

Phase Goal

Deliver a simple and consistent daily mood journaling flow that is easy to use, secure per user, and reliable for long-term tracking.

Scope

* Authenticated users can record one mood entry per day.
* Each entry contains a mood selection and optional reflection text.
* Users can view their own mood history sorted by date.
* Users can update their own existing entry when needed.
* Users cannot access or modify another user's mood entries.

Planned Features

* Daily Mood Check-in
* Optional Reflection Note
* Mood History Timeline
* Filter History by Month
* Flash Feedback for Save and Update

Technical Tasks

* Create `mood_entries` migration with unique constraint `(user_id, entry_date)`
* Add `MoodEntry` model and `User -> hasMany(MoodEntry)` relation
* Build `MoodEntryController` for listing, storing, and updating entries
* Create Request Validation classes for store and update
* Define routes in `routes/web.php` under `auth` middleware
* Build Blade view for daily entry form and history list
* Add navigation access from dashboard and main menu
* Add ownership guard to block cross-user access

Validation Rules (Minimum)

* Mood: required, in allowed values
* Reflection: nullable, text, max length
* Entry Date: required, valid date
* Entry Date per user: unique per day

Testing Plan

* Guest cannot access mood routes
* Authenticated user can create daily mood entry
* User cannot create duplicate entry on same date
* User can update own entry
* User cannot update another user's entry
* Validation errors appear for invalid payload
* History page only shows current user's data

Deliverables

* Fully functional Mood Tracker module
* Daily check-in flow with one-entry-per-day rule
* Secure ownership checks for mood records
* Passing feature tests for core mood flows
* Updated documentation for mood module behavior

Definition of Done

* Mood entries are stored correctly in database
* Duplicate same-day entries are prevented
* Only owner can view and modify their entries
* Validation feedback is shown properly in UI
* Core feature tests pass
* Changes committed and pushed to GitHub

Deliverables

* Mood Tracker

Status

✅ Completed

---

# Phase 8 — Notes Module

Objective

Allow users to store personal learning notes.

Phase Goal

Deliver a practical personal notes workflow and basic profile settings so users can write study notes safely and maintain account information without leaving the app.

Scope

* Authenticated users can create, view, update, and delete their own notes.
* Notes support title, content, optional tags, and optional pinned status.
* Notes list supports search and basic sorting (latest and pinned first).
* Users can update basic profile data (name, email).
* Users can change password with current password confirmation.
* Users can optionally upload avatar image.
* Users can delete account with password confirmation.
* Users cannot access or modify another user's notes or profile data.

Features

* Create Note
* Edit Note
* Delete Note
* View Notes
* Search Notes
* Pin / Unpin Note
* Profile Page

Practical Features for Version 1.0

* Notes List Page (cards or table)
* Note Create Form
* Note Edit Form
* Note Delete Action with confirmation
* Search by title and content
* Pin notes for quick access
* Profile Edit (name and email)
* Avatar Upload (image only)
* Password Update
* Account Deletion

Technical Tasks

* Create `notes` migration with relation to `users` and ownership index.
* Add `Note` model and `User -> hasMany(Note)` relation.
* Build `NoteController` for index, store, update, and destroy.
* Create Request Validation classes for note store and update.
* Add authorization policy or ownership checks for every note action.
* Define protected routes in `routes/web.php` under `auth` middleware.
* Build Blade views for notes list, create, and edit.
* Implement simple query search and sorting logic for notes list.
* Integrate pin and unpin action with lightweight update endpoint.
* Use Laravel built-in profile update, password update, and account deletion flow.
* Add avatar upload path and storage linking (`storage:link`) if not yet configured.
* Add flash messages for all create, update, and delete actions.

Suggested Notes Table Fields

* id
* user_id (foreign key, cascade on delete)
* title (string)
* content (text)
* tags (nullable string for comma-separated tags in v1)
* is_pinned (boolean, default false)
* created_at
* updated_at

Validation Rules (Minimum)

* Title: required, string, max length
* Content: required, text
* Tags: nullable, string, max length
* Is Pinned: boolean
* Avatar: nullable, image, max size limit
* Name: required, string, max length
* Email: required, email, unique except current user
* Password Change: current password required, new password confirmation required
* Account Deletion: current password required

Testing Plan

* Guest cannot access notes and profile settings routes.
* Authenticated user can create, read, update, and delete own note.
* User cannot access or modify another user's note.
* Search only returns current user's matching notes.
* Pin and unpin action updates only owner note.
* Validation errors appear for invalid note and profile payloads.
* User can update own profile data.
* User can change password with valid current password.
* User can delete account after password confirmation.

Deliverables

* Fully functional Personal Notes module
* Basic Profile Settings module integrated with auth user
* Secure ownership and authorization checks for notes
* Passing feature tests for notes and profile critical flows
* Updated documentation for note usage and profile behavior

Definition of Done

* Notes CRUD works without errors for authenticated users
* Cross-user note access is blocked
* Search and pin behavior works as expected
* Profile update, password change, and account deletion work correctly
* Validation feedback is shown properly in UI
* Core feature tests pass
* Changes committed and pushed to GitHub

Implementation Priority

1. Notes migration, model, and relation
2. Notes CRUD controller and request validation
3. Notes views and list search
4. Pin and unpin support
5. Profile settings integration
6. Feature tests and bug fixes

Status

✅ Completed

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
| Laravel Setup                   | ✅      |
| Authentication                  | ✅      |
| Task Management                 | ✅      |
| Study Library                   | ✅      |
| Obatpedia                       | ✅      |
| Mood Tracker                    | ✅      |
| Notes                           | ✅      |
| Dashboard                       | ⬜      |
| Testing                         | ⬜      |
| Deployment                      | ⬜      |
| NurseBuddy Version 1.0 Released | ⬜      |

---

# Conclusion

This roadmap provides a structured path from planning to deployment for NurseBuddy Version 1.0.

By following each phase sequentially and avoiding unnecessary scope expansion, the project will remain focused, maintainable, and achievable.

The ultimate objective is to deliver a fully functional, well-documented, and publicly deployed web application that demonstrates practical software engineering skills and serves as a professional portfolio project.