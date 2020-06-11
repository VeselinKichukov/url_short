<?php

namespace App\Http\Controllers;

use App\Services\UrlService;
use Illuminate\Http\Request;
use App\UrlShort;

class UrlController extends Controller
{
    private $urlService;

    /**
     * UrlController constructor.
     *
     * @param UrlService $urlService
     */
    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function short(Request $request)
    {
        $this->urlService->validateUrl($request);

        $short = $this->urlService->generateShortURL($request);

        $this->urlService->store($request, $short);

        $this->urlService->markAsUsed($short->word);

        return $this->show();
    }

    /**
     * Show the view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $urls = UrlShort::wherePrivate('false')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('welcome', compact('urls'));
    }

    /**
     * Count the number of times the short url was used.
     *
     * @param $link
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function count($link)
    {
        $short = UrlShort::whereShort($link)->first();

        $short->increment('count');

        return redirect($short->url);
    }
}
