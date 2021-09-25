<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Story;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Story::class, function (Faker $faker) {
    $type = $faker->randomElement(['long','short']);
    if($type == 'short'){
        $body = $faker->text('500');
    }else{
        $body = $faker->paragraph();
    }
    
    return [
        'user_id' => $faker->numberBetween(1,2),
        'title' => $faker->unique()->lexify('??????????'),
        'body' => $body,
        'type' =>$type,
        'status' => 1
    ];
});
