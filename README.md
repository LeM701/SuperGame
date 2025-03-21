# 🎮 SuperGame

SuperGame is a simple web application that allows you to add players and display their scores in a ranked leaderboard. Built with PHP, MySQL, HTML5, and CSS3, the application focuses on security and data validation.

## 🚀 Features
- Add Player: Register a new player by entering a username, email, and score.
- Input Validation: Both client-side and server-side validation ensure that the username, email, and score meet the required formats.
- CSRF Protection: Secures form submissions with a CSRF token generated in the user session.
- Real-Time Leaderboard: Displays players sorted by their scores in descending order.
- Flash Messages: Provides instant feedback to users on successful registrations or errors.

## 🛠️ Technologies Used
- PHP – Backend logic and data handling.
- MySQL – Persistent data storage.
- HTML5 – Structuring the web pages.
- CSS3 – Styling and responsive design.
- JavaScript (ES6+) – Form validation and UI interaction.

## 🌍 Usage
### 👤 Register a Player
- Enter a unique username (3-20 characters).
- Provide a valid email address.
- Input a score between 0 and 10,000.
- Submit the form to save the player data.
### 📊 View Leaderboard
- The leaderboard automatically updates to reflect new scores.
- Players are listed from highest to lowest score.
### 🔒 Security Measures
- CSRF token is generated and validated for each form submission.
- Input is sanitized and validated to avoid security breaches.