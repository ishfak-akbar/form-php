# 🧾 User Registration System

A modern, interactive web application built with **PHP**, **MySQL**, **JavaScript (AJAX)**, **HTML**, **CSS**, and **Tailwind CSS**.  
This project allows users to **register, view, edit, and delete** data — all dynamically without reloading the page — using a clean, modular, and responsive interface.

It demonstrates how to build a **real-time PHP CRUD system** with separated frontend and backend logic, ensuring **better performance, maintainability, and scalability**.

---

## 🚀 Features

✅ **User Registration** — Register new users with validation and instant AJAX feedback.  
🔍 **View Registered Users** — Instantly fetch and display users in a responsive, Tailwind-styled table/list.  
✏️ **Edit & Update Data** — Edit user details dynamically using a modal popup.  
❌ **Delete Users** — Remove users instantly without reloading the page.  
🕒 **Timestamps** — Each record includes a creation date/time (`created_at`).  
⚡ **AJAX-Powered CRUD** — All actions are asynchronous for a smoother user experience.  
🎨 **Responsive UI** — Clean, mobile-friendly layout built with Tailwind CSS.  
🔗 **Well-Structured Files** — Independent PHP, CSS, and JS files for modularity and clarity.  
🧱 **Auto Table Creation** — Database tables created automatically on first run.  
🔐 **Secure Password Handling** — User passwords are hashed using PHP’s `password_hash()`.

---

## 🧠 Technologies Used

| Technology | Purpose |
|-------------|----------|
| **HTML5** | Structure and layout of pages |
| **CSS3** | Custom styling and layout adjustments |
| **Tailwind CSS** | Utility-first framework for sleek responsive UI |
| **JavaScript (AJAX)** | Frontend interactivity and async communication |
| **PHP (MySQLi)** | Backend logic and database management |
| **MySQL** | Storing and managing user data |
| **XAMPP** | Localhost environment for PHP + MySQL |

---

## 📂 Project Structure

📁 **PHP-User-Form**
- 📄 `index.php` — Main registration page (Form + Live User List)  
- ⚙️ `process.php` — Handles AJAX CRUD operations (Add / Edit / Delete / Fetch)  
- 🧠 `script.js` — AJAX logic for form submission and modals  
- 🎨 `styles.css` — Custom CSS and Tailwind overrides  
- 🖼️ `bg2.jpg` — Background image for layout  
- 📘 `README.md` — Project documentation  

---

## ⚙️ Setup Instructions

1. **Place the project** inside your XAMPP `htdocs` directory:
C:\xampp\htdocs\PHP-User-Form

2. **Start** Apache and MySQL from the **XAMPP Control Panel**.

3. **Create a database:**
- Visit [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Create a database named:
  ```
  form
  ```
*(Tables will be created automatically when you run the project.)*

4. **Run the project:**
http://localhost/WebProgramming/form_2/


✅ Now you can register users, view them live, edit, and delete seamlessly — all without page reloads.

---

## 📸 Screenshots

| Registration Page | User List | Edit Modal |
|-------------------|------------|-------------|
| ![Form Screenshot](form_2/assets/form-preview.png) | ![List Screenshot](form_2/assets/list-preview.png) | ![Edit Modal Screenshot](form_2/assets/edit-modal.png) |


---

## 🔒 Security Highlights

- Input sanitized using `real_escape_string()`  
- Passwords hashed using `password_hash()`  
- Separate backend logic prevents direct access exploits  
- No page reloads → less chance of form resubmission issues  

---

## 🧰 Additional Notes

- Tailwind CSS can be customized via CDN or local build.  
- The modal edit/delete system uses JavaScript for dynamic DOM manipulation.  
- The project demonstrates how to separate **frontend display logic** from **backend processing** effectively.

---

## 👨‍💻 Author

**Developed by:** Ishfak Akbar  
🎓 Department of Software Engineering, Metropolitan University, Sylhet  
📧 [ishfakakbar24@gmail.com](mailto:ishfakakbar24@gmail.com)  
🌐 [GitHub Profile](https://github.com/ishfak-akbar)

---

## ⭐ Acknowledgments

- Tailwind CSS for providing modern responsive design utilities  
- XAMPP for local development environment  
- Inspiration from full-stack PHP AJAX CRUD architecture  

---

### 🩵 *Fast. Interactive. Modern.*  
A clean, responsive, and modular **PHP Registration System** powered by **AJAX** and **Tailwind CSS**, built for modern web development.

---
