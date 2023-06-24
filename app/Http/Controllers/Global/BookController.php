<?php

namespace App\Http\Controllers\Global;

use App\Http\Controllers\Controller;
use App\Http\Repository\Books\BookAttributeRepository;
use App\Http\Repository\Books\BookRepository;
use App\Http\Services\ResponseService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ResponseService;

    public $bookRepository;
    public $bookAttributeRepository;

    public function __construct(BookRepository $bookRepository,BookAttributeRepository $bookAttributeRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->bookAttributeRepository = $bookAttributeRepository;
    }

    /*** List Book Attributes */
    public function attributesList()
    {
        $result = $this->bookAttributeRepository->attributesList();

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result,
            ]
        ]);
    }

    /*** Filter All Book */
    public function filter(Request $request)
    {
        $result = $this->bookRepository->filter($request->all())->with(['attributes'])->paginate(10);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'data' => $result->items(),
                'total_pages'  => $result->lastPage(),
                'current_page' => $result->currentPage()
            ]
        ]);
    }

    /*** Get Book */
    public function getBook($book_id)
    {
        $book = $this->bookRepository->find($book_id);

        return $this->response(200,[
            'status'   => SUCCESS,
            'payload'  => [
                'title' => $book->title,
                'auther' => $book->auther,
            ]
        ]);
    }

    /*** Fill Book Attributes */
    public function fillBookAttributes(Request $request)
    {
        $book = $this->bookRepository->fillBookAttributes($request->book_id,$request->values);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attributes' => $book->attributes,
            ]
        ]);
    }
}
