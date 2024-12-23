# Event Management Dashboard

This is a web-based Event Management Dashboard designed to streamline the process of creating events, managing attendees, and tracking tasks. The application is developed using PHP, HTML, CSS, and JavaScript and integrates with a MySQL database.

## Features

### 1. Login System
- Secure user authentication using PHP sessions.

### 2. Event Management
- Add, view, edit, and delete events.
- Display event details including name, description, location, and date.

### 3. Attendee Management
- Add and view attendees.
- Delete attendees.
- Assign attendees to specific events.

### 4. Task Tracker
- Add tasks associated with events.
- View tasks for specific events.
- Update task status (Pending/Completed).

## File Structure

### Frontend
- `index.html`: Login page.
- `events.html`: Dashboard for managing events.
- `styles.css`: Styling for the application.
- `login.js`: Handles login functionality.
- `events.js`: Manages frontend interactions for events.

### Backend
- `login.php`: Handles user authentication.
- `events.php`: API for managing events.
- `attendees.php`: API for managing attendees.
- `tasks.php`: API for managing tasks.

### Database
- `db_setup.sql`: SQL script to create and set up the database.

## Installation Instructions

### Prerequisites
- PHP (7.4 or above)
- MySQL (5.7 or above)
- A web server (e.g., Apache via XAMPP or WAMP)

### Steps
1. **Database Setup**:
   - Import the `db_setup.sql` file into your MySQL database:
     ```bash
     mysql -u root -p < db_setup.sql
     ```

2. **File Setup**:
   - Extract the project files into your server's root directory:
     - For XAMPP: `C:\xampp\htdocs\event_management_dashboard`
     - For WAMP: `C:\wamp64\www\event_management_dashboard`

3. **Run the Application**:
   - Start your local server (Apache and MySQL).
   - Open the following URLs in your browser:
     - **Login Page**: `http://localhost/event_management_dashboard/index.html`
     - **Events Page**: `http://localhost/event_management_dashboard/events.html`

4. **Add a Test User**:
   - Use the following SQL command to add a user for testing:
     ```sql
     INSERT INTO users (username, password) VALUES ('testuser', PASSWORD('testpassword'));
     ```

5. **Testing**:
   - Log in using the credentials `testuser` and `testpassword`.

## API Endpoints

### Events
- `GET /events.php`: Retrieve all events.
- `POST /events.php`: Add a new event.
- `DELETE /events.php`: Delete an event.

### Attendees
- `GET /attendees.php`: Retrieve all attendees.
- `POST /attendees.php`: Add a new attendee.
- `DELETE /attendees.php`: Delete an attendee.

### Tasks
- `GET /tasks.php?event_id={event_id}`: Retrieve tasks for an event.
- `POST /tasks.php`: Add a new task.
- `PUT /tasks.php`: Update a task's status.

## Technologies Used
- PHP
- MySQL
- HTML/CSS
- JavaScript

## License
This project is licensed under the MIT License.

# event_management_final
