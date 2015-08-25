<?php
    class Department
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function getId()
        {
            return $this->id;
        }

        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function setId($new_id)
        {
            $this->id = $new_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO departments (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_departments = $GLOBALS['DB']->query("SELECT * FROM departments;");
            $departments = array();
            foreach($returned_departments as $department) {
                $name = $department['name'];
                $id = $department['id'];
                $new_department = new Department($name, $id);
                array_push($departments, $new_department);
            }
            return $departments;
        }

        static function find($search_id)
        {
            $found_department = null;
            $department = Department::getAll();
            foreach($department as $department) {
                $department_id = $department->getId();
                if ($department_id == $search_id) {
                    $found_department = $department;
                }
            }
            return $found_department;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM departments;");
        }

        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (student_id, course_id, department_id) VALUES ({$this->getId()}, {$course->getId()},{$course->getId()});");
        }

    }


?>
