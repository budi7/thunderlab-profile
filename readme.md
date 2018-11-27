## I. installation
```
// 1. download or clone
git clone https://github.com/budi7/thunderlab-profile.git
cd thunderlab-profile 

// 2. composer install
composer install
composer dump-autoload -o

// 3. npm's
npm install
npm run production
```

## II. configs
1. create new mysql database 
2. configure .env file (template on .env.example)
3. configure google analytics account via .env files
4. copy google auth Json id to **/storage** directory

## III. run
1. migrate & seed
```
php artisan migrate
php artisan db:seed
```
2. run
```
//with hot reload
php artisan serve
npm run watch

// normal
php artisan serve
```
