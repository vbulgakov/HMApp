There is MUCH to improve here, but it is a test task after all.

Sending welcome mail on registration: Event is fired, 
actual mail:: is commented out to allow testing without setting up mailer.

Default user email is 'manager@hmapp.test' with password 'zxc123fghj', seeded ONLY for ease of testing.



After you clone repo:

1.  npm install

2.  Add your virtual host to config/sanctum.php
'localhost,localhost:3000,127.0.0.1,127.0.0.1:8000,::1,hmapp.test', - hmapp.test is MY virtual host

3.  php artisan migrate:fresh --seed

4.  npm run dev



For people data:
Name and surname can contain spaces
South African ID Number - 13 digits, checksum validation is advised
Email address is primary and unique

Assuming we build an app to work, main workflow seems like:
login->insert people all day long->logout.

To minimise human error we can force usage of filled-once language and interests data.
So, in progress of people creation, operator will choose language from drop-down or radio list, and checkout interests form checkout list.
Also, date input in 3 separate fields may be better in long run than datepicker widget.



