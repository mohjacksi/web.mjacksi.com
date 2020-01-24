<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;

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
        $username = Auth::user()->username;
        $url = $request['url'];
        $validatedData = $request->validate([
            'url' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:pages,url,NULL,id,username,'.$username],
            'html_code' => ['required', 'string'],
        ]);

        $page = new Page();
        $page->url = $request['url'];
        $page->html_code = $request['html_code'];
        $page->is_public = $request['is_public'] == 'on' ? true : false;
        $page->username = $username;
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

        if(!$page->is_public)
        {
            if(auth()->check()){
                if (Auth::user()->username != $username)
                    abort(403, 'Page is not public!.');
            }else{
                abort(403, 'Page is not public!.');
            }
        }

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
        if(auth()->check()){
            if (Auth::user()->username != $username)
                abort(403, 'You do not have the right to edit this page!');
        }else{
            abort(403, 'You do not have the right to edit this page!');
        }
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
        if(auth()->check()){
            if (Auth::user()->username != $page->username)
                abort(403, 'You do not have the right to edit this page!');
        }else{
            abort(403, 'You do not have the right to edit this page!');
        }

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
        $page = Page::find($id);
        if(auth()->check()){
            if (Auth::user()->username != $page->username)
                abort(403, 'You do not have the right to edit this page!');
        }else{
            abort(403, 'You do not have the right to edit this page!');
        }

        $page->delete();
        return redirect('/pages')->withSuccess(__('pages.destroyed'));

    }


    public function get_public_pages_of($username){
        //
        $pages = Page::where(['username'=>$username,'is_public'=> true])->get();
        return view('pages.public_pages_of')->with(['pages' => $pages,'username'=>$username]);
    }

    public function public_pages(){
        //
        $pages = Page::where(['is_public'=> true])->orderBy('id')->get();
        return view('pages.public_pages')->with(['pages' => $pages]);
    }

}
