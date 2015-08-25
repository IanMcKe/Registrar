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

        function updateName($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id={$this->getId()};");
            $this->name = $new_name;
        }

        function updateDate($new_date)
        {
            $GLOBALS['DB']->exec("UPDATE students SET date = '{$new_date}' WHERE id={$this->getId()};");
            $this->date = $new_date;
        }

        function update($new_name, $new_date)
        {
            $this->updateName($new_name);
            $this->updateDate($new_date);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
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

        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (student_id, course_id) VALUES ({$this->getId()}, {$course->getId()});");
        }

        function getCourses()
        {
            $query = $GLOBALS['DB']->query("SELECT courses.* FROM
            students JOIN students_courses ON (students.id = students_courses.student_id)
                     JOIN courses ON (students_courses.course_id = courses.id)
            WHERE students.id = {$this->getId()};");
            $returned_courses = $query->fetchAll(PDO::FETCH_ASSOC);

            $courses = [];
            foreach($returned_courses as $course){
                $title = $course['title'];
                $teacher = $course['teacher'];
                $time = $course['time'];
                $semester = $course['semester'];
                $id = $course['id'];
                $new_course = new Course($title, $teacher, $time, $semester, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }
    }
?>
