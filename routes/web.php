<?php

use App\Events\chat_user;
use App\Events\MessageDelivered;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;



Route::get('/send_mail',[
    'as' => 'send_mail',
    'uses' => 'AdminController@send_mail',
]);



Route::get('/login',[
    'as' => 'login',
    'uses' => 'AdminController@loginAdmin',
]);

Route::get('/reset_pass',[
    'as' => 'reset_pass',
    'uses' => 'AdminController@reset_pass',
]);

Route::post('/get_pass',[
    'as' => 'get_pass',
    'uses' => 'AdminController@get_pass',
]);




Route::post('/logout',[
    'as'=> 'logout',
    'uses' => 'AdminController@logout'
]);



Route::get('/register', [
    'as' => 'register',
    'uses' => 'AdminController@register',
]);

Route::post('/post_register', [

    'as'=> 'post_register',
     'uses' => 'AdminController@post_register',
]);

Route::post('/login','AdminController@postloginAdmin');

Route::get('/homePage', [
    'as' => 'homePage',
    'uses' => 'UserController@homePage',
]);

Route::get('/', [
    'as' => 'general',
    'uses' => 'UserController@index',
]);

Route::get('/new', [
    'as' => 'user.new_course',
    'uses' => 'UserController@new_course',
]);



Route::get('/home', function () {
    
    return view('home');
});




Route::prefix('admin')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [
            'as' => 'categories.index',
            'uses' => 'CategoryController@index',
            'middleware' => 'can:category-list'
    
        ]);
    
        Route::get('/create', [
            'as' => 'categories.create',
            'uses' => 'CategoryController@create',
            'middleware' => 'can:category-add'
    
        ]);
    
        Route::post('/store', [
            'as' => 'categories.store',
            'uses' => 'CategoryController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'categories.edit',
            'uses' => 'CategoryController@edit',
            'middleware' => 'can:category-update'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'categories.update',
            'uses' => 'CategoryController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'categories.delete',
            'uses' => 'CategoryController@delete',
            'middleware' => 'can:category-delete'
    
        ]);
    
    
    });
       
    Route::prefix('courses')->group(function () {
        

        Route::get("/", [
            "as"=> "courses.index",
            "uses"=> "AdminCoursesController@index"
        ]);

        Route::get("/showCourse", [
            "as"=> "courses.showCourse",
            "uses"=> "AdminCoursesController@showCourse"
        ]);

        Route::get("/search_manage", [
            "as"=> "courses.search_course_manage_page",
            "uses"=> "AdminCoursesController@search_course_manage_page"
        ]);

        Route::get('/detail/{id}', [ 
            'as' => 'courses.detail',
            'uses' => 'AdminCoursesController@detail'
    
        ]);

        Route::get('/detail_chat_/{id}', [ 
            'as' => 'courses.detail_chat_for_user',
            'uses' => 'AdminCoursesController@detail_chat_for_user'
    
        ]);
        Route::get('/detail_chat', [ 
            'as' => 'courses.chat_private',
            'uses' => 'AdminCoursesController@detail_chat'
    
        ]);

        Route::post('/send_message_course/{id_course}', [
            'as'=> 'courses.send_message_course',
            'uses' => 'AdminCoursesController@send_message_course'
        ]);

        Route::post('/send_message_user/{id_receive}', [
            'as'=> 'courses.send_message_user',
            'uses' => 'AdminCoursesController@send_message_user'
        ]);


       
        Route::get('/create', [
            'as' => 'courses.create',
            'uses' => 'AdminCoursesController@create'
    
        ]);
    
        Route::post('/store', [
            'as' => 'courses.store',
            'uses' => 'AdminCoursesController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'courses.edit',
            'uses' => 'AdminCoursesController@edit',
             'middleware' => 'can:course_update,id'

        ]);
    
        Route::post('/update/{id}', [
            'as' => 'courses.update',
            'uses' => 'AdminCoursesController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'courses.delete',
            'uses' => 'AdminCoursesController@delete'
    
        ]);

        Route::get('/search', [
            'as' => 'courses.search',
            'uses' => 'AdminCoursesController@search'
    
        ]);

        Route::get('/search_course', [
            'as' => 'courses.search_courses_index',
            'uses' => 'AdminCoursesController@search_courses_index'
    
        ]);





    });
    
    Route::prefix('menus')->group(function () {
        Route::get('/', [
            'as' => 'menus.index',
            'uses' => 'MenuController@index',
            'middleware' => 'can:menu-list'

    
        ]);
    
        Route::get('/create', [
            'as' => 'menus.create',
            'uses' => 'MenuController@create',
             'middleware' => 'can:menu-add'
    
        ]);
    
        Route::post('/store', [
            'as' => 'menus.store',
            'uses' => 'MenuController@store',
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'menus.edit',
            'uses' => 'MenuController@edit',
             'middleware' => 'can:menu-update'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'menus.update',
            'uses' => 'MenuController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'menus.delete',
            'uses' => 'MenuController@delete',
              'middleware' => 'can:menu-delete'
    
        ]);
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/', [
            'as' => 'sliders.index',
            'uses' => 'SliderAdminController@index'
    
        ]);
    
        Route::get('/create', [
            'as' => 'sliders.create',
            'uses' => 'SliderAdminController@create'
    
        ]);
    
        Route::post('/store', [
            'as' => 'sliders.store',
            'uses' => 'SliderAdminController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'sliders.edit',
            'uses' => 'SliderAdminController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'sliders.update',
            'uses' => 'SliderAdminController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'sliders.delete',
            'uses' => 'SliderAdminController@delete'
    
        ]);
    });


    Route::prefix('settings')->group(function () {
        Route::get('/', [
            'as' => 'settings.index',
            'uses' => 'SettingAdminController@index'
    
        ]);
    
        Route::get('/create', [
            'as' => 'settings.create',
            'uses' => 'SettingAdminController@create'
    
        ]);
    
        Route::post('/store', [
            'as' => 'settings.store',
            'uses' => 'SettingAdminController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'settings.edit',
            'uses' => 'SettingAdminController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'settings.update',
            'uses' => 'SettingAdminController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'settings.delete',
            'uses' => 'SettingAdminController@delete'
    
        ]);
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index'
    
        ]);
    
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create'
    
        ]);
    
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete'
    
        ]);

        Route::get('/detail_chat_/{id}', [ 
            'as' => 'users.detail_chat_for_user',
            'uses' => 'AdminUserController@detail_chat_for_user'
    
        ]);
        Route::get('/detail_chat', [ 
            'as' => 'users.chat_private',
            'uses' => 'AdminUserController@detail_chat'
    
        ]);
    });

    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'RolesController@index'
    
        ]);
    
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'RolesController@create'
    
        ]);
    
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'RolesController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'roles.edit',
            'uses' => 'RolesController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'RolesController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'roles.delete',
            'uses' => 'RolesController@delete'
    
        ]);
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', [
            'as' => 'permissions.index',
            'uses' => 'PermissionsController@index'
    
        ]);
    
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'PermissionsController@create'
    
        ]);
    
        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'PermissionsController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'permissions.edit',
            'uses' => 'PermissionsController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'permissions.update',
            'uses' => 'PermissionsController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'permissions.delete',
            'uses' => 'PermissionsController@delete'
    
        ]);
    });

    Route::prefix('courses/questions')->group(function () {
        Route::get('/{id_course}', [
            'as' => 'questions.index',
            'uses' => 'QuestionController@index'   
        ]);
       Route::get('/create/{id_course}', [ 
            'as' => 'questions.create',
            'uses' => 'QuestionController@create'
    
        ]);

        Route::get('/create_excel/{id_course}', [ 
            'as' => 'questions.create_excel',
            'uses' => 'QuestionController@create_excel'
    
        ]);

  
        Route::post('/store', [
            'as' => 'questions.store',
            'uses' => 'QuestionController@store'
    
        ]);

        
        Route::post('/store_excel', [
            'as' => 'questions.store_excel',
            'uses' => 'QuestionController@store_excel'
    
        ]);
        Route::get('/export/{id_course}', [
            'as' => 'questions.export',
            'uses' => 'QuestionController@export'
    
        ]);

        
        Route::get('/edit/{id}', [
            'as' => 'questions.edit',
            'uses' => 'QuestionController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'questions.update',
            'uses' => 'QuestionController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'questions.delete',
            'uses' => 'QuestionController@delete'
    
        ]);
    });

    Route::prefix('sections')->group(function () {
        Route::get('/{id_course}', [
            'as' => 'sections.index',
            'uses' => 'SectionController@index'   
        ]);
    
       Route::get('/create/{id_course}', [
        'as'=> 'sections.create',
        'uses'=> 'SectionController@create',

       ]);
    
        Route::post('/store', [
            'as' => 'sections.store',
            'uses' => 'SectionController@store'
    
        ]);
        Route::get('/edit/{id}', [
            'as' => 'sections.edit',
            'uses' => 'SectionController@edit'
    
        ]);
    
        Route::post('/update/{id}/{id_course}', [
            'as' => 'sections.update',
            'uses' => 'SectionController@update'
    
        ]);


    
        Route::get('/delete/{id}', [
            'as' => 'sections.delete',
            'uses' => 'SectionController@delete'
    
        ]);

        
    });

    Route::prefix('courses/exercises')->group(function () {
        Route::get('/{id_course}', [
            'as' => 'exercises.index',
            'uses' => 'ExerciseController@index'   
        ]);
    
        Route::get('/create/{id_course}', [ 
            'as' => 'exercises.create',
            'uses' => 'ExerciseController@create'
    
        ]);

        Route::get('/create_auto/{id_course}', [ 
            'as' => 'exercises.create_auto',
            'uses' => 'ExerciseController@create_auto'
    
        ]);


    
        Route::post('/store', [
            'as' => 'exercises.store',
            'uses' => 'ExerciseController@store'
    
        ]);

        Route::post('/store_auto', [
            'as' => 'exercises.store_auto',
            'uses' => 'ExerciseController@store_auto'
    
        ]);

        Route::get('/edit/{id}', [
            'as' => 'exercises.edit',
            'uses' => 'ExerciseController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'exercises.update',
            'uses' => 'ExerciseController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'exercises.delete',
            'uses' => 'ExerciseController@delete'
    
        ]);

        
    });


    Route::prefix('courses/learners')->group(function () {
        Route::get('/', [
            'as' => 'learners.index',
            'uses' => 'ScoreExerciseController@index'   
        ]);
    
        Route::get('/create/{id_course}', [ 
            'as' => 'learners.create',
            'uses' => 'ExerciseController@create'
    
        ]);

        Route::get('/detail/{id}', [ 
            'as' => 'learners.detail',
            'uses' => 'ScoreExerciseController@detail'
    
        ]);
        
        Route::get('/detail_score/{id}', [ 
            'as' => 'learners.detail_score',
            'uses' => 'ScoreExerciseController@detail_score'
    
        ]);

    
        Route::post('/store', [
            'as' => 'learners.store',
            'uses' => 'ScoreExerciseController@store'
    
        ]);


        Route::get('/edit/{id}', [
            'as' => 'learners.edit',
            'uses' => 'ScoreExerciseController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'learners.update',
            'uses' => 'ScoreExerciseController@update'
    
        ]);
    
        Route::get('/delete/{id}/{id_course}', [
            'as' => 'learners.delete',
            'uses' => 'ScoreExerciseController@delete'
    
        ]);

        
    });


    Route::prefix('courses/scores')->group(function () {
        Route::get('/', [
            'as' => 'scores.index',
            'uses' => 'ScoreExerciseController@index'   
        ]);
    
        Route::get('/create/{id_course}', [ 
            'as' => 'scores.create',
            'uses' => 'ScoreExerciseController@create'
    
        ]);

        Route::get('/accept/{id}/{id_course}', [ 
            'as' => 'scores.accept',
            'uses' => 'ScoreExerciseController@accept'
    
        ]);

        Route::get('/detail/{id}', [ 
            'as' => 'scores.detail',
            'uses' => 'ScoreExerciseController@detail'
    
        ]);
        

    
        Route::post('/store', [
            'as' => 'scores.store',
            'uses' => 'ScoreExerciseController@store'
    
        ]);


        Route::get('/edit/{id}', [
            'as' => 'scores.edit',
            'uses' => 'ScoreExerciseController@edit'
    
        ]);
    
        Route::post('/update/{id}', [
            'as' => 'scores.update',
            'uses' => 'ScoreExerciseController@update'
    
        ]);
    
        Route::get('/delete/{id}', [
            'as' => 'scores.delete',
            'uses' => 'ScoreExerciseController@delete'
    
        ]);

        
    });



});

Route::prefix('user')->group(function () {
    Route::get('/profile', [
        'as'=> 'user.profile',
        'uses' => 'UserController@profile'
    ]);

    Route::get('/updatePro', [
        'as'=> 'update_Profile',
        'uses' => 'UserController@update_Profile'
    ]);

    Route::get('/notificate/{id_notificate}', [
        'as'=> 'user.notificate',
        'uses' => 'UserController@notificate'
    ]);

    Route::post('/store', [
        'as'=> 'user.store',
        'uses' => 'UserController@store'
    ]);

    Route::get('/teacher', [
        'as'=> 'user.teacher',
        'uses' => 'UserController@showTeacher'
    ]);

    Route::get('/teacher/{id}', [
        'as'=> 'user.teacher_profile',
        'uses' => 'UserController@showTeacher_profile'
    ]);

    Route::get('/detail_course/{id}', [
        'as'=> 'user.detail_course',
        'uses' => 'UserController@detail_course'
    ]);

    Route::get('/chat_course/{id}', [
        'as'=> 'user.chat_course',
        'uses' => 'UserController@chat_course'
    ]);

    Route::get('/course_exercise/{id}', [
        'as'=> 'user.course_exercise',
        'uses' => 'UserController@course_exercise'
    ]);

    Route::post('/register_course/{id_course}', [
        'as' => 'user.register_course',
        'uses' => 'UserController@register_course'

    ]);

    Route::get('/course_document/{id}', [
        'as'=> 'user.course_document',
        'uses' => 'UserController@course_document'
    ]);

    Route::get('/do_exercise/{id_exercise}/{id_course}', [
        'as'=> 'user.do_exercise',
        'uses' => 'UserController@do_exercise'
    ]);

    Route::get('/show_answer_checked/{id_exercise}/{id_course}/{id_score_exercise}', [
        'as'=> 'user.show_answer_checked',
        'uses' => 'UserController@show_answer_checked'
    ]);

    

    Route::post('/send_message_course/{message}', [
        'as'=> 'user.send_message_course',
        'uses' => 'UserController@send_message_course'
    ]);

    Route::post('/submit_exercise/{id_exercise}/{id_course}', [
        'as'=> 'user.submit_exercise',
        'uses' => 'UserController@submit_exercise'
    ]);

    Route::get('/search}', [
        'as'=> 'user.search',
        'uses' => 'UserController@search'
    ]);

    Route::get('/search_message}', [
        'as'=> 'user.search_message',
        'uses' => 'UserController@user.search_message'
    ]);


    

});




// route::get('/event',function(){
//     event(new MessageDelivered('thi is '));
// });

route::get('/listen',function(){
   
return view('listen');
});

route::get('/messageCreated',function(){
     MessageDelivered::dispatch('test');

});

route::get('/messageCreated1',function(){
    chat_user::dispatch('test');

});


route::get('/vnpay',function(){
    return view('vnpay_php.index');

});


Route::get('/index_payment', [
    'as'=> 'index_payment',
    'uses' => 'paymentController@index_payment'
]);

Route::get('/pay', [
    'as'=> 'pay',
    'uses' => 'paymentController@pay'
]);

Route::post('/vnpay_create_payment', [
    'as'=> 'vnpay_create_payment',
    'uses' => 'paymentController@vnpay_create_payment'
]);


Route::get('/vnpay_return', function(){
    return view('vnpay_php.vnpay_returns');
});







