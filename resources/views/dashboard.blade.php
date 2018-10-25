@extends('layouts.app')

@section('content')

    <!-- include summernote css/js , not in the includes layout because it's very specific -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<div class="wrapper">
    @include('layouts.sidebar')
    <div class="container-fluid" id="dashboardContent">
            {!! $page !!}
            @if( ! empty($submittedContent))
                {!! $submittedContent !!}
            @endif
    </div>
</div>


<script>
function loadAddPage(){
    $("#dashboardContent" ).load("{{ route('addPage') }}", function() {
        history.pushState({}, '', '/dashboard/addPage');
        alert( "Load was performed." );
    });
}
</script>

@endsection
