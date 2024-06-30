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

            $analyzer = new Analyzer();

            $output = $analyzer->getSentiment($translatedText);

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