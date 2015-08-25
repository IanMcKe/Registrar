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

        function __construct($title, $teacher, $time, $semester, $id)
        {
            $this->title = $title;
            $this->teacher = $teacher;
            $this->time = $time;
            $this->semester = $semester;
            $this->id = $id;
        }
    }
?>
