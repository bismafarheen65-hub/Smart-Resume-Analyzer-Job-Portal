# Smart Resume Analyzer & Job Portal

An AI-powered web-based recruitment platform that connects job seekers and employers. The system allows users to create professional resumes, search and apply for jobs, while employers can post jobs and manage applicants.

## 📌 Project Overview

**Smart Resume Analyzer & Job Portal** is a database-driven web application developed as a Database Systems project.

The system has two main modules:

* **Job Seeker**
* **Employer**

Job seekers can create and manage their resumes, search for available jobs, analyze their resumes according to job requirements, and apply for suitable jobs.

Employers can create profiles, post job vacancies, manage their jobs, and view applicants.

The project also includes an **AI-based Resume Analysis** feature that compares the skills in a candidate's resume with the required skills of a job and provides a match percentage, matched skills, missing skills, and improvement suggestions.

---

## ✨ Key Features

### 👩‍💻 Job Seeker

* User Registration and Login
* Profile Management
* Resume/CV Builder
* Multiple Resume Templates
* Personal Information
* Education
* Work Experience
* Skills
* Projects
* Certifications
* Resume Preview
* Resume PDF Generation
* Job Search
* Job Application
* Application Management
* Resume Completion Status
* AI Resume Analysis

### 🏢 Employer

* Employer Registration and Login
* Employer Dashboard
* Company/Profile Management
* Post New Jobs
* Edit Job Posts
* Delete Job Posts
* Manage Job Vacancies
* View Applicants
* View Candidate Information and Resumes

### 🤖 AI Resume Analysis

The AI module analyzes a candidate's resume according to a selected job's requirements.

It provides:

* Resume-Job Match Percentage
* Matched Skills
* Missing Skills
* Resume Improvement Suggestions

---

## 🛠️ Technologies Used

| Technology     | Purpose                                           |
| -------------- | ------------------------------------------------- |
| **PHP**        | Backend development and server-side functionality |
| **MySQL**      | Database management and data storage              |
| **HTML**       | Structure of web pages                            |
| **CSS**        | Styling and page design                           |
| **JavaScript** | Client-side functionality and interaction         |
| **Bootstrap**  | Responsive user interface                         |
| **AI API**     | Resume and job skill matching                     |
| **Dompdf**     | Generating resumes in PDF format                  |
| **XAMPP**      | Local development environment                     |
| **phpMyAdmin** | Database administration                           |

---

## 🗄️ Database

The project uses **MySQL** as its relational database.

Database name:

```text
resumebuilder
```

The database stores information related to:

* Users
* Job Seekers
* Employers
* Resumes
* Education
* Experience
* Skills
* Projects
* Certifications
* Jobs
* Job Applications
* Resume Analysis

The SQL database file is included in this repository.

---

## 🔄 AI Resume Analysis Workflow

```text
Candidate Resume
       ↓
Resume Skills
       ↓
Job Required Skills
       ↓
AI Analysis
       ↓
Match Percentage
       ↓
Matched Skills + Missing Skills
       ↓
Improvement Suggestions
```

---

## 📄 Resume PDF Generation

The system allows job seekers to generate professional resumes in PDF format.

**Dompdf** is used to convert HTML-based resume templates into downloadable PDF documents.

---

## 📁 Project Structure

```text
Smart-Resume-Analyzer-Job-Portal/
│
├── ai_match.php
├── analyze_resume.php
├── applicants.php
├── apply_job.php
├── apply_jobs.php
├── create_cv.php
├── cv_status.php
├── dashboard.php
├── db.php
├── edashboard.php
├── edit_cv.php
├── elogin.php
├── eregister.php
├── generate_pdf.php
├── index.php
├── login.php
├── logout.php
├── my_applications.php
├── my_jobs.php
├── post_job.php
├── preview.php
├── profile.php
├── register.php
│
├── advanced.php
├── modern.php
├── simple.php
│
├── advanced_pdf.php
├── modern_pdf.php
├── simple_pdf.php
│
├── api.php
├── db.php
├── resumebuilder.sql
│
└── README.md
```

---

## ⚙️ Installation and Setup

### 1. Install XAMPP

Install XAMPP with:

* Apache
* MySQL
* phpMyAdmin

### 2. Clone the Repository

```bash
git clone https://github.com/bismafarheen65-hub/Smart-Resume-Analyzer-Job-Portal.git
```

### 3. Move the Project

Copy the project folder into:

```text
C:\xampp\htdocs\
```

### 4. Start XAMPP

Open XAMPP Control Panel and start:

```text
Apache
MySQL
```

### 5. Create the Database

Open phpMyAdmin:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
resumebuilder
```

Import the SQL file included in the repository.

### 6. Configure Database Connection

Update the database credentials in:

```text
db.php
```

according to your local MySQL configuration.

### 7. Configure AI API

Add your own API credentials in the API configuration file.

**Do not upload or expose your API key on GitHub.**

### 8. Run the Project

Open the project through XAMPP in your browser:

```text
http://localhost/Smart-Resume-Analyzer-Job-Portal/
```

---

## 🎯 Project Objectives

* Develop a centralized online recruitment platform.
* Provide professional resume creation and management.
* Allow employers to post and manage job vacancies.
* Allow candidates to search and apply for jobs.
* Store recruitment data using a relational database.
* Implement database CRUD operations.
* Provide AI-assisted resume analysis.
* Compare candidate skills with job requirements.
* Identify missing skills.
* Provide resume improvement suggestions.
* Generate professional resumes in PDF format.

---

## 🌱 Sustainable Development Goals

### SDG 4 — Quality Education

Helps students and job seekers improve their resumes and career readiness.

### SDG 8 — Decent Work and Economic Growth

Supports job searching, recruitment, and employment opportunities.

### SDG 9 — Industry, Innovation and Infrastructure

Uses web technologies, databases, PDF generation, and AI to provide a digital recruitment solution.

---

## 🎓 Academic Project

**Project:** Smart Resume Analyzer & Job Portal
**Course:** Database Systems
**Department:** Computer Engineering
**University:** COMSATS University Islamabad – Abbottabad Campus
**Semester:** Spring 2026

### Team Members

* Bisma Farheen
* Azka Kabir
* Fizza Razzaq

---

## 📸 Screenshots

Screenshots of the following modules can be added to this README:

* Home Page
* Registration and Login
* Job Seeker Dashboard
* Employer Dashboard
* Resume Builder
* Resume Templates
* Resume Preview
* Job Listings
* Job Application
* AI Resume Analysis
* Generated Resume PDF

---

## 🚀 Future Enhancements

* Advanced AI resume parsing
* Intelligent candidate ranking
* Email notifications
* Advanced job filtering
* Interview scheduling
* Online deployment
* Mobile application
* Enhanced authentication and security

---

## ⭐ Project

If you find this project useful, consider giving the repository a ⭐ star.
