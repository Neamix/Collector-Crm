<?php

namespace App\Http\Repository\Instractors;

use App\Models\InstractorAttributes;
use Prettus\Repository\Eloquent\BaseRepository;

class InstractorAttributeRepository extends BaseRepository {

    public function model()
    {
        return InstractorAttributes::class;
    }

    /*** Upsert Instractor Attributes */
    public function upsertInstractorAttributes($request)
    {
        return $this->updateOrCreate([
            'id'  => $request->id
        ],[
            'attribute' => $request->attribute
        ]);
    }

    /*** Get Instractor Attributes List */
    public function attributesList()
    {
        return $this->all();
    }


    /*** Delete Instractor Attributes */
    public function deleteInstractorAttributes($attribute_id)
    {
        // Get Attribute Under Action
        $attribute = $this->find($attribute_id);

        // Detach Attribute 
        $attribute->instractors()->detach();

        // Delete Attribute
        $attribute->delete();
    }

}