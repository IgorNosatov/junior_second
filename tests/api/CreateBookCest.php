<?php 
use App\Book;
use ApiTester;
use Faker\Factory;

class CreateBookCest
{
    public function _before(ApiTester $I)
    {
    }

    public function createbook(ApiTester $I)
    {
        //Arrange
        $book=factory(Book::class,1)->create();
        $book=$book->toArray();
        $book=$book[0];
        //Act
        $I->sendbook('book',$book);
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->seeRecord(Book::TABLE_NAME,$book);
        $I->assertEquals('Success' , $response);
    }

    public function error404(ApiTester $I, \Codeception\Example $requiredParameter){
        $book = Factory(Book::class,1)->create();
        $book->toArray();
        $book=$book[0];
        unset($book[$requiredParameter['parameterName']]);
        
        $I->sendBook('book',$book);
        $I->seeResponseCodeIs(400);
    }

    protected function requiredParameters(){
        return [
            ['parameterName'=>Book::TITLE],
            ['parameterName'=>Book::AUTHOR],
            ['parameterName'=>Book::DESCRIPTION],
            ['parameterName'=>Book::IMAGE],
            ['parameterName'=>Book::GENRE],
        ];
    }
}
