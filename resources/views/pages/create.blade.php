@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Add new page') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pages.store') }}">
                            @csrf
                            <div class="form-group form-inline">
                                <div class="col-sm-6 my-1">
                                    <label class="sr-only" for="url">url</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">mjacksi.com/{{ $username}}/</div>
                                        </div>
                                        <input type="text" class="form-control @error('url') is-invalid @enderror"
                                               name="url" value="{{ old('url') }}" placeholder="pagename" required>
                                    </div>
                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-7 offset-md-5">
                                    <label for="html_code" class="col-form-label text-md-right">Type HTML code here:</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="html_code"
                                              class="form-control @error('html_code') is-invalid @enderror codemirror-textarea"
                                              name="html_code" rows="10" autofocus></textarea>
                                    @error('html_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-center bd-highlight mb-3">
                                <div class="p-2 bd-highlight">
                                    <div class="custom-control custom-checkbox checkbox-xl">
                                        <input type="checkbox" class="custom-control-input" name="is_public"
                                               id="is_public" checked="">
                                        <label class="custom-control-label" for="is_public">Make page public?</label>
                                    </div>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                                {{--<div class="p-2 bd-highlight">
                                    <button type="button" id="preview" class="btn btn-lg btn-success">
                                        {{ __('Preview') }}
                                    </button>
                                </div>--}}
                            </div>
                        </form>
                    </div>
                    <div class="container border">
                        <div id="preview_html_code"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <link rel="stylesheet" href="/plugin/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="/plugin/codemirror/addon/hint/show-hint.css">

    <!-- javascript -->
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/plugin/codemirror/lib/codemirror.js"></script>
    <script type="text/javascript" src="/js/default.js"></script>
    <script src="/plugin/codemirror/lib/codemirror.js"></script>
    <script src="/plugin/codemirror/addon/hint/show-hint.js"></script>
    <script src="/plugin/codemirror/addon/hint/xml-hint.js"></script>
    <script src="/plugin/codemirror/addon/hint/html-hint.js"></script>
    <script src="/plugin/codemirror/mode/xml/xml.js"></script>
    <script src="/plugin/codemirror/mode/javascript/javascript.js"></script>
    <script src="/plugin/codemirror/mode/css/css.js"></script>
    <script src="/plugin/codemirror/mode/htmlmixed/htmlmixed.js"></script>

    <style>
        .CodeMirror {
            border-top: 1px solid #888;
            border-bottom: 1px solid #888;
            font-size: x-large;
        }

        .card-body {
            padding-left: 0px;
            padding-right: 0px;
        }
    </style>@endpush
