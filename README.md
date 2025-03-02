# Laravel Authentication

![Laravel Authentication](00_introduction/images/thumbnail.png)


This repository contains the **step-by-step source code** for the **Laravel Authentication Series** on YouTube. Each folder corresponds to a video, allowing you to follow the project's progress **from start to finish**.  

## 📌 Features Implemented  

### 🔐 Authentication Features  
- Login via **Email or Phone**  
- User Registration  
- Logout & Logout from All Devices  
- Password Reset & Change Password  
- Account Verification via **Email or Phone OTP**  
- Social Login (**Google, Facebook, GitHub**)  
- Passwordless Authentication (**Magic Link or OTP**)  
- User Profile Management  
- Control Active Sessions on Multiple Devices

### 🔒 Access Control & User Management  
- Role & Permission Management  
- Admin Panel for User Management  

### 🛠️ API Endpoints  
- Login, Register, Logout  
- User Profile & Update Profile  
- Token Refresh for Persistent Authentication  

## 📂 Repository Structure  

Each folder represents a video in the playlist:  
📁 [00_introduction](https://github.com/Abdogoda/Laravel-Authentication/tree/main/00_introduction)  
📁 [01_login_register_logout](https://github.com/Abdogoda/Laravel-Authentication/tree/main/01_login_register_logout)  
📁 [02_update_profile_change_password](https://github.com/Abdogoda/Laravel-Authentication/tree/main/02_update_profile_change_password)  
📁 [03_reset_password](https://github.com/Abdogoda/Laravel-Authentication/tree/main/03_reset_password)  
📁 [04_verify_email_with_otp](https://github.com/Abdogoda/Laravel-Authentication/tree/main/04_verify_email_with_otp)  
📁 [05_auth_with_google](https://github.com/Abdogoda/Laravel-Authentication/tree/main/05_auth_with_google)  

This structure allows you to follow along **step by step** and see the project's evolution.  

## 📺 Watch the Playlist on YouTube  
📌 [Laravel Authentication Series](https://youtube.com/playlist?list=PLBy71Vfd0SzVaLjezaxqjnSsK8_p_aTcp&si=p3DluiMX7-euuw3A)  

## 🚀 How to Use This Repo  

1. Clone the repository:  
   ```bash
   git clone https://github.com/Abdogoda/Laravel-Authentication.git
   ```

2. Navigate to any folder you want in the repository, for example:  
   ```bash
   cd Laravel-Authentication/01_login_register_logout
   ```

3. Install dependencies:  
   ```bash
   composer install
   ```

4. Set up configurations:  
   ```bash
   cp .env.example .env
   ```

5. Generate App Key
   ```bash
   php artisan key:generate
   ```

6. Set up the database (SQLITE):  
   ```bash
   php artisan migrate
   ```

7. Start the development server:  
   ```bash
   php artisan serve
   ```

8. Access the app in your browser at `http://localhost:8000`.


## 🔗 Connect & Follow  
- **GitHub:** [@Abdogoda](https://github.com/Abdogoda)  
- **YouTube:** [@Abdulrhman-Goda](https://www.youtube.com/@Abdulrhman-Goda)

This repository is **continuously updated** as new videos are released. **Star this repo** ⭐ to stay updated! 🚀  