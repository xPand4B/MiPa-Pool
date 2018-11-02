<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetBrandColor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'brand:color';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rewrite material-dashboard colors';

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
        $this->info('Rewriting Material-Dashboard Colors.');

        // BRAND-COLOR
            // Select File
            $path = 'node_modules/material-dashboard/assets/scss/material-dashboard/variables/';
            $file = '_brand.scss';
            // Delete file
            unlink($path . $file);

            // Recreate file
            $fp = fopen($path . $file, 'a') or die(
                $this->error('Could not re-create file. Check you permissions.')
            );

            // New Content
            $content = [
                '// Bootstrap brand color customization',
                '',
                '',
                '/*     default brand Colors              */',
                '// $brand-primary:              $purple-500 !default;',
                '// $brand-info:                 $cyan-500 !default;',
                '// $brand-success:              $green-500 !default;',
                '// $brand-warning:              $orange-500 !default;',
                '// $brand-danger:               $red-500 !default;',
                '// $brand-rose:                 $pink-500 !default;',
                '// $brand-inverse:              $black-color !default;',
                '',
                '',
                '/*     new brand Colors              */',
                '$brand-primary:              rgb(0, 94, 184) !default;',
                '$brand-info:                 rgb(0, 177, 235) !default;',
                '$brand-success:              rgb(149, 193, 31) !default;',
                '$brand-warning:              rgb(236, 103, 38) !default;',
                '$brand-danger:               rgb(229, 0, 81) !default;',
                '$brand-rose:                 rgb(230, 0, 126) !default;',
                '$brand-inverse:              $black-color !default;'
            ];

            // Write content
            foreach($content as $line){
                fwrite($fp, $line . "\n");
            }
            fclose($fp);


        // DATA-COLOR
            // Select File
            $path = 'node_modules/material-dashboard/assets/scss/material-dashboard/';
            $file = '_sidebar-and-main-panel.scss';
            $ending = '.tmp';

            $reading = fopen($path . $file, 'r') or die(
                $this->error('Could not open file "sidebar-and-main-panel.scss". Check you permissions.')
            );
            $writing = fopen($path . $file . $ending, 'w');

            $replaced = false;
            // Loop each line
            while (!feof($reading)) {
                $line = fgets($reading);
                // Primary
                if (stristr($line,'&[data-color="purple"]{')) {
                    $line = '    &[data-color="primary"]{'. "\n";
                    $replaced = true;
                // info
                }else if(stristr($line,'&[data-color="azure"]{')){
                    $line = '    &[data-color="info"]{'. "\n";
                    $replaced = true;
                // success
                }else if(stristr($line,'&[data-color="green"]{')){
                    $line = '    &[data-color="success"]{'. "\n";
                    $replaced = true;
                // warning
                }else if(stristr($line,'&[data-color="orange"]{')){
                    $line = '    &[data-color="warning"]{'. "\n";
                    $replaced = true;
                // danger
                }else if(stristr($line,'&[data-color="danger"]{')){
                    $line = '    &[data-color="danger"]{'. "\n";
                    $replaced = true;
                // rose
                }else if(stristr($line,'&[data-color="rose"]{')){
                    $line = '    &[data-color="rose"]{'. "\n";
                    $replaced = true;
                }
                fputs($writing, $line);
            }

            fclose($reading); fclose($writing);
            
            // might as well not overwrite the file if we didn't replace anything
            if ($replaced){
                rename($path . $file . $ending, $path . $file);
            } else {
                unlink($path . $file . '.tmp');
            }
        
        // Output
        $this->info('Rewrite successful. New colors are now available.');
    }
}
