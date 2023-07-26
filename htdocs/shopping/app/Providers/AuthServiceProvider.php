<?php

namespace App\Providers;

use App\Product;
use App\services\PermissionGateAndPolicyAccess;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Define permission
        $PermissionGateAndPolicy = new PermissionGateAndPolicyAccess();
        $PermissionGateAndPolicy->setGateAndPolicy();

        //dd(config('permissions.access.list-category'));
//        /*Gate::define('category-list', function ($user) {
//            //b1 :gội phường thức trong user để check true false
//            return $user->checkPermissionAccess(config('permissions.access.list-category'));
//        });*/
        // đưa vào policy
//        Gate::define('menu-list', function($user){
//            return $user->checkPermissionAccess(config('permissions.access.list-menu'));
//        });
//
//        Gate::define('product-list', function($user){
//            return $user->checkPermissionAccess('product_list');
//        });
//        Gate::define('product-edit', function($user, $id){
//            $product = Product::find($id);
//            if($user->checkPermissionAccess('product_edit') && $user->id === $product->user_id){
//                return true;
//            }
//            return false;
//        });
    }
}
