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
                    <table class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Views</th>
                            <th>Is public</th>
                            <th>Show / Edit / Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $i => $page)
                            <tr>
                                <th>{{$i + 1}}</th>
                                <td>{{$page->url}}</td>
                                <td>{{$page->views}}</td>
                                <td>{{$page->is_public ? "yes" : "no"}}</td>
                                <td><a class="btn btn-success" target="_blank"
                                       href="/{{$page->username}}/{{$page->url}}"
                                       role="button">Show</a>
                                    <a class="btn btn-success" href="/{{$page->username}}/{{$page->url}}/edit"
                                       role="button">Edit</a>
                                    <form class="float-right" method="POST"
                                          action="{{ route('pages.destroy',$page->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
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
