#!/bin/bash
FILE="-f docker/docker-compose.yml"
docker-compose $FILE up -d
echo ...Wait to start db...
sleep 10
docker-compose $FILE exec app bash -c "php artisan key:generate; php artisan migrate; npm run prod"
