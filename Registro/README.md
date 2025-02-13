# 🎓 Student Grades Management System

This project is a **Student Grades Management System**, allowing students and administrators to manage subjects and grades. Admins can add, edit, and remove subjects, while students can view and insert grades.

## ✨ Features

- 🔑 **User Authentication:** Secure login for students and admins.
- 🛠 **Admin Panel:** Manage subjects (add, edit, delete).
- 📊 **Student Panel:** View grades and calculate the overall average.
- 📝 **Grade Entry:** Students can input their grades.
- 🚪 **Logout Functionality:** Securely ends the session.
- 📈 **Grade Statistics:** View detailed grade distribution and performance trends.
- 📅 **Academic Calendar:** Schedule and track exams or assignments.
- 📢 **Notifications System:** Alerts for new grades or upcoming exams.
- 🏆 **Leaderboard:** Compare performance with other students.

## 🛠 Technologies Used

- **PHP** (Backend logic)
- **MySQL** (Database)
- **HTML/CSS** (Frontend)

## 🗃 Database Structure

- **`studenti`**: Stores user credentials and roles.
- **`materie`**: List of subjects.
- **`voti`**: Stores student grades.

## 🔒 Security Notes

- Passwords are stored using MD5 (not recommended for production, consider bcrypt or Argon2).
- SQL queries should use prepared statements to prevent SQL injection.
- User sessions are managed securely to prevent unauthorized access.

## 🌟 Future Improvements

- 🔐 Implement password hashing with bcrypt.
- 🎨 Enhance UI/UX with modern frontend frameworks.
- 🔌 Add API endpoints for better integration.
- 📱 Develop a mobile-friendly version.
- 🧑‍🏫 Implement teacher roles with grading permissions.
- 📜 Add export functionality for reports (PDF, Excel).

## 📜 License

This project is licensed under the MIT License. Feel free to modify and distribute it.

## 👨‍💻 Author

Developed by **OraOtak**. Contributions are welcome! 🚀

