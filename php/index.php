<?php

/* 
    The recommend engine: https://github.com/stojg/recommend
    Benchmark tools: https://github.com/fotuzlab/appgati

 */
include './vendor/autoload.php';
require_once './benchmark.php';

$benchmark = new Benchmark();
$benchmark->start();

//Columns: userID, movieID, genreID, reviewID, movieRating, date
$myfile = fopen("../movie-ratings.txt", "r") or die("Unable to open file!");
$rateData = [];
while(!feof($myfile)){
    $current_line = fgets($myfile);
    $columns = explode(",", $current_line);

    $rateData[$columns[0]][$columns[1]] = $columns[4];
}

$data = new \stojg\recommend\Data($rateData);
// Recommend items for user id 9000
$recommendations = $data->recommend(9000, new \stojg\recommend\strategy\Manhattan());
var_export($recommendations);

$benchmark->end();

/* 
Benchmark result
Array
(
    [Clock time in seconds] => 0.048884153366089
    [Time taken in User Mode in seconds] => 0.048082
    [Time taken in System Mode in seconds] => 0.000647
    [Total time taken in Kernel in seconds] => 0.048729
    [Memory limit in MB] => 512
    [Memory usage in MB] => 9.4627685546875
    [Peak memory usage in MB] => 10.125778198242
    [Maximum resident shared size in KB] => 9520
    [Integral shared memory size] => 0
    [Integral unshared data size] => 0
    [Integral unshared stack size] => N ot Available
    [Number of page reclaims] => 2372
    [Number of page faults] => 0
    [Number of block input operations] => 0
    [Number of block output operations] => Not Available
    [Number of messages sent] => 0
    [Number of messages received] => 0
    [Number of signals received] => 0
    [Number of voluntary context switches] => 0
    [Number of involuntary context switches] => 0 
)*/