<?php 
use App\Book;
use ApiTester;
use Faker\Factory;

class IndexBookCest
{
    public function _before(ApiTester $I)
    {
    }

    public function showAllbooks(ApiTester $I)
    {

        $books=$I->haveMultiple(Book::class,10);
        
        $expectedArray= [
            Book::CURRENT_PAGE=>1,
            Book::DATA => [
              0 => [
                Book::TITLE => $books[0]->title,
                Book::DESCRIPTION => $books[0]->DESCRIPTION
              ],
              1 =>  [
                Book::TITLE => $books[1]->title,
                Book::DESCRIPTION => $books[1]->DESCRIPTION
              ],
              2 =>  [
                Book::TITLE => $books[2]->title,
                Book::DESCRIPTION => $books[2]->DESCRIPTION
              ]
            ],
            Book::FIRST_PAGE_URL => env('APP_URL').'/api/books?page=1',
            Book::FROM => 1,
            Book::LAST_PAGE => 5,
            Book::LAST_PAGE_URL => env('APP_URL')."/api/books?page=5",
            Book::NEXT_PAGE_URL => env('APP_URL')."/api/books?page=2",
            Book::PATH => env('APP_URL')."/api/books",
            Book::PER_PAGE => 3,
            Book::PREV_PAGE_URL => null,
            Book::TO => 3,
            Book::TOTAL => 13
        ];
          
        $I->sendGET('books');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson($expectedArray);
    }
    public function error404(ApiTester $I){
        $I->sendGET('books');
        $I->seeResponseCodeIs(404);
    }
}
