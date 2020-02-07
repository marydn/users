## Environment setup using Docker

### Application execution

1. [Install Docker](https://www.docker.com/get-started)

2. Clone this project: `$ git clone https://github.com/marydn/users`

3. Move to the project folder: `$ cd users`

4. Start the project: `$ make build`
   
    This will install PHP dependencies, bring up the Docker containers with Docker Compose and load fixtures in database.

5. Check everything's up: `$ docker-composer ps`

    It should show `nginx`, `php` and `mysql`  services up.

6. Go to `http:://localhost:8000` in your browser

7. By default, local database created by Docker is used in `.env` file
    
   To override this parameter:
    
    ```bash
    $ touch .env.local
    $ echo "DATABASE_URL='sqlite:///XXXXX.sqlite'" >> .env.local
    ```
   
   To fill the new database with fixtures: `make fixtures`

### Some Docker commands

- Bringing up the project using Docker: `$ make`
- Bringing down the project: `$ make destroy`
- Rebuild Docker images forcing latest versions and ignoring cache: `$ make rebuild`

## Project explanation

This is a simple demo project to search users with custom attributes values.

```bash
$ tree -L 4 src
src
├── Controller
│   └── GetUsersController.php
├── DataFixtures
│   └── AppFixtures.php
├── Entity
│   ├── Attribute.php
│   ├── UserHasAttribute.php
│   └── User.php
├── Repository
│   └── UserRepository.php
├── Resources
│   └── config
│       └── doctrine
│           ├── Attribute.orm.yml
│           ├── UserHasAttribute.orm.yml
│           └── User.orm.yml
└── Service
    └── UserManager.php

```
