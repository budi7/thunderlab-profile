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
3. configure google analytics & recaptcha account via .env files
4. copy google auth Json id to **/storage** directory

## III. run
1. migrate & seed
configure migration file **/database/seeds/user_seeder.php**
```
    $user['name'] = your name;
    $user['username'] = your email;
    $user['password'] = your password;
```

2. run 
```
php artisan migrate
php artisan db:seed
```
3. run
```
//with hot reload
php artisan serve
npm run watch

// normal
php artisan serve
```
