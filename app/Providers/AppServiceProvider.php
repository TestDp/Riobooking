<?php

namespace App\Providers;


use App\Org_Saludables\Datos\Repositorio\MCitas\ColaboradorRepositorio;
use App\Org_Saludables\Datos\Repositorio\MCitas\IColaboradorRepositorio;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\CompaniaRepositorio;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\ICompaniaRepositorio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\CompaniaServicio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ICompaniaServicio;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\ISedeRepositorio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\ISedeServicio;
use Org_Saludables\Datos\Repositorio\MEmpresa\SedeRepositorio;
use Org_Saludables\Negocio\Logica\MEmpresa\SedeServicio;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\IRegionalRepositorio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\IRegionalServicio;
use Org_Saludables\Datos\Repositorio\MEmpresa\RegionalRepositorio;
use Org_Saludables\Negocio\Logica\MEmpresa\RegionalServicio;
use App\Org_Saludables\Datos\Repositorio\MEmpresa\IGerenciaRepositorio;
use App\Org_Saludables\Negocio\Logica\MEmpresa\IGerenciaServicio;
use Org_Saludables\Datos\Repositorio\MEmpresa\GerenciaRepositorio;
use Org_Saludables\Negocio\Logica\MEmpresa\GerenciaServicio;
use App\Org_Saludables\Datos\Repositorio\MCitas\IJornadaRepositorio;
use App\Org_Saludables\Negocio\Logica\MCitas\IJornadaServicio;
use Org_Saludables\Datos\Repositorio\MCitas\JornadaRepositorio;
use Org_Saludables\Negocio\Logica\MCitas\JornadaServicio;
use App\Org_Saludables\Datos\Repositorio\MCitas\ICitasRepositorio;
use Org_Saludables\Datos\Repositorio\MCitas\CitasRepositorio;
use Org_Saludables\Negocio\Logica\MCitas\CitaServicio;
use App\Org_Saludables\Negocio\Logica\MCitas\ICitaServicio;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        app()->bind(ISedeRepositorio::class,SedeRepositorio::class);
        app()->bind(ISedeServicio::class,SedeServicio::class);
        app()->bind(ICompaniaRepositorio::class,CompaniaRepositorio::class);
        app()->bind(ICompaniaServicio::class,CompaniaServicio::class);
        app()->bind(IRegionalServicio::class,RegionalServicio::class);
        app()->bind(IRegionalRepositorio::class,RegionalRepositorio::class);
        app()->bind(IGerenciaServicio::class,GerenciaServicio::class);
        app()->bind(IGerenciaRepositorio::class,GerenciaRepositorio::class);
        app()->bind(IJornadaServicio::class,JornadaServicio::class);
        app()->bind(IJornadaRepositorio::class,JornadaRepositorio::class);
        app()->bind(ICitasRepositorio::class,CitasRepositorio::class);
        app()->bind(ICitaServicio::class,CitaServicio::class);
        app()->bind(IColaboradorRepositorio::class,ColaboradorRepositorio::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
