<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

        function test_getTitle()
        {
            //Assert
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);

            //Act
            $result = $test_course->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }
    }
?>
