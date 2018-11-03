<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * @author Eric Heinzl <xpand.4beatz@gmail.com>
 * 
 * @license MIT
 * @package MiPa-Pool
 */
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
     * Content for replacing
     *
     * @var array
     */
    private $content = [];

    /**
     * Filenames for replacing
     *
     * @var array
     */
    private $files = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->SetDefaultValues();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
        |--------------------------------------------------------------------------
        | Change Brand-Color
        |--------------------------------------------------------------------------
        |
        | This Command is for changing the default colors from the "Material-Dashboard".
        | It replaces lines inside .scss files inside the "node_mmodules" folder.
        | If you want to change my default values search for $content inside the $Replace function.
        |
        |
        | Following files are already affected:
        |--------------------------------------------------------------------------
        |   node_modules/material-dashboard/assets/scss/material-dashboard/_cards.scss
        |   node_modules/material-dashboard/assets/scss/material-dashboard/variables/_brand.scss
        |   node_modules/material-dashboard/assets/scss/material-dashboard/_sidebar-and-main-panel.scss
        |
        */

        // Start Message
        $this->line('');
        $this->info('Rewriting Material-Dashboard Colors.');
        
        // Add Values
        // Note that both values, filename AND content must have some content.
        $this->AddValue(
            // FILENAMES
            [
                // 'node_modules/material-dashboard/assets/scss/material-dashboard/variables/_brand.scss',
            ],

            // CONTENT
            // What you see in the following example will be only for one file.
            // If you have multiple files call $this->AddValues() again.
            [
                // What should be searched for
                [
                    // Example:
                    // '&[data-color="purple"]{',
                ],
                // Which content should replace it
                [
                    // '&[data-color="primary"]{',
                ]
            ]
        );

        // Start rewriting files
        $this->Start();

        // Finish Message
        $this->line('');
        $this->info('Rewrite successful. New colors are now available.');
        $this->line('');
    }

    /**
     * Add new Values to replace
     *
     * @param array $newFiles
     * @param array $newContent
     * @return void
     */
    private function AddValue(array $newFiles = [], array $newContent = [])
    {
        // Add files and content to array
        if(sizeof($newFiles) != 0 && sizeof($newContent)){
            array_push($this->files, $newFiles);
            array_push($this->content, $newContent);
        }
    }

        /**
     * Set default values for MiPa-Pool
     *
     * @return void
     */
    private function SetDefaultValues()
    {
        // Select File
        $this->files = [
            // Brand-Color
            'node_modules/material-dashboard/assets/scss/material-dashboard/variables/_brand.scss',
            // data-color
            'node_modules/material-dashboard/assets/scss/material-dashboard/_sidebar-and-main-panel.scss',
            // Card Color
            'node_modules/material-dashboard/assets/scss/material-dashboard/_cards.scss',
        ];

        // Set Content
        $this->content = [
            // Brand-Color
            [
                [
                    // Primary
                    '$purple-500',
                    // Info
                    '$cyan-500',
                    // Success
                    '$green-500',
                    // Warning
                    '$orange-500',
                    // Danger
                    '$red-500',
                    // Rose
                    '$pink-500',
                ],
                [
                    // Primary
                    '$brand-primary:              rgb(0, 94, 184) !default;',
                    // Info
                    '$brand-info:                 rgb(0, 177, 235) !default;',
                    // Success
                    '$brand-success:              rgb(149, 193, 31) !default;',
                    // Warning
                    '$brand-warning:              rgb(236, 103, 38) !default;',
                    // Danger
                    '$brand-danger:               rgb(229, 0, 81) !default;',
                    // Rose
                    '$brand-rose:                 rgb(230, 0, 126) !default;',
                ],
            ],
            // data-color
            [
                [
                    // Primary
                    '&[data-color="purple"]{',
                    // Info
                    '&[data-color="azure"]{',
                    // Success
                    '&[data-color="green"]{',
                    // Warning
                    '&[data-color="orange"]{',
                ],
                [
                    // Primary
                    '    &[data-color="primary"]{',
                    // Info
                    '    &[data-color="info"]{',
                    // Success
                    '    &[data-color="success"]{',
                    // Warning
                    '    &[data-color="warning"]{',
                ]
            ],
            // Card Color
            [
                [
                    // Primary
                    '$purple-400, $purple-600',
                    // Info
                    '$cyan-400, $cyan-600',
                    // Success
                    '$green-400, $green-600',
                    // Warning
                    '$orange-400, $orange-600',
                    // Danger
                    '$red-400 $red-600',
                    // Rose
                    '$pink-400, $pink-600'
                ],
                [
                    // Primary
                        // #01
                        '      background: linear-gradient(60deg, rgb(0, 94, 184), rgb(162, 0, 103));',
                        // #02
                        // '      background: linear-gradient(60deg, rgb(0, 94, 184), rgb(135, 136, 138));',
                        // #03
                        // '      background: linear-gradient(60deg, rgb(162, 0, 103), rgb(135, 136, 138));',
                        // #04
                        // '      background: linear-gradient(60deg, rgb(162, 0, 103), rgb(0, 94, 184));',
                        // #05
                        // '      background: linear-gradient(60deg, rgb(0, 94, 184), rgb(162, 0, 103));',
                    // Info
                    '      background: linear-gradient(60deg, rgb(0, 177, 235), rgb(65, 192, 240));',
                    // Success
                    '      background: linear-gradient(60deg, rgb(149, 196, 31), rgb(174, 205, 96));',
                    // Warning
                    '      background: linear-gradient(60deg, rgb(236, 103, 38), rgb(247, 168, 35));',
                    // Danger
                    '      background: linear-gradient(60deg, rgb(229, 0, 81), rgb(236, 95, 120));',
                    // Rose
                    '      background: linear-gradient(60deg, rgb(230, 0, 126), rgb(231, 82, 151));'
                ]
            ],            
        ];
    }
    
    /**
     * Start loops for replacing stuff
     *
     * @return void
     */
    private function Start()
    {
        // Set File Number
        $fileCount = sizeof($this->files);
        $counter = 1;

        // Loop for function call
        for($i = 0; $i < $fileCount; $i++){
            // Replace inside File
            $this->RewriteFiles($this->files[$i], $this->content[$i]);
            
            // Output after a file is finished
            $this->line('');
            $this->info('   ' . $counter . '/' . $fileCount . ' files rewriten.');
            $this->line('      > ' . $this->files[$i]);
            $counter++;
        }
    }

    /**
     * Replaces lines inside files
    *
    * @param string $file
    * @param array $modules
    * @return void
    */
    private function RewriteFiles(string $file, array $modules = [])
    {
        $ending = '.tmp';

        $reading = fopen($file, 'r') or die(
            $this->error('Could not open file "' . $file . '". Check you permissions.')
        );
        $writing = fopen($file . $ending, 'w');

        $replaced = false;
        // Loop each line
        while (!feof($reading)) {
            $line = fgets($reading);

            for($i = 0; $i < sizeof($modules[0]); $i++){
                if(stristr($line, $modules[0][$i])){
                    $line = $modules[1][$i] . "\n";
                    $replaced = true;
                }
            }
            fputs($writing, $line);
        }

        fclose($reading); fclose($writing);

        // might as well not overwrite the file if we didn't replace anything
        if ($replaced){
            rename($file . $ending, $file);
        } else {
            unlink($file . '.tmp');
        }

       
    }
}
