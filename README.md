# CodeIgniter User Authentication & Management System

This project is a user authentication and management system built with **CodeIgniter**. It includes API-based functionality for both frontend and backend, offering different roles (Admin, Customer) with specific dashboards and user management capabilities.


## Features

1. **Create a CodeIgniter Project**  
   - The project is built using the CodeIgniter framework and contains a custom helper, config, and library integrated for various logic operations.
![image](https://github.com/user-attachments/assets/33cec0fe-e6c7-453e-af62-3f8579eec42e)
![image](https://github.com/user-attachments/assets/b2377483-fab4-4f33-9b3c-b7a9ad6f61bb)
![image](https://github.com/user-attachments/assets/64d60ba5-b78d-4fc0-acd5-f8d2141b456d)



2. **User Authentication**  
   - Supports two types of user roles:
     - **Admin**: Full access to manage users and view system statistics.
     - **Customer**: Limited access to their own dashboard and account information.

3. **Dashboard for Both User Roles**  
   - Displays a welcome message and the user's last login details.
![image](https://github.com/user-attachments/assets/884bd88a-78ed-486f-9b82-dce7dcb4bf50)
![image](https://github.com/user-attachments/assets/538ab261-ca95-4521-89ff-867430c77442)



4. **Admin Dashboard**  
   - Displays the count of users on the platform.
   - Shows the last 5 users who have been added.
![image](https://github.com/user-attachments/assets/b1da08ba-107f-4bc8-abb9-1dc18f6db514)



5. **Admin User Management Module**  
   - Admin can:
     - View a list of all customers.
     - Create, update, and delete user accounts.
     - Users have attributes like first name, last name, email, password, profile image, education, and employment details.
     - User images can be cropped and compressed.
![image](https://github.com/user-attachments/assets/68a5ee28-8f72-4d15-a43d-7ec0aa3e5622)

6. **User Education and Employment Details**  
   - User education and employment data are stored in separate tables.

7. **User Detail Page**  
   - Displays all user-related information including personal, education, and employment details.
![image](https://github.com/user-attachments/assets/3520a857-429a-4201-a8c9-4d0a73762a28)


8. **API-Based Functionality**  
   - All functionalities are implemented through APIs.
--Login 
![image](https://github.com/user-attachments/assets/e98bdcff-4242-4017-b63b-5a4576b079bf)
--Get User List 
![image](https://github.com/user-attachments/assets/9b961dce-8b8b-4d67-95a8-df0b1235c45b)
--Get User Detail
![image](https://github.com/user-attachments/assets/f27fe853-51dd-4718-8e94-7452dc32cff6)
--Create User
![image](https://github.com/user-attachments/assets/9badf6b6-f3a7-45cf-b781-baac9eec0212)
--Update User
![image](https://github.com/user-attachments/assets/c97434dd-cfe1-44f4-a66d-3dc12b22e2b6)

9. **Additional Functionalities**  
Created Library for Static Text:
A custom library has been created to manage static text throughout the project.
![image](https://github.com/user-attachments/assets/b5cc7f1b-3aad-4bfe-86fb-c7dc24cb0293)

Created Helper to Upload Image:
A custom helper function to handle image upload, cropping, and compression for user profile images.
![image](https://github.com/user-attachments/assets/9cf648cf-5b16-49dd-883d-b0124722a976)

Basic Authentication in API:
Basic authentication has been implemented for API routes to secure access and ensure only authorized users can perform certain actions.
![image](https://github.com/user-attachments/assets/989cadaf-fe84-4ee1-a915-52281b371ab3)

