# 🩸 Emergency Blood Donation Management System

A web-based platform built to streamline the process of connecting blood donors with recipients during emergencies. The system allows registered agents (e.g., blood bank coordinators) to manage donor data, while public users can search for suitable blood donors by blood group and location.

---

## 🔧 Features

- ✅ **Agent Registration** with email verification  
- ✅ **Secure Agent Login** and dashboard access  
- ✅ **Add / Edit / Delete Donors**  
- ✅ **Public Search** by blood group, city, and country  
- ✅ **Email Confirmation** via SwiftMailer  
- ✅ **Profile Management** for agents  
- ✅ **Image Uploading** for donor and agent photos  
- ✅ **Responsive UI** (basic mobile/tablet support)  
- ✅ **Admin Approval** for donor visibility  

---

## 💻 Technologies Used

- **Frontend**: HTML, CSS, Bootstrap (optional)  
- **Backend**: PHP  
- **Database**: MySQL (via PDO)  
- **Email**: SwiftMailer (SMTP configuration)  
- **Security**: PHP Sessions, Prepared Statements  
- **Utilities**: Dynamic state dropdowns, Clean URLs via `.htaccess`

---

## 🚀 Getting Started

### 🔹 Prerequisites

- Local Server: XAMPP / WAMP / MAMP  
- PHP ≥ 7.0  
- MySQL Server  
- Composer (for SwiftMailer installation)

### 🔹 Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/emergency-blood-donation.git
   ```

2. Import the database:
   - Open `phpMyAdmin`
   - Create a database (e.g., `blood_donation`)
   - Import the `.sql` file provided

3. Configure database connection:
   - Edit `dbconfig.php` with your DB credentials

4. Configure email:
   - Update SMTP details in `registration.php` or via `tbl_settings`

5. Run the project:
   - Visit `http://localhost/emergency-blood-donation/`

---

## 📁 Project Structure

```
/project-root
│
├── dbconfig.php               # Database connection settings
├── registration.php           # Agent registration with email verification
├── login.php / logout.php     # Secure login & logout
├── donor-add.php              # Add donor
├── donor-edit.php             # Edit donor
├── donor-view.php             # List donors
├── donor-delete.php           # Remove donor
├── dashboard.php              # Agent dashboard
├── profile-edit.php           # Profile updates
├── search.php                 # Public search
├── blood-groupwise-result.php # Blood group search results
├── header.php / footer.php    # Page layout components
├── uploads/                   # Donor & agent images
└── README.md
```

---

## 🧪 Testing

Manual testing was conducted to ensure that:
- Registration and login systems validate data correctly  
- Agents can add/edit/delete donors and upload images  
- Email confirmation works using SwiftMailer  
- Only logged-in agents access dashboards  
- Search filters return accurate donor results  

---

## 📊 Evaluation Summary

All core requirements were met, including:
- Verified agent registration  
- Donor management by agents  
- Public search functionality  
- Secure database and session handling  
- Clean user interface  
Some minor improvements are needed for full mobile responsiveness.

---

## 📌 Future Improvements

- 📱 Full mobile optimization  
- 🔔 Real-time emergency notifications  
- 📈 Donation analytics for admins  
- 🤖 AI-powered donor-recipient matching

---

## 📃 License

This project is open-source and available under the [MIT License](LICENSE).

---

## 🤝 Contributing

Contributions are welcome. For major changes, open an issue to discuss what you would like to propose.

---

## 🙏 Acknowledgments

- [SwiftMailer](https://swiftmailer.symfony.com/)  
- [W3Schools PHP Guide](https://www.w3schools.com/php/)  
- [MySQL Documentation](https://dev.mysql.com/doc/)  
- [Bootstrap](https://getbootstrap.com/)  
- [World Health Organization – Blood Donation](https://www.who.int/news-room/fact-sheets/detail/blood-safety-and-availability)  
