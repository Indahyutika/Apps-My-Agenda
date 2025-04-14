<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\MyAgenda_sekolah as AppMyAgenda_sekolah;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\MyAgenda_sekolah;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $myagendaProfile = null;
            $myagendaSekolah = null;
    
            if ($user) {
                // kalau user admin, ambil foto dari profile
                if ($user->myagenda_user_role == 'admin') {
                    $myagendaProfile = DB::table('myagenda_profile')->where('myagenda_profile_user_id', $user->myagenda_user_id)->first();
                }
    
                // ambil data sekolah user
                $myagendaSekolah = MyAgenda_sekolah::where('myagenda_sekolah_user_id', $user->myagenda_user_id)->first();
            }
    
            // kirim variabel ke semua view
            $view->with(compact('myagendaProfile', 'myagendaSekolah'));
        });
    }
}
