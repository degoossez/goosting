@extends('layouts.app')

@section('content')

<div class="wrapper">
    @include('layouts.sidebar')
    <div class="container-fluid" id="dashboardContent">
        
    </div>
</div>
<script>
function loadAddPage(){
    $( "#dashboardContent" ).load("{{ route('addPage') }}", function() {
        history.pushState({}, '', '/dashboard/addPage');
        alert( "Load was performed." );
    });
}
</script>

@endsection
