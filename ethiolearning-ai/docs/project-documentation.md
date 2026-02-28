# EthioLearning AI - Complete Project Documentation

## Project Title
**EthioLearning AI Self-Learning Website for Ethiopian Students**

## 1. Introduction
EthioLearning AI is a web-based learning platform designed for Grade 9-12 students. The system provides digital course materials, assignments, competition quizzes, and a points-based leaderboard. An admin panel manages users and content.

## 2. Objectives
- Improve student access to learning materials.
- Provide self-learning tools and competition-based motivation.
- Digitize teacher/student interactions.
- Build a secure and scalable school project system.

## 3. System Architecture

### Frontend
- HTML for structure
- CSS for design
- JavaScript for validation and dynamic behavior

### Backend
- PHP 8+
- MySQL 8+

### Data Layer
- Relational schema with foreign keys and constraints
- Users, teachers, courses, assignments, competitions, attempts

## 4. Database Design Summary
Database name: `ethiolearning_ai`

Core tables:
1. `users`
2. `teachers`
3. `courses`
4. `assignments`
5. `competitions`
6. `competition_attempts`

Implementation SQL is in `database/schema.sql`.

## 5. Main Algorithms

### A) Student Registration
1. Accept full name, email, password, grade, optional stream.
2. Validate input format.
3. If grade is 11/12, enforce stream value (Natural/Social).
4. Check existing email.
5. Hash password with `password_hash`.
6. Insert user record and create session.

### B) User Login
1. Accept email and password.
2. Find user by email.
3. Verify password with `password_verify`.
4. Regenerate session ID.
5. Redirect by role:
   - `admin` -> admin panel
   - `user` -> dashboard

### C) Competition Logic
1. Show question + options.
2. Save selected option.
3. Compare with `correct_answer`.
4. If correct, increment points.
5. Update leaderboard using users ordered by points.

### D) Teacher Search
1. User enters teacher ID.
2. Query `teachers` table.
3. If found, show teacher details.
4. If not found, show message.

## 6. AI Assistant Integration Logic (Design)

### Goal
Add a simple AI tutor feature for question-answer support.

### Suggested flow
1. Student writes a question in chat box.
2. Frontend sends request to backend endpoint (`/backend/ai_assistant.php`).
3. Backend:
   - validates session
   - checks input length and profanity rules
   - sends sanitized prompt to AI API (OpenAI or equivalent)
4. Store prompt/response in `ai_chat_logs` table.
5. Return answer to frontend.

### Minimal table for AI logs
- `id` (PK)
- `user_id` (FK)
- `prompt` (TEXT)
- `response` (TEXT)
- `created_at` (TIMESTAMP)

### Important safeguards
- Rate limit per user
- Max token/request size
- Block API key from frontend (keep in backend `.env`)
- Filter unsafe responses

## 7. Security Practices
- Use prepared statements (PDO)
- Hash passwords (`password_hash`)
- Verify passwords (`password_verify`)
- Harden session cookies
- Validate upload MIME and extension
- Restrict file upload folders
- Add CSRF token for forms (recommended extension)

## 8. Deployment Notes
- XAMPP/WAMP/LAMP is enough for demo.
- Enable Apache `mod_rewrite` only if pretty URLs are used.
- Use HTTPS if deployed publicly.

## 9. Future Improvements
- Full AI tutor with subject mode (Math, Biology, Physics)
- Mobile app (Flutter/React Native)
- Email verification + password reset
- Analytics dashboard for student progress
- Teacher feedback and in-app messaging

## 10. Conclusion
This project design is school-ready, secure by default, and easy to implement with common technologies. It demonstrates software engineering practice through architecture, database design, algorithms, security, and extensibility.
