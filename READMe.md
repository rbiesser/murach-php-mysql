# Murach PHP and MySQL

https://www.murach.com/shop/murach-s-php-and-mysql-2nd-edition-detail

## Run with Docker without a Dockerfile
```bash
docker run -p 80:80 -v "$PWD":/var/www/html php:7.4-apache
```
- Open a terminal and browse to a location containing index.php
- Browse to http://localhost/
- You can make edits on your host and refresh the page to see changes.
- Use `CTRL-C` to stop the container.

### Cleanup stopped containers
```bash
docker ps -a
docker container prune
```
- Use `ps -a` to view all containers
- `prune` removes stopped containers