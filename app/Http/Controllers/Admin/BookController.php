<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\Books\BookAttributeRepository;
use App\Http\Repository\Books\BookRepository;
use App\Http\Requests\BookAttributeRequest;
use App\Http\Requests\BookRequest;
use App\Http\Services\ResponseService;

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

    /*** Upsert Book */
    public function upsertBook(BookRequest $request) 
    {
        $book = $this->bookRepository->upsertBook($request);
        
        return $this->response(200,[
            'status' => SUCCESS,
            'payload' => [
                'title'    => $book->title,
                'auther' => $book->auther,
                'attributes' => $book->attributes
            ]
        ]);
    }

    /*** Delete Book */
    public function deleteBook($book_id)
    {
        $this->bookRepository->deleteBook($book_id);

        return $this->response(200,[
            'status' => SUCCESS
        ]);
    }

    /*** Upsert Custom Attributes To Book */
    public function upsertBookAttributes(BookAttributeRequest $request)
    {
        $attributes = $this->bookAttributeRepository->upsertBookAttributes($request);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'attribute' => $attributes->attribute
            ]
        ]);
    }

    /*** Delete Book Attributes */
    public function deleteBookAttributes($attribute_id)
    {
        $this->bookAttributeRepository->deleteBookAttributes($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
        ]);
    }

    /*** Get Attribute */
    public function getAttribute($attribute_id)
    {
        $attribute = $this->bookAttributeRepository->find($attribute_id);

        return $this->response(200,[
            'status'  => SUCCESS,
            'payload' => [
                'id' => $attribute->id,
                'attribute' => $attribute->attribute
            ]
        ]);
    }
}
