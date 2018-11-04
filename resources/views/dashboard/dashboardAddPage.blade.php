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
                <textarea name="summernoteTitle" id="summernoteTitle" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                </textarea>
                <h5 id="maxContentPostTitle" style="text-align:right">50</h5>
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
    });
</script>

