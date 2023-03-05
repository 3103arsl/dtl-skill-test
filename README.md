# DTL Information Technologies Skill Test

### Requirement

- We expect that product module will contain product's name, price, status, person's information who add the product and product's type (item/service).
- We expect to see all product's previous record history. (This may be just in Model & Migration.)
- We expect to see Product's add, edit, delete, show, and index methods.
- We expect a capability to see the person who added the product and capability to see a product list that can be filtered as product name and person who added the product.
- When new products added, you need to send an email to person who added the product. (Mail settings do not have to be adjusted. We just need to see the mail notification code.)
- When we run the project, we expect at least 1 person, and 1 product has been registered as default.
- We will NOT be expecting to see login, logout, user crud modules. Please keep your focus on the product module. (You are free to create a middleware that can create a random user when request triggered.)
- We are NOT expecting to test a code.
- We are NOT expecting for HTML/Blade Template code. This scenario must work on an API and works with JSON format.
 
 ### Installation
 
 Clone project
 
Install dependencies using following command
 
 ```bash
composer install
```
Copy .env file

 ```bash
copy .env.example .env
```
Create database

 ```bash
php artisan migrate:refresh --seed
```

Run application

 ```bash
php artisan serve
```

