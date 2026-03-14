<?php
namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller {
    public function index(Request $request) {
        $query = Course::query();
        if ($request->has('department')) $query->where('department',$request->department);
        return response()->json($query->get());
    }
    public function byDepartment() {
        return response()->json(
            Course::selectRaw('department, COUNT(*) as course_count, SUM(enrolled) as total_enrolled')
                ->groupBy('department')->get()
        );
    }
    public function summary() {
        return response()->json(['total'=>Course::count(),'active'=>Course::where('status','Active')->count()]);
    }
}