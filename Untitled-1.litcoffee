# File Tree: e-store

**Generated:** 3/19/2026, 1:51:24 PM
**Root Path:** `c:\xampp\htdocs\e-store\e-store`

```
├── app
│   ├── Exceptions
│   ├── Helpers
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── API
│   │   │   │   └── V1
│   │   │   │       ├── Auth
│   │   │   │       ├── Category
│   │   │   │       │   └── CategoryController.php
│   │   │   │       └── Product
│   │   │   │           └── ProductController.php
│   │   │   └── Controller.php
│   │   ├── Repositories
│   │   │   ├── Contracts
│   │   │   │   ├── CategoryRepositoryInterface.php
│   │   │   │   └── ProductRepositoryInterface.php
│   │   │   └── Eloquent
│   │   │       ├── CategoryRepository.php
│   │   │       └── ProductRepository.php
│   │   ├── Requests
│   │   │   └── API
│   │   │       └── V1
│   │   │           ├── Ads
│   │   │           │   ├── StoreAdsRequest.php
│   │   │           │   └── UpdateAdsRequest.php
│   │   │           ├── Auth
│   │   │           │   ├── LoginRequest.php
│   │   │           │   └── RegisterRequest.php
│   │   │           ├── Category
│   │   │           │   ├── StoreCategoryRequest.php
│   │   │           │   └── UpdateCategoryRequest.php
│   │   │           ├── Product
│   │   │           │   ├── StoreProductRequest.php
│   │   │           │   └── UpdateProductRequest.php
│   │   │           ├── ShippingLocation
│   │   │           │   ├── StoreLocationRequest.php
│   │   │           │   └── UpdateLocationRequest.php
│   │   │           └── User
│   │   ├── Resources
│   │   │   ├── CategoryResource.php
│   │   │   └── ProductResource.php
│   │   └── Services
│   │       ├── CategoryService.php
│   │       └── ProductService.php
│   ├── Models
│   │   ├── Category.php
│   │   ├── Product.php
│   │   └── User.php
│   └── Providers
│       └── AppServiceProvider.php
├── bootstrap
│   ├── app.php
│   └── providers.php
├── config
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── database.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   └── session.php
├── database
│   ├── factories
│   │   └── UserFactory.php
│   ├── migrations
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2026_03_17_184117_create_personal_access_tokens_table.php
│   │   ├── 2026_03_18_123118_create_product_table.php
│   │   └── 2026_03_18_132000_create_categories_table.php
│   ├── seeders
│   │   └── DatabaseSeeder.php
│   ├── .gitignore
│   └── database.sqlite
├── public
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── resources
│   ├── css
│   │   └── app.css
│   ├── js
│   │   ├── app.js
│   │   └── bootstrap.js
│   └── views
│       └── welcome.blade.php
├── routes
│   ├── api
│   │   ├── v1
│   │   │   ├── api_ads_routes.php
│   │   │   ├── api_auth_routes.php
│   │   │   ├── api_category_routes.php
│   │   │   ├── api_order_routes.php
│   │   │   ├── api_products_routes.php
│   │   │   ├── api_user_routes.php
│   │   │   └── api_v1_routes.php
│   │   └── api_routes.php
│   ├── api.php
│   ├── console.php
│   └── web.php
├── storage
│   ├── app
│   │   ├── private
│   │   │   └── .gitignore
│   │   ├── public
│   │   │   └── .gitignore
│   │   └── .gitignore
│   ├── framework
│   │   ├── sessions
│   │   │   └── .gitignore
│   │   ├── testing
│   │   │   └── .gitignore
│   │   ├── views
│   │   │   ├── .gitignore
│   │   │   ├── 6a53bb46b230cdd6c254cbd5131d0970.php
│   │   │   ├── cdc8430de4dddd022c0bae3980f0cb76.php
│   │   │   └── d28bb655356b2b8415b7539dd70637c8.php
│   │   └── .gitignore
│   └── logs
│       └── .gitignore
├── tests
│   ├── Feature
│   │   └── ExampleTest.php
│   ├── Unit
│   │   └── ExampleTest.php
│   └── TestCase.php
├── .editorconfig
├── .env.example
├── .gitattributes
├── .gitignore
├── README.md
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
└── vite.config.js
```

---
*Generated by FileTree Pro Extension*
