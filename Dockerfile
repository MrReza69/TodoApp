# استفاده از تصویر رسمی PHP با آپاچی
FROM php:8.2-apache

# نصب وابستگی‌های مورد نیاز
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring exif pcntl

# کپی کردن فایل‌های پروژه به داخل کانتینر
COPY . /var/www/html

# تنظیم مجوزها
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# فعال کردن rewrite module برای آپاچی
RUN a2enmod rewrite

# تنظیم دایرکتوری کار
WORKDIR /var/www/html

# نصب Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# نصب وابستگی‌های Composer
RUN composer install --no-dev --optimize-autoloader

# پورت مورد استفاده
EXPOSE 80

# دستور شروع
CMD ["apache2-foreground"]