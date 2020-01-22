@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-2 offset-md-10">
                        <a class="btn btn-primary" href="/pages/create" role="button">Create page</a>
                    </div>
                </div>
            </div>
        </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr class="row">
                                <th class="col-sm-2">#</th>
                                <th class="col-sm-3">Name</th>
                                <th class="col-sm-2">Views</th>
                                <th class="col-sm-2">Is public</th>
                                <th class="col-sm-3">Show / Edit / Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pages as $i => $page)
                                <tr class="row">
                                    <th class="col-sm-2">{{$i + 1}}</th>
                                    <td class="col-sm-3">{{$page->url}}</td>
                                    <td class="col-sm-2">{{$page->views}}</td>
                                    <td class="col-sm-2">{{$page->is_public ? "yes" : "no"}}</td>
                                    <td class="col-sm-3"><a class="btn btn-success" target="_blank"
                                                            href="/{{$page->username}}/{{$page->url}}"
                                                            role="button">Show</a>
                                        <a class="btn btn-success" href="/{{$page->username}}/{{$page->url}}/edit"
                                           role="button">Edit</a>
                                        <a class="btn btn-danger" href="/pages/create" role="button">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </div>
@endsection
