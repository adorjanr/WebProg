<?php


class Subject
{
    private string $code;
    private string $name;
    /**
     * @var Student[]
     */
    private array $students = [] ;

    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
        $this->students = [];
    }
    
    public function getCode(): string {return $this->code;}

    public function getName(): string {return $this->name;}

    public function getStudents(): array {return $this->students;}

    public function setCode(string $x): void {$this->code = $x;}

    public function setName(string $x): void {$this->name = $x;}

    /**
     * Method accepts student name and number, creates instance of the Student class, adds inside $students array
     * and returns created instance
     *
     * @param string $name
     * @param string $studentNumber
     * @return Student
     */
    public function addStudent(string $name, string $studentNumber): Student
    {
        $student = new Student($name, $studentNumber);
        $studentData = $this->isStudentExists($studentNumber);

        if (!$studentData['exists']) array_push($this->students, $student);
        else throw new Exception("Student $name already in course $this->code.<br>");

        return $student;
    }

    public function deleteStudent(string $studentNumber): void
    {
        $studentData = $this->isStudentExists($studentNumber);
        if ($studentData['exists']){
            unset($this->students[$studentData['index']]);
            $this->students = array_values($this->students);
            echo "Student $studentNumber successfully unenrolled from course $this->code.<br>";
        } else throw new Exception("Student $studentNumber is not enrolled in course $this->code.<br>");
    }

    private function isStudentExists(string $studentNumber): array
    {
        for ($i = 0; $i < count($this->students); $i++) {
            if ($this->students[$i]->getStudentNumber() == $studentNumber) return ['exists' => true, 'index' => $i];
        }
        return ['exists' => false];
    }

    public function __toString()
    {
        return "$this->code - $this->name: " . implode(', ', $this->students);
    }
}