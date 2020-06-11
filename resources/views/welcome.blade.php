@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{url('/') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <input type="text"
                                   class="form-control"
                                   name="url"
                                   id="url"
                                   value="{{old('url')}}"
                                   placeholder="Long URL (required)"
                                   required>
                        </div>
                        <div class="col-sm-4">
                            <input type="text"
                                   class="form-control"
                                   name="url_short"
                                   id="url_short"
                                   value="{{old('url_short')}}"
                                   placeholder="Short URL keyword (optional)">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="checked" name="private" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Private?
                            </label>
                        </div>
                        <div class="col-sm-2">
                            <button id="shorten-btn"
                                    type="submit"
                                    class="btn">
                                Shorten
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <textarea type="text"
                                      name="description"
                                      class="form-control"
                                      id="description"
                                      rows="2"
                                      placeholder="URL Description (max: 140 characters optional)">{{old('description')}}</textarea>
                        </div>
                    </div>
                </form>
                <br>
                @include('common.errors')
                <h1>
                    Recent links
                </h1>
                <br>
                @forelse($urls as $url)
                    <div class="card">
                        <div class="card-body">
                            <a id="link" href="{{ url('/short/' .  $url->short) }}">
                                {{ url($url->short) }}
                            </a>
                            <br>
                            <span>
                                    {{ $url->created_at->diffForHumans() }}
                                </span>
                            <br>
                            {{$url->url}}
                            <br>
                            {{$url->description}}
                        </div>
                    </div>
                @empty
                    <p>There are no relevant results at this time.</p>
                @endforelse
                {{ $urls->links() }}
            </div>
        </div>
    </div>
@endsection
