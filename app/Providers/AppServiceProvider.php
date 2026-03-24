<?php

namespace App\Providers;

use App\Models\AdsRepository;
use App\Models\Order;
use App\Repositories\Contracts\AdsRepositoryInterface;
use App\Repositories\Contracts\AuthRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\CheckoutRepositoryInterface;
use App\Repositories\Contracts\FavoriteRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\ShippingCompanyRepository;
use App\Repositories\Contracts\ShippingCompanyRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\AdsRepository as EloquentAdsRepository;
use App\Repositories\Eloquent\AuthRepository;
use App\Repositories\Eloquent\CartRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CheckoutRepository;
use App\Repositories\Eloquent\FavoriteRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ReviewRepository;
use App\Repositories\Eloquent\ShippingCompanyRepository as EloquentShippingCompanyRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            ShippingCompanyRepositoryInterface::class,
            EloquentShippingCompanyRepository::class
        );

        $this->app->bind(
            AdsRepositoryInterface::class,
            EloquentAdsRepository::class,
        );
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class,
        );
        $this->app->bind(
            FavoriteRepositoryInterface::class,
            FavoriteRepository::class,
        );

        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class
        );

        $this->app->bind(
            CheckoutRepositoryInterface::class,
            CheckoutRepository::class
        );

        $this->app->bind(
            ReviewRepositoryInterface::class,
            ReviewRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
