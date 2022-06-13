<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetLanguageLabels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'label';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $path = base_path('resources/views/consumer/');
        $files = scandir($path);
        $labels = [];

        
        foreach ($files as $file) {
            if (is_file($path.$file)) {
                $match = [];
                $str = file_get_contents($path.$file);

                preg_match_all('#@lang\(\'(.*?)\'\)#isu', $str, $match);

                foreach ($match[1] as $label) {
                    $labels[$label] = $label;
                }
            }
        }

        file_put_contents(base_path('lang/kz.json'), json_encode($labels, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
