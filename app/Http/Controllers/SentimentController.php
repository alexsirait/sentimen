<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use Sentiment\Analyzer;
use Stichoza\GoogleTranslate\GoogleTranslate;

class SentimentController extends Controller
{
    public function sentiment(Request $req)
    {
        try {

            $translator = new GoogleTranslate();

            $translator->setTarget('en');

            $translatedText = $translator->translate($req->msg);

            $stringParg = preg_replace("/[^a-zA-Z\s]/", "", $translatedText);

            $stringParg = strtolower($stringParg);

            $stringParg = preg_replace('/\s+/', ' ', $stringParg);

            $analyzer = new Analyzer();

            $output = $analyzer->getSentiment($stringParg);

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