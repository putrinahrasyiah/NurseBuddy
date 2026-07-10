# User Flow

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document describes how users interact with each module of NurseBuddy. It illustrates the journey from the user's perspective and serves as a bridge between the Software Requirement Specification (SRS) and the implementation phase.

---

# User Role

Primary User:

* Nursing Student

Secondary User:

* Newly Graduated Nurse

---

# 1. Authentication Flow

## Goal

Allow users to securely access NurseBuddy.

### Main Flow

```
Open Website
      │
      ▼
Landing Page
      │
      ▼
Click Login / Register
      │
      ▼
Enter Email & Password
      │
      ▼
Authentication Success
      │
      ▼
Dashboard
```

### Alternative Flow

```
Invalid Email or Password
      │
      ▼
Display Error Message
      │
      ▼
Try Again
```

### Result

The user successfully logs into NurseBuddy and is redirected to the Dashboard.

---

# 2. Dashboard Flow

## Goal

Provide users with a quick overview of their daily activities.

### Main Flow

```
Login
      │
      ▼
Dashboard
      │
      ├──────────────┐
      ▼              ▼
Today's Tasks   Mood Summary
      │              │
      ▼              ▼
Recent Notes   Upcoming Deadlines
      │
      ▼
Navigate to Feature
```

### Result

Users immediately understand their current activities and can quickly access any module.

---

# 3. Task Management Flow

## Goal

Help users organize academic and clinical tasks.

### Main Flow

```
Dashboard
      │
      ▼
Task Management
      │
      ▼
Create Task
      │
      ▼
Fill Task Form
      │
      ▼
Save
      │
      ▼
Task List
      │
      ├──────────────┐
      ▼              ▼
Edit Task     Mark Complete
      │              │
      ▼              ▼
Update Task    Task Completed
```

### Alternative Flow

```
Required Field Empty
      │
      ▼
Validation Error
      │
      ▼
Complete Required Information
```

### Result

Users can create, update, complete, and manage their daily tasks.

---

# 4. Study Library Flow

## Goal

Provide centralized learning resources.

### Main Flow

```
Dashboard
      │
      ▼
Study Library
      │
      ▼
Browse Categories
      │
      ▼
Search Material
      │
      ▼
Open Material
      │
      ▼
Read / Download
```

### Alternative Flow

```
No Search Result
      │
      ▼
Display Empty State
```

### Result

Users can easily access learning materials anytime.

---

# 5. Obatpedia Flow

## Goal

Help users learn medications while encouraging community knowledge sharing.

### Main Flow

```
Dashboard
      │
      ▼
Obatpedia
      │
      ▼
Search Drug
      │
      ▼
Drug Detail
      │
      ├─────────────────────────────┐
      ▼                             ▼
View Drug Information         View Community Alias
      │                             │
      ▼                             ▼
Generic Name                 Hospital Brand Name
Category                     Hospital Name
Dosage                       Province
Side Effects                 Community Notes
      │                             │
      └──────────────┬──────────────┘
                     ▼
            Return to Drug List
```

### Community Contribution Flow

```
Drug Detail
      │
      ▼
Add Hospital Alias
      │
      ▼
Fill Contribution Form
      │
      ▼
Submit
      │
      ▼
Waiting for Review
```

### Alternative Flow

```
Drug Not Found
      │
      ▼
Display "No Result"
```

### Result

Users can learn drug information and contribute practical knowledge from different hospitals.

---

# 6. Mood & Self-Care Flow

## Goal

Support users' emotional well-being.

### Main Flow

```
Dashboard
      │
      ▼
Mood Tracker
      │
      ▼
Select Today's Mood
      │
      ▼
Write Reflection
      │
      ▼
Save
      │
      ▼
Mood History
```

### Alternative Flow

```
Today's Mood Already Submitted
      │
      ▼
Display Existing Entry
```

### Result

Users can monitor their emotional condition over time.

---

# 7. Personal Notes Flow

## Goal

Allow users to keep personal notes related to learning or clinical practice.

### Main Flow

```
Dashboard
      │
      ▼
My Notes
      │
      ▼
Create Note
      │
      ▼
Write Content
      │
      ▼
Save
      │
      ▼
Notes List
      │
      ├─────────────┐
      ▼             ▼
Edit Note     Delete Note
```

### Result

Users can organize personal notes in one place.

---

# Overall User Journey

```
Open Website
      │
      ▼
Register
      │
      ▼
Login
      │
      ▼
Dashboard
      │
      ├─────────────────────────────────────────────┐
      ▼                                             ▼
Task Management                             Study Library
      │                                             │
      ▼                                             ▼
Manage Tasks                               Read Materials
      │
      ├─────────────────────────────────────────────┐
      ▼                                             ▼
Obatpedia                                  Mood Tracker
      │                                             │
      ▼                                             ▼
Learn Drugs                               Daily Reflection
      │
      ▼
Personal Notes
      │
      ▼
Logout
```

---

# Navigation Structure

```
Landing Page
│
├── Login
├── Register
│
└── Dashboard
     │
     ├── Task Management
     ├── Study Library
     ├── Obatpedia
     ├── Mood Tracker
     ├── Personal Notes
     ├── User Profile
     └── Logout
```

---

# Future User Flow

The following flows are planned for future versions of NurseBuddy:

* Email Verification
* Forgot Password
* Community Discussion
* Admin Dashboard
* Drug Submission Approval
* Push Notifications
* AI Learning Assistant
* Mobile Application Synchronization

---

# User Flow Summary

| Module             | Status    |
| ------------------ | --------- |
| Authentication     | Version 1 |
| Dashboard          | Version 1 |
| Task Management    | Version 1 |
| Study Library      | Version 1 |
| Obatpedia          | Version 1 |
| Mood Tracker       | Version 1 |
| Personal Notes     | Version 1 |
| Admin Dashboard    | Future    |
| Community Forum    | Future    |
| AI Assistant       | Future    |
| Mobile Application | Future    |
