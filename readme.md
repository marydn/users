## Environment setup using Docker

### Environment configuration

1. Clone this project: `$ git clone https://github.com/marydn/users`

2. Move to the project folder: `$ cd users`

3. By default, SQLite database file is set in .env.
    
   To override this parameter with: (feel free to use any valid DSN url value)
    
    ```bash
    $ touch .env.local
    $ echo "DATABASE_URL='sqlite:///XXXXX.sqlite'" >> .env.local
    ```

4. Load some fixtures: `make fixtures`

### Application execution

1. [Install Docker](https://www.docker.com/get-started)

2. Start the project: `$ make build`
   
    This will install PHP dependencies and bring up the project Docker containers with Docker Compose.

3. Check everything's up: `$ docker-composer ps`

    It should show nginx and php services up.

4. Go to `http:://localhost:8000` in your browser

### Some Docker commands

- Bringing up the project using Docker: `$ make`
- Bringing down the project: `$ make destroy`
- Rebuild Docker images forcing latest versions and ignoring cache: `$ make rebuild`

## Project explanation

This is a simple demo project to handle users with custom attributes values.

```bash
$ tree -L 4 src
src
├── Controller
│   └── DefaultController.php
├── DataFixtures
│   └── AppFixtures.php
├── Entity
│   ├── Attribute.php
│   ├── UserHasAttribute.php
│   └── User.php
├── Repository
│   └── UserRepository.php
└── Resources
    └── config
        └── doctrine
            ├── Attribute.orm.yml
            ├── UserHasAttribute.orm.yml
            └── User.orm.yml
```
