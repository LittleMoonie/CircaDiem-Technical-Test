<?php

namespace App\Console;

class Kernel extends \Illuminate\Console\Kernel
{
    protected $commands = [
        \App\Console\Commands\ManageProductsCommand::class,
        \App\Console\Commands\ManageCategoriesCommand::class,
        \App\Console\Commands\ManageVariationsCommand::class,
    ];
}
