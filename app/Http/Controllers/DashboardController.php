<?php
namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\SchoolDay;
use App\Models\Student;

class DashboardController extends Controller {
    public function index() {
        $students = [
            'total'    => Student::count(),
            'active'   => Student::where('enrollment_status','Active')->count(),
            'inactive' => Student::where('enrollment_status','Inactive')->count(),
            'graduated'=> Student::where('enrollment_status','Graduated')->count(),
        ];
        $courses = ['total'=>Course::count(),'active'=>Course::where('status','Active')->count()];
        $year = date('Y');
        $monthly = Student::selectRaw('MONTH(enrollment_date) as month, COUNT(*) as count')
            ->whereYear('enrollment_date',$year)->groupBy('month')->orderBy('month')->get();
        $monthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        $enrollmentData = [];
        for ($i=1; $i<=12; $i++) {
            $found = $monthly->firstWhere('month',$i);
            $enrollmentData[] = ['month'=>$monthNames[$i-1],'count'=>$found ? $found->count : 0];
        }
        $courseDistribution = Student::selectRaw('course, COUNT(*) as count')
            ->groupBy('course')->orderByDesc('count')->limit(10)->get();
        $attendanceData = SchoolDay::where('type','School Day')->orderBy('date')->limit(30)->get()
            ->map(fn($d) => ['date'=>$d->date->format('M d'),'present'=>$d->present,'absent'=>$d->absent,'late'=>$d->late]);
        $recentEvents = SchoolDay::where('type','!=','School Day')->orderByDesc('date')->limit(5)->get();
        return response()->json([
            'students'            => $students,
            'courses'             => $courses,
            'enrollment_trend'    => $enrollmentData,
            'course_distribution' => $courseDistribution,
            'attendance'          => $attendanceData,
            'recent_events'       => $recentEvents,
        ]);
    }
}