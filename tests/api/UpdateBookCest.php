<?php 
use App\Book;
use ApiTester;
use Faker\Factory;

class UpdateBookCest
{

    public function updateBook(ApiTester $I)
    {
        $book=$I->have(Book::class);
        $faker=Factory::create();
        $updates=[
            Book::TITLE => $faker->sentence(5),
            Book::DESCRIPTION => $faker->text
            ];
        $expectedArray=[
            'data'=>[
                $book->id => [
                    Book::TITLE => $updates[Book::TITLE],
                    Book::DESCRIPTION => $updates[Book::DESCRIPTION]
                ]
            ]
        ];
        $expectedJson=json_encode($expectedArray);

        $I->sendPUT('books/update/'.$book->id,$updates);
        $response=$I->grabResponse();

        $I->seeResponseCodeIs(200);
        $I->seeRecord(Book::TABLE_NAME,$updates);
        $I->assertEquals($expectedJson,$response);
    }
    public function error404(ApiTester $I){
        $id=22;
        $I->sendPUT('books/update/'.$id);
        $I->seeResponseCodeIs(404);
    }
}
