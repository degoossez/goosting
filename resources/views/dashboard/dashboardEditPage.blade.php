
@extends('dashboard.dashboard')

@section('content')

<!-- include summernote css/js , not in the includes layout because it's very specific -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<!-- Include Choices CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@4.1.1/public/assets/styles/choices.min.css">
<!-- Include Choices JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/choices.js@4/public/assets/scripts/choices.min.js"></script>

<div class="wrapper">
    @include('dashboard.sidebar')
    <div class="container-fluid" id="dashboardContent">        
        <form action="{{route('updateOrPublish')}}" method="POST" id="editPageForm">
            {{ csrf_field() }}
            <input type="hidden" value="{!! $pageData->id !!}" name="page_id">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                        </button>
                    </div>
                    <div class="col-11">
                        <h2>Edit page</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Page title</span>
                        </div>
                        <input name="pageTitle" id="pageTitle" type="text" value="{!! $pageData->title !!}" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">    
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Summary   </span>
                        </div>
                        <input name="summary" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{!! $pageData->summary !!}">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Theme</span>
                        </div>
                        <select name="pageTheme" id="pageTheme" class="form-control custom-select" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            <!-- TODO: dynamicly load all users themes-->
                            <option value="green">Green</option>
                            <option value="red">Red</option>                            
                        </select>                    
                    </div>
                </div>
            </div>    
            <textarea name="summernoteInput" id="summernote">
                @if( ! empty($pageData->content))
                {!! $pageData->content !!}
                @endif
            </textarea>
            <!-- Select theme in multi select with https://select2.org/ -->
            <!-- Select tags in multi select with https://select2.org/ -->
            
            <br>
            <button type="submit" class="btn btn-info" name="submitButton" value="update">Update</button>
            <button type="submit" class="btn btn-info" name="submitButton" value="publish">Publish</button>
        </form>
    </div>
</div>

<script>
    
    var h = window.innerHeight/2;
    var w = window.innerWidth * 2/3; //set width of the title & summary box
    
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
    function loadAddTheme(){
        $("#dashboardContent" ).load("{{ route('addTheme') }}", function() {
            history.pushState({}, '', '/dashboard/addTheme');
        });
    }     

    $(document).ready(function () {  

        //TODO: Showing active page is not working because this is loaded before the li is created
        $('#pageSubmenu').collapse('toggle');
        /*var url = window.location.href;
        var inputArray = url.split("/");
        var id = "#editPage" + inputArray[inputArray.length-1];
        //$(id).addClass('active_side');
        $('#editPage23').addClass('active_side');*/
    });     
</script>

@endsection
