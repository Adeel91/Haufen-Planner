# Project Management System

V 1.0

Project Management System based on Larvel 5.5.* and Vue.js :)

## Features
- Clients Management
- Projects Management
- Tasks Management
- Task Conversations
- Role / Permissions based actions

## Todos
- [ ] Notifications.
- [ ] Role and Permissions customization UI.
- [ ] Migrate to Vue( such as model popups, forms, Datatable and etc ).
- [ ] Charts.
- [ ] Project Time Handling.
- [ ] Co-workers and their permissions.

## Get Involved
- Clone or fork the project.
- Create feature branches off develop branch.
- Once your changes are ready create a pull request into the master branch.

## Installation
- Clone the repo
- Copy .env.example to .env
- Set values in .env file
- Run `composer install`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Run `npm install`
- Run `npm run dev`
- Start developing!

## Important Information

Need to run these commands to run the project on 
the browser
- Run `npm run dev` to build the project
- Run `php artisan serve` to start the development server
on this URL <http://127.0.0.1:8000>

## Notes
If you run `php artisan db:seed` it will create a one default user and five status ( `draft,open,ongoing,close,cancel.` ). These Details are stored in `DatabaseSeeder.php` class.
By Default
- **User Name** : Muhammad Sajeel
- **Email Address** : Sajeel@haufen-planner.com
- **Password** : Sajeel

Configurations are stored in `config/pms.php` file.
    
## User Credentials

This section has the user credentials used in the project.

### Admin Users
- **User Name** : Muhammad Sajeel
- **Email Address** : Sajeel@haufen-planner.com
- **Password** : Sajeel

### Suervisor Users
- **User Name** : Muhammad Nabeel
- **Email Address** : Nabeel@haufen-planner.com
- **Password** : Nabeel
<hr />

- **User Name** : Muhammad Adeel
- **Email Address** : Adeel@haufen-planner.com
- **Password** : Adeeel
<hr />

- **User Name** : Faisal Yazdanie
- **Email Address** : Faisal@haufen-planner.com
- **Password** : Faisal

### Team Members (Employees)
- **User Name** : Osama Bin Athar
- **Email Address** : Osama@haufen-planner.com
- **Password** : Osamaa
<hr />

- **User Name** : Abdul Mannan
- **Email Address** : Mannan@haufen-planner.com
- **Password** : Mannan
<hr />

- **User Name** : Anas Hassan
- **Email Address** : Anas@haufen-planner.com
- **Password** : Anaass
<hr />

- **User Name** : Arbaz Sagheer
- **Email Address** : Arbaz@haufen-planner.com
- **Password** : Arbaaz
<hr />
