<?php

namespace App\Console\Commands;

use App\Http\Controllers\DocusignController;
use Illuminate\Console\Command;

class ChangeIsSigned extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'is_signed:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change is_signed Contract';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $controller=new DocusignController();
        return $controller->getContractState();
    }
}
