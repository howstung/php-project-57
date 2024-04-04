<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Policies\BasePolicy;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Label::class => BasePolicy::class,
        TaskStatus::class => BasePolicy::class,
        Task::class => TaskPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
