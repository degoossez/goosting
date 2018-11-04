
@extends('dashboard.dashboard')

@section('content')

<!-- include summernote css/js , not in the includes layout because it's very specific -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

<div class="wrapper">
    @include('dashboard.sidebar')
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
                        <textarea name="summernoteTitle" id="summernoteTitle" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            {!! $pageData->title !!}
                        </textarea>
                        <h5 id="maxContentPostTitle" style="text-align:right">50</h5>
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
    function loadPage(pageId){
        $('#editPageForm').load('{{URL::to("/dashboard/editpage/")}}/'+pageId + "/false", function(){
            var url = pageId + "/false";
            history.pushState({},'',url);
        });
    }

    //Limit summernote field to xx amount of characters
    function registerSummernote(element, placeholdertext, max, postMax,callbackMax) {
        $(element).summernote({
            width: w,
            toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']]
            ],
            placeholder: 'placeholdertext',
            callbacks: {
                onKeydown: function (e) { 
                        var t = e.currentTarget.innerText; 
                        if (t.trim().length >= max) {
                            //delete keys, arrow keys, copy, cut
                            if (e.keyCode != 8 && !(e.keyCode >=37 && e.keyCode <=40) && e.keyCode != 46 && !(e.keyCode == 88 && e.ctrlKey) && !(e.keyCode == 67 && e.ctrlKey))
                            e.preventDefault(); 
                        } 
                    },
                    onKeyup: function (e) {
                        var t = e.currentTarget.innerText;
                        $(postMax).text(max - t.trim().length);
                    },
                    onPaste: function (e) {
                        var t = e.currentTarget.innerText;
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        var maxPaste = bufferText.length;
                        if(t.length + bufferText.length > max){
                            maxPaste = max - t.length;
                        }
                        if(maxPaste > 0){
                            document.execCommand('insertText', false, bufferText.substring(0, maxPaste));
                        }
                        $(postMax).text(max - t.length);
                    }
            }
        });
    }   
    
    $(document).ready(function () {
        registerSummernote('#summernoteTitle', 'Leave a comment', 50, '#maxContentPostTitle',function(max) {
            $('#maxContentPostTitle').text(max)
        });

        registerSummernote('#summernoteSummary', 'Leave a comment', 100, '#maxContentPostSummary',function(max) {
            $('#maxContentPostSummary').text(max)
        });
        
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
