@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row justify-content-center">
            <div class="d-flex justify-content-center bd-highlight mb-3">
                <div class="p-2 bd-highlight">
                    <h3>{{$username}}'s pages</h3>
                </div>
            </div>


            <div class="col-md-12">
                <table class="table table-striped table-bordered table-list">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Views</th>
                        <th scope="col">Show</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($pages as $i => $page)
                        <tr>
                            <th scope="row">{{$i + 1}}</th>
                            <td>{{$page->url}}</td>

                            <td>{{$page->views}}</td>

                            <td><a class="btn btn-success" target="_blank" href="/{{$page->username}}/{{$page->url}}"
                                   role="button">Show</a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection
