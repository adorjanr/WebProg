<?php

include 'loader.php';

$sapi = new University();
$peti = new Student('Nagy Péter', '1');

function studentAvgs(array $students): array {
    $studentAvgs = [];
    foreach ($students as $s) {
        $studentAvgs[$s->getName()] = $s->getAvgGrades();
    }
    arsort($studentAvgs);
    return $studentAvgs;
}

try {
    $matek = $sapi->addSubject('m24', 'Matematika');
    $info = $sapi->addSubject('i24', 'Informatika');
    $sanyi = $matek->addStudent('Lakatos Sándor', '2');
    $sapi->addStudentOnSubject('i24', $peti);
    $sapi->addStudentOnSubject('i24', $sanyi);
    $sapi->print();

    echo 'i24 hallgatók: '; print_r($sapi->getStudentsForSubject('i24')); echo '<br>';
    $nr = $sapi->getNumberOfStudents();
    echo "Sapi hallgatók száma: $nr<br><br>";
    
    $matek->deleteStudent('2');
    $sapi->print();
    
    $sapi->deleteSubject($matek);
    $sapi->print();

    echo '<br>';
    $peti->addGrade($matek, 4);
    $peti->addGrade($info, 10);
    $sanyi->addGrade($matek, 8);
    $sanyi->addGrade($info, 9);
    echo 'Sanyi:<br>';
    $peti->printGrades();
    echo 'Peti:<br>';
    $sanyi->printGrades();

    $students = [$peti, $sanyi];
    $studentAvgs = studentAvgs($students);
    print_r($studentAvgs);
    echo '<br>';
} catch (Exception $e) {
    echo $e->getMessage();
}


// hibák
echo '<br>';
try {$info->addStudent('Lakatos Sándor', '2');}
catch (Exception $e) {echo $e->getMessage();}

try {
    $info->deleteStudent('Lakatos Sándor', '2');
    $info->deleteStudent('Lakatos Sándor', '2');
}
catch (Exception $e) {echo $e->getMessage();}

try {$sapi->addSubject('i24', 'Informatika');}
catch (Exception $e) {echo $e->getMessage();}

try {$sapi->deleteSubject($info);}
catch (Exception $e) {echo $e->getMessage();}

try {$sapi->deleteSubject($matek);}
catch (Exception $e) {echo $e->getMessage();}

try {$sapi->addStudentOnSubject('i24', $peti);}
catch (Exception $e) {echo $e->getMessage();}

try {$sapi->addStudentOnSubject('m24', $peti);}
catch (Exception $e) {echo $e->getMessage();}