<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Sentiment\Analyzer;
class SentimentController extends Controller
{
    public function sentiment(Request $req)
    {
        try {
            $analyzer = new Analyzer();

            $output = $analyzer->getSentiment($req->sentiment);

            return response()->json([
                "output" => $output,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "output" => $th->getMessage(),
            ]);
        }
    }
}