<?php 
use Carbon\Carbon;
use Faker\Factory;
use UnitTester;

class CreateBookTest extends \Codeception\Test\Unit
{
    public function saveBookTest(UnitTester $I)
    {
        $faker = Factory::create('App\Book');
        $title = $faker->name();
        $author = $faker->name();
        $description = $faker->text();
        $image = $faker->imageUrl();
        $genre = $faker->name();
        $created_at = Carbon::now();
        $updated_at = Carbon::now();

        $I->haveRecord(
            'App\Book',
            [
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'image' => $image,
                'genre' => $genre,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]
        );

        $I->seeRecord(
            'books',
            [
                'title' => $title,
                'author' => $author,
                'description' => $description,
                'image' => $image,
                'genre' => $genre,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]
        );

    }
}