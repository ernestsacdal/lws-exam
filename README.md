## LWS-Exam: Anime API

The LWS-Exam API is a Laravel-based backend system designed for managing anime collections. It serves as a robust backend for applications, enabling users to perform CRUD operations on anime data. This API supports authentication and allows users to create, read, update, and delete anime entries through a RESTful interface.

## Features
- **Authentication System:** Signup, login, and logout functionalities to manage user sessions.
- **CRUD Operations:** Users can create, read, update, and delete anime entries.
- **Anime Listing:** Display a comprehensive list of anime.
- **Individual Anime Details:** View detailed information about each anime.
- **API Key Authentication:** Access to all API endpoints is secured with an `x-api-key` header to ensure only authorized requests are processed.

### API Key Authentication
To access the API endpoints, you must include an API key in the request headers. Use the key named `x-api-key` for all requests. Example header:
x-api-key: 1234567
The default `API_KEY` value is `1234567`, but you can change it to any value you prefer in the `.env` file.

## Technologies Used
- **Backend:** Laravel
- **Database:** MySQL
- **Authentication:** Laravel Sanctum

## Getting Started

### Prerequisites
To run this project locally, you'll need to have the following installed:
- PHP (version  8.1.10 or higher)
- Composer
- MySQL

## Installation

To set up the LWS-Exam API locally, run the following commands in your terminal:

### 1. Clone the repository
```bash
git clone https://github.com/ernestsacdal/lws-exam.git
```
### 2. Navigate into the project directory
```bash
cd lws-exam
```
### 3. Install dependencies
```bash
composer install
```
### 4. Create and configure the .env file
```bash
cp .env.example .env
```
### 5. Generate an application key
```bash
php artisan key:generate
```
### 6. Run the database migrations
```bash
php artisan migrate
```
### 7. Create a symbolic link for the storage directory
```bash
php artisan storage:link
```
### 8. Start the Laravel development server
```bash
php artisan serve
```
## Post-Installation Reminder

### Setting up the API_KEY
After installation, it's crucial to ensure that your `API_KEY` is correctly set up in your `.env` file. This key is essential for authenticating requests to your API. The default value provided is `1234567`, but for enhanced security, you're encouraged to change it to a more complex value. To do this, simply edit the `API_KEY` value in your `.env` file:

```env
API_KEY=your_new_secure_key_here
```

### Authenticating Request
With your API_KEY set, remember that all API requests must include the x-api-key header containing your API key's value. This requirement ensures that your API endpoints are protected against unauthorized access. When making requests to the API, add the header as follows:

```Headers:
x-api-key: your_api_key_here
```

## API Documentation

### User Endpoints

All endpoints require the `x-api-key` header for access.

#### Signup
- **POST** `/api/users`
- **Body**: `firstName`, `middleName`, `lastName`,`email`, `contactNumber`, `birthday`, `password`, `password_confirmation`
- **Responses**: 201 (User created successfully.), 422 (e.g., missing required fields, invalid email format)

#### Login
- **POST** `/api/login`
- **Body**: `email`, `password`
- **Responses**: 201 (Login successful, Returns token), 401 (The provided credentials are incorrect.)

#### Get User Profile
- **GET** `/api/user`
- **Headers**: `Authorization: Bearer <token>`
- **Responses**: 200 (Returns user profile), 401 (Unauthenticated)

#### Logout
- **POST** `/api/logout`
- **Headers**: `Authorization: Bearer <token>`
- **Responses**: 200 (Logged out), 401 (Invalid token, Unauthenticated)

## Anime Endpoints

All endpoints require the `x-api-key` header for access.

#### Create Anime
- **POST** `/api/anime`
- **Body**: `name`, `category`, `description`, `publisher`, `thumbnail`, `type`
- **Headers**: `Authorization: Bearer <token>`
- **Responses**: 201 (Anime created successfully, Return Anime Data), 422 (e.g., missing required fields, invalid thumbnail format)

#### List Anime
- **GET** `/api/anime`
- **Headers**: `Authorization: Bearer <token>`
- **Responses**: 200 (Returns list of anime with pagination), 404 (No anime found)

#### Get Anime Details
- **GET** `/api/anime/{id}`
- **Headers**: `Authorization: Bearer <token>`
- **Responses**: 200 (Returns anime details), 404 (Anime not found)

#### Update Anime
- **POST** `/api/anime/{id}?_method=PUT`
- **Headers**: `Authorization: Bearer <token>`
- **Body**: `name`, `category`, `description`, `publisher`, `thumbnail`, `type`
- **Responses**: 200 (Anime updated successfully.), 404 (No anime found with the provided ID)

#### Delete Anime
- **DELETE** `/api/anime/{id}`
- **Headers**: `Authorization: Bearer <token>`
- **Responses**: 200 (Anime deleted successfully), 404 (Anime not found)


