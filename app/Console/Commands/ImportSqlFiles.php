<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportSqlFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:import-sql';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all .sql files from the specified folder into the MS SQL database';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Specify the folder containing the .sql files
        $sqlFilesPath = base_path('database/sql_files'); // Adjust the path if necessary

        // Get all .sql files from the folder
        $sqlFiles = File::glob($sqlFilesPath . '/*.sql');

        if (empty($sqlFiles)) {
            $this->info('No SQL files found to import.');
            return;
        }

        foreach ($sqlFiles as $file) {
            $this->info('Importing file: ' . $file);

            // Read the contents of the SQL file
            $sql = File::get($file);

            try {
                // Execute the SQL statements
                DB::unprepared($sql);
                $this->info('Successfully imported: ' . $file);
            } catch (\Exception $e) {
                $this->error('Error importing file: ' . $file);
                $this->error('Error message: ' . $e->getMessage());
            }
        }

        $this->info('All SQL files have been imported.');
    }
}
