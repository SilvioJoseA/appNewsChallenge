<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NytimesNews;
use App\Models\GuardianNews;
use App\Models\AlphaNews;
class AlphaNewsController extends Controller
{
    private function formatNews($news, $sourceType = 'default') {
        return $news->map(function ($item) use ($sourceType) {
            return [
                'title' => $sourceType === 'nytimes' ? $item->web_url : ($sourceType === 'guardian' ? $item->web_title : $item->title),
                'description' => $sourceType === 'nytimes' ? $item->abstract : ($sourceType === 'guardian' ? $item->web_title : $item->description),
                'author' => $sourceType === 'nytimes' ? $item->byline_original : ($sourceType === 'guardian' ? "Author" : $item->author),
                'url' => $sourceType === 'nytimes' ? $item->web_url : ($sourceType === 'guardian' ? $item->web_title : $item->url),
                'urlToImage' => $sourceType === 'nytimes' ? $item->web_url ?? "." : ($sourceType === 'guardian' ? ".":$item->urlToImage?? '.' ),
                'publishedAt' => $sourceType === 'nytimes' ? $item->pub_date : ($sourceType === 'guardian' ? $item->web_publication_date : $item->publishedAt),
                'content' => $sourceType === 'nytimes' ? $item->web_title ?? 'content' : ($sourceType === 'guardian' ? $item->web_title ?? 'content' : ($item->snippet ?? 'Default Content')),
                'source_name' => $sourceType === 'nytimes' ? 'nytimes' : ($sourceType === 'guardian' ? 'guardian' : $item->source_name),
            ] + array_fill_keys(['title', 'description', 'author', 'url', 'urlToImage', 'publishedAt', 'content', 'source_name'], '');
        })->toArray();
    }
    public function getSources() {
        try {
            $rowsNews = $this->formatNews(News::all());
            $rowsNytimes = $this->formatNews(NytimesNews::all(), 'nytimes');
            $rowsGuardian = $this->formatNews(GuardianNews::all(), 'guardian');
            $combinedArray = [
                'news' => $rowsNews,
                'nytimes' => $rowsNytimes,
                'guardian' => $rowsGuardian,
            ];
            foreach ($combinedArray as $sourceType => $rows) {
                AlphaNews::insert($rows);
            }
            return response()->json(['message' => 'Datos guardados correctamente en AlphaNews'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getNews(Request $request) {     
        $filterAuthor = $request->input('filter_category');
        $dateFilter = $request->input('filter_date');
        $filterKeyword = $request->input('filter_keyword');
        $filterSource = $request->input('filter_source');  
        $query = AlphaNews::query();
        if ($dateFilter) {
            $query->where('publishedAt', '>=', $dateFilter);
        }
        if ($filterSource) {
            $query->where('source_name', 'like', "%$filterSource%");
        }
        if ($filterKeyword) {
            $query->where('description', 'like', "%$filterKeyword%");
        }
        if ($filterAuthor) {
            $query->where('author', 'like', "%$filterAuthor%");
        }
        $filteredNews = $query->get();
        return response()->json($filteredNews, 200);
    }
}
