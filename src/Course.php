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

        function updateTitle($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET title = '{$new_title}' WHERE id = {$this->getId()};");
            $this->title = $new_title;
        }

        function updateTeacher($new_teacher)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET teacher = '{$new_teacher}' WHERE id = {$this->getId()};");
            $this->teacher = $new_teacher;
        }

        function updateTime($new_time)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET time = '{$new_time}' WHERE id = {$this->getId()};");
            $this->time = $new_time;
        }

        function updateSemester($new_semester)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET semester = '{$new_semester}' WHERE id = {$this->getId()};");
            $this->semester = $new_semester;
        }

        function update($new_title, $new_teacher, $new_time, $new_semester)
        {
            $this->updateTitle($new_title);
            $this->updateTeacher($new_teacher);
            $this->updateTime($new_time);
            $this->updateSemester($new_semester);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
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

        static function find($search_id)
        {
            $found_course  = NULL;
            $courses = Course::getAll();
            foreach($courses as $course) {
                $course_id = $course->getId();
                if($course_id == $search_id){
                    $found_course = $course;
                }
            }
            return $found_course;
        }
    }
?>
