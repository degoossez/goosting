@extends('preview.preview')

@section('content')

    <!-- include summernote css/js , not in the includes layout because it's very specific -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<link href="{{ $linkToStyleSheet }}" rel="stylesheet">
<div class="wrapper">
    <div class="container" id="dashboardContent">
        <h2>{!! $title !!}</h2>
        {!! $pageData->content !!} 
    </div>
</div>

@endsection
