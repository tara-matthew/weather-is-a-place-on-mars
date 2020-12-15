<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Helpers\Media;

class MediaController extends Controller
{
    protected $media;

    public function __construct()
    {
        $this->media = new Media();
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $days = $this->media->calculateDays($request);

        $response = HTTP::get('https://api.nasa.gov/planetary/apod', [
            'api_key' => getenv('NASA_API_KEY'),
            'date' => date('yy-m-d', strtotime($days))
        ])->json();

        return $this->media->checkFormat($response, $request->input('days'));
    }

    public function compressImage(Request $request)
    {
        $fileName = strtolower($request->input('filename'));
        $url = $request->input('url');
        try {
            $response = HTTP::timeout(3)->get('http://api.resmush.it/ws.php', [
                'img' => $url,
            ]);
            
            $response = $response->json();
            $destination = $response['dest'];
            return redirect()->action(['App\Http\Controllers\MediaController', 'testCompression'], ['destination' => $destination, 'response' => $response, 'filename' => $fileName]);
        } catch (ConnectionException $e) {
            return redirect()->action(
                ['App\Http\Controllers\MediaController', 'compressImage'],
                ['filename' => $fileName, 'url' => $url]
            );
        }
    }

    public function testCompression(Request $request)
    {
        $destination = $request->get('destination');
        $response = $request->get('response');
        $fileName = $request->get('filename');
        $imageContents = HTTP::timeout(3)->get($destination);

        return $this->media->compressImage($fileName, $imageContents, $response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
