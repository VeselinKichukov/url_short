<?php

namespace App\Console\Commands;

use App\Word;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FillUrlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill the database with the words used to shorten urls.';

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
     * @return mixed
     */
    public function handle()
    {
        if(!empty(Word::first())){
            if ($this->confirm('There are existing records. Running the command will override the existing records with new ones. Do you wish to continue?')) {
                DB::table('words')->truncate();
                DB::table('url_short')->truncate();
                $this->insertRecords();
            }
            else{
                $this->info('The process was stopped.');
            }
        }
        else{
            $this->insertRecords();
        }
    }

    /**
     * Insert the words in the database.
     *
     * @return void
     */
    protected function insertRecords()
    {
        $fp = fopen('https://www.eff.org/files/2016/09/08/eff_short_wordlist_2_0.txt', "r");

        while (!feof($fp)) {
            $current_line = fgets($fp);

            if (!empty($current_line)) {
                $word = preg_replace("/[^a-zA-Z]/", "", $current_line);

                Word::create([
                    'word' => $word,
                    'used' => false
                ]);
            }
        }
        fclose($fp);

        $this->info('All done!');
    }
}
