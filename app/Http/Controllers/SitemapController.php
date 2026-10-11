<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $pages = [];

        // Các trang công khai
        $publicRoutes = [
            'home',
            'about',
            'skills',
            'projects',
            'experience',
            'contact',
        ];

        foreach ($publicRoutes as $routeName) {
            if (Route::has($routeName)) {
                $pages[] = [
                    'url' => route($routeName),
                    'lastmod' => null,
                ];
            }
        }

        // Danh sách dự án
        if (Route::has('projects.show')) {
            $projects = Project::query()
                ->orderBy('id')
                ->get();

            foreach ($projects as $project) {
                $pages[] = [
                    'url' => route('projects.show', $project),
                    'lastmod' => $project->updated_at
                        ? $project->updated_at->toAtomString()
                        : null,
                ];
            }
        }

        // Tạo XML không sử dụng Blade
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        $root = $xml->createElementNS(
            'http://www.sitemaps.org/schemas/sitemap/0.9',
            'urlset'
        );

        $xml->appendChild($root);

        foreach ($pages as $page) {
            $url = $xml->createElement('url');

            $loc = $xml->createElement('loc');
            $loc->appendChild(
                $xml->createTextNode($page['url'])
            );

            $url->appendChild($loc);

            if (!empty($page['lastmod'])) {
                $lastmod = $xml->createElement('lastmod');

                $lastmod->appendChild(
                    $xml->createTextNode($page['lastmod'])
                );

                $url->appendChild($lastmod);
            }

            $root->appendChild($url);
        }

        return response(ltrim($xml->saveXML(), "\xEF\xBB\xBF \t\r\n"), 200)
    ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
