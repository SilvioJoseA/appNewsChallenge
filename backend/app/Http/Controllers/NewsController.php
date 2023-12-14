<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use Carbon\Carbon;

class NewsController extends Controller {
    public function obtenerNoticias(Request $request){
        $url = 'https://newsapi.org/v2/everything';
        $apiKey = 'b15363534834420a9c312c3193b59b5c';
        $params = [
            'from' => $request->input('from', '2023-12-07'),
            'sortBy' => 'publishedAt',
            'apiKey' => $apiKey,
        ];
        if ($request->has('q')) {
            $params['q'] = $request->input('q','tesla');
        }
        $response = Http::get($url, $params);
        $newResponse = $response->json()['articles'];
        $this->saveNewsToDatabase($newResponse);
        return response()->json($response->json(), $response->status());
    }
    private function saveNewsToDatabase ($newResponse) {
        if(empty(!$newResponse)){
            foreach ($newResponse as $news) {
                var_dump($news);
                News::create([
                    'title' => $news['title'] ? $news['title'] : 'Valor Predeterminado',
                    'description' => $news['description']?$news['description']:'Valor predeterminado',
                    'author' => $news['author']?$news['author']:'Valor predeterminado',
                    'url' => $news['url']?$news['url']:'Valor predeterminado',
                    'urlToImage' => $news['urlToImage']?$news['urlToImage']:'Valor predeterminado',
                    'publishedAt' =>Carbon::parse($news['publishedAt'])?Carbon::parse($news['publishedAt']):Now(),
                    'content' => $news['content']?$news['content']:'Valor predeterminado',
                    'source_name' => $news['source']['name']?$news['source']['name']:'Valor predeterminado',
                ]);
            }
        }
    }
    public function getNews(Request $request) {     
        $categoryFilter = $request->input('filter_category');
        $dateFilter = $request->input('filter_date');
        $filterKeyword = $request->input('filter_keyword');
        $filterSource = $request->input('filter_source');  
        $query = News::query();
        if ($dateFilter) {
            $query->where('publishedAt', '>=', $dateFilter);
        }
        if ($filterSource) {
            $query->where('source_name', 'like', "%$filterSource%");
        }
        if ($filterKeyword) {
            $query->where('description', 'like', "%$filterKeyword%");
        }
        $filteredNews = $query->get();
        return response()->json($filteredNews, 200);
    }
    
}

