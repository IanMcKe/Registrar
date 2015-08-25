<?php
    class Course
    {
        //name of the course (i.e. HIST101 or HIST-101)
        private $title;
        //name of the professor
        private $teacher;
        //times the course takes place (i.e. MWF 9AM-10AM)
        private $time;
        //the semester/dates the course takes place
        private $semester;
        //the id of the course in the database
        private $id;

        function __construct($title, $teacher, $time, $semester, $id=null)
        {
            $this->title = $title;
            $this->teacher = $teacher;
            $this->time = $time;
            $this->semester = $semester;
            $this->id = $id;
        }

        function getTitle()
        {
            return $this->title;
        }

        function getTeacher()
        {
            return $this->teacher;
        }

        function getTime()
        {
            return $this->time;
        }

        function getSemester()
        {
            return $this->semester;
        }

        function getId()
        {
            return $this->id;
        }


        function setTitle($new_title)
        {
            $this->title = $new_title;
        }

        function setTeacher($new_teacher)
        {
            $this->teacher = $new_teacher;
        }

        function setTime($new_time)
        {
            $this->time = $new_time;
        }

        function setSemester($new_semester)
        {
            $this->semester = $new_semester;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (title, teacher, time, semester) VALUES ('{$this->getTitle()}', '{$this->getTeacher()}', '{$this->getTime()}', '{$this->getSemester()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses ORDER BY title;");
            $courses = array();
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

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
        }
    }
?>
