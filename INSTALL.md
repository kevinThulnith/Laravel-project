<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="600" alt="Laravel Logo"></a></p>

# Laravel Project Docs

## Setting up the project.

All commands executed on project directory command prompt | powerShell. Install Composer <a href="https://getcomposer.org/download/"> Link </a> .

1. Creating an Application :

```bash
laravel new <project-name>
```

2. Go to project directory :

```bash
cd <project-name>
```

-   To open Vs code on project directotory

```bash
code .
```

3. Install npm packages :

```bash
npm install && npm run build
```

4. Run project server :

```bash
php artisan serve
```

5. Start Frontend server :

```bash
composer run dev
```

All migrations are done automatically if using SQLite, if not have to make migrations manually for eaxmple MySQL on xampp.

6. Create DB connection on `.env` :

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=example-app
DB_USERNAME=root
DB_PASSWORD=
```

7. Make migrations :

```bash
php artisan migrate
```

## Set up Login | Register | Email verificaton with Breeze

All commands executed on project directory command prompt | powerShell.

1. Rerriev required packages to project :

```bash
 composer require laravel/breeze --dev
```

2. Install required packages to project :

```bash
 php artisan breeze:install
```

-   Select blade as front end press enter twice

3. Email Varification :

Change Auth user model in `app\Models\User.php`.

-   uncomment this line

```bash
 use Illuminate\Contracts\Auth\MustVerifyEmail;
```

-   add `MustVerifyEmail` to user class

```bash
 class User extends Authenticatable implements MustVerifyEmail
```

Configure `.env` file with email and App password with gmail.

```bash
 MAIL_MAILER=smtp
 MAIL_HOST=smtp.gmail.com
 MAIL_PORT=465
 MAIL_USERNAME= <example@gmail.com>
 MAIL_PASSWORD= <email app password>
 MAIL_ENCRYPTION=tls
 MAIL_FROM_ADDRESS= <same email>
 MAIL_FROM_NAME="Laravel App"
```

## Setting up API

Install nececessary packages :

```bash
php artisan install:api
```

## Make Model

1. Make model with neccesary documentation :

```bash
php artisan make:model <model-name> -a --api
```

2. Setup created model in `app\Models\<model-name>.php` :

```bash
class <model-name> extends Model
{
  use HasFactory;
  protected $fillable = ['Column1', 'Column2'];
}
```

-   If forieng key is used, in this esample Auth:user model is forieng key. Import required models before ading.

```bash
public function user()
{
    return $this->belongsTo(User::class);
}
```

-   Editing user model

```bash
public function products()
{
    return $this->hasMany(products::class);
}
```

3. Setup migration :

```bash
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string("name")->unique();
        $table->decimal("price", 10, 2);
        $table->integer("quantity");
        $table->text("description");
        $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // if forieng key is added
        $table->timestamps();
    });
}
```

5. Run migrations :

```bash
php artisan migrate
```

## Setting up API routes

Edit files to create API routes

1. Set-up API resource in `routes\api.php` :

```bash
use App\Http\Controllers\<Controller-class>;

Route::apiResource('posts', <Controller-class>::class);
```

2. List routes on powershell :

```bash
php artisan route:list
```

3. Select data :

Set controller function to get _SELECT \* FROM_ `<table-name>` in laravel

```bash
public function index()
{
    $products = product::all();
    return $products
}
```
