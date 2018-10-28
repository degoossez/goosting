<div class="container">
    <div class="row">
        <div class="col">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
        </div>
    </div>

</div>


<form action="{{route('summernotePersist')}}" method="POST">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <h2>Create a new page</h2>
        </div>
        <div class="row">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Page title</span>
                </div>
                <input name="pagetitle" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Summary</span>
                </div>
                <input name="summary" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
            </div>
        </div>
    </div>    
    <textarea name="summernoteInput" id="summernote">
            @if( ! empty($summernote->content))
                {!! $summernote->content !!}
            @endif
    </textarea>
    <!-- Select tags in multi select with https://select2.org/ -->
    
    <br>
    <button type="submit" class="btn btn-info">Submit</button>
</form>

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
</script>

