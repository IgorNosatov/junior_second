<?php 
use App\Book;
use ApiTester;
use Faker\Factory;

class DeleteBookCest
{
    public function _before(ApiTester $I)
    {
    }

    public function deleteBook(ApiTester $I)
    {
        //Arrange
        $book=$I->have(Book::class);
        //Act
        $I->sendDELETE('books/delete/'.$book->id);
        $response=$I->grabResponse();

        //Assert
        $I->seeResponseCodeIs(200);
        $I->dontSeeRecord(Book::TABLE_NAME,[Book::ID=>$book->id]);
        $I->assertEquals('Success',$response);
    }

    public function error404(ApiTester $I){
        $id=99;
        $I->sendDELETE('books/delete/'.$id);
        $I->seeResponseCodeIs(404);
    }
}
