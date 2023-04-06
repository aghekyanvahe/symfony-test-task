# first you need to clone project ``git clone https://github.com/aghekyanvahe/symfony-test-task.git``

# If you want to run app need to use these versions

We are using php7.4 and composer 2.1 version  
And Symfony version is 5.4 version

When you did these steps you can run ```composer install```

# 2 step you need to connect your local mysql DB
Then run `` php bin/console doctrine:migrations:migrate ``

Then if everything will be ok 
You can run ``` php -S 127.0.0.1:8000 -t public ```

# CRUD Endpoints

# star you need to give params for create and update
# name=string, galaxy_id=int, radius=float, temperature=float, rotation_frequency=float
Create - http://127.0.0.1:8000/star/create
Update - http://127.0.0.1:8000/star/{id}/update
Delete - http://127.0.0.1:8000/star/{id}/delete

# atom you need to give params for create and update
# name=string, star_id=int
Create - http://127.0.0.1:8000/atom/create

# galaxy you need to give params for create and update
# name=string, star_id=int
Create - http://127.0.0.1:8000/galaxy/create
Update - http://127.0.0.1:8000/galaxy/{id}/update
Delete - http://127.0.0.1:8000/galaxy/{id}/delete

# Showing uniqueStars use this endpoint
uniqueStars - http://127.0.0.1:8000/galaxy/{id}/stars


# I have created Swagger but didn't give endpoints ``http://127.0.0.1:8000/api/doc``
