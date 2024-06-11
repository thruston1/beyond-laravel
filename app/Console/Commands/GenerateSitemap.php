<?php

namespace App\Console\Commands;

use App\Codes\Models\News;
use App\Codes\Models\Promo;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Manually create sitemap
        $sitemap = Sitemap::create();

        // Static pages
        $sitemap->add('/');
        $sitemap->add('/about-us');
        $sitemap->add('/menu');
        $sitemap->add('/our-store');
        $sitemap->add('/contact');
        $sitemap->add('/privacy-policy');
        $sitemap->add('/franchise');

        $sitemap->add('/promo');
        $getList = Promo::where('publish', '<=', date('Y-m-d H:i:s'))->where('status', '=', 80)->get();
        foreach ($getList as $list) {
            $sitemap->add("/promo/{$list->slugs}");
        }

        $sitemap->add('/news');
        $getList = News::where('publish', '<=', date('Y-m-d H:i:s'))->where('status', '=', 80)->get();
        foreach ($getList as $list) {
            $sitemap->add("/news/{$list->slugs}");
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

    }
}
