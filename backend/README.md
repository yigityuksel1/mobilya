# Mobilya E-Ticaret Backend

Laravel + Filament + Spatie Media Library tabanlı mobilya e-ticaret backend projesi. Kategori, marka, ürün ve varyant yönetimi ile admin paneli içerir.

## Teknolojiler

- Laravel 11
- Filament Admin Panel (v3)
- Spatie Laravel Media Library (v11)
- MariaDB/MySQL
- DDEV (opsiyonel, lokal geliştirme için)

## Özellikler

- Kategori yönetimi (parent-child hiyerarşi)
- Marka yönetimi
- Ürün yönetimi
  - SKU, fiyat, açıklama, aktif/pasif
  - Kapak ve çoklu görsel yükleme (Media Library)
  - Slug otomatik oluşturma
- Varyant yönetimi (fiyat, stok, SKU)
- Admin panel: /admin

## Hızlı Kurulum (Yerel Makine)

### Gereksinimler
- PHP 8.2+
- Composer
- MySQL/MariaDB
- Node.js & npm (opsiyonel)

### Adımlar

1) Repoyu klonla:
   ```bash
   git clone https://github.com/yigityuksel1/mobilya.git
   cd mobilya 
2) PHP bağımlılıklarını yükle:
   ```bash
   composer install
3) .env oluştur ve uygulama anahtarını üret:
   ```bash
   cp .env.example .env
   php artisan key:generate
4) Veritabanı ayarlarını .env içinde yap (örnek değerler):
   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mobilya_db
   DB_USERNAME=root
   DB_PASSWORD=
5) Migrasyonları çalıştır ve storage link oluştur:
   ```bash
   php artisan migrate
   php artisan storage:link
6) Admin kullanıcı oluştur:
   ```bash
   php artisan make:filament-user
   # Name: Admin
   # Email: admin@site.com
   # Password: (belirle)
7) Geliştirme sunucusunu başlat ve admin panele gir:
   ```bash
   php artisan serve
## Kurulum (DDEV)
Gereksinimler:

Docker
DDEV (kurulum için: ddev.readthedocs.io)
Adımlar:
# 1) Repoyu klonla ve dizine gir
git clone https://github.com/yigityuksel1/mobilya.git
cd mobilya

# 2) DDEV'i yapılandır ve başlat
ddev config --project-type=laravel --docroot=public
ddev start

# 3) Bağımlılıklar ve başlangıç
ddev composer install
ddev exec cp .env.example .env
ddev exec php artisan key:generate

# 4) .env içinde DDEV varsayılanlarını doğrula (aşağıya bak)
# 5) Migrasyon, storage link, admin kullanıcı
ddev exec php artisan migrate
ddev exec php artisan storage:link
ddev exec php artisan make:filament-user
# Name/Email/Password gir

# 6) Admin panel
# https://mobilya.ddev.site/admin
## .env.example
APP_NAME="Mobilya E-Ticaret"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=tr
APP_FALLBACK_LOCALE=tr
APP_FAKER_LOCALE=tr_TR

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4
BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mobilya_db
DB_USERNAME=root
DB_PASSWORD=

# DDEV kullanıyorsanız yukarıdaki DB ayarlarını şunlarla değiştirin:
# DB_CONNECTION=mariadb
# DB_HOST=db
# DB_PORT=3306
# DB_DATABASE=db
# DB_USERNAME=db
# DB_PASSWORD=db
# APP_URL=https://mobilya.ddev.site
# SESSION_DOMAIN=mobilya.ddev.site
# SANCTUM_STATEFUL_DOMAINS=mobilya.ddev.site

SESSION_DRIVER=cookie
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
