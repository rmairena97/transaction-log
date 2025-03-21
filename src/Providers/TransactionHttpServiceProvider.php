<?php

namespace Rmairena\TransactionHttp\Providers;
use Illuminate\Support\ServiceProvider;
use Rmairena\TransactionHttp\TransactionHandler;

class TransactionHttpServiceProvider extends ServiceProvider {
    public function boot() {
        if ( $this->app->runningInConsole()) {
            $this->publishResources();
        }
    }

    public function register(){
        $this->mergeConfigFrom(__DIR__.'/../../config/table-definition.php', 'rmairena.transaction.http');

        $this->app->bind('rmairena.transaction.http', function() {
            return new TransactionHandler;
        });
    }

    protected function publishResources()
    {
        $this->publishes([
            __DIR__.'/../../config/table-definition.php' => config_path('table-definition.php'),
        ], 'rmairena.transaction.http-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/01-create_transaction_type_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_01-create_transaction_type_table.php'),
        ], 'rmairena.transaction.http-migrations');
        $this->publishes([
            __DIR__.'/../../database/migrations/02-create_thread_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_02-create_thread_table.php'),
        ], 'rmairena.transaction.http-migrations');
        $this->publishes([
            __DIR__.'/../../database/migrations/03-create_transaction_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_03-create_transaction_table.php'),
        ], 'rmairena.transaction.http-migrations');

        $this->publishes([
            __DIR__.'/../../database/migrations/04-create_transaction_trace_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_04-create_transaction_trace_table.php'),
        ], 'rmairena.transaction.http-migrations');

        $this->publishes([
            __DIR__.'/../../database/migrations/05-create_transaction_trace_log.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_05-create_transaction_trace_log.php'),
        ], 'rmairena.transaction.http-migrations');

        $this->publishes([
            __DIR__.'/../../database/seeds/TransactionTypeSeeder.php' => database_path('seeders/TransactionTypeSeeder.php'),
        ], 'rmairena.transaction.http-seeds');
    }
}