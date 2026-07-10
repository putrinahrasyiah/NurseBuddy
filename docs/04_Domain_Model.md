# Domain Model

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document defines the core business entities (domain objects) of the NurseBuddy system.

A Domain Model represents the real-world objects that exist within the application before considering database tables or implementation details.

It serves as the foundation for the Entity Relationship Diagram (ERD), Database Design, and Laravel Models.

---

# Domain Overview

NurseBuddy is built around several core entities that support productivity, learning, knowledge sharing, and personal well-being for nursing students.

The following entities represent the business domain of the application.

---

# 1. User

## Description

Represents a registered user of the NurseBuddy platform.

A user can manage tasks, notes, moods, and contribute knowledge to Obatpedia.

### Responsibilities

* Register an account
* Login
* Manage personal tasks
* Manage notes
* Record mood
* Browse study materials
* Search drug information
* Submit hospital drug aliases

---

# 2. Task

## Description

Represents an academic or clinical activity created by a user.

Tasks help users organize assignments, clinical responsibilities, exams, or reminders.

### Responsibilities

* Create task
* Update task
* Delete task
* Mark as completed
* Set priority
* Set deadline

---

# 3. Note

## Description

Represents personal notes created by users.

Notes may contain lecture summaries, clinical observations, or personal reminders.

### Responsibilities

* Create note
* Edit note
* Delete note

---

# 4. Mood Entry

## Description

Represents a user's daily emotional check-in.

Each mood entry contains the selected mood and an optional reflection.

### Responsibilities

* Record daily mood
* Save reflection
* View mood history

Business Rule:

One mood entry is allowed per user per day.

---

# 5. Study Material

## Description

Represents educational resources available within NurseBuddy.

Study materials include lecture notes, PDF references, nursing guides, and learning documents.

### Responsibilities

* Display learning material
* Search material
* Filter by category

---

# 6. Study Category

## Description

Groups study materials into organized learning topics.

Examples:

* Anatomy
* Pharmacology
* Medical Surgical Nursing
* Pediatric Nursing
* Emergency Nursing

### Responsibilities

* Organize study materials
* Improve searching
* Improve filtering

---

# 7. Drug

## Description

Represents a medication stored in Obatpedia.

Each drug contains official medical information.

### Information

* Generic Name
* Category
* Indications
* Dosage
* Side Effects
* Contraindications (Future)
* Nursing Considerations (Future)

### Responsibilities

Provide reliable drug information.

---

# 8. Drug Alias

## Description

Represents hospital-specific brand names submitted by the NurseBuddy community.

Different hospitals may use different commercial brands for the same generic medication.

Drug Alias enables users to share real clinical experiences.

### Information

* Hospital Name
* Province
* Brand Name
* Community Notes

### Responsibilities

* Share knowledge
* Improve medication recognition
* Help nursing students during clinical practice

---

# Entity Relationships Overview

The relationships between the entities are described conceptually below.

* One User can have many Tasks.
* One User can have many Notes.
* One User can have many Mood Entries.
* One User can submit many Drug Aliases.
* One Study Category can contain many Study Materials.
* One Drug can have many Drug Aliases.

These conceptual relationships will be transformed into the Entity Relationship Diagram (ERD) in the next design phase.

---

# Future Domain Expansion

The following entities are planned for future versions of NurseBuddy.

## Administrator

Responsible for:

* Managing study materials
* Managing drug database
* Reviewing community submissions
* Monitoring platform usage

---

## Community Discussion

Allows users to communicate, ask questions, and share nursing experiences.

---

## Hospital

Stores hospital information to standardize Drug Alias submissions.

---

## Achievement

Supports future gamification by rewarding active users for learning and community contributions.

---

## Notification

Provides reminders for deadlines, study goals, and mood check-ins.

---

# Domain Model Summary

| Entity         | Purpose                                                   |
| -------------- | --------------------------------------------------------- |
| User           | Represents a registered NurseBuddy user                   |
| Task           | Manages academic and clinical activities                  |
| Note           | Stores personal notes                                     |
| Mood Entry     | Records daily emotional well-being                        |
| Study Material | Stores educational resources                              |
| Study Category | Organizes study materials                                 |
| Drug           | Stores official medication information                    |
| Drug Alias     | Stores community-contributed hospital-specific drug names |

---

# Conclusion

The Domain Model defines the core business objects of NurseBuddy independently of any programming language, framework, or database.

It provides a shared understanding of the application's business domain and acts as the blueprint for the upcoming Entity Relationship Diagram (ERD), Database Design, and Laravel implementation.