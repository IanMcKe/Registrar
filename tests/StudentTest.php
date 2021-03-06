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

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            //Act
            $result = $test_student->getName();
            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getDate()
        {
            //Arrange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            //Act
            $result = $test_student->getDate();
            //Assert
            $this->assertEquals($date, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $id = 1;
            $test_student = new Student($name, $date, $id);
            //Act
            $result = $test_student->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getAll()
        {
            //Arange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            $name2 = "Fred Flintstone";
            $date2 = "0001-01-01";
            $test_student2 = new Student($name2, $date2);
            $test_student2->save();

            //Act
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$test_student2, $test_student], $result);

        }

        function test_save()
        {
            //Arange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            //Act
            $result = Student::getAll();

            //Assert
            $this->assertEquals($test_student, $result[0]);
        }

        function test_update()
        {
            //Arange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            $name2 = "Fred Flintstone";
            $date2 = "0001-01-01";
            $test_student->update($name2, $date2);

            //Act
            $id = $test_student->getId();
            $result = new Student($name2, $date2, $id);

            //Assert
            $this->assertEquals(Student::find($id), $result);
        }

        function test_delete()
        {
            //Arange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            $name2 = "Fred Flintstone";
            $date2 = "0001-01-01";
            $test_student2 = new Student($name2, $date2);
            $test_student2->save();

            //Act
            $test_student->delete();
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$test_student2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            $name2 = "Fred Flintstone";
            $date2 = "0001-01-01";
            $test_student2 = new Student($name2, $date2);
            $test_student2->save();

            //Act
            Student::deleteAll();
            $result = Student::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            $name2 = "Fred Flintstone";
            $date2 = "0001-01-01";
            $test_student2 = new Student($name2, $date2);
            $test_student2->save();

            //Act
            $result = Student::find($test_student->getId());

            //Assert
            $this->assertEquals($test_student, $result);

        }

        function test_addCourse()
        {
            //Arrange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            //Act
            $result = [$test_course];
            $test_student->addCourse($test_course);

            //Assert
            $this->assertEquals($test_student->getCourses(), $result);
        }

        function test_getCourses()
        {
            //Arrange
            $name = "Steve Beekman";
            $date = "2015-08-23";
            $test_student = new Student($name, $date);
            $test_student->save();

            $title = "Intro to Typing: COM-91";
            $teacher = "Ancient Raven";
            $time = "TH 9PM-11PM";
            $semester = "Fall";
            $test_course = new Course($title, $teacher, $time, $semester);
            $test_course->save();

            //Act
            $result = [$test_student];
            $test_course->addStudent($test_student);

            //Assert
            $this->assertEquals($test_course->getStudents(), $result);
        }

    }
?>
