<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\AdminRole;
use App\Models\Campaign;
use App\Models\FlatShopTreeElement;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define("super_admin", function(Admin $admin) {
            return $admin->admin_role->id == AdminRole::SUPER_ADMIN;
        });

        Gate::define("regular_admin", function(Admin $admin) {
            $role = $admin->admin_role->id;
            return $role == AdminRole::SUPER_ADMIN || $role == AdminRole::REGULAR_ADMIN;
        });

        Gate::define("developer", function(Admin $admin) {
            return $admin->company->isAdministration();
        });

        Gate::define("editable_campaign", function(Admin $admin, int $id) {
            $campaign = Campaign::with("shop_tree_elements")->findOrFail($id);
            return $campaign->canEdit($admin);
        });

        Gate::define("editable_admin", function(Admin $admin, int $id) {
            if($admin->company->isAdministration()) return true;

            $target = Admin::find($id);
            return $admin->company_id == $target->company_id;
        });

        Gate::define("editable_shop_tree_element", function(Admin $admin, int $id) {
            if($admin->company->isAdministration()) return true;

            $root_ids = $admin->company->shopTrees->pluck("id");
            return FlatShopTreeElement::getLowers($root_ids)->contains("id", $id);
        });
    }
}
