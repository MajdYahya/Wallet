# Wallet
Role-based system; let us call it "Wallet", which allows only registered users with role "user". The wallet is a personal finance manager, built to help you save money, and see all your finances in one place with chart report.

We have two different roles, we have "admin" and "user". and for simplicity, I used Spatie/ laravel-permission package (https://github.com/spatie/laravel-permission)

I also, used Bootstrap, and Jquery inside the app.


In order to run the application, you must do the add the following commands after perparing the .env file

$ php arttisan:migrate
$ php artisan db:seed (its very important to run the seed, because I create the admin user through the seeds, and to create the categories)


then 

$php artisan serve

first go to http://127.0.0.1:8888/register and register as a normal user, you will be redirected into the user dashbord, 
and if you want to add new or view your transactions at  your wallet, click on transactions  in the navbar

 If you want to log in as Admin, log out and login using the following user/pass
email: admin@domain.net
pass:   mypassword123


Again, the system admin is created by seeder, so you must run the seeder .
