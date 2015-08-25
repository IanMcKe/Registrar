<?php

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Student.php";

    $app = new Silex\Application();

    $app['debug']=true;

    $server = 'mysql:host=localhost;dbname=registrar';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig');
    });

    $app->get("/students", function() use ($app) {
        return $app['twig']->render('students.html.twig', array('students'=>Student::getAll()));
    });

    $app->post("/students", function() use ($app) {
        $student = new Student($_POST['name'], $_POST['date']);
        $student->save();
        return $app['twig']->render('students.html.twig', array('students'=>Student::getAll()));
    });

    $app->get("/courses", function() use ($app) {
        return $app['twig']->render('courses.html.twig', array('courses'=>Course::getAll()));
    });

    $app->post("courses", function() use ($app) {
        $course = new Course($_POST['title'], $_POST['teacher'], $_POST['time'], $_POST['semester']);
        $course->save();
        return $app['twig']->render('courses.html.twig', array('courses'=>Course::getAll()));
    });

    $app->get("/courses/{id}", function($id) use ($app) {
        $course = Course::find($id);
        return $app['twig']->render('course.html.twig', array('course'=>$course, 'students'=>$course->getStudents(), 'all_students'=>Student::getAll()));
    });

    $app->post("/add_student", function() use ($app) {
        $student = Student::find($_POST['student_id']);
        $course = Course::find($_POST['course_id']);
        $course->addStudent($student);
        return $app['twig']->render('course.html.twig', array('course'=>$course, 'students'=>$course->getStudents(), 'all_students'=>Student::getAll()));
    });

    $app->get("/courses/{id}/edit", function($id) use ($app) {
        $course = Course::find($id);
        return $app['twig']->render('course_edit.html.twig', array('course' => $course));
    });

    $app->patch("/course/{id}", function($id) use ($app) {
        $course = Course::find($id);
        $course->update($_POST['title'],$_POST['teacher'], $_POST['time'],$_POST['semester']);
        return $app['twig']->render('course.html.twig', array('course'=>$course, 'students' => $course->getStudents(), 'all_students'=>Student::getAll()));
    });

    $app->get("/student/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $courses = $student->getCourses();
        return $app['twig']->render('student.html.twig', array('student' =>$student, 'courses' => $courses, 'all_courses' => Course::getAll()));
    });

    $app->get("/student/{id}/edit", function($id) use ($app) {
        $student = Student::find($id);
        return $app['twig']->render('student_edit.html.twig', array('student' => $student));
    });

    $app->patch("/student/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $student->update($_POST['name'],$_POST['date']);
        return $app['twig']->render('student.html.twig', array('student'=>$student, 'courses'=>$student->getCourses(), 'all_courses'=> Course::getAll()));
    });



    return $app;

 ?>
