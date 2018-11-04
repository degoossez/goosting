
@extends('layouts.app')

@section('content')

    <!-- include summernote css/js , not in the includes layout because it's very specific -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<div class="wrapper">
    @include('layouts.sidebar')
    <div class="container-fluid" id="dashboardContent">
        <div class="container">
            <div class="row">
                <div class="col">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                    </button>
                </div>
            </div>
        </div>

        <form action="{{route('updateOrPublish')}}" method="POST" id="editPageForm">
            {{ csrf_field() }}
            <input type="hidden" value="{!! $pageData->id !!}" name="page_id">
            <div class="container">
                <div class="row">
                    <h2>Edit page</h2>
                </div>
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Page title</span>
                        </div>
                        <input name="pagetitle" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{!! $pageData->title !!}">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Summary</span>
                        </div>
                        <input name="summary" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{!! $pageData->summary !!}">
                    </div>
                </div>
            </div>    
            <textarea name="summernoteInput" id="summernote">
                    @if( ! empty($pageData->content))
                        {!! $pageData->content !!}
                    @endif
            </textarea>
            <!-- Select tags in multi select with https://select2.org/ -->
            
            <br>
            <button type="submit" class="btn btn-info" name="submitButton" value="update">Update</button>
            <button type="submit" class="btn btn-info" name="submitButton" value="publish">Publish</button>
        </form>
    </div>
</div>

<script>

    var h = window.innerHeight/2;
    $('#summernote').summernote({
        height: h,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote
    });
    function loadAddPage(){
        $("#dashboardContent" ).load("{{ route('addPage') }}", function() {
            history.pushState({}, '', '/dashboard/addPage');
        });
    }
    function loadPage(pageId){
        $('#editPageForm').load('{{URL::to("/dashboard/editpage/")}}/'+pageId + "/false", function(){
            var url = pageId + "/false";
            history.pushState({},'',url);
        });
    }
    /*
    * Showing active page is not working because this is loaded before the li is created
    */
    $( window ).on( "load", function() {
        $('#pageSubmenu').collapse('toggle');
        //TODO: not working atm
        /*var url = window.location.href;
        var inputArray = url.split("/");
        var id = "#editPage" + inputArray[inputArray.length-1];
        //$(id).addClass('active_side');
        $('#editPage23').addClass('active_side');*/
    });

</script>

@endsection
