<?php

namespace App\Http\Repository\Students;

use App\Models\StudentAttributes;
use Prettus\Repository\Eloquent\BaseRepository;

class StudentAttributeRepository extends BaseRepository {

    public function model()
    {
        return StudentAttributes::class;
    }

    /*** Upsert Student Attributes */
    public function upsertStudentAttributes($request)
    {
        return $this->updateOrCreate([
            'id'  => $request->id
        ],[
            'attribute' => $request->attribute
        ]);
    }

    /*** Get Student Attributes List */
    public function attributesList()
    {
        return $this->all();
    }


    /*** Delete Student Attributes */
    public function deleteStudentAttributes($attribute_id)
    {
        // Get Attribute Under Action
        $attribute = $this->find($attribute_id);

        // Detach Attribute 
        $attribute->students()->detach();

        // Delete Attribute
        $attribute->delete();
    }

}