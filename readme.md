# Nette DDD Project Setup

## Requirements

- **Docker**: Make sure you have Docker and Docker Compose installed on your machine.

## Setup Instructions

Follow these steps to set up and run the project:

### 1. Start Docker Containers

The project is Dockerized, so you can easily start the necessary containers using the following command:

```bash
docker-compose up
```

### 3. Install Composer Dependencies

You need to install the Composer dependencies inside the PHP container. Run the following command to install the dependencies:

```bash
docker-compose exec php composer install
```

### 2. Initialize the Database

Once the containers are up and running, you need to initialize the database. Run the following command inside the PHP container to execute the database migrations:

```bash
docker-compose exec php bin/console migrations
```

### Run PHPStan for Linting

To check the code for static analysis issues, use PHPStan. Run the following command in the PHP container:

```bash
docker-compose exec php composer phpstan
