<?php


class University extends AbstractUniversity
{
    public function getSubjects(): array {return $this->subjects;}

    public function addSubject(string $code, string $name): Subject
    {
        $subject = new Subject($code, $name);
        $subjectData = $this->isSubjectExists($code, $name);

        if (!$subjectData['exists']) array_push($this->subjects, $subject);
        else throw new Exception("Subject $code already exists.<br>");

        return $subject;
    }

    public function deleteSubject(Subject $subject): void
    {
        $code = $subject->getCode();
        $subjectData = $this->isSubjectExists($code);

        if ($subjectData['exists']) {
            $students = $this->getStudentsForSubject($subject->getCode());

            if (empty($students)) {
                unset($this->subjects[$subjectData['index']]);
                $this->subjects = array_values($this->subjects);

                echo "Subject $code successfully deleted.<br>";
            }
            else {
                $count = count($students);
                throw new Exception("There are $count student(s) enrolled in subject $code - can't delete.<br>") ;
            }
        }
        else {
            throw new Exception("Subject with code $code doesn't exist.<br>");
        }
    }

    public function addStudentOnSubject(string $code, Student $student): void
    {
        $subjectData = $this->isSubjectExists($code);

        if ($subjectData['exists']) {
            $subject = $this->subjects[$subjectData['index']];
            if (!in_array($student, $subject->getStudents())) {
                $subject->addStudent($student->getName(), $student->getStudentNumber());
            } else {
                $name = $student->getName();
                throw new Exception("Student $name already in course $code.<br>");
            }
        }
        else throw new Exception("Subject with code $code doesn't exist.<br>");
    }

    public function getStudentsForSubject(string $code): array
    {
        foreach ($this->subjects as $subject) {
            if ($subject->getCode() == $code) return $subject->getStudents();
        }
        return [];
    }

    public function getNumberOfStudents(): int
    {
        $sum = 0;
        foreach ($this->subjects as $subject) {
            $sum += count($subject->getStudents());
        }
        return $sum;
    }

    private function isSubjectExists(string $code): array
    {
        for ($i = 0; $i < count($this->subjects); $i++) {
            if ($this->subjects[$i]->getCode() == $code) return ['exists' => true, 'index' => $i];
        }
        return ['exists' => false];
    }

    public function print(): void
    {
        echo '<br><br>';
        foreach ($this->subjects as $subject) {
            echo $subject->getName() . ' - ' . $subject->getCode() . '<br>';
            echo '-------------------------<br>';
            foreach ($subject->getStudents() as $student) {
                echo $student->getName() . ' - ' . $student->getStudentNumber() . '<br>';
            }
            echo '<br><br>';
        }
    }
}