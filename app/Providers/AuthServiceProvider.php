<?php
namespace App\Providers;
use App\Models\User;
use App\Models\Course;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        $this->getCategory();
        $this->getMenu();
        $this->getCourse();
        $this->getSlider();
        $this->getRole();
        $this->getPermission();
        $this->getSetting();
        $this->getUser();

    }
    public function getCategory()
    {
        Gate::define('category-list', 'App\Policies\CategoryPolicy@view');
        Gate::define('category-add', 'App\Policies\CategoryPolicy@create');
        Gate::define('category-update', 'App\Policies\CategoryPolicy@update');
        Gate::define('category-delete', 'App\Policies\CategoryPolicy@delete');
    }
    public function getCourse(){
        Gate::define('course-list', 'App\Policies\CoursePolicy@view');
        Gate::define('course-add', 'App\Policies\CoursePolicy@create');
        Gate::define('course_update', function () {
            if (auth()->user()->checkPermissionAccess('course_edit') ) {
                return true;
            }
            return false;
        });
        Gate::define('course-delete', 'App\Policies\CoursePolicy@delete');
    }
    public function getMenu()
    {
        Gate::define('menu-list', 'App\Policies\MenuPolicy@view');
        Gate::define('menu-add', 'App\Policies\MenuPolicy@create');
        Gate::define('menu-update', 'App\Policies\MenuPolicy@update');
        Gate::define('menu-delete', 'App\Policies\MenuPolicy@delete');
    }

    public function getSlider()
    {
        Gate::define('slider-list', 'App\Policies\SliderPolicy@view');
        Gate::define('slider-add', 'App\Policies\SliderPolicy@create');
        Gate::define('slider-update', 'App\Policies\SliderPolicy@update');
        Gate::define('slider-delete', 'App\Policies\SliderPolicy@delete');
    }


    public function getSetting()
    {
        Gate::define('setting-list', 'App\Policies\settingPolicy@view');
        Gate::define('setting-add', 'App\Policies\settingPolicy@create');
        Gate::define('setting-update', 'App\Policies\settingPolicy@update');
        Gate::define('setting-delete', 'App\Policies\settingPolicy@delete');
    }

    public function getRole()
    {
        Gate::define('role-list', 'App\Policies\RolePolicy@view');
        Gate::define('role-add', 'App\Policies\RolePolicy@create');
        Gate::define('role-update', 'App\Policies\RolePolicy@update');
        Gate::define('role-delete', 'App\Policies\RolePolicy@delete');
    }
    public function getPermission()
    {
        Gate::define('permission-list', 'App\Policies\PermissionPolicy@view');
        Gate::define('permission-add', 'App\Policies\PermissionPolicy@create');
        Gate::define('permission-update', 'App\Policies\PermissionPolicy@update');
        Gate::define('permission-delete', 'App\Policies\PermissionPolicy@delete');
    }

    public function getUser()
    {
        Gate::define('user-list', 'App\Policies\UserPolicy@view');
        Gate::define('user-add', 'App\Policies\UserPolicy@create');
        Gate::define('user-update', 'App\Policies\UserPolicy@update');
        Gate::define('user-delete', 'App\Policies\UserPolicy@delete');
    }
}
