# Testing Plan

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document defines the testing strategy for NurseBuddy Version 1.0.

The purpose of testing is to ensure that every feature functions correctly, data integrity is maintained, and users experience a reliable and consistent application.

Testing will be performed incrementally throughout development rather than only at the end of the project.

---

# Testing Objectives

The testing process aims to verify that:

* Every feature works as expected.
* Invalid inputs are properly handled.
* Database operations are accurate.
* Authentication is secure.
* User interface behaves consistently.
* Application remains stable after changes.

---

# Testing Strategy

Testing will be performed after completing each development module.

Each completed feature must pass all planned test cases before proceeding to the next module.

---

# Testing Scope

Modules to be tested:

* Authentication
* Dashboard
* Task Management
* Study Library
* Obatpedia
* Mood Tracker
* Notes
* Profile

---

# Testing Types

## Functional Testing

Verify that every feature performs its intended function.

Examples:

* Login
* Register
* Create Task
* Update Task
* Delete Task
* Search Drug
* Submit Mood
* Create Note

---

## Validation Testing

Ensure invalid input is rejected correctly.

Examples:

* Empty required fields
* Invalid email format
* Past deadlines
* Duplicate email registration
* Oversized file uploads

---

## Database Testing

Verify:

* Records are created correctly.
* Records are updated correctly.
* Records are deleted correctly.
* Relationships remain consistent.
* Foreign keys are enforced.

---

## Authentication Testing

Verify:

* Login
* Logout
* Session expiration
* Protected routes
* Unauthorized access prevention

---

## UI Testing

Verify:

* Buttons work correctly.
* Forms display properly.
* Navigation is consistent.
* Layout follows the UI Design document.

---

## Responsive Testing

Verify usability on:

* Mobile
* Tablet
* Desktop

---

# Module Test Checklist

## Authentication

* Register account
* Login
* Logout
* Invalid credentials
* Protected route access

Status:

⬜ Pending

---

## Task Management

* Create task
* Edit task
* Delete task
* Mark task completed
* Urgent flag
* Deadline validation

Status:

⬜ Pending

---

## Study Library

* View categories
* View materials
* Open PDF
* Open YouTube link
* Open website link

Status:

⬜ Pending

---

## Obatpedia

* Search medication
* View details
* Submit drug alias
* Upvote alias
* Downvote alias
* Prevent duplicate votes

Status:

⬜ Pending

---

## Mood Tracker

* Submit mood
* Update today's mood
* View mood history
* One mood entry per day

Status:

⬜ Pending

---

## Notes

* Create note
* Edit note
* Delete note
* View note

Status:

⬜ Pending

---

## Dashboard

Verify:

* Greeting displayed
* Tasks displayed
* Mood summary displayed
* Recent notes displayed
* Quick access links work

Status:

⬜ Pending

---

## Profile

Verify:

* Update profile
* Upload avatar
* Edit bio

Status:

⬜ Pending

---

# Bug Severity

| Severity | Description                 |
| -------- | --------------------------- |
| Critical | Application cannot be used  |
| High     | Core feature fails          |
| Medium   | Feature partially works     |
| Low      | Minor UI or usability issue |

---

# Acceptance Criteria

A module is considered complete when:

* All planned features are implemented.
* All test cases pass successfully.
* No critical bugs remain.
* No high-severity bugs remain.
* Documentation is updated.
* Code has been committed and pushed to GitHub.

---

# Regression Testing

Whenever a new feature is added, previously completed modules should be tested again to ensure no existing functionality has been broken.

---

# Final Testing Before Deployment

Before Version 1.0 is released:

* Complete application walkthrough
* Cross-module testing
* Database verification
* Responsive verification
* Final UI review
* README review
* GitHub repository review

---

# Testing Principles

Throughout development, the following principles should be followed:

* Test every completed feature.
* Fix bugs before building new features.
* Prioritize application stability.
* Verify database integrity.
* Maintain documentation alongside development.

---

# Conclusion

Testing is an integral part of the NurseBuddy development process.

By validating each module before moving to the next phase, Version 1.0 will achieve a stable, maintainable, and reliable release suitable for real-world use and portfolio presentation.