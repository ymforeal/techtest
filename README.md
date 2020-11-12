# techtest

## Thank you for review

This project implements Best First Search Algorithm to find the first best path from one device to another within certain latency.
Articles about Best First Search can be accessed at https://www.geeksforgeeks.org/best-first-search-informed-search/.
Sorry for the implementation not ideal, can be improved in pattern design with more time.

## Project Setup

Setup with local environment
```
$ composer install
```

Run the program from local environment, at root dir
```
$ cd src
$ php index.php [PATH TO CSV FILE]
```
Sample
```
$ php index.php ./map.csv
A F 1000
A F 1200
A D 100
A D 200
E A 400
E A 80

```


Setup with docker, at root dir, please put CSV files for testing in ./src

```
$ docker-compose up -d
$ docker exec -it test_src composer install
```
Run the program with docker containers and sample files
```
docker exec -it test_src php index.php ./map.csv
```