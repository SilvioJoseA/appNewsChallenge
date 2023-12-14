<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\NytimesNews;
use Carbon\Carbon;

class NYTNewsController extends Controller
{
    public function getNews(Request $request)
    {
        $apiKey = 'YrUizx2HoNWLmppVElk6uhMAoBR0uQJs'; // Replace with your actual API key
        $url = 'https://api.nytimes.com/svc/search/v2/articlesearch.json';

        // Set up the request parameters
        $params = [
            'q' => $request->input('q', ''),
            'api-key' => $apiKey,
            'page' => $request->input('page', 1), // Increment the page number to get more results
        ];

        // Make the API request
        $response = Http::get($url, $params);

        // Check if the request was successful
        if ($response->successful()) {
            // Parse the JSON response
            $data = $response->json();

            // Extract relevant information from the response (adjust as needed)
            $articles = $data['response']['docs'];

            // Process each article and save to the database
            $this->saveNewsToDatabase($articles);

            // You can further process or return the articles as needed
            return response()->json($articles, 200);
        } else {
            // Handle the case where the request was not successful
            return response()->json(['error' => 'Failed to fetch news.'], $response->status());
        }
    }

    private function saveNewsToDatabase($articles)
    {
        foreach ($articles as $article) {
                //var_dump($article['keywords'][0]['value']);
            NytimesNews::create([
                'abstract' => $article['abstract'] ?? '',
                'web_url' => $article['web_url'] ?? '',
                'snippet' => $article['snippet'] ?? '',
                'lead_paragraph' => $article['lead_paragraph'] ?? '',
                'source' => $article['source'] ?? '',
                'urlImagen' => '', // You can set the image URL based on available data
                'keywords' => '', // You can set keywords based on available data
                'pub_date' => $article['pub_date'] ?? '',
                'document_type' => $article['document_type'] ?? '',
                'news_desk' => $article['news_desk'] ?? '',
                'section_name' => $article['section_name'] ?? '',
                'subsection_name' => $article['subsection_name'] ?? '',
                'byline_original' => $article['byline']['original'] ?? '',
                
            ]);
        }
    }
    private function concatKeywords ($keyword) {
    }
    public function getNews1() {
        $arrNews = NytimesNews::all();
        return response()->json($arrNews,201);
    }
    
}
