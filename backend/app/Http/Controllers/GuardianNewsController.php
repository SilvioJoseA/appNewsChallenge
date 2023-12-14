<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\GuardianNews;

class GuardianNewsController extends Controller
{
    public function getNews(){
        $apiKey = 'bb613488-ea68-4145-80ff-7ac2498cc31b';
        $url = 'https://content.guardianapis.com/search';
        $params = [
            'api-key' => $apiKey,
        ];
        $response = Http::get($url, $params);
        if ($response->successful()) {
            $data = $response->json();
            $articles = $data['response']['results'];
            $this->saveNewsToDatabase($articles);
            return response()->json($articles, 200);
        } else {
            return response()->json(['error' => 'Failed to fetch news.'], $response->status());
        }
    }
    private function saveNewsToDatabase ($articles) {
        foreach ($articles as $article) {
            GuardianNews::create([
                'article_id' => $article['id'] ?? '',
                'type' => $article['type'] ?? '',
                'section_id' => $article['sectionId'] ?? '',
                'section_name' => $article['sectionName'] ?? '',
                'web_publication_date' => $article['webPublicationDate'] ?? '',
                'web_title' => $article['webTitle'] ?? '',
                'web_url' => $article['webUrl'] ?? '',
                'api_url' => $article['apiUrl'] ?? '',
                'is_hosted' => $article['isHosted'] ?? '',
                'pillar_id' => $article['pillarId'] ?? '',
                'pillar_name' => $article['pillarName']?? ''
            ]);
        }
    }
    public function getNews1() {
        $arrNews = GuardianNews::all();
        return response()->json($arrNews,201);
    }
}
