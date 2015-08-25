<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";
    require_once "src/Department.php";

    $server = 'mysql:host=localhost;dbname=registrar_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class DepartmentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
            Department::deleteAll();
        }


        function testSave()
        {
            //Arrange
            $name = "Math";
            $id = 1;
            $test_department = new Department($name, $id);
            $test_department->save();

            //Act
            $result = Department::getAll();

            //Assert
            $this->assertEquals($test_department, $result[0]);
        }

        function testFind() {

            //Arrange
            $name = "Math";
            $id = 1;
            $test_department = new Department($name, $id);
            $test_department->save();

            $name2 = "Business";
            $id2 = 2;
            $test_department2 = new Department($name2, $id2);
            $test_department2->save();

            //Act
            $id = $test_department->getId();
            $result = Department::find($id);

            //Assert
            $this->assertEquals($test_department, $result);
        }
    }
?>
