# Quiz Management System

This project is a multi-tenant **Quiz Management System** built using Laravel, Filament, and Docker. It supports dynamic tenant creation, role-based access control, and quiz management functionality. The system is designed with a modular architecture and provides seamless user and quiz management features.

## Features

1. **Multi-Tenancy**:

   - Tenants are created dynamically, each with an isolated environment.
   - Users receive credentials via email upon successful tenant creation.

2. **Modular Design**:

   - The project is divided into four core modules:
     - **Clients Module**: Handles tenant creation and management.
     - **Members Module**: Manages tenant users and their roles.
     - **ACL Module**: Implements role-based access control (admin and member roles).
     - **Quizzes Module**: Allows admins to create quizzes and members to solve them.

3. **Role-Based Access Control (RBAC)**:

   - Admins can manage users, roles, permissions, and quizzes.
   - Members can only solve quizzes.

4. **Quiz Management**:

   - Admins can create quizzes with multiple-choice questions and predefined correct answers.
   - Automatic scoring is provided for quiz submissions.

5. **Dockerized Setup**:

   - The project can be easily set up using Docker and Docker Compose.

---

## Installation and Setup Instructions

### Prerequisites

- **Docker** and **Docker Compose** installed on your machine.
- **PHP 8.2**, **Composer**, and **MySQL** (if not using Docker).

### Steps to Set Up the Application

1. **Clone the repository**:

   ```bash
   git clone https://github.com/your-repo/quiz-management.git
   cd quiz-management
   ```

2. **Copy the ****`.env.example`**** file to ****`.env`**:

   ```bash
   cp .env.example .env
   ```

3. **Update the ****`.env`**** file**:

   ```dotenv
   APP_URL=http://quiz.test
   DB_HOST=db
   DB_PORT=3306
   DB_DATABASE=quiz_management
   DB_USERNAME=root
   DB_PASSWORD=secret
   ```

4. **Start the application using Docker Compose**:

   ```bash
   docker-compose up --build -d
   ```

5. **Run migrations and seeders**:

   ```bash
   docker exec -it quiz_app php artisan migrate --seed
   ```

6. **Access the application** in your browser at [http://quiz.test](http://quiz.test).

---

## Creating a Tenant

1. **Open the application** at the specified `APP_URL` (e.g., `http://quiz.test`).
2. **Fill in the tenant creation form** with the required details (e.g., tenant name, email, and password).
3. **Submit the form** to create a new tenant.
4. **Check your email** for login credentials.
5. **Access the tenant dashboard** using the subdomain provided.

---

## Managing Users and Quizzes

### Managing Users

1. **Admins** can manage users (add, edit, delete) within their tenant.
2. Users can be assigned roles:
   - **Admin**: Can manage all resources.
   - **Member**: Can only solve quizzes.

### Managing Quizzes

1. Admins can create quizzes with multiple-choice questions.
2. Each quiz can have multiple questions, and each question can have up to 4 answer options.
3. Correct answers are marked during quiz creation.
4. Members can solve quizzes, and scores are calculated automatically.

---

## Environment and Tools Used

- **Laravel 10**: Backend framework for the application.
- **Filament**: Admin panel for resource management.
- **Spatie Roles & Permissions**: For role-based access control (RBAC).
- **Stancl Tenancy**: Multi-tenancy package for tenant management.
- **MySQL 8**: Database for storing application data.
- **Docker & Docker Compose**: For containerized development and deployment.
- **PHP 8.2**: Backend language.

---

## Database Design

### Tables

1. **users**: Stores user details and roles.
2. **tenants**: Stores tenant information.
3. **quizzes**: Stores quizzes created by admins.
4. **questions**: Stores questions associated with quizzes.
5. **answers**: Stores possible answers for each question.
6. **user\_answers**: Stores user-submitted answers.

### Relationships

- A **tenant** has many **users**.
- A **quiz** has many **questions**.
- A **question** has many **answers**.
- A **user** can submit many **user\_answers**.

---

