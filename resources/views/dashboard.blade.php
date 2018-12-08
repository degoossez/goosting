@extends('dashboard.dashboard')

@section('content')

    <!-- include summernote css/js , not in the includes layout because it's very specific -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<div class="wrapper">
    @include('dashboard.sidebar')
    <div class="container-fluid" id="dashboardContent">
            {!! $page !!}
    </div>
</div>


<script>
function loadAddPage(){ //function called from the layouts.sidebar.blade.php file when clicked on add new page button
    $("#dashboardContent" ).load("{{ route('addPage') }}", function() {
        history.pushState({}, '', '/dashboard/addPage');
    });
}
function loadAddTheme(){
        $("#dashboardContent" ).load("{{ route('addTheme') }}", function() {
            history.pushState({}, '', '/dashboard/addTheme');
        });
    }    
</script>

@endsection
