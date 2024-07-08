# RADIPLUS: A Collaborative Tool For Radiology Information Sharing

## Table of Contents
- [Introduction](#introduction)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Introduction
Radiplus is a comprehensive solution designed to manage and streamline radiology workflows. It allows for efficient handling of patient information, scheduling, imaging results, and reporting.

## Features
- Patient Management: Add, edit, and view patient details.
- Doctor Management: Manage doctor profiles and schedules.
- Appointment Scheduling: Book, reschedule, and cancel appointments.
- Imaging Records: Store and retrieve patient imaging results.
- Reporting: Generate detailed reports for patients and doctors.
- User Roles: Different access levels for administrators, doctors, and technicians.

## Technologies Used
- **Backend**: Laravel (PHP Framework)
- **Frontend**: Bootstrap, Blade Templating
- **Database**: MySQL
- **Other**: Composer, Laravel Mix

## Installation
## Installation

### Prerequisites
- PHP >= 7.4
  - [Download PHP](https://www.php.net/downloads.php)
- Composer
  - [Download Composer](https://getcomposer.org/download/)
- MySQL
  - [Download MySQL](https://dev.mysql.com/downloads/mysql/)


### Steps
1. **Clone the repository:**
   ```bash
   https://github.com/DebraJuma/Radiplus3.0.git
   cd ris
   ```

2.
**Install dependencies and copy env .file: Into your terminal type the following commands:**
  ```bash
  
composer install
```
```

```bash
cp .env.example .env
```
3.**Generate an application key:**

```bash
Copy code
php artisan key:generate
```
4.**Set up your database:**

Create a MySQL database for the project.
Update the .env file with your database credentials.
env
```
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
5 .**Run database migrations and seeders:**

```bash
php artisan migrate--seed
Compile assets:
```

6.**Start the development server:**

```bash

php artisan serve
```


## Configuration
### Environment Variables
Adjust the environment variables in the .env file as needed. Key variables include:

- APP_NAME
- APP_ENV
- APP_DEBUG
- DB_CONNECTION
- MAIL_*
## Usage
1. **Access the application:**
   Open your browser and navigate to `http://localhost:8000`.

2. **Admin Login:**
   - Username: `admin@example.com`
   - Password: `password`

3. **Managing Patients:**
   - Navigate to the Patients section to add, edit, or view patient information.
   - You can also view the history of appointments and medical records for each patient.
   - Use the search function to quickly find patient records.

4. **Managing Doctors:**
   - Navigate to the Doctors section to add, edit, or view doctor profiles.
   - Assign doctors to specific departments and manage their schedules.
   - View doctor availability and appointment history.

5. **Managing Radiologists:**
   - Navigate to the Radiologists section to add, edit, or view radiologist profiles.
   - Manage the schedules and assignments of radiologists.
   - Ensure that radiologists have access to relevant patient imaging records.
   - View radiologist workload and performance statistics.

6. **Scheduling Appointments:**
   - Use the Schedule section to book, reschedule, or cancel appointments.
   - Select the patient and the doctor/radiologist for the appointment.
   - Set the date and time, and add any necessary notes for the appointment.
   - View the calendar to see upcoming appointments and availability.

7. **Viewing Imaging Records:**
   - Access the Imaging section to view and manage patient imaging results.
   - Upload new imaging records and link them to the appropriate patient profile.
   - Allow doctors and radiologists to add notes and interpretations to the imaging records.

8. **Generating Reports:**
   - Use the Reports section to generate detailed reports for patients, doctors, and radiologists.
   - Customize reports based on date ranges, departments, and other criteria.
   - Export reports to PDF or Excel for easy sharing and documentation
  

RADIPLUS
├── Administration

│   ├── User Management
│   │   ├── Admins
│   │   ├── Doctors
│   │   └── Radiologists
│   ├── Role Management
│   │   ├── Permissions
│   │   └── Access Levels
│   └── Reports
├── Patient Management
│   ├── Patient Profiles
│   ├── Medical History
│   ├── Appointments
│   └── Imaging Records
├── Doctor Management
│   ├── Doctor Profiles
│   ├── Schedules
│   └── Specializations
├── Radiologist Management
│   ├── Radiologist Profiles
│   ├── Schedules
│   └── Imaging Records Access
├── Appointment Scheduling
│   ├── Booking
│   ├── Rescheduling
│   └── Cancellation
├── Imaging Records
│   ├── Upload
│   ├── View
│   └── Interpretation
└── Reporting
    ├── Patient Reports
    ├── Doctor Reports
    └── Radiologist Reports

## Contributing
We welcome contributions to the Radiology Information System project. Please follow these steps:

- Fork the repository.
- Create a new branch: git checkout -b feature-name.
- Make your changes and commit them: git commit -m 'Add new feature'.
- Push to the branch: git push origin feature-name.
- Submit a pull request.
## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Contact
For any inquiries or issues, please contact:

Email: debra.juma@strathmore.edu or Mercy.mwaniki@strathmore.edu
GitHub Issues: GitHub Issues
Thank you for using our Radiology Information System!



