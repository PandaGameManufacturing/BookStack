@extends('base')

@section('content')

    <!-- 
        TODO:
        This is all fugly, need to 
        1) cache the results, 
        2) optimize any queries 
        3) componentize the loop templates 
    -->

    <div class="faded-small toolbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 faded">
                    <div class="action-buttons text-left">
                        <!-- <a expand-toggle=".entity-list.compact .entity-item-snippet" class="text-primary text-button"><i class="zmdi zmdi-wrap-text"></i>{{ trans('common.toggle_details') }}</a> -->
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style type="text/css">
        ul.sitemap,
        ul.sitemap ul
        {
            list-style-type: none;
        }
        ul.sitemap>li {
            padding-top: 1em;
        }
    </style>

    <div class="container" ng-non-bindable>


    @foreach ($books as $book)
        @if ($loop->first || $loop->iteration % 3 == 0)
        <div class="row">
        @endif

            <div class="col-sm-4">
                <ul class="sitemap">
                    <li>
                        <a class="text-book entity-list-item-link" href="{{$book->getUrl()}}"><i class="zmdi zmdi-book"></i> {{ $book->name }}</a>
                        <!-- @if(isset($book->searchSnippet))
                            <p class="text-muted" style="float:right;">{!! $book->searchSnippet !!}</p>
                        @else
                            <p class="text-muted" style="float:right;">{{ $book->getExcerpt() }}</p>
                        @endif -->

                    @if ($book->chapters)
                        <ul>
                        @foreach ($book->chapters as $chapter)
                            <li>
                                <a href="{{ $chapter->getUrl() }}" class="text-chapter entity-list-item-link">
                                    <i class="zmdi zmdi-collection-bookmark"></i>{{ $chapter->name }}
                                </a>

                            @if ($book->pages)
                                <ul>
                                @foreach ($chapter->pages as $page)
                                    <li>
                                        <a href="{{ $page->getUrl() }}" class="text-page entity-list-item-link">
                                            <i class="zmdi zmdi-file-text"></i>{{ $page->name }}
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                            </li>
                        @endforeach
                        </ul>
                    @endif

                    @if ($book->pages)
                        <ul>
                        @foreach ($book->pages as $page)
                            @if (!$page->hasChapter())
                            <li>
                                <a href="{{ $page->getUrl() }}" class="text-page entity-list-item-link">
                                    <i class="zmdi zmdi-file-text"></i>{{ $page->name }}
                                </a>
                            </li>
                            @endif
                        @endforeach
                        </ul>
                    @endif


                    </li>
                </ul>
            </div>

        @if ($loop->last || $loop->iteration % 3 == 2)
        </div>
        @endif
    @endforeach
    </div>


@stop
