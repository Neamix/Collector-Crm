<?php

namespace App\Http\Repository\Books;

use App\Models\BookAttribute;
use Prettus\Repository\Eloquent\BaseRepository;

class BookAttributeRepository extends BaseRepository {

    public function model()
    {
        return BookAttribute::class;
    }

    /*** Upsert Book Attributes */
    public function upsertBookAttributes($request)
    {
        return $this->updateOrCreate([
            'id'  => $request->id
        ],[
            'attribute' => $request->attribute
        ]);
    }

    /*** Get Book Attributes List */
    public function attributesList()
    {
        return $this->all();
    }


    /*** Delete Book Attributes */
    public function deleteBookAttributes($attribute_id)
    {
        // Get Attribute Under Action
        $attribute = $this->find($attribute_id);

        // Detach Attribute 
        $attribute->books()->detach();

        // Delete Attribute
        $attribute->delete();
    }

}