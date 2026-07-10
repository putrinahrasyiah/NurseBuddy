# Entity Relationship Diagram (ERD)

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document defines the logical data model of NurseBuddy.

It identifies the entities, their relationships, and the business rules governing the interactions between them.

The ERD serves as the foundation for the database schema, Laravel migrations, Eloquent models, and application logic.

---

# Entity List

The following entities are included in Version 1.0 of NurseBuddy.

| Entity        | Description                                              |
| ------------- | -------------------------------------------------------- |
| User          | Registered user of NurseBuddy                            |
| Task          | Personal academic or clinical task                       |
| Note          | Personal learning or clinical note                       |
| MoodEntry     | Daily mood record                                        |
| StudyCategory | Category of learning materials                           |
| StudyMaterial | Educational resources                                    |
| Drug          | Official medication information                          |
| DrugAlias     | Community-contributed hospital-specific drug brand names |
| DrugVote      | User votes for DrugAlias credibility                     |

---

# Entity Relationships

## 1. User → Task

Relationship:

**One User can have many Tasks.**

```
User (1)
      │
      │
      └──────────────< Task (Many)
```

Business Rules:

* Every task belongs to exactly one user.
* A user may create zero or many tasks.

---

## 2. User → Note

Relationship:

**One User can have many Notes.**

```
User (1)
      │
      │
      └──────────────< Note (Many)
```

Business Rules:

* Every note belongs to one user.
* Notes are private.

---

## 3. User → MoodEntry

Relationship:

**One User can have many Mood Entries.**

```
User (1)
      │
      │
      └──────────────< MoodEntry (Many)
```

Business Rules:

* One mood entry per user per day.
* Mood uses ENUM values.
* Reflection is optional.

---

## 4. StudyCategory → StudyMaterial

Relationship:

**One Study Category contains many Study Materials.**

```
StudyCategory (1)
        │
        │
        └──────────────< StudyMaterial (Many)
```

Business Rules:

* Every study material belongs to one category.
* Categories organize learning resources.

---

## 5. Drug → DrugAlias

Relationship:

**One Drug may have many Drug Aliases.**

```
Drug (1)
     │
     │
     └──────────────< DrugAlias (Many)
```

Business Rules:

* One drug may have multiple hospital brand names.
* Each DrugAlias references exactly one Drug.

---

## 6. User → DrugAlias

Relationship:

**One User can submit many Drug Aliases.**

```
User (1)
      │
      │
      └──────────────< DrugAlias (Many)
```

Business Rules:

* Every DrugAlias has one contributor.
* Users may contribute multiple aliases.

---

## 7. DrugAlias → DrugVote

Relationship:

**One DrugAlias may receive many votes.**

```
DrugAlias (1)
       │
       │
       └──────────────< DrugVote (Many)
```

Business Rules:

* Every vote belongs to one DrugAlias.
* Votes are either Upvote (+1) or Downvote (-1).

---

## 8. User → DrugVote

Relationship:

**One User may vote on many Drug Aliases.**

```
User (1)
      │
      │
      └──────────────< DrugVote (Many)
```

Business Rules:

* One user can only vote once per DrugAlias.
* Users may change their vote later.

---

# Entity Attributes (Logical)

## User

* User ID
* Full Name
* Email
* Password
* Avatar
* Bio
* Created At
* Updated At

---

## Task

* Task ID
* User ID
* Title
* Description
* Priority
* Is Urgent
* Deadline
* Status
* Created At
* Updated At

---

## Note

* Note ID
* User ID
* Title
* Content
* Created At
* Updated At

---

## MoodEntry

* Mood Entry ID
* User ID
* Mood
* Reflection
* Entry Date
* Created At

---

## StudyCategory

* Category ID
* Name
* Description

---

## StudyMaterial

* Material ID
* Category ID
* Title
* Description
* Resource Type
* Resource URL
* Thumbnail
* Created At

---

## Drug

* Drug ID
* Generic Name
* Drug Category
* Dosage
* Indication
* Side Effects
* Nursing Considerations
* Created At

---

## DrugAlias

* Alias ID
* Drug ID
* User ID
* Hospital Name
* Department
* Province
* Brand Name
* Contributor Note
* Created At

---

## DrugVote

* Vote ID
* User ID
* Drug Alias ID
* Vote Type
* Created At

---

# Business Rules

### User

* Every registered user has one account.
* Email must be unique.

---

### Task

* Tasks belong to one user.
* Tasks may be marked completed.
* Deadline is optional.
* Urgent is a boolean flag.

---

### Mood Entry

* Maximum one entry per day per user.
* Mood values are predefined ENUM values.

---

### Study Material

* Managed by administrators.
* Users may suggest resources in future versions.

---

### Drug

* Drug information is managed by administrators.
* Drug data must be medically verified.

---

### Drug Alias

* Community-generated.
* Multiple aliases are allowed.
* Hospital information is required.
* Brand names may differ between hospitals.

---

### Drug Vote

* One vote per user per alias.
* Vote may be updated.

---

# ERD Summary

```
User
 ├──────── Task
 ├──────── Note
 ├──────── MoodEntry
 ├──────── DrugAlias
 └──────── DrugVote

StudyCategory
 └──────── StudyMaterial

Drug
 └──────── DrugAlias
           └──────── DrugVote
```

---

# Future Expansion

The following entities are intentionally excluded from Version 1.0 but have been considered for future scalability:

* Administrator
* ResourceSuggestion
* Hospital
* Community Discussion
* Achievement
* Notification
* AI Assistant

The current ERD is designed to allow these entities to be integrated with minimal changes to the existing database structure.

---

# Conclusion

This Logical ERD establishes the core relationships between the entities in NurseBuddy Version 1.0.

It provides the blueprint for the next phase: **Database Design**, where logical attributes will be transformed into physical database tables, SQL data types, indexes, constraints, and Laravel migrations.
