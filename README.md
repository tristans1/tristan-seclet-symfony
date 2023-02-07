# tristan-seclet-symfony


## Note 

Je vous ai envoyé un mail expliquant que j'ai rendu ce projet en retard suite à des complications de santé. Cela ne justifie en rien mon retard, je souhaitais uniquement vous prévenir afin que vous sachiez que j'ai rendu un projet. Vous êtes en droit de ne pas noter ce devoir étant donné que je n'ai pas respecté la deadline.

Tristan Seclet 
## Installation

- composer install

create database :
- `php bin/console doctrine:database:create`
- `php bin/console doctrine:migrations:diff`
- `php bin/console doctrine:migrations:migrate`

generate users :
- `php bin/console doctrine:fixtures:load`

generate data with Star Wars API :
- `php bin/console app:init`

run app
- `symfony server:start`

## API

### Users
Logged in as **ADMIN**

`email: "admin@gmail.com",
password: "admin"`

Logged in as **USER**
### For the user role

`email: "user1@gmail.com",
password: "password"`


### Endpoints

1. Planets
   - /api/planets
   - /api/planets/{id}
2. Peoples
    - /api/people
    - /api/people/{id}
3. Species
   - /api/species
   - /api/species/{id}
4. Starships
   - /api/starships
   - /api/starships/{id}
5. Vehicles
   - /api/vehicles
   - /api/vehicles/{id}

You can POST,GET,PUT and DELETE on all the route if you are logged with the "ROLE_ADMIN"

You can GET on all the route if you are logged with the account user

## Admin

### the different routes :

1. DOMAIN_URL/register :  to create a new user with "ROLE_USER"
2. DOMAIN_URL/login : to connect to the admin
3. DOMAIN_URL/admin:  to access to the admin 




