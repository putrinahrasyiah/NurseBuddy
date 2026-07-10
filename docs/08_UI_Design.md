# UI Design

## NurseBuddy Web Application

**Version:** 1.0
**Project:** NurseBuddy

---

# Introduction

This document defines the User Interface (UI) design guidelines for NurseBuddy Version 1.0.

The objective of this document is to ensure that every page of the application follows a consistent visual style, provides an intuitive user experience, and supports nursing students in completing their daily activities efficiently.

The UI design is based on the initial wireframe created during the planning phase and will serve as the primary reference during the implementation using Laravel Blade.

---

# Design Philosophy

NurseBuddy is designed with the following principles:

* Simple
* Clean
* Friendly
* Professional
* Comfortable
* Easy to Learn

The interface should reduce cognitive load by presenting information clearly and minimizing unnecessary visual distractions.

---

# Target Users

The application is designed for:

* Nursing students
* Clinical practice students
* Newly graduated nurses
* Healthcare learners

The interface should be easy to understand, even for first-time users.

---

# Design Principles

The UI follows these principles:

### Simplicity

Only display information that users need.

Avoid unnecessary elements.

---

### Consistency

Every page should use:

* Same colors
* Same typography
* Same spacing
* Same buttons
* Same card styles

---

### Accessibility

* Easy to read
* High color contrast
* Large touch targets
* Responsive layout

---

### User-Centered Design

The application focuses on helping users complete their tasks quickly.

Navigation should require as few clicks as possible.

---

# Visual Style

NurseBuddy adopts a **Healthcare Minimalism** design style.

Characteristics:

* White background
* Rounded corners
* Soft shadows
* Blue as the primary color
* Plenty of whitespace
* Friendly illustrations
* Simple icons
* Clean typography

---

# Color Palette

| Purpose        | Color   |
| -------------- | ------- |
| Primary        | #4F8EF7 |
| Secondary      | #7AC7E3 |
| Success        | #34C759 |
| Warning        | #FFCC00 |
| Danger         | #FF3B30 |
| Background     | #F8FAFC |
| Card           | #FFFFFF |
| Text Primary   | #1F2937 |
| Text Secondary | #6B7280 |
| Border         | #E5E7EB |

---

# Typography

## Font Family

Primary Font:

**Poppins**

Fallback:

* Arial
* Sans-serif

---

## Font Hierarchy

| Element       | Size | Weight   |
| ------------- | ---- | -------- |
| Page Title    | 28px | Bold     |
| Section Title | 22px | SemiBold |
| Card Title    | 18px | SemiBold |
| Body Text     | 16px | Regular  |
| Small Text    | 14px | Regular  |
| Caption       | 12px | Light    |

---

# Icon Style

Icons should be:

* Rounded
* Simple
* Easy to recognize
* Consistent throughout the application

Recommended icon library:

* Heroicons
* Lucide Icons

---

# Layout Structure

Desktop Layout

```text
+------------------------------------------------------+
| Navbar                                               |
+------------------------------------------------------+
| Sidebar |                Main Content                |
|         |                                            |
|         |                                            |
|         |                                            |
+------------------------------------------------------+
```

---

Mobile Layout

```text
+-------------------------+
| Header                  |
+-------------------------+
|                         |
| Main Content            |
|                         |
+-------------------------+
| Bottom Navigation       |
+-------------------------+
```

---

# Navigation Structure

Main Navigation consists of:

* Dashboard
* Task Management
* Study Library
* Obatpedia
* Mood Tracker
* Notes
* Profile

---

# Dashboard Design

The Dashboard is the application's main screen.

Purpose:

Provide users with an overview of their daily activities.

Main Components:

* Greeting
* Today's Tasks
* Mood Check-in
* Study Progress
* Quick Access
* Recent Notes
* Reward Tree

Dashboard should prioritize the most important information at the top of the page.

---

# Task Management Page

Components:

* Task List
* Add Task Button
* Priority Badge
* Deadline
* Status Indicator
* Search Bar (Future Version)
* Filter (Future Version)

---

# Study Library Page

Components:

* Category Cards
* Learning Materials
* Search Bar
* Resource Type Badge
* Material Detail

Resource types include:

* PDF
* Image
* YouTube
* Website
* Quizlet

---

# Obatpedia Page

Components:

* Search Bar
* Drug Information Card
* Generic Name
* Brand Names
* Drug Category
* Dosage
* Indications
* Side Effects
* Nursing Considerations
* Community Drug Aliases
* Upvote / Downvote Buttons

---

# Mood Tracker Page

Components:

* Mood Selection
* Mood History
* Reflection Notes

Mood options:

* Happy
* Calm
* Excited
* Tired
* Sad
* Anxious
* Stressed

Users may only submit one mood entry per day.

---

# Notes Page

Components:

* Notes List
* Create Note
* Edit Note
* Delete Note

Notes are private and visible only to the owner.

---

# Profile Page

Components:

* Profile Picture
* Full Name
* Email
* Biography
* Account Information

Future Version:

* Statistics
* Achievements
* Badges

---

# Button Design

Primary Button

* Blue background
* White text
* Rounded corners
* Medium shadow

Secondary Button

* White background
* Blue border
* Blue text

Danger Button

* Red background
* White text

---

# Card Design

Cards should include:

* Rounded corners (16px)
* White background
* Soft shadow
* Consistent spacing
* Clear hierarchy

---

# Form Design

Forms should include:

* Labels above inputs
* Placeholder text
* Validation messages
* Required field indicators

---

# Responsive Design

The application should support:

* Mobile
* Tablet
* Desktop

Layouts should automatically adjust according to screen size.

---

# Accessibility

The UI should provide:

* Readable font sizes
* High color contrast
* Keyboard accessibility
* Proper form labels
* Responsive touch targets

---

# UI Consistency Rules

To maintain a professional appearance:

* Use one primary font family.
* Maintain consistent spacing.
* Use the same button style throughout the application.
* Use the same color palette on every page.
* Keep navigation consistent.
* Avoid unnecessary animations.
* Prioritize usability over decoration.

---

# Wireframe Reference

The UI implementation is based on the NurseBuddy wireframe prepared during the planning phase.

The wireframe serves as the initial visual blueprint for:

* Dashboard
* Task Management
* Study Library
* Obatpedia
* Mood Tracker
* Notes
* Navigation

Minor adjustments may be made during implementation to improve usability while preserving the original design concept.

---

# Future Improvements (Version 2)

The following enhancements are planned for future versions and are intentionally excluded from Version 1.0:

* Dark Mode
* Advanced Search
* Drag-and-Drop Task Management
* Push Notifications
* Achievement System Expansion
* AI Learning Assistant
* Mobile Application

---

# Conclusion

The NurseBuddy UI is designed to provide a clean, friendly, and professional experience for nursing students. By following the design principles and standards defined in this document, the application will maintain visual consistency, improve usability, and support efficient development throughout Version 1.0.
