<?php

namespace Sitren\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Illuminate\Contracts\Events\Dispatcher;
use Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/Main.php');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
         Schema::defaultStringLength(191);
           $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
             if (auth()->check() && auth()->user()->level == "admin") {
               $event->menu->add('MAIN NAVIGATION');
               $event->menu->add([
                 'text' => 'Beranda',
                 'url' => 'admin',
                 'icon'=>"home",
               ]);
               $event->menu->add([
                 'text' => 'Data Master ',
                 'url' => '#',
                 'icon'=>"file",
                 'submenu'=>[
                   [
                     'text'=>"Data Kelas",
                     'url'=>"admin/kelas"
                   ],[
                     'text'=>"Data Kamar",
                     'url'=>"admin/kamar"
                   ],[
                     'text'=>"Data Santri",
                     'url'=>"admin/santri"
                   ],[
                     'text'=>"Data Pegawai",
                     'url'=>"admin/pegawai"
                   ],[
                     'text'=>"Data Kategori Infrastruktur",
                     'url'=>"admin/katinfra"
                   ],[
                     'text'=>"Data Infrastruktur",
                     'url'=>"admin/infra"
                   ],[
                     'text'=>"Data Kepengurusan",
                     'url'=>"admin/pengurus"
                   ]
                 ]
               ]);
               $event->menu->add([
                 'text' => 'Penerapan',
                 'url' => '#',
                 'icon'=>"file",
                 'submenu'=>[
                   [
                     'text'=>"Kelas",
                     'url'=>"admin/penerapan/kelas"
                   ],[
                     'text'=>"Kamar",
                     'url'=>"admin/penerapan/kamar"
                   ],[
                     'text'=>"Wali Kamar",
                     'url'=>"admin/penerapan/walikamar"
                   ]
                 ]
               ]);
               $event->menu->add([
                 'text' => 'Laporan',
                 'url' => 'admin/laporan',
                 'icon'=>"file",
               ]);
             }elseif (auth()->check() && auth()->user()->level == "pengurus") {
               $event->menu->add('MAIN NAVIGATION');
               $event->menu->add([
                 'text' => 'Beranda',
                 'url' => 'pengurus',
                 'icon'=>"home",
               ]);
               $event->menu->add([
                 'text' => 'Data Perijinan',
                 'url' => 'pengurus/ijin',
                 'icon'=>"arrow-up",
               ]);
               $event->menu->add([
                 'text' => 'Data & Catatan Aktivitas Santri',
                 'url' => 'pengurus/santri',
                 'icon'=>"users",
               ]);
               $event->menu->add([
                 'text' => 'Pengaturan Akun',
                 'url' => 'pengurus/akun',
                 'icon'=>"gears",
               ]);
               $event->menu->add([
                 'text' => 'Laporan',
                 'url' => 'pengurus/laporan',
                 'icon'=>"file",
               ]);
             }
           });
    }
}
