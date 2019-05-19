docker rm -f ci-landing-page-dev
docker run -d -p 8000:80 -v "$(pwd):/var/www/html" --name ci-landing-page-dev mamat08nurahmat/ci-landing-page
