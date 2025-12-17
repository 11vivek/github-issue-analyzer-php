# GitHub Issue Analyzer with Local Caching + LLM (Laravel + SQL)

This project is a backend service built using **Laravel 10** that:
- Fetches and caches GitHub issues locally
- Analyzes cached issues using a natural language prompt and an LLM

This project was developed as part of a coding assignment to demonstrate backend design, API development, local caching, and LLM integration.

---

## 📁 Project Overview

The service exposes two REST APIs:

### 1. POST `/api/scan`
- Fetches all open GitHub issues for a given repository
- Stores them in a local SQL database

### 2. POST `/api/analyze`
- Retrieves cached issues
- Combines them with a natural language prompt
- Sends the combined context to an LLM
- Returns the generated analysis

No UI is included; this is a backend-only service.

---

## 🚀 How to Run the Server

### 1. Prerequisites
- PHP 8.1+
- Composer
- MySQL
- GitHub & OpenAI API access

---

### 2. Clone the Repository

```bash
git clone <your-github-repo-url>
cd github-issue-analyzer-laravel

### 3. Install Dependencies
composer install

4. Environment Setup

Copy .env.example to .env and update:

DB_DATABASE=github_issues
DB_USERNAME=root
DB_PASSWORD=

OPENAI_API_KEY=your_openai_api_key

5. Database Migration
php artisan migrate

6. Start the Server
php artisan serve

Server will run at:
http://127.0.0.1:8000

🧪 API Usage
POST /api/scan
{
  "repo": "laravel/framework"
}
Response:
{
  "repo": "laravel/framework",
  "issues_fetched": 100,
  "cached_successfully": true
}


POST /api/analyze
{
  "repo": "laravel/framework",
  "prompt": "Find common issues and suggest priority fixes"
}
Response:
{
  "analysis": "<LLM generated insights>"
}

🗄️ Storage Choice: SQL Database (MySQL)

Why SQL Database?
Persistent local storage (data survives server restarts)
Easy to query and verify cached data
Scalable and production-ready
Fits naturally with Laravel’s Eloquent ORM
Compared to in-memory or JSON storage, SQL provides better durability and structure for this use case.

⚠️ Edge Cases Handled

Repository not scanned before analysis
No cached issues found
GitHub API errors
LLM API failures
Invalid input validation
All errors return meaningful JSON responses.

🤖 AI Usage & Prompts

AI coding tools were used to assist during development.
Below is a list of prompts used to demonstrate the workflow.

🔹 Prompts Used for Development Help

"Create a Laravel REST API to fetch and store GitHub issues"
"How to call GitHub REST API using Laravel Http client"
"Design a database schema for caching GitHub issues"
"Handle validation and error responses in Laravel API"

🔹 Prompts Used to Fix Errors & Improve Logic

"Why is Laravel request validation failing for JSON body?"
"How to debug missing request payload in Laravel API"
"Optimize code structure using services in Laravel"
"Best practices for handling external API failures"

🔹 Prompts Used for LLM Analysis Endpoint

"Analyze the following GitHub issues and identify common themes"
"Based on these issues, recommend what maintainers should fix first"
"Summarize recurring problems from recent GitHub issues"
"Generate actionable insights from issue titles and descriptions"
These prompts were combined dynamically with cached issue data before sending to the LLM.

✅ Notes

Backend-only implementation as required
Clean separation of concerns using Services
Easily extendable for pagination or authentication
Designed for clarity and maintainability







