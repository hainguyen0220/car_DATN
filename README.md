<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Về dự án


## Công nghệ sử dụng

-   PHP: 8.0
-   Laravel: v8.83.15
-   Bootstrap :[(Bootstrap 5.0.2)](https://getbootstrap.com/docs/5.0/getting-started/introduction/)

## Cấu trúc dự án

-

## Cài đặt

1.  Install composer
2.  Install dependencies:

-   Chạy lệnh để cài đặt composer:

```
composer install
```

-   Chạy lệnh để tạo cơ sở dữ liệu:

```
php artisan migrate
```

-   Chạy lệnh để tạo dữ liệu mẫu:

```
php artisan db:seed
```

-   Chạy lệnh để bật serve:

```
php artisan serve
```

## Cơ sở dữ liệu

-   Tạo cơ sở dữ liệu tự động:

```
php artisan migrate
```

-   Nếu muốn cập nhật cơ sở dữ liệu thì chạy lệnh để sửa đổi:

```
php artisan make:migration <migration_name>
```

-   Để viết lệnh và có thể quay lại dùng lệnh:

```
php artisan migrate:rollback
```

-   Để tạo dữ liệu mẫu bằng Factory and Seeder dùng để thử nghiệm và kiểm thử:

```
php artisan db:seed --class=<SeederClassName>
```

-   Thứ tự chạy các lệnh seed

```
php artisan db:seed --class=AccountSeeder

php artisan db:seed --class=AuthorSeeder

php artisan db:seed --class=GaraSeeder

php artisan db:seed --class=CategorySeeder

php artisan db:seed --class=BookSeeder

```

```
php artisan schedule:work
```

-   Lệnh này sẽ chạy tất cả các lịch đã lên.

## Lấy đường dẫn storgate

```
php artisan storage:link
```
#   c a r _ D A T N  
 