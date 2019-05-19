docker rm -f my-apache-app
docker run -dit --name my-apache-app -p 8008:80 -v "$PWD":/usr/local/apache2/htdocs/ httpd:2.4
