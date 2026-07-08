# Software Requirement Specification (SRS)

## NurseBuddy Web Application

**Version:** 1.0
**Document Status:** Draft
**Project:** NurseBuddy
**Prepared By:** Putri Nahrasyiah Ramadhan Mustafa
**Last Updated:** July 2026

---

# 1. Introduction

## 1.1 Purpose

This Software Requirement Specification (SRS) defines the functional and non-functional requirements for **NurseBuddy**, a web-based platform designed to help nursing students and early-career nurses organize their academic, clinical, and personal development activities.

The purpose of this document is to provide a clear understanding of the system's functionality, scope, user roles, and technical expectations before the development process begins.

---

## 1.2 Project Description

NurseBuddy is a centralized platform that combines productivity tools, study resources, drug references, and mental well-being support into a single web application.

The project is inspired by real experiences from nursing education, where students often struggle with scattered learning materials, busy clinical schedules, different medication brand names across hospitals, and emotional fatigue during practice.

Instead of switching between multiple applications, users can manage everything in one place through NurseBuddy.

---

# 2. Project Scope

## Included in Version 1.0

The first version of NurseBuddy will include the following modules:

* User Authentication
* Dashboard
* Task Management
* Study Library
* Obatpedia (Drug Information)
* Community Drug Knowledge Sharing
* Mood & Self-Care Tracker
* Personal Notes

---

## Excluded from Version 1.0

The following features are planned for future releases and are not included in the first version:

* Mobile Application (Android & iOS)
* AI Study Assistant
* Push Notifications
* Hospital Integration
* Community Discussion Forum
* Clinical Skill Assessment
* Video Learning Platform

---

# 3. User Roles

## Primary User

### Nursing Student

The primary user of NurseBuddy.

Permissions:

* Register an account
* Login and logout
* Manage personal tasks
* Access study materials
* Search drug information
* Save personal notes
* Record daily mood
* Submit community drug knowledge

---

## Secondary User

### Newly Graduated Nurse

Can use NurseBuddy to continue managing daily work, learning materials, and medication references during the transition into professional practice.

---

## Future User

The following user roles may be introduced in future versions:

### Administrator

Responsibilities:

* Manage study materials
* Moderate community submissions
* Manage drug database
* Remove inappropriate content
* Monitor application usage

---

# 4. Functional Requirements

Each requirement below describes what the system must be able to perform.

### Authentication

| ID     | Requirement                                                                   |
| ------ | ----------------------------------------------------------------------------- |
| FR-001 | The system shall allow users to register using an email address and password. |
| FR-002 | The system shall ensure each email address is unique.                         |
| FR-003 | The system shall securely encrypt user passwords before storing them.         |
| FR-004 | The system shall allow users to log in.                                       |
| FR-005 | The system shall allow users to log out.                                      |

---

### Dashboard

| ID     | Requirement                                                    |
| ------ | -------------------------------------------------------------- |
| FR-006 | The system shall display a personalized dashboard after login. |
| FR-007 | The dashboard shall display today's tasks.                     |
| FR-008 | The dashboard shall display upcoming deadlines.                |
| FR-009 | The dashboard shall display recent notes.                      |
| FR-010 | The dashboard shall display mood summary.                      |

---

### Task Management

| ID     | Requirement                                     |
| ------ | ----------------------------------------------- |
| FR-011 | Users shall be able to create tasks.            |
| FR-012 | Users shall be able to edit tasks.              |
| FR-013 | Users shall be able to delete tasks.            |
| FR-014 | Users shall be able to mark tasks as completed. |
| FR-015 | Users shall be able to assign task priority.    |
| FR-016 | Users shall be able to set task deadlines.      |

---

### Study Library

| ID     | Requirement                                       |
| ------ | ------------------------------------------------- |
| FR-017 | Users shall be able to browse learning materials. |
| FR-018 | Users shall be able to search study materials.    |
| FR-019 | Users shall be able to read notes and references. |

---

### Obatpedia

| ID     | Requirement                                                                                |
| ------ | ------------------------------------------------------------------------------------------ |
| FR-020 | Users shall be able to search medications.                                                 |
| FR-021 | The system shall display generic names, indications, dosage, side effects, and categories. |
| FR-022 | Users shall be able to view hospital-specific drug aliases submitted by the community.     |
| FR-023 | Users shall be able to submit new drug alias information for review.                       |

---

### Mood & Self-Care Tracker

| ID     | Requirement                                     |
| ------ | ----------------------------------------------- |
| FR-024 | Users shall be able to record their daily mood. |
| FR-025 | Users shall be able to view mood history.       |
| FR-026 | The dashboard shall display a mood summary.     |

---

### Personal Notes

| ID     | Requirement                          |
| ------ | ------------------------------------ |
| FR-027 | Users shall be able to create notes. |
| FR-028 | Users shall be able to edit notes.   |
| FR-029 | Users shall be able to delete notes. |

---

# 5. Non-Functional Requirements

## Performance

* The application should load the dashboard within 3 seconds under normal conditions.
* The application should provide smooth navigation between pages.

---

## Security

* Passwords must be encrypted.
* User authentication must be required before accessing protected pages.
* Each user may only access their own personal data.

---

## Availability

* Internet connection is required.
* The application will be available as a web application accessible through modern browsers.

---

## Compatibility

The application should support:

* Google Chrome
* Microsoft Edge
* Mozilla Firefox
* Safari

---

## Responsive Design

The application should work properly on:

* Desktop
* Tablet
* Mobile Browser

---

## Scalability

The system should be designed to allow future expansion without major changes to the existing database structure.

---

# 6. User Stories

* As a nursing student, I want to organize my daily clinical tasks so that I never miss important responsibilities.
* As a nursing student, I want to search drug information so that I can quickly understand medications during clinical practice.
* As a nursing student, I want to record my daily mood so that I can monitor my emotional well-being.
* As a nursing student, I want to keep all my study materials in one place so that learning becomes more efficient.
* As a nursing student, I want to share drug aliases used in different hospitals so that other students and nurses can benefit from real clinical experiences.

---

# 7. Business Rules

* Every user must register with a unique email address.
* A task belongs to exactly one user.
* A note belongs to exactly one user.
* Users can only edit or delete their own data.
* Community drug submissions are intended for knowledge sharing and may require administrator review in future versions.
* Mood entries are limited to one submission per day.

---

# 8. Assumptions & Constraints

## Assumptions

* Users have a stable internet connection.
* Users possess basic digital literacy.
* Drug information is provided for educational purposes and is not intended to replace professional medical judgment.

## Constraints

* Version 1.0 is web-based only.
* Offline mode is not supported.
* Mobile applications are outside the scope of Version 1.0.
* Only registered users can access the application's main features.

---

# 9. Future Enhancements

Future versions of NurseBuddy may include:

* AI-powered learning assistant
* Mobile application
* Push notifications
* Hospital collaboration
* Community discussion forum
* Clinical skill tracking
* Reward and gamification system
* Drug interaction checker
* Analytics dashboard
* Integration with educational institutions
