<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder {
    public function run(): void {
        $departments = [
            'College of Information Technology' => ['BSIT','BSCS','BSIS'],
            'College of Engineering'            => ['BSCE','BSEE','BSME'],
            'College of Business'               => ['BSBA','BSA','BSHRM'],
            'College of Education'              => ['BEED','BSED','BPE'],
            'College of Arts & Sciences'        => ['AB-Psych','AB-CommArts','BS-Biology'],
            'College of Nursing'                => ['BSN'],
            'College of Criminology'            => ['BSCrim'],
        ];
        $firstNames = ['Juan','Maria','Jose','Ana','Pedro','Rosa','Carlos','Elena','Miguel','Sofia',
            'Antonio','Isabella','Francisco','Valentina','Luis','Camila','Jorge','Lucia','Manuel',
            'Daniela','Roberto','Fernanda','Andres','Mariana','Ricardo','Gabriela','Mark','Christine',
            'James','Patricia','John','Mary','Michael','Jennifer','David','Linda','Kevin','Angelica'];
        $lastNames = ['Santos','Reyes','Cruz','Garcia','Torres','Flores','Rivera','Lopez','Gonzalez',
            'Martinez','Hernandez','Ramirez','Perez','Castillo','Morales','Jimenez','Romero','Vargas',
            'Medina','Silva','Aguilar','Mendoza','Ortiz','Ramos','Delgado','Villanueva','Aquino',
            'Bautista','Pascual','Navarro','Salazar','Lim','Tan','Ong','Sy','Chua'];
        $addresses = ['Cotabato City','General Santos City','Koronadal City','Kidapawan City',
            'Tacurong City','Isulan, Sultan Kudarat','Midsayap, Cotabato','Kabacan, Cotabato',
            'Libungan, Cotabato','Pigcawayan, Cotabato','Pikit, Cotabato','Tupi, South Cotabato'];
        $genders   = ['Male','Female','Male','Female','Male','Female','Other'];
        $statuses  = ['Active','Active','Active','Active','Active','Inactive','Graduated'];
        $records   = [];
        $idCounter = 100001;

        foreach ($departments as $dept => $courses) {
            $perDept = (int)(500 / count($departments)) + rand(5,20);
            for ($i=0; $i<$perDept; $i++) {
                $fn = $firstNames[array_rand($firstNames)];
                $ln = $lastNames[array_rand($lastNames)];
                $records[] = [
                    'student_id' => (string)$idCounter++,
                    'first_name'        => $fn,
                    'last_name'         => $ln,
                    'email'             => strtolower($fn.'.'.$ln.rand(1,999)).'@student.edu.ph',
                    'gender'            => $genders[array_rand($genders)],
                    'birth_date'        => date('Y-m-d',mktime(0,0,0,rand(1,12),rand(1,28),rand(2000,2005))),
                    'address'           => $addresses[array_rand($addresses)],
                    'department'        => $dept,
                    'course'            => $courses[array_rand($courses)],
                    'year_level'        => rand(1,4),
                    'enrollment_status' => $statuses[array_rand($statuses)],
                    'enrollment_date'   => date('Y-m-d',mktime(0,0,0,rand(1,12),rand(1,28),rand(2021,2024))),
                    'created_at'        => now(),
                    'updated_at'        => now(),
                ];
            }
        }
        foreach (array_chunk($records,50) as $chunk) \DB::table('students')->insert($chunk);
        $this->command->info('✓ Seeded '.count($records).' students');
    }
}