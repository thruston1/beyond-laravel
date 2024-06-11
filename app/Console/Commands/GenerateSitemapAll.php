<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemapAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generateAll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate All sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SitemapGenerator::create('http://localhost:8000')
            ->hasCrawled(function (Url $url) {
                return $url;
            })
            ->writeToFile(public_path('sitemap.xml'));
        
    }
}
