<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder {
    public function run(): void {
        $courses = [
            ['course_code'=>'IT101','course_name'=>'Introduction to Computing',      'department'=>'College of Information Technology','units'=>3,'instructor'=>'Prof. Santos',  'capacity'=>40,'enrolled'=>38,'schedule'=>'MWF', 'room'=>'IT-101'],
            ['course_code'=>'IT201','course_name'=>'Data Structures & Algorithms',   'department'=>'College of Information Technology','units'=>3,'instructor'=>'Prof. Reyes',   'capacity'=>35,'enrolled'=>33,'schedule'=>'TTH', 'room'=>'IT-102'],
            ['course_code'=>'IT301','course_name'=>'Web Development',                'department'=>'College of Information Technology','units'=>3,'instructor'=>'Prof. Cruz',    'capacity'=>40,'enrolled'=>37,'schedule'=>'MWF', 'room'=>'IT-Lab1'],
            ['course_code'=>'IT401','course_name'=>'Mobile App Development',         'department'=>'College of Information Technology','units'=>3,'instructor'=>'Prof. Garcia',  'capacity'=>30,'enrolled'=>28,'schedule'=>'TTH', 'room'=>'IT-Lab2'],
            ['course_code'=>'CS301','course_name'=>'Database Management Systems',    'department'=>'College of Information Technology','units'=>3,'instructor'=>'Prof. Flores',  'capacity'=>40,'enrolled'=>40,'schedule'=>'ONLINE','room'=>null],
            ['course_code'=>'CE101','course_name'=>'Engineering Mathematics',        'department'=>'College of Engineering',           'units'=>5,'instructor'=>'Prof. Rivera',  'capacity'=>45,'enrolled'=>42,'schedule'=>'MWF', 'room'=>'ENG-101'],
            ['course_code'=>'CE201','course_name'=>'Structural Analysis',            'department'=>'College of Engineering',           'units'=>4,'instructor'=>'Prof. Lopez',   'capacity'=>40,'enrolled'=>38,'schedule'=>'TTH', 'room'=>'ENG-201'],
            ['course_code'=>'EE101','course_name'=>'Basic Electrical Engineering',   'department'=>'College of Engineering',           'units'=>4,'instructor'=>'Prof. Martinez','capacity'=>40,'enrolled'=>36,'schedule'=>'MWF', 'room'=>'ENG-Lab1'],
            ['course_code'=>'BA101','course_name'=>'Principles of Management',       'department'=>'College of Business',              'units'=>3,'instructor'=>'Prof. Hernandez','capacity'=>50,'enrolled'=>47,'schedule'=>'MWF', 'room'=>'BUS-101'],
            ['course_code'=>'BA201','course_name'=>'Financial Accounting',           'department'=>'College of Business',              'units'=>3,'instructor'=>'Prof. Ramirez', 'capacity'=>45,'enrolled'=>44,'schedule'=>'TTH', 'room'=>'BUS-201'],
            ['course_code'=>'BA301','course_name'=>'Business Economics',             'department'=>'College of Business',              'units'=>3,'instructor'=>'Prof. Perez',   'capacity'=>50,'enrolled'=>48,'schedule'=>'ONLINE','room'=>null],
            ['course_code'=>'HRM101','course_name'=>'Introduction to Hospitality',  'department'=>'College of Business',              'units'=>3,'instructor'=>'Prof. Castillo','capacity'=>40,'enrolled'=>37,'schedule'=>'SAT', 'room'=>'BUS-102'],
            ['course_code'=>'ED101','course_name'=>'Foundation of Education',        'department'=>'College of Education',             'units'=>3,'instructor'=>'Prof. Morales', 'capacity'=>45,'enrolled'=>42,'schedule'=>'MWF', 'room'=>'EDU-101'],
            ['course_code'=>'ED201','course_name'=>'Child & Adolescent Development', 'department'=>'College of Education',             'units'=>3,'instructor'=>'Prof. Jimenez', 'capacity'=>45,'enrolled'=>43,'schedule'=>'TTH', 'room'=>'EDU-201'],
            ['course_code'=>'PE101','course_name'=>'Physical Education 1',           'department'=>'College of Education',             'units'=>2,'instructor'=>'Prof. Romero',  'capacity'=>50,'enrolled'=>50,'schedule'=>'SAT', 'room'=>'GYM'],
            ['course_code'=>'PSY101','course_name'=>'General Psychology',            'department'=>'College of Arts & Sciences',       'units'=>3,'instructor'=>'Prof. Vargas',  'capacity'=>45,'enrolled'=>41,'schedule'=>'MWF', 'room'=>'AS-101'],
            ['course_code'=>'BIO101','course_name'=>'General Biology',               'department'=>'College of Arts & Sciences',       'units'=>4,'instructor'=>'Prof. Medina',  'capacity'=>40,'enrolled'=>38,'schedule'=>'TTH', 'room'=>'SCI-Lab'],
            ['course_code'=>'COM101','course_name'=>'Speech Communication',          'department'=>'College of Arts & Sciences',       'units'=>3,'instructor'=>'Prof. Silva',   'capacity'=>45,'enrolled'=>43,'schedule'=>'ONLINE','room'=>null],
            ['course_code'=>'NUR101','course_name'=>'Fundamentals of Nursing',       'department'=>'College of Nursing',               'units'=>5,'instructor'=>'Prof. Aguilar', 'capacity'=>35,'enrolled'=>33,'schedule'=>'TTH', 'room'=>'NUR-Lab'],
            ['course_code'=>'NUR201','course_name'=>'Medical-Surgical Nursing',      'department'=>'College of Nursing',               'units'=>5,'instructor'=>'Prof. Mendoza', 'capacity'=>35,'enrolled'=>34,'schedule'=>'MWF', 'room'=>'NUR-201'],
            ['course_code'=>'CRIM101','course_name'=>'Introduction to Criminology',  'department'=>'College of Criminology',           'units'=>3,'instructor'=>'Prof. Ortiz',   'capacity'=>45,'enrolled'=>43,'schedule'=>'SAT', 'room'=>'CRIM-101'],
        ];
        foreach ($courses as &$c) { $c['status']='Active'; $c['created_at']=now(); $c['updated_at']=now(); }
        \DB::table('courses')->insert($courses);
        $this->command->info('✓ Seeded '.count($courses).' courses');
    }
}