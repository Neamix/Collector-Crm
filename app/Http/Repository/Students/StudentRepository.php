<?php 

namespace App\Http\Repository\Students;

use App\Http\Services\CustomFieldService;
use App\Models\Setting;
use App\Models\Student;
use Prettus\Repository\Eloquent\BaseRepository;

class StudentRepository extends BaseRepository {
    /*** Attach Repo To Model */
    public function model()
    {
        return Student::class;
    }

    public function upsertStudent($request)
    {
        return $this->updateOrCreate([
            'name' => $request->name,
            'grade' => $request->grade,
            'birthday' => $request->birthday
        ]);
    }

    public function deleteStudent($student_id)
    {
        // Delete Relations

        // Delete Student
        return $this->where('id',$student_id)->delete();
    }

    public function filter($request)
    {
        return Student::filter($request);
    }

    public function addCustomsAttributes($name)
    {
        $this->addCustomField($name);
    }

    public function fillStudentAttributes($request)
    {
        // Get Student Under Action
        $student = Student::find($request->student_id);

        // Fill Student Attributes
        $this->fillAttributes($student,$request->attribute);

        return $student;    
    }

}