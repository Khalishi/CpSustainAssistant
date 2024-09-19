# Installation steps
git clone https://github.com/MbDigitalAI/CpSustainAssistant.git
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
php artisan serve
