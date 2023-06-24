<?php 

namespace App\Http\Repository\Courses;

use App\Models\Course;
use Prettus\Repository\Eloquent\BaseRepository;

class CourseRepository extends BaseRepository {
    /*** Attach Repo To Model */
    public function model()
    {
        return Course::class;
    }

    /*** Upsert Course */
    public function upsertCourse($request)
    {
        return $this->updateOrCreate(
        [
            'id' => $request->id
        ],    
        [
            'subject' => $request->subject,
            'name'    => $request->name,
            'instractor_id' => $request->instractor_id,
            'start_date'    => $request->start_date,
            'end_date'    => $request->end_date,
        ]);
    }

    /*** Delete Course */
    public function deleteCourse($course_id)
    {
        // Get Course Under Action
        $course = $this->find($course_id);

        // Delete Relations
        $course->attributes()->detach();
        
        // Delete Course
        return $this->where('id',$course_id)->delete();
    }

    public function addStudent($request)
    {
        // Get Course Under Action
        $course = $this->find($request->course_id);

        // Attach Student Attending
        $course->students()->attach([$request->student_id => [
            'score' => $request->score
        ]]);
    }

    /*** Filter Course Data */
    public function filter($request)
    {
        return Course::filter($request);
    }

    /*** Fill Course Attributes */
    public function fillCourseAttributes($course_id,$values)
    {   
        // Get Course Under Action
        $course = $this->find($course_id);

        // Sync Attributes
        $course->attributes()->sync($values);
        
        return $course;
    }
}