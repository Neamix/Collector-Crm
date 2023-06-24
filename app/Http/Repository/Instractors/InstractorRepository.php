<?php 

namespace App\Http\Repository\Instractors;

use App\Models\Instractor;
use Prettus\Repository\Eloquent\BaseRepository;

class InstractorRepository extends BaseRepository {
    /*** Attach Repo To Model */
    public function model()
    {
        return Instractor::class;
    }

    /*** Upsert Instractor */
    public function upsertInstractor($request)
    {
        return $this->updateOrCreate(
        [
            'id' => $request->id
        ],    
        [
            'name' => $request->name,
            'year_of_experience' => $request->year_of_experience,
            'birthday' => $request->birthday
        ]);
    }

    /*** Delete Instractor */
    public function deleteInstractor($instractor_id)
    {
        // Get Instractor Under Action
        $instractor = $this->find($instractor_id);

        // Delete Relations
        $instractor->attributes()->detach();
        
        // Delete Instractor
        return $this->where('id',$instractor_id)->delete();
    }

    /*** Filter Instractor Data */
    public function filter($request)
    {
        return Instractor::filter($request);
    }

    /*** Fill Instractor Attributes */
    public function fillInstractorAttributes($instractor_id,$values)
    {   
        // Get Instractor Under Action
        $instractor = $this->find($instractor_id);

        // Sync Attributes
        $instractor->attributes()->sync($values);
        
        return $instractor;
    }
}