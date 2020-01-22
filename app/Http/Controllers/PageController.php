<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //

        $pages = Auth::user()->pages;

        return view('pages.index')->with(['pages' => $pages,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        return view('pages.create')->with(['username' => Auth::user()->username,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $page = new Page();
        $page->url = $request['url'];
        $page->html_code = $request['html_code'];
        $page->is_public = $request['is_public'] == 'on' ? true : false;
        $page->username = Auth::user()->username;
        Auth::user()->pages()->save($page);

        return redirect('/'.$page->username.'/'.$page->url.'/edit')->withSuccess(__('pages.created'));

    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($username, $url)
    {
        $page = Page::where(['username' => $username, 'url' => $url])->first();
        $page->increment("views",1);

        return view('pages.show')->with(['page' => $page]);
    }


    public function showPage($username, $url)
    {
        $page = Page::where('url', $url)->and('username');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($username, $url)
    {
        $page = Page::where(['username' => $username, 'url' => $url])->first();

        return view('pages.edit')->with(['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $page = Page::find($id);
        $page->html_code = $request['html_code'];
        $page->is_public = $request['is_public'] == 'on' ? true : false;
        $page->save();
        return redirect()->route('page.edit_by_username_url',[$page->username,$page->url])->withSuccess(__('pages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getPublicPages($username){
        $pages = Page::where(['username'=>$username,'is_public'=> true])->get();

        return view('pages.public_pages')->with(['pages' => $pages,'username'=>$username]);

    }
}
