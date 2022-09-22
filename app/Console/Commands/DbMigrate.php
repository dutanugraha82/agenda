<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate_in_order';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute the migrations in the order specified in the file app/Console/Comands/DbMigrate.php \n Drop all the table in db before execute the command.';

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
        $migrations = [ 
            '001_09_21_0001_create_units_table.php',
            '002_09_21_073025_create_users_table.php',
            '003_09_21_062341_create_unit_social_media_table.php',
            '2022_09_21_062813_create_acivities_table.php',
            '2022_09_21_063549_create_social_media_table.php',
            '2022_09_21_064221_create_websites_table.php',
            '2014_10_12_100000_create_password_resets_table.php',
            '2019_08_19_000000_create_failed_jobs_table.php',
        ];

        foreach($migrations as $migration)
        {
        $basePath = 'database/migrations/';          
        $migrationName = trim($migration);
        $path = $basePath.$migrationName;
        $this->call('migrate:refresh', [
            '--path' => $path ,            
        ]);
        }
    }
}
