<?php 

namespace App\Http\Repository\Books;

use App\Models\Book;
use Prettus\Repository\Eloquent\BaseRepository;

class BookRepository extends BaseRepository {
    /*** Attach Repo To Model */
    public function model()
    {
        return Book::class;
    }

    /*** Upsert Book */
    public function upsertBook($request)
    {
        return $this->updateOrCreate(
        [
            'id' => $request->id
        ],    
        [
            'title' => $request->title,
            'auther'    => $request->auther,
        ]);
    }

    /*** Delete Book */
    public function deleteBook($book_id)
    {
        // Get Book Under Action
        $book = $this->find($book_id);

        // Delete Relations
        $book->attributes()->detach();
        
        // Delete Book
        return $this->where('id',$book_id)->delete();
    }


    /*** Filter Book Data */
    public function filter($request)
    {
        return Book::filter($request);
    }

    /*** Fill Book Attributes */
    public function fillBookAttributes($book_id,$values)
    {   
        // Get Book Under Action
        $book = $this->find($book_id);

        // Sync Attributes
        $book->attributes()->sync($values);

        return $book;
    }
}