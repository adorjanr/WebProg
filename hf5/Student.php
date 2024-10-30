<?php

include 'loader.php';

class Student
{
    private string $name;
    private string $studentNumber;
    private array $grades;

    public function __construct(string $name, string $studentNumber)
    {
        $this->name = $name;
        $this->studentNumber = $studentNumber;
        $this->grades = [];
    }
    
    public function getName(): string {return $this->name;}

    public function getStudentNumber(): string {return $this->studentNumber;}

    public function setName(string $x): void {$this->name = $x;}

    public function setStudentNumber(string $x): void {$this->studentNumber = $x;}

    public function addGrade(Subject $subject, int $grade): void
    {
        $this->grades[$subject->getCode()] = $grade;
    }

    public function getAvgGrades(): float
    {
        $sum = 0;
        if (!empty($this->grades)) {
            foreach ($this->grades as $code => $grade) {
                $sum += $grade;
            }
            return $sum / count($this->grades);
        }
        return 0;
    }

    public function printGrades(): void
    {
        foreach ($this->grades as $code => $grade) {
            echo "$code - $grade<br>";
        }
    }
}