# techtest

This project implements Best First Search Algorithm to find the first best path from one device to another within certain latency.
Articles about Best First Search can be accessed at https://www.geeksforgeeks.org/best-first-search-informed-search/.
Sorry for the implementation not ideal, can be improved in pattern design with more time.

## Project Setup

Setup with local environment
```
composer install
```

Setup with docker, at root dir
```
docker-compose up -d
docker exec -it test_src composer install
```

Run the program from local environment, at root dir
```
cd src
php index.php [PATH TO CSV FILE] (sample file is at ./map.csv)
```