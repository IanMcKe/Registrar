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
            //Arrange
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

        function test_getTeacher()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);

            //Act
            $result = $test_course->getTeacher();

            //Assert
            $this->assertEquals($teacher, $result);
        }

        function test_getTime()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);

            //Act
            $result = $test_course->getTime();

            //Assert
            $this->assertEquals($time, $result);
        }

        function test_getSemester()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);

            //Act
            $result = $test_course->getSemester();

            //Assert
            $this->assertEquals($semester, $result);
        }

        function test_getId()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $id = 1;
            $test_course = new Course($title, $teacher, $time, $semester, $id);

            //Act
            $result = $test_course->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals($test_course, $result[0]);
        }

        function test_update()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            $title2 = "Intro to Ladders: SHOP-10";
            $teacher2 = "Jeff Winger";
            $time2 = "MWF 11AM-12PM";
            $semester2 = "Spring";
            $test_course->update($title2, $teacher2, $time2, $semester2);

            //Act
            $id = $test_course->getId();
            $result = new Course($title2, $teacher2, $time2, $semester2, $id);

            //Assert
            $this->assertEquals(Course::find($id), $result);
        }

        function test_delete()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            $title2 = "Intro to Ladders: SHOP-10";
            $teacher2 = "Jeff Winger";
            $time2 = "MWF 11AM-12PM";
            $semester2 = "Spring";
            $test_course2 = new Course($title2, $teacher2, $time2, $semester2);
            $test_course2->save();

            //Act
            $test_course->delete();
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course2], $result);
        }

        function test_getAll()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            $title2 = "Intro to Ladders: SHOP-10";
            $teacher2 = "Jeff Winger";
            $time2 = "MWF 11AM-12PM";
            $semester2 = "Spring";
            $test_course2 = new Course($title2, $teacher2, $time2, $semester2);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course2, $test_course], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            $title2 = "Intro to Ladders: SHOP-10";
            $teacher2 = "Jeff Winger";
            $time2 = "MWF 11AM-12PM";
            $semester2 = "Spring";
            $test_course2 = new Course($title2, $teacher2, $time2, $semester2);
            $test_course2->save();

            //Act
            Course::deleteAll();
            $result = Course::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            $title2 = "Intro to Ladders: SHOP-10";
            $teacher2 = "Jeff Winger";
            $time2 = "MWF 11AM-12PM";
            $semester2 = "Spring";
            $test_course2 = new Course($title2, $teacher2, $time2, $semester2);
            $test_course2->save();

            //Act
            $result = Course::find($test_course->getId());

            //Assert
            $this->assertEquals($test_course, $result);
        }
    }
?>
