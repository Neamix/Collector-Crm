<?php

namespace App\Http\Repository\Courses;

use App\Models\CourseAttribute;
use Prettus\Repository\Eloquent\BaseRepository;

class CourseAttributeRepository extends BaseRepository {

    public function model()
    {
        return CourseAttribute::class;
    }

    /*** Upsert Course Attributes */
    public function upsertCourseAttributes($request)
    {
        return $this->updateOrCreate([
            'id'  => $request->id
        ],[
            'attribute' => $request->attribute
        ]);
    }

    /*** Get Course Attributes List */
    public function attributesList()
    {
        return $this->all();
    }


    /*** Delete Course Attributes */
    public function deleteCourseAttributes($attribute_id)
    {
        // Get Attribute Under Action
        $attribute = $this->find($attribute_id);

        // Detach Attribute 
        $attribute->courses()->detach();

        // Delete Attribute
        $attribute->delete();
    }

}