<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class SchoolDaySeeder extends Seeder {
    public function run(): void {
        $records = [];
        $holidays = [
            '2024-01-01'=>"New Year's Day",'2024-04-09'=>'Araw ng Kagitingan',
            '2024-04-17'=>'Maundy Thursday','2024-04-18'=>'Good Friday',
            '2024-05-01'=>'Labor Day','2024-06-12'=>'Independence Day',
            '2024-08-26'=>'National Heroes Day','2024-11-01'=>"All Saints' Day",
            '2024-11-30'=>'Bonifacio Day','2024-12-25'=>'Christmas Day','2024-12-30'=>'Rizal Day',
        ];
        $events = [
            '2024-01-22'=>['type'=>'Event','title'=>'First Day of Classes'],
            '2024-03-15'=>['type'=>'Exam', 'title'=>'Midterm Examinations'],
            '2024-05-20'=>['type'=>'Exam', 'title'=>'Final Examinations'],
            '2024-06-03'=>['type'=>'Event','title'=>'Graduation Ceremony'],
            '2024-10-28'=>['type'=>'Event','title'=>'Foundation Day'],
            '2024-11-15'=>['type'=>'Exam', 'title'=>'Final Examinations'],
        ];
        $current = new \DateTime('2024-01-22');
        $end     = new \DateTime('2024-12-15');
        while ($current <= $end) {
            $ds = $current->format('Y-m-d');
            $dow = (int)$current->format('N');
            if ($dow < 6) {
                if (isset($holidays[$ds])) {
                    $records[] = ['date'=>$ds,'type'=>'Holiday','title'=>$holidays[$ds],'description'=>'Public Holiday','present'=>0,'absent'=>0,'late'=>0,'created_at'=>now(),'updated_at'=>now()];
                } elseif (isset($events[$ds])) {
                    $ev = $events[$ds];
                    $records[] = ['date'=>$ds,'type'=>$ev['type'],'title'=>$ev['title'],'description'=>$ev['title'],'present'=>rand(400,480),'absent'=>rand(20,80),'late'=>rand(10,40),'created_at'=>now(),'updated_at'=>now()];
                } else {
                    $records[] = ['date'=>$ds,'type'=>'School Day','title'=>'Regular School Day','description'=>null,'present'=>rand(400,475),'absent'=>rand(10,60),'late'=>rand(5,30),'created_at'=>now(),'updated_at'=>now()];
                }
            }
            $current->modify('+1 day');
        }
        foreach (array_chunk($records,50) as $chunk) \DB::table('school_days')->insert($chunk);
        $this->command->info('✓ Seeded '.count($records).' school days');
    }
}   