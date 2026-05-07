<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Dedoc\Scramble\Scramble;
use Illuminate\Routing\Route as LaravelRoute;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gate lama
        Gate::define('manage-category', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk buka docs API
        Gate::define('viewApiDocs', function () {
            return true;
        });

        Gate::policy(Product::class, ProductPolicy::class);

        // Scramble baca route api/* dan tampilkan bearer auth
        Scramble::configure()
            ->routes(function (LaravelRoute $route) {
                return Str::startsWith($route->uri, 'api/');
            })
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            })
            ->withOperationTransformers(function ($operation, $routeInfo) {
                $routeMiddleware = $routeInfo->route->gatherMiddleware();

                $hasAuthMiddleware = collect($routeMiddleware)->contains(
                    fn ($middleware) => Str::startsWith($middleware, 'auth:')
                );

                // route tanpa auth tidak perlu token
                if (! $hasAuthMiddleware) {
                    $operation->addSecurity([]);
                }
            });
    }
}