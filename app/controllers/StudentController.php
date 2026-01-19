<?php
// app/controllers/StudentController.php

require_once __DIR__ . '/../models/Student.php';

class StudentController {
    private $studentModel;
    private $blade;

    public function __construct($pdo, $blade) {
        $this->studentModel = new Student($pdo);
        $this->blade = $blade;
    }

    public function index() {
        $students = $this->studentModel->all();
        echo $this->blade->render('students.index', ['students' => $students]);
    }

    public function create() {
        echo $this->blade->render('students.create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->studentModel->create(
                $_POST['name'],
                $_POST['email'],
                $_POST['course']
            );
            // Correct for your setup
            header('Location: /Fullstack/Workshop8/public/index.php?action=index');


            exit;
        }
    }

    public function edit($id) {
        $student = $this->studentModel->find($id);
        echo $this->blade->render('students.edit', ['student' => $student]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->studentModel->update(
                $id,
                $_POST['name'],
                $_POST['email'],
                $_POST['course']
            );
            // Correct for your setup
            header('Location: /Fullstack/Workshop8/public/index.php?action=index');


            exit;
        }
    }

    public function delete($id) {
        $this->studentModel->delete($id);
        // Correct for your setup
        header('Location: /Fullstack/Workshop8/public/index.php?action=index');


        exit;
    }
}
