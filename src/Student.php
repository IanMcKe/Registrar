<?php
    class Student
    {
        //the student's name
        private $name;
        //the student's enrollment date
        private $date;
        //the student id in the database
        private $id;

        function __construct($name, $date, $id = NULL)
        {
            $this->name = $name;
            $this->date = $date;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getDate()
        {
            return $this->date;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setDate($new_date)
        {
            $this->date = $new_date;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, date) VALUES ('{$this->getName()}', '{$this->getDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students ORDER BY name;");
            $students = array();
            foreach($returned_students as $student){
                $name = $student['name'];
                $date = $student['date'];
                $id = $student['id'];
                $new_student = new Student($name, $date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function find($search_id)
        {
            $found_student = NULL;
            $students = Student::getAll();
            foreach($students as $student){
                $student_id = $student->getId();
                if($student_id == $search_id){
                    $found_student = $student;
                }
            }
            return $found_student;
        }
    }
?>
