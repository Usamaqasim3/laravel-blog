# Laravel Blog with Editor.js

A simple blog project built with Laravel and [Editor.js](https://editorjs.io/) for rich content creation.

## 🚀 Features

- Create, read, and delete blog posts
- Rich content editing with Editor.js (supports headings, paragraphs, and images)
- Image upload support
- Responsive UI with Bootstrap
- Beautiful blog detail view
- JSON-based content rendering

---


## 🛠 Tech Stack

- PHP (Laravel 10+)
- MySQL / SQLite
- JavaScript
- Editor.js
- Bootstrap 5

---

## 📦 Installation

1. **Clone the repository**

```bash
git clone https://github.com/usamaqasim3/laravel-blog.git
cd laravel-blog
```
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
npm run dev

 **Usage**
Navigate to / or /posts/create to add a new blog post.

Use Editor.js to write rich content.

Go to /posts to see the list of blogs.

Click any post to view it in detail.

Use the delete button to remove a post.


