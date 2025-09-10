# 📝 Blog API with Laravel

## 📌 Overview
This project is a **RESTful API** for a blogging system built with **Laravel 12** and **PHP 8.x**.  
It supports user authentication, blog posts management, comments management, and email notifications when new comments are added.  

---

## ⚙️ Features
- ✅ User authentication using **Laravel Sanctum** (token-based).  
- ✅ CRUD operations for **Posts** and **Comments**.  
- ✅ Eloquent relationships between **Users, Posts, and Comments**.  
- ✅ Email notifications to post owners when new comments are created.  
- ✅ Validation and authorization on all requests.  
- ✅ Clean code with proper use of Services and Mailables.  

---

## 🛠️ Technologies Used
- **Backend:** PHP 8.x, Laravel 12  
- **Database:** MySQL  
- **Authentication:** Laravel Sanctum  
- **Mail Service:** gmail (personal)  
- **Testing:** PHPUnit & Laravel Feature Tests  
- **Version Control:** Git  
- **API Documentation:** Markdown (this README)

---

## 📂 Project Structure
```
app/
 ├── Http/Controllers/API   # API Controllers (Auth, Post, Comment)
 ├── Mail/                  # Mailables for email notifications
 ├── Models/                # Eloquent Models (User, Post, Comment)             
routes/
 ├── api.php                # API Routes
 └── web.php                # Web Routes (if needed)
database/
 ├── migrations/            # Database migrations
tests/
 ├── Feature/               # Feature tests
 └── Unit/                  # Unit tests
```

---

## 🚀 Installation & Setup
1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/blog-api.git
   cd blog-api
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install && npm run build   # if you use Vite for assets
   ```

3. **Create `.env` file**
   ```bash
   cp .env.example .env
   ```

4. **Configure database & mail service** in `.env`
   ```env
   DB_DATABASE=blog_api
   DB_USERNAME=root
   DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mohamedfathymo66@gmail.com
MAIL_PASSWORD=pmnsmrkbvcywglxz 
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="mohamedfathymo66@gmail.com"
MAIL_FROM_NAME="Laravel Blog"

ADMIN_EMAIL=mohamedfathymo66@gmail.com
  


5. **Generate app key & run migrations**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

6. **Install Sanctum**
   ```bash
   php artisan install:api
   ```

7. **Serve the app**
   ```bash
   php artisan serve
   ```

---

## 🔑 Authentication
This API uses **Laravel Sanctum** for token-based authentication.  
After login/register, include the token in the **Authorization header** for protected routes:

```
Authorization: Bearer <token>
```

---

## 📖 API Endpoints

### 🔐 Auth
| Method | Endpoint       | Description              |
|--------|---------------|--------------------------|
| POST   | `/api/register` | Register a new user      |
| POST   | `/api/login`    | Login and get token      |
| POST   | `/api/logout`   | Logout (revoke token)    |

---

### 📝 Posts
| Method | Endpoint       | Description              |
|--------|---------------|--------------------------|
| GET    | `/api/posts`   | Get all posts            |
| POST   | `/api/posts`   | Create a new post        |
| GET    | `/api/posts/{id}` | Get single post       |
| PUT    | `/api/posts/{id}` | Update a post         |
| DELETE | `/api/posts/{id}` | Delete a post         |

---

### 💬 Comments
| Method | Endpoint                   | Description              |
|--------|----------------------------|--------------------------|
| POST   | `/api/posts/{id}/comments` | Add comment to a post    |
| DELETE | `/api/comments/{id}`       | Delete a comment         |

---

## 📧 Email Notifications
- Whenever a new comment is created on a post, the **post owner** receives an email notification containing:
  - Comment author name & email  
  - Comment content  
  - Post title  

---

## ✅ Testing
Run tests with:
```bash
php artisan test
```

Feature tests included:
- User registration & login  
- Post creation & retrieval  
- Comment creation triggers email  

---

## 📌 License
This project is licensed under the MIT License.
