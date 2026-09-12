<?php

use Illuminate\Support\Facades\Route;

// ------------------------- Public front CMS -------------------------
Route::get('/', [App\Http\Controllers\FrontController::class, 'home'])->name('front.home');
Route::get('/news', [App\Http\Controllers\FrontController::class, 'news'])->name('front.news');
Route::get('/news/{id}', [App\Http\Controllers\FrontController::class, 'newsShow'])->name('front.news.show');
Route::get('/courses', [App\Http\Controllers\FrontController::class, 'courses'])->name('front.courses');
Route::get('/courses/{id}', [App\Http\Controllers\FrontController::class, 'courseShow'])->name('front.courses.show');
Route::get('/about-us', [App\Http\Controllers\FrontController::class, 'about'])->name('front.about');
Route::get('/contact', [App\Http\Controllers\FrontController::class, 'contact'])->name('front.contact');
Route::post('/contact', [App\Http\Controllers\FrontController::class, 'contactSave'])->name('front.contact.save');
Route::get('/page/{slug}', [App\Http\Controllers\FrontController::class, 'page'])->name('front.page');

// ------------------------- Auth -------------------------
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // ------------------------- Shared (all roles) -------------------------
    Route::get('chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('chat/fetch/{user}', [App\Http\Controllers\ChatController::class, 'fetch'])->name('chat.fetch');
    Route::post('chat/send', [App\Http\Controllers\ChatController::class, 'send'])->name('chat.send');
    Route::post('chat/invite', [App\Http\Controllers\ChatController::class, 'invite'])->name('chat.invite');
    Route::post('chat/invite/{id}/respond', [App\Http\Controllers\ChatController::class, 'respondInvite'])->name('chat.invite.respond');
    Route::post('chat/block', [App\Http\Controllers\ChatController::class, 'block'])->name('chat.block');
    Route::post('chat/unblock/{user}', [App\Http\Controllers\ChatController::class, 'unblock'])->name('chat.unblock');
    Route::post('chat/pin/{id}', [App\Http\Controllers\ChatController::class, 'pin'])->name('chat.pin');

    Route::get('messages', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
    Route::post('messages', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
    Route::post('messages/{id}/read', [App\Http\Controllers\MessageController::class, 'read'])->name('messages.read');

    Route::get('study-material/assignments', [App\Http\Controllers\StudyMaterialController::class, 'assignments'])->name('study-material.assignments');
    Route::get('study-material/materials', [App\Http\Controllers\StudyMaterialController::class, 'materials'])->name('study-material.materials');
    Route::get('study-material/syllabus', [App\Http\Controllers\StudyMaterialController::class, 'syllabus'])->name('study-material.syllabus');
    Route::get('study-material/downloads', [App\Http\Controllers\StudyMaterialController::class, 'downloads'])->name('study-material.downloads');

    // ------------------------- Panels (profile + student/parent/teacher) -------------------------
    Route::get('profile', [App\Http\Controllers\PanelController::class, 'profile'])->name('panel.profile');
    Route::post('profile', [App\Http\Controllers\PanelController::class, 'profileUpdate'])->name('panel.profile.update');

    Route::middleware(['role:student,parent'])->group(function () {
        Route::get('my/routine', [App\Http\Controllers\PanelController::class, 'routine'])->name('panel.routine');
        Route::get('my/marks', [App\Http\Controllers\PanelController::class, 'marks'])->name('panel.marks');
        Route::get('my/attendance', [App\Http\Controllers\PanelController::class, 'attendance'])->name('panel.attendance');
        Route::get('my/results', [App\Http\Controllers\PanelController::class, 'results'])->name('panel.results');
        Route::get('my/invoices', [App\Http\Controllers\FeeController::class, 'myInvoices'])->name('panel.invoices');
        Route::get('my/pay/{master}', [App\Http\Controllers\FeeController::class, 'payOnline'])->name('panel.pay');
        Route::post('my/pay/{master}', [App\Http\Controllers\FeeController::class, 'payOnlineSubmit'])->name('panel.pay.submit');
        Route::get('online-exams/{id}/take', [App\Http\Controllers\OnlineExamController::class, 'take'])->name('online-exams.take');
        Route::post('online-exams/{id}/submit', [App\Http\Controllers\OnlineExamController::class, 'submit'])->name('online-exams.submit');
    });

    Route::middleware(['role:teacher'])->group(function () {
        Route::get('my/students', [App\Http\Controllers\PanelController::class, 'myStudents'])->name('panel.students');
    });

    // ------------------------- Shared resources (all roles) -------------------------
    Route::resource('notices', App\Http\Controllers\NoticeController::class)->only(['index']);
    Route::resource('events', App\Http\Controllers\EventController::class)->only(['index']);
    Route::resource('holidays', App\Http\Controllers\HolidayController::class)->only(['index']);
    Route::get('homeworks', [App\Http\Controllers\HomeworkController::class, 'index'])->name('homeworks.index');
    Route::get('online-exams', [App\Http\Controllers\OnlineExamController::class, 'index'])->name('online-exams.index');
    Route::get('fees/invoice/{id}', [App\Http\Controllers\FeeController::class, 'invoice'])->name('fees.invoice');

    // ------------------------- Admin + Teacher -------------------------
    Route::middleware(['role:admin,teacher'])->group(function () {
    Route::resource('students', App\Http\Controllers\StudentController::class)->except(['show']);
    Route::resource('class-routines', App\Http\Controllers\ClassRoutineController::class)->except(['show']);
    Route::resource('upload-contents', App\Http\Controllers\UploadContentController::class)->except(['show']);
    Route::resource('lessons', App\Http\Controllers\LessonController::class)->except(['show']);
    Route::resource('topics', App\Http\Controllers\TopicController::class)->except(['show']);
    Route::resource('lesson-plans', App\Http\Controllers\LessonPlanController::class)->except(['show']);
    Route::resource('exam-schedules', App\Http\Controllers\ExamScheduleController::class)->except(['show']);
    Route::resource('exam-attendances', App\Http\Controllers\ExamAttendanceController::class)->except(['show']);
    Route::resource('question-banks', App\Http\Controllers\QuestionBankController::class)->except(['show']);
    Route::resource('homeworks', App\Http\Controllers\HomeworkController::class)->except(['show', 'index']);
    Route::resource('notices', App\Http\Controllers\NoticeController::class)->except(['show', 'index']);
    Route::resource('events', App\Http\Controllers\EventController::class)->except(['show', 'index']);
    Route::resource('holidays', App\Http\Controllers\HolidayController::class)->except(['show', 'index']);
    Route::resource('homework-evaluations', App\Http\Controllers\HomeworkEvaluationController::class)->except(['show']);
        Route::resource('online-exams', App\Http\Controllers\OnlineExamController::class)->except(['show', 'index']);

        Route::get('online-exams/{id}/questions', [App\Http\Controllers\OnlineExamController::class, 'questions'])->name('online-exams.questions');
        Route::post('online-exams/{id}/questions', [App\Http\Controllers\OnlineExamController::class, 'questionsSave'])->name('online-exams.questions.save');

        Route::get('attendance/student', [App\Http\Controllers\AttendanceController::class, 'studentForm'])->name('attendance.student');
        Route::post('attendance/student', [App\Http\Controllers\AttendanceController::class, 'studentSave'])->name('attendance.student.save');
        Route::get('attendance/student/report', [App\Http\Controllers\AttendanceController::class, 'studentReport'])->name('attendance.student.report');
        Route::get('attendance/subject', [App\Http\Controllers\AttendanceController::class, 'subjectForm'])->name('attendance.subject');
        Route::post('attendance/subject', [App\Http\Controllers\AttendanceController::class, 'subjectSave'])->name('attendance.subject.save');
        Route::get('attendance/subject/report', [App\Http\Controllers\AttendanceController::class, 'subjectReport'])->name('attendance.subject.report');

        Route::get('marks/register', [App\Http\Controllers\MarksController::class, 'registerForm'])->name('marks.register');
        Route::post('marks/register', [App\Http\Controllers\MarksController::class, 'registerSave'])->name('marks.register.save');

        Route::get('homeworks/evaluation', [App\Http\Controllers\HomeworkReportController::class, 'evaluation'])->name('homeworks.evaluation');
    });

    // ------------------------- Admin + Accountant -------------------------
    Route::middleware(['role:admin,accountant'])->group(function () {
    Route::resource('fees-groups', App\Http\Controllers\FeesGroupController::class)->except(['show']);
    Route::resource('fees-types', App\Http\Controllers\FeesTypeController::class)->except(['show']);
    Route::resource('fees-masters', App\Http\Controllers\FeesMasterController::class)->except(['show']);
    Route::resource('fees-discounts', App\Http\Controllers\FeesDiscountController::class)->except(['show']);
    Route::resource('bank-payments', App\Http\Controllers\BankPaymentController::class)->except(['show']);
    Route::resource('fees-carry-forwards', App\Http\Controllers\FeesCarryForwardController::class)->except(['show']);
    Route::resource('accounts', App\Http\Controllers\AccountController::class)->except(['show']);
    Route::resource('payment-methods', App\Http\Controllers\PaymentMethodController::class)->except(['show']);
    Route::resource('bank-accounts', App\Http\Controllers\BankAccountController::class)->except(['show']);
    Route::resource('incomes', App\Http\Controllers\IncomeController::class)->except(['show']);
    Route::resource('expenses', App\Http\Controllers\ExpenseController::class)->except(['show']);

        Route::get('fees/collect', [App\Http\Controllers\FeeController::class, 'collectForm'])->name('fees.collect');
        Route::post('fees/collect', [App\Http\Controllers\FeeController::class, 'collectSave'])->name('fees.collect.save');
        Route::get('fees/invoice/{id}', [App\Http\Controllers\FeeController::class, 'invoice'])->name('fees.invoice');
        Route::get('fees/search-payment', [App\Http\Controllers\FeeController::class, 'searchPayment'])->name('fees.search-payment');
        Route::get('fees/search-dues', [App\Http\Controllers\FeeController::class, 'searchDues'])->name('fees.search-dues');
        Route::get('fees/collection-report', [App\Http\Controllers\FeeController::class, 'collectionReport'])->name('fees.collection-report');
        Route::get('fees/monthly-report', [App\Http\Controllers\FeeController::class, 'monthlyReport'])->name('fees.monthly-report');

        Route::get('accounts/dashboard', [App\Http\Controllers\AccountController::class, 'dashboard'])->name('accounts.dashboard');
        Route::get('accounts/payment-history', [App\Http\Controllers\AccountController::class, 'paymentHistory'])->name('accounts.payment-history');
    });

    // ------------------------- Admin only -------------------------
    Route::middleware(['role:admin'])->group(function () {
    Route::resource('admission-queries', App\Http\Controllers\AdmissionQueryController::class)->except(['show']);
    Route::resource('visitor-books', App\Http\Controllers\VisitorBookController::class)->except(['show']);
    Route::resource('phone-call-logs', App\Http\Controllers\PhoneCallLogController::class)->except(['show']);
    Route::resource('postal-receives', App\Http\Controllers\PostalReceiveController::class)->except(['show']);
    Route::resource('postal-dispatches', App\Http\Controllers\PostalDispatchController::class)->except(['show']);
    Route::resource('complaints', App\Http\Controllers\ComplaintController::class)->except(['show']);
    Route::resource('student-certificates', App\Http\Controllers\StudentCertificateController::class)->except(['show']);
    Route::resource('id-cards', App\Http\Controllers\IdCardController::class)->except(['show']);
    Route::resource('student-categories', App\Http\Controllers\StudentCategoryController::class)->except(['show']);
    Route::resource('student-groups', App\Http\Controllers\StudentGroupController::class)->except(['show']);
    Route::resource('academic-years', App\Http\Controllers\AcademicYearController::class)->except(['show']);
    Route::resource('classes', App\Http\Controllers\ClassController::class)->except(['show']);
    Route::resource('sections', App\Http\Controllers\SectionController::class)->except(['show']);
    Route::resource('subjects', App\Http\Controllers\SubjectController::class)->except(['show']);
    Route::resource('optional-subjects', App\Http\Controllers\OptionalSubjectController::class)->except(['show']);
    Route::resource('assign-class-teachers', App\Http\Controllers\AssignClassTeacherController::class)->except(['show']);
    Route::resource('assign-subjects', App\Http\Controllers\AssignSubjectController::class)->except(['show']);
    Route::resource('class-rooms', App\Http\Controllers\ClassRoomController::class)->except(['show']);
    Route::resource('class-times', App\Http\Controllers\ClassTimeController::class)->except(['show']);
    Route::resource('marks-grades', App\Http\Controllers\MarksGradeController::class)->except(['show']);
    Route::resource('exam-types', App\Http\Controllers\ExamTypeController::class)->except(['show']);
    Route::resource('exams', App\Http\Controllers\ExamController::class)->except(['show']);
    Route::resource('staff', App\Http\Controllers\StaffController::class)->except(['show']);
    Route::resource('payrolls', App\Http\Controllers\PayrollController::class)->except(['show']);
    Route::resource('email-sms', App\Http\Controllers\EmailSmsLogController::class)->except(['show']);
    Route::resource('book-categories', App\Http\Controllers\BookCategoryController::class)->except(['show']);
    Route::resource('books', App\Http\Controllers\BookController::class)->except(['show']);
    Route::resource('library-members', App\Http\Controllers\LibraryMemberController::class)->except(['show']);
    Route::resource('book-issues', App\Http\Controllers\BookIssueController::class)->except(['show']);
    Route::resource('item-categories', App\Http\Controllers\ItemCategoryController::class)->except(['show']);
    Route::resource('item-stores', App\Http\Controllers\ItemStoreController::class)->except(['show']);
    Route::resource('suppliers', App\Http\Controllers\SupplierController::class)->except(['show']);
    Route::resource('items', App\Http\Controllers\ItemController::class)->except(['show']);
    Route::resource('item-receives', App\Http\Controllers\ItemReceiveController::class)->except(['show']);
    Route::resource('item-sells', App\Http\Controllers\ItemSellController::class)->except(['show']);
    Route::resource('item-issues', App\Http\Controllers\ItemIssueController::class)->except(['show']);
    Route::resource('transport-routes', App\Http\Controllers\TransportRouteController::class)->except(['show']);
    Route::resource('vehicles', App\Http\Controllers\VehicleController::class)->except(['show']);
    Route::resource('assign-vehicles', App\Http\Controllers\AssignVehicleController::class)->except(['show']);
    Route::resource('transport-schedules', App\Http\Controllers\TransportScheduleController::class)->except(['show']);
    Route::resource('dormitories', App\Http\Controllers\DormitoryController::class)->except(['show']);
    Route::resource('room-types', App\Http\Controllers\RoomTypeController::class)->except(['show']);
    Route::resource('dormitory-rooms', App\Http\Controllers\DormitoryRoomController::class)->except(['show']);
    Route::resource('dormitory-assigns', App\Http\Controllers\DormitoryAssignController::class)->except(['show']);
    Route::resource('cms-menus', App\Http\Controllers\CmsMenuController::class)->except(['show']);
    Route::resource('news-categories', App\Http\Controllers\NewsCategoryController::class)->except(['show']);
    Route::resource('cms/news', App\Http\Controllers\NewsController::class)->except(['show'])->names('news');
    Route::resource('course-categories', App\Http\Controllers\CourseCategoryController::class)->except(['show']);
    Route::resource('cms/courses', App\Http\Controllers\CourseController::class)->except(['show'])->names('courses');
    Route::resource('testimonials', App\Http\Controllers\TestimonialController::class)->except(['show']);
    Route::resource('contact-messages', App\Http\Controllers\ContactMessageController::class)->except(['show']);
    Route::resource('social-links', App\Http\Controllers\SocialLinkController::class)->except(['show']);
    Route::resource('pages', App\Http\Controllers\PageController::class)->except(['show']);
    Route::resource('footer-widgets', App\Http\Controllers\FooterWidgetController::class)->except(['show']);
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);

        Route::get('certificates/generate', [App\Http\Controllers\CertificateController::class, 'generateForm'])->name('certificates.generate');
        Route::post('certificates/generate', [App\Http\Controllers\CertificateController::class, 'generateSave'])->name('certificates.generate.save');
        Route::get('certificates/print/{id}', [App\Http\Controllers\CertificateController::class, 'printCertificate'])->name('certificates.print');

        Route::get('id-cards/generate', [App\Http\Controllers\IdCardController::class, 'generateForm'])->name('id-cards.generate');
        Route::post('id-cards/generate', [App\Http\Controllers\IdCardController::class, 'generateSave'])->name('id-cards.generate.save');
        Route::get('id-cards/print/{id}', [App\Http\Controllers\IdCardController::class, 'printCard'])->name('id-cards.print');

        Route::get('students/promote', [App\Http\Controllers\StudentManageController::class, 'promoteForm'])->name('students.promote');
        Route::post('students/promote', [App\Http\Controllers\StudentManageController::class, 'promoteSave'])->name('students.promote.save');
        Route::get('students/disabled', [App\Http\Controllers\StudentManageController::class, 'disabled'])->name('students.disabled');
        Route::post('students/{id}/toggle', [App\Http\Controllers\StudentManageController::class, 'toggleStatus'])->name('students.toggle');

        Route::get('attendance/staff', [App\Http\Controllers\AttendanceController::class, 'staffForm'])->name('attendance.staff');
        Route::post('attendance/staff', [App\Http\Controllers\AttendanceController::class, 'staffSave'])->name('attendance.staff.save');
        Route::get('attendance/staff/report', [App\Http\Controllers\AttendanceController::class, 'staffReport'])->name('attendance.staff.report');

        Route::get('marks/send-sms', [App\Http\Controllers\MarksController::class, 'sendSmsForm'])->name('marks.send-sms');
        Route::post('marks/send-sms', [App\Http\Controllers\MarksController::class, 'sendSms'])->name('marks.send-sms.submit');

        Route::get('payrolls/report', [App\Http\Controllers\PayrollController::class, 'report'])->name('payrolls.report');

        Route::get('library/issued-books', [App\Http\Controllers\LibraryController::class, 'issued'])->name('book-issues.issued');
        Route::get('transport/report', [App\Http\Controllers\TransportController::class, 'report'])->name('transport.report');
        Route::get('dormitory/monitoring', [App\Http\Controllers\DormitoryManageController::class, 'monitoring'])->name('dormitory.monitoring');
        Route::get('dormitory/report', [App\Http\Controllers\DormitoryManageController::class, 'report'])->name('dormitory.report');

        // Reports
        Route::get('reports/student', [App\Http\Controllers\ReportController::class, 'student'])->name('reports.student');
        Route::get('reports/guardian', [App\Http\Controllers\ReportController::class, 'guardian'])->name('reports.guardian');
        Route::get('reports/student-history', [App\Http\Controllers\ReportController::class, 'studentHistory'])->name('reports.student-history');
        Route::get('reports/login', [App\Http\Controllers\ReportController::class, 'login'])->name('reports.login');
        Route::get('reports/fees-statement', [App\Http\Controllers\ReportController::class, 'feesStatement'])->name('reports.fees-statement');
        Route::get('reports/balance-fees', [App\Http\Controllers\ReportController::class, 'balanceFees'])->name('reports.balance-fees');
        Route::get('reports/class', [App\Http\Controllers\ReportController::class, 'classReport'])->name('reports.class');
        Route::get('reports/class-routine', [App\Http\Controllers\ReportController::class, 'classRoutine'])->name('reports.class-routine');
        Route::get('reports/exam-routine', [App\Http\Controllers\ReportController::class, 'examRoutine'])->name('reports.exam-routine');
        Route::get('reports/teacher-routine', [App\Http\Controllers\ReportController::class, 'teacherRoutine'])->name('reports.teacher-routine');
        Route::get('reports/merit-list', [App\Http\Controllers\ReportController::class, 'meritList'])->name('reports.merit-list');
        Route::get('reports/online-exam', [App\Http\Controllers\ReportController::class, 'onlineExam'])->name('reports.online-exam');
        Route::get('reports/mark-sheet', [App\Http\Controllers\ReportController::class, 'markSheet'])->name('reports.mark-sheet');
        Route::get('reports/tabulation', [App\Http\Controllers\ReportController::class, 'tabulation'])->name('reports.tabulation');
        Route::get('reports/progress-card', [App\Http\Controllers\ReportController::class, 'progressCard'])->name('reports.progress-card');
        Route::get('reports/user-log', [App\Http\Controllers\ReportController::class, 'userLog'])->name('reports.user-log');
        Route::get('reports/previous-result', [App\Http\Controllers\ReportController::class, 'previousResult'])->name('reports.previous-result');

        // Settings
        Route::get('settings/general', [App\Http\Controllers\SettingsController::class, 'general'])->name('settings.general');
        Route::post('settings/general', [App\Http\Controllers\SettingsController::class, 'generalSave'])->name('settings.general.save');
        Route::get('settings/roles', [App\Http\Controllers\SettingsController::class, 'roles'])->name('settings.roles');
        Route::get('settings/email', [App\Http\Controllers\SettingsController::class, 'email'])->name('settings.email');
        Route::post('settings/email', [App\Http\Controllers\SettingsController::class, 'emailSave'])->name('settings.email.save');
        Route::get('settings/sms', [App\Http\Controllers\SettingsController::class, 'sms'])->name('settings.sms');
        Route::post('settings/sms', [App\Http\Controllers\SettingsController::class, 'smsSave'])->name('settings.sms.save');
        Route::get('settings/weekend', [App\Http\Controllers\SettingsController::class, 'weekend'])->name('settings.weekend');
        Route::post('settings/weekend', [App\Http\Controllers\SettingsController::class, 'weekendSave'])->name('settings.weekend.save');
        Route::get('settings/language', [App\Http\Controllers\SettingsController::class, 'language'])->name('settings.language');
        Route::post('settings/language', [App\Http\Controllers\SettingsController::class, 'languageSave'])->name('settings.language.save');
        Route::get('settings/backup', [App\Http\Controllers\SettingsController::class, 'backup'])->name('settings.backup');
        Route::get('settings/backup/download', [App\Http\Controllers\SettingsController::class, 'backupDownload'])->name('settings.backup.download');
    });
});
