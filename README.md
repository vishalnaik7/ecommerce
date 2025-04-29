 ⚙️ Project Setup
git clone  https://github.com/vishalnaik7/ecommerce.git

Update your .env file with correct DB credentials:
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=your_password


🔐 Admin Panel Login
URL: /admin/login
Email: vishal7naik@gmail.com
Password: password123


🛒 Key Features
Admin Panel:
Add Product with Title, Price, and Multiple Images 
View Cart Items in Backend (user_id = 1)

APIs (via Postman)
Add Product to Cart (POST)
http://localhost:8000/api/add-to-cart

{
  "product_id": 4,
  "quantity": 2
}


📦 Files Provided
✅ Full Laravel project

✅ laravel.sql (MySQL DB backup)

✅ Postman collection (inovant-task.postman_collection.json)

✅ README documentation

🧪 Validation & Error Handling
All forms and API inputs are validated.

Invalid HTTP methods return proper 405 responses.

Invalid product/cart actions show meaningful messages (via Toastify).