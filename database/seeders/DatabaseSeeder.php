<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\AssignClassTeacher;
use App\Models\AssignSubject;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\ClassRoom;
use App\Models\ClassRoutine;
use App\Models\ClassTime;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\FeesGroup;
use App\Models\FeesMaster;
use App\Models\FeesType;
use App\Models\Homework;
use App\Models\Lesson;
use App\Models\MarksGrade;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Notice;
use App\Models\OnlineExam;
use App\Models\OnlineExamQuestion;
use App\Models\PaymentMethod;
use App\Models\QuestionBank;
use App\Models\Section;
use App\Models\SchoolClass;
use App\Models\Setting;
use App\Models\Staff;
use App\Models\Student;
use App\Models\StudentCategory;
use App\Models\Subject;
use App\Models\Testimonial;
use App\Models\Topic;
use App\Models\TransportRoute;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---------------- Users ----------------
        $admin = User::create(['name' => 'System Admin', 'email' => 'admin@school.com', 'password' => Hash::make('password'), 'role' => 'admin', 'phone' => '01700000001']);
        User::create(['name' => 'Accountant User', 'email' => 'accounts@school.com', 'password' => Hash::make('password'), 'role' => 'accountant', 'phone' => '01700000002']);
        $teacher1 = User::create(['name' => 'Sarah Johnson', 'email' => 'teacher@school.com', 'password' => Hash::make('password'), 'role' => 'teacher', 'phone' => '01700000003']);
        $teacher2 = User::create(['name' => 'David Miller', 'email' => 'teacher2@school.com', 'password' => Hash::make('password'), 'role' => 'teacher', 'phone' => '01700000004']);
        $parent = User::create(['name' => 'Michael Brown', 'email' => 'parent@school.com', 'password' => Hash::make('password'), 'role' => 'parent', 'phone' => '01700000005']);
        $studentUser = User::create(['name' => 'Emily Brown', 'email' => 'student@school.com', 'password' => Hash::make('password'), 'role' => 'student', 'phone' => '01700000006']);

        // ---------------- Academics ----------------
        AcademicYear::create(['name' => '2025-2026', 'start_date' => '2025-07-01', 'end_date' => '2026-06-30', 'is_active' => true]);

        $class8 = SchoolClass::create(['name' => 'Class 8']);
        $class9 = SchoolClass::create(['name' => 'Class 9']);
        $class10 = SchoolClass::create(['name' => 'Class 10']);

        $secA = Section::create(['name' => 'A', 'class_id' => $class9->id, 'capacity' => 40]);
        Section::create(['name' => 'B', 'class_id' => $class9->id, 'capacity' => 40]);
        Section::create(['name' => 'A', 'class_id' => $class8->id, 'capacity' => 40]);
        Section::create(['name' => 'A', 'class_id' => $class10->id, 'capacity' => 40]);

        $math = Subject::create(['name' => 'Mathematics', 'code' => 'MTH', 'type' => 'theory']);
        $eng = Subject::create(['name' => 'English', 'code' => 'ENG', 'type' => 'theory']);
        $sci = Subject::create(['name' => 'Science', 'code' => 'SCI', 'type' => 'theory']);
        Subject::create(['name' => 'ICT', 'code' => 'ICT', 'type' => 'practical']);

        $room1 = ClassRoom::create(['name' => 'Room 101', 'capacity' => 45]);
        ClassRoom::create(['name' => 'Room 102', 'capacity' => 45]);

        ClassTime::create(['period' => 'Period 1', 'start_time' => '08:00', 'end_time' => '08:45']);
        ClassTime::create(['period' => 'Period 2', 'start_time' => '08:45', 'end_time' => '09:30']);

        AssignClassTeacher::create(['class_id' => $class9->id, 'section_id' => $secA->id, 'teacher_id' => $teacher1->id]);
        AssignSubject::create(['class_id' => $class9->id, 'section_id' => $secA->id, 'subject_id' => $math->id, 'teacher_id' => $teacher1->id]);
        AssignSubject::create(['class_id' => $class9->id, 'section_id' => $secA->id, 'subject_id' => $eng->id, 'teacher_id' => $teacher2->id]);

        foreach ([
            ['Monday', $math->id, $teacher1->id, '08:00', '08:45'],
            ['Monday', $eng->id, $teacher2->id, '08:45', '09:30'],
            ['Tuesday', $sci->id, $teacher1->id, '08:00', '08:45'],
            ['Wednesday', $math->id, $teacher1->id, '08:45', '09:30'],
            ['Thursday', $eng->id, $teacher2->id, '08:00', '08:45'],
        ] as [$day, $sub, $t, $from, $to]) {
            ClassRoutine::create(['class_id' => $class9->id, 'section_id' => $secA->id, 'subject_id' => $sub, 'teacher_id' => $t, 'room_id' => $room1->id, 'day' => $day, 'start_time' => $from, 'end_time' => $to]);
        }

        // ---------------- Students ----------------
        $cat = StudentCategory::create(['name' => 'General']);
        $student = Student::create([
            'admission_no' => 'ADM-0001', 'roll_no' => '1', 'first_name' => 'Emily', 'last_name' => 'Brown',
            'gender' => 'female', 'dob' => '2011-03-15', 'category_id' => $cat->id,
            'class_id' => $class9->id, 'section_id' => $secA->id, 'parent_id' => $parent->id,
            'user_id' => $studentUser->id, 'phone' => '01711111111', 'email' => 'student@school.com',
            'address' => '12 Lake View Road', 'admission_date' => '2025-07-05', 'status' => 'active',
        ]);
        Student::create([
            'admission_no' => 'ADM-0002', 'roll_no' => '2', 'first_name' => 'James', 'last_name' => 'Wilson',
            'gender' => 'male', 'dob' => '2011-06-20', 'category_id' => $cat->id,
            'class_id' => $class9->id, 'section_id' => $secA->id,
            'phone' => '01722222222', 'admission_date' => '2025-07-05', 'status' => 'active',
        ]);
        Student::create([
            'admission_no' => 'ADM-0003', 'roll_no' => '3', 'first_name' => 'Ayesha', 'last_name' => 'Khan',
            'gender' => 'female', 'dob' => '2011-01-10', 'category_id' => $cat->id,
            'class_id' => $class9->id, 'section_id' => $secA->id,
            'phone' => '01733333333', 'admission_date' => '2025-07-06', 'status' => 'active',
        ]);

        // ---------------- Exams ----------------
        MarksGrade::insert([
            ['name' => 'A+', 'gpa' => 5.00, 'percent_from' => 80, 'percent_to' => 100],
            ['name' => 'A', 'gpa' => 4.00, 'percent_from' => 70, 'percent_to' => 79],
            ['name' => 'B', 'gpa' => 3.00, 'percent_from' => 60, 'percent_to' => 69],
            ['name' => 'C', 'gpa' => 2.00, 'percent_from' => 50, 'percent_to' => 59],
            ['name' => 'F', 'gpa' => 0.00, 'percent_from' => 0, 'percent_to' => 49],
        ]);
        $final = ExamType::create(['name' => 'Final Exam', 'include_in_final' => true]);
        ExamType::create(['name' => 'Class Test', 'include_in_final' => false]);
        Exam::create(['name' => 'First Term 2025', 'exam_type_id' => $final->id, 'class_id' => $class9->id, 'section_id' => $secA->id, 'start_date' => '2025-11-01', 'end_date' => '2025-11-10', 'exam_mark' => 100]);

        // ---------------- Online exam ----------------
        $q1 = QuestionBank::create(['question' => 'What is 12 x 8?', 'type' => 'mcq', 'option_a' => '86', 'option_b' => '96', 'option_c' => '104', 'option_d' => '88', 'correct_answer' => 'B', 'mark' => 1, 'class_id' => $class9->id, 'subject_id' => $math->id]);
        $q2 = QuestionBank::create(['question' => 'The earth revolves around the sun.', 'type' => 'true_false', 'correct_answer' => 'true', 'mark' => 1, 'class_id' => $class9->id, 'subject_id' => $sci->id]);
        $q3 = QuestionBank::create(['question' => 'The past tense of "go" is ____.', 'type' => 'fill_blank', 'correct_answer' => 'went', 'mark' => 1, 'class_id' => $class9->id, 'subject_id' => $eng->id]);
        $oe = OnlineExam::create(['title' => 'Weekly Quiz - Mixed', 'class_id' => $class9->id, 'section_id' => $secA->id, 'subject_id' => $math->id, 'date' => today()->toDateString(), 'start_time' => '08:00', 'end_time' => '23:59', 'duration_minutes' => 10, 'total_mark' => 3, 'status' => 'published']);
        foreach ([$q1, $q2, $q3] as $q) {
            OnlineExamQuestion::create(['online_exam_id' => $oe->id, 'question_bank_id' => $q->id]);
        }

        // ---------------- Homework / lessons ----------------
        Homework::create(['class_id' => $class9->id, 'section_id' => $secA->id, 'subject_id' => $math->id, 'homework_date' => today()->subDays(2)->toDateString(), 'submission_date' => today()->addDays(3)->toDateString(), 'marks' => 10, 'description' => 'Solve exercise 4.1, questions 1-10 (algebra basics).', 'created_by' => $teacher1->id]);
        $lesson = Lesson::create(['name' => 'Algebra Basics', 'class_id' => $class9->id, 'subject_id' => $math->id]);
        Topic::create(['name' => 'Linear Equations', 'lesson_id' => $lesson->id]);

        // ---------------- Fees ----------------
        $fg = FeesGroup::create(['name' => 'Academic Fees']);
        $ft1 = FeesType::create(['name' => 'Tuition Fee', 'fees_group_id' => $fg->id]);
        $ft2 = FeesType::create(['name' => 'Admission Fee', 'fees_group_id' => $fg->id]);
        FeesMaster::create(['fees_group_id' => $fg->id, 'fees_type_id' => $ft1->id, 'class_id' => $class9->id, 'amount' => 1200, 'due_date' => today()->addDays(15)->toDateString()]);
        FeesMaster::create(['fees_group_id' => $fg->id, 'fees_type_id' => $ft2->id, 'class_id' => $class9->id, 'amount' => 500, 'due_date' => today()->addDays(30)->toDateString()]);
        PaymentMethod::create(['name' => 'Cash']);
        PaymentMethod::create(['name' => 'Bank Transfer']);
        PaymentMethod::create(['name' => 'Online']);

        // ---------------- Staff ----------------
        Staff::create(['staff_no' => 'STF-001', 'name' => 'Sarah Johnson', 'designation' => 'Senior Teacher', 'department' => 'Mathematics', 'gender' => 'female', 'phone' => '01700000003', 'email' => 'teacher@school.com', 'joining_date' => '2020-01-15', 'salary' => 2500, 'user_id' => $teacher1->id]);
        Staff::create(['staff_no' => 'STF-002', 'name' => 'David Miller', 'designation' => 'Teacher', 'department' => 'English', 'gender' => 'male', 'phone' => '01700000004', 'joining_date' => '2021-06-01', 'salary' => 2200, 'user_id' => $teacher2->id]);

        // ---------------- Library / Transport ----------------
        $bc = BookCategory::create(['name' => 'Textbooks']);
        Book::create(['title' => 'Mathematics Class 9', 'book_no' => 'BK-001', 'book_category_id' => $bc->id, 'author' => 'NCTB', 'quantity' => 30, 'price' => 15]);
        Book::create(['title' => 'English Grammar', 'book_no' => 'BK-002', 'book_category_id' => $bc->id, 'author' => 'R. Murphy', 'quantity' => 20, 'price' => 12]);

        $route = TransportRoute::create(['title' => 'Route 1 - Downtown', 'fare' => 60]);
        Vehicle::create(['vehicle_no' => 'BUS-101', 'model' => 'Toyota Coaster', 'driver_name' => 'Karim Uddin', 'driver_phone' => '01800000001', 'capacity' => 30, 'transport_route_id' => $route->id]);

        // ---------------- Communicate ----------------
        Notice::create(['title' => 'Welcome to the new session', 'message' => 'Classes for session 2025-2026 begin on July 6. All students should collect their class routine from the notice board.', 'publish_date' => today()->toDateString(), 'target' => 'all']);
        Notice::create(['title' => 'First Term Exam', 'message' => 'First Term examination starts November 1. Exam routine will be published soon.', 'publish_date' => today()->toDateString(), 'target' => 'students']);

        // ---------------- CMS ----------------
        $nc = NewsCategory::create(['name' => 'Announcements']);
        News::create(['title' => 'Admissions open for 2026', 'news_category_id' => $nc->id, 'description' => 'Admission forms for the 2026 session are now available at the school office and online.', 'publish_date' => today()->toDateString()]);
        $cc = CourseCategory::create(['name' => 'Science']);
        Course::create(['title' => 'Higher Mathematics', 'course_category_id' => $cc->id, 'overview' => 'Advanced mathematics course covering algebra, geometry and calculus fundamentals.', 'duration' => '1 year', 'fee' => 300]);
        Course::create(['title' => 'English Language', 'course_category_id' => $cc->id, 'overview' => 'Comprehensive English course: grammar, writing and speaking practice.', 'duration' => '6 months', 'fee' => 150]);
        Testimonial::create(['name' => 'Rahim Ahmed', 'designation' => 'Parent', 'description' => 'The school portal keeps me updated about my child\'s attendance, marks and fees. Excellent transparency.']);

        // ---------------- Settings ----------------
        Setting::insert([
            ['key' => 'school_name', 'value' => 'Greenfield High School'],
            ['key' => 'school_code', 'value' => 'GHS-100'],
            ['key' => 'address', 'value' => '25 College Street, Springfield'],
            ['key' => 'phone', 'value' => '+1 555 0100'],
            ['key' => 'email', 'value' => 'info@greenfield.edu'],
            ['key' => 'currency', 'value' => 'USD'],
            ['key' => 'currency_symbol', 'value' => '$'],
            ['key' => 'session', 'value' => '2025-2026'],
            ['key' => 'weekends', 'value' => '["Saturday","Sunday"]'],
            ['key' => 'default_language', 'value' => 'en'],
            ['key' => 'footer_text', 'value' => '© 2026 Greenfield High School. All rights reserved.'],
        ]);
    }
}
