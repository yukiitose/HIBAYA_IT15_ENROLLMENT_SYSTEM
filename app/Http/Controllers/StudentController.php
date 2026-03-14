<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller {
    public function index(Request $request) {
        $query = Student::query();
        if ($request->has('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('first_name','like',"%$s%")
                  ->orWhere('last_name','like',"%$s%")
                  ->orWhere('student_id','like',"%$s%")
                  ->orWhere('email','like',"%$s%");
            });
        }
        return response()->json($query->paginate(20));
    }
    public function enrollmentStats() {
        $year = date('Y');
        $monthly = Student::selectRaw('MONTH(enrollment_date) as month, COUNT(*) as count')
            ->whereYear('enrollment_date', $year)->groupBy('month')->orderBy('month')->get();
        $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $data = [];
        for ($i=1; $i<=12; $i++) {
            $found = $monthly->firstWhere('month',$i);
            $data[] = ['month'=>$months[$i-1],'count'=>$found ? $found->count : 0];
        }
        return response()->json($data);
    }
    public function courseDistribution() {
        return response()->json(
            Student::selectRaw('course, COUNT(*) as count')->groupBy('course')->orderByDesc('count')->get()
        );
    }
    public function summary() {
        return response()->json([
            'total'    => Student::count(),
            'active'   => Student::where('enrollment_status','Active')->count(),
            'inactive' => Student::where('enrollment_status','Inactive')->count(),
            'graduated'=> Student::where('enrollment_status','Graduated')->count(),
        ]);
    }
}