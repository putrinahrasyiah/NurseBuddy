# Database Design

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document defines the physical database design for the NurseBuddy web application.

It translates the Logical Entity Relationship Diagram (ERD) into a physical relational database structure that will be implemented using MySQL and Laravel Eloquent ORM.

The database is designed with the following objectives:

* Maintain data integrity
* Reduce redundancy
* Support scalability
* Follow Laravel conventions
* Ensure maintainability

---

# Database Management System

| Item              | Value            |
| ----------------- | ---------------- |
| Database          | MySQL 8.x        |
| Framework         | Laravel 12       |
| ORM               | Eloquent ORM     |
| Naming Convention | Laravel Standard |

---

# Table: users

## Purpose

Stores registered users of NurseBuddy.

| Column     | Data Type    | Constraint         | Description       |
| ---------- | ------------ | ------------------ | ----------------- |
| id         | BIGINT       | PK, Auto Increment | Primary Key       |
| name       | VARCHAR(255) | NOT NULL           | Full Name         |
| email      | VARCHAR(255) | UNIQUE             | User Email        |
| password   | VARCHAR(255) | NOT NULL           | Hashed Password   |
| avatar     | VARCHAR(255) | NULL               | Profile Image     |
| bio        | TEXT         | NULL               | Short Biography   |
| created_at | TIMESTAMP    |                    | Laravel Timestamp |
| updated_at | TIMESTAMP    |                    | Laravel Timestamp |

---

# Table: tasks

## Purpose

Stores personal academic and clinical tasks.

| Column      | Data Type    | Constraint         | Description       |
| ----------- | ------------ | ------------------ | ----------------- |
| id          | BIGINT       | PK                 | Primary Key       |
| user_id     | BIGINT       | FK                 | Owner             |
| title       | VARCHAR(255) | NOT NULL           | Task Title        |
| description | TEXT         | NULL               | Task Description  |
| priority    | ENUM         | Low, Medium, High  | Task Priority     |
| is_urgent   | BOOLEAN      | Default FALSE      | Urgent Flag       |
| deadline    | DATETIME     | NULL               | Due Date          |
| status      | ENUM         | Pending, Completed | Task Status       |
| created_at  | TIMESTAMP    |                    | Laravel Timestamp |
| updated_at  | TIMESTAMP    |                    | Laravel Timestamp |

Relationship

* user_id → users.id

Index

* user_id
* deadline

---

# Table: notes

## Purpose

Stores user personal notes.

| Column     | Data Type    | Constraint | Description       |
| ---------- | ------------ | ---------- | ----------------- |
| id         | BIGINT       | PK         | Primary Key       |
| user_id    | BIGINT       | FK         | Owner             |
| title      | VARCHAR(255) | NOT NULL   | Note Title        |
| content    | LONGTEXT     | NOT NULL   | Note Content      |
| created_at | TIMESTAMP    |            | Laravel Timestamp |
| updated_at | TIMESTAMP    |            | Laravel Timestamp |

Relationship

* user_id → users.id

Index

* user_id

---

# Table: mood_entries

## Purpose

Stores daily mood tracking.

| Column     | Data Type | Constraint                                          | Description         |
| ---------- | --------- | --------------------------------------------------- | ------------------- |
| id         | BIGINT    | PK                                                  | Primary Key         |
| user_id    | BIGINT    | FK                                                  | Owner               |
| mood       | ENUM      | Happy, Calm, Excited, Tired, Sad, Anxious, Stressed | Daily Mood          |
| reflection | TEXT      | NULL                                                | Personal Reflection |
| entry_date | DATE      | NOT NULL                                            | Mood Date           |
| created_at | TIMESTAMP |                                                     | Laravel Timestamp   |
| updated_at | TIMESTAMP |                                                     | Laravel Timestamp   |

Relationship

* user_id → users.id

Business Constraint

* One user may only create one mood entry per day.

Index

* user_id
* entry_date

Unique Constraint

* (user_id, entry_date)

---

# Table: study_categories

## Purpose

Stores learning material categories.

| Column      | Data Type    | Constraint | Description          |
| ----------- | ------------ | ---------- | -------------------- |
| id          | BIGINT       | PK         | Primary Key          |
| name        | VARCHAR(100) | UNIQUE     | Category Name        |
| description | TEXT         | NULL       | Category Description |
| created_at  | TIMESTAMP    |            | Laravel Timestamp    |
| updated_at  | TIMESTAMP    |            | Laravel Timestamp    |

---

# Table: study_materials

## Purpose

Stores educational resources.

| Column        | Data Type    | Constraint                            | Description       |
| ------------- | ------------ | ------------------------------------- | ----------------- |
| id            | BIGINT       | PK                                    | Primary Key       |
| category_id   | BIGINT       | FK                                    | Study Category    |
| title         | VARCHAR(255) | NOT NULL                              | Material Title    |
| description   | TEXT         | NULL                                  | Description       |
| resource_type | ENUM         | PDF, Image, YouTube, Website, Quizlet | Resource Type     |
| resource_url  | TEXT         | NOT NULL                              | File or URL       |
| thumbnail     | VARCHAR(255) | NULL                                  | Preview Image     |
| created_at    | TIMESTAMP    |                                       | Laravel Timestamp |
| updated_at    | TIMESTAMP    |                                       | Laravel Timestamp |

Relationship

* category_id → study_categories.id

Index

* category_id

---

# Table: drugs

## Purpose

Stores verified medication information.

| Column                 | Data Type    | Constraint | Description            |
| ---------------------- | ------------ | ---------- | ---------------------- |
| id                     | BIGINT       | PK         | Primary Key            |
| generic_name           | VARCHAR(255) | UNIQUE     | Generic Drug Name      |
| drug_category          | VARCHAR(100) | NOT NULL   | Drug Category          |
| dosage                 | TEXT         | NOT NULL   | Dosage Information     |
| indication             | TEXT         | NOT NULL   | Drug Indications       |
| side_effects           | TEXT         | NULL       | Side Effects           |
| nursing_considerations | TEXT         | NULL       | Nursing Considerations |
| created_at             | TIMESTAMP    |            | Laravel Timestamp      |
| updated_at             | TIMESTAMP    |            | Laravel Timestamp      |

Index

* generic_name

---

# Table: drug_aliases

## Purpose

Stores hospital-specific brand names contributed by users.

| Column           | Data Type    | Constraint | Description         |
| ---------------- | ------------ | ---------- | ------------------- |
| id               | BIGINT       | PK         | Primary Key         |
| drug_id          | BIGINT       | FK         | Related Drug        |
| user_id          | BIGINT       | FK         | Contributor         |
| hospital_name    | VARCHAR(255) | NOT NULL   | Hospital Name       |
| department       | VARCHAR(100) | NULL       | Department          |
| province         | VARCHAR(100) | NOT NULL   | Province            |
| brand_name       | VARCHAR(255) | NOT NULL   | Hospital Brand Name |
| contributor_note | TEXT         | NULL       | User Experience     |
| created_at       | TIMESTAMP    |            | Laravel Timestamp   |
| updated_at       | TIMESTAMP    |            | Laravel Timestamp   |

Relationship

* drug_id → drugs.id
* user_id → users.id

Index

* drug_id
* user_id
* hospital_name

---

# Table: drug_votes

## Purpose

Stores community voting for Drug Alias credibility.

| Column        | Data Type | Constraint       | Description       |
| ------------- | --------- | ---------------- | ----------------- |
| id            | BIGINT    | PK               | Primary Key       |
| drug_alias_id | BIGINT    | FK               | Drug Alias        |
| user_id       | BIGINT    | FK               | Voter             |
| vote          | ENUM      | Upvote, Downvote | Vote Type         |
| created_at    | TIMESTAMP |                  | Laravel Timestamp |
| updated_at    | TIMESTAMP |                  | Laravel Timestamp |

Relationship

* drug_alias_id → drug_aliases.id
* user_id → users.id

Business Constraint

* One user can only vote once for each Drug Alias.

Unique Constraint

* (user_id, drug_alias_id)

Index

* drug_alias_id
* user_id

---

# Referential Integrity Rules

| Parent Table     | Child Table     | On Delete | On Update |
| ---------------- | --------------- | --------- | --------- |
| users            | tasks           | Cascade   | Cascade   |
| users            | notes           | Cascade   | Cascade   |
| users            | mood_entries    | Cascade   | Cascade   |
| users            | drug_aliases    | Cascade   | Cascade   |
| users            | drug_votes      | Cascade   | Cascade   |
| drugs            | drug_aliases    | Cascade   | Cascade   |
| drug_aliases     | drug_votes      | Cascade   | Cascade   |
| study_categories | study_materials | Restrict  | Cascade   |

---

# Database Index Strategy

Indexes are added to improve search performance.

Indexed Columns:

* users.email
* tasks.user_id
* tasks.deadline
* notes.user_id
* mood_entries.user_id
* mood_entries.entry_date
* study_materials.category_id
* drugs.generic_name
* drug_aliases.drug_id
* drug_aliases.user_id
* drug_aliases.hospital_name
* drug_votes.drug_alias_id
* drug_votes.user_id

---

# Database Summary

| Table            | Purpose                        |
| ---------------- | ------------------------------ |
| users            | User accounts                  |
| tasks            | User task management           |
| notes            | Personal notes                 |
| mood_entries     | Daily mood tracking            |
| study_categories | Learning categories            |
| study_materials  | Educational resources          |
| drugs            | Official drug database         |
| drug_aliases     | Community hospital brand names |
| drug_votes       | Community credibility voting   |

---

# Conclusion

The NurseBuddy database is designed to support Version 1.0 of the application while remaining scalable for future enhancements. The schema follows Laravel naming conventions, enforces relational integrity through foreign keys and constraints, and applies indexing strategies to improve performance and maintainability.
