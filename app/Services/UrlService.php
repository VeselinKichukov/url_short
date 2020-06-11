<?php

namespace App\Services;

use App\Rules\MustBeFromAllowedWords;
use App\Rules\MustNotBeInUse;
use App\Rules\WordsMustExist;
use App\UrlShort;
use App\Word;
use Illuminate\Http\Request;

class UrlService
{
    /**
     * Generate a short url.
     *
     * @param $request
     * @return mixed
     */
    public function generateShortURL($request)
    {
        if (!empty($request->url_short)) {
            $short = $request->url_short;

            return Word::whereWord($short)->whereUsed(0)->first();
        }
        return Word::whereUsed(0)->first();
    }

    /**
     * Store the resources.
     *
     * @param Request $request
     * @param $short
     */
    public function store(Request $request, $short): void
    {
        $private = !empty($request->private);

        UrlShort::create([
            'url' => $request->url,
            'short' => $short->word,
            'description' => $request->description,
            'private' => $private
        ]);
    }

    /**
     * Mark the short url word as used.
     *
     * @param $short
     */
    public function markAsUsed($short): void
    {
        Word::whereWord($short)->update(['used' => 1]);
    }

    /**
     * Validate url, description, and short url.
     *
     * @param Request $request
     */
    public function validateUrl(Request $request): void
    {
        $request->validate([
            'url' => 'required|url',
            'url_short' => [
                new WordsMustExist,
                new MustBeFromAllowedWords,
                new MustNotBeInUse
            ],
            'description' => 'nullable|max:140'
        ]);
    }
}
