<?php 

namespace App\Http\Repository\Students;

use App\Models\Student;
use Prettus\Repository\Eloquent\BaseRepository;

class StudentRepository extends BaseRepository {
    /*** Attach Repo To Model */
    public function model()
    {
        return Student::class;
    }

    /*** Upsert Student */
    public function upsertStudent($request)
    {
        return $this->updateOrCreate([
            'name' => $request->name,
            'grade' => $request->grade,
            'birthday' => $request->birthday
        ]);
    }

    /*** Delete Student */
    public function deleteStudent($student_id)
    {
        // Delete Relations

        // Delete Student
        return $this->where('id',$student_id)->delete();
    }

    /*** Filter Student Data */
    public function filter($request)
    {
        return Student::filter($request);
    }

    /*** Fill Student Attributes */
    public function fillStudentAttributes($student_id,$values)
    {   
        // Get Student Under Action
        $student = $this->find($student_id);

        // Sync Attributes
        $student->attributes()->sync($values);
        
        return $student;
    }
}