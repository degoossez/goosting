<form action="{{route('summernotePersist')}}" method="POST">
    {{ csrf_field() }}
    <div class="container">
        <div class="row">
            <div class="col">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
            <div class="col-11">
                <h2>Create a new page</h2>
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Page title</span>
                </div>
                <input name="pageTitle" id="pageTitle" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
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
    var w = window.innerWidth * 2/3; //set width of the title & summary box
    $('#summernote').summernote({
        height: h,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null             // set maximum height of editor
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

    });
</script>

