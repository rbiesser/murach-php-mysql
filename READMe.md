# Murach PHP and MySQL

https://www.murach.com/shop/murach-s-php-and-mysql-2nd-edition-detail

## Run with Docker Compose
- Open a terminal and browse to a project folder containing `index.php`.
- Copy `docker/docker-compose.yml` to your php/mysql project directory containing 
- Update the database connection string to be `mysql:host=db;dbname=my_guitar_shop1`
- Run commands
```bash
docker-compose up
```
- Browse to http://localhost/
- Make edits on your host and refresh the page to see changes.
- Use `CTRL-C` to stop the containers.
- Use `-d` flag to run in the background.

### Cleanup stopped containers
```bash
docker-compose down
```
- Removes containers and networks.
- Use `--volumes` flag to also delete volumes

## Run without a Dockerfile
- Open a terminal and browse to a location containing 
`index.php`
- Run commands
```bash
docker run -p 80:80 -v "$PWD":/var/www/html php:apache
```
- Browse to http://localhost/
- Make edits on your host and refresh the page to see changes.
- Use `CTRL-C` to stop the container.
- Use `-d` flag to run in the background.

### Cleanup stopped containers
```bash
docker ps -a
docker container prune
```
- Use `ps -a` to view all containers
- `prune` removes stopped containers