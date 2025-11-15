# Simple Jobportal - API

## Description
MX100 adalah job portal yang menghubungkan perusahaan dengan expert freelancer / part-timer.
Pemberi kerja dapat memposting lowongan pekerjaan, menyimpan sebagai draft dan mempublikasikan.
Freelancer dapat melihat daftar lowongan pekerjaan yang dipublish dan hanya dapat mengirim 1 CV saja untuk satu pekerjaan.
Pemberi kerja dapat melihat CV dari freelancer dari pekerjaan yang diapply.

### Tech Stack
- Language: PHP (8.3)
- Framework: Laravel (v12)
- Database: PostgreSQL (v16)

## Installation
```
# Clone Repository
git clone <repository-url>
cd simple-jobportal-mx100
composer install
```

## Development
Jalankan database migration:
```
php artisan migrate
```

Jalankan perintah seeder:
```
php artisan db:seed
```

Jalankan development server:
```
php artisan serve
```

## API Documentation
Import postman collection:
- simple_jobportal_mx100.postman_collection.json
- simple_jobportal_mx100.postman_environment.json