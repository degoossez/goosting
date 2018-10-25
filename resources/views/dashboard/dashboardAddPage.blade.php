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
    <textarea name="summernoteInput" id="summernote">
            @if( ! empty($data_id))
                {!! $data_id !!}
            @endif
            @if( ! empty($summernote->content))
                {!! $summernote->content !!}
            @endif
    </textarea>
    <br>
    <button type="submit">Submit</button>
</form>

<script>
    var h = window.innerHeight/2;
    $('#summernote').summernote({
        height: h,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote
    });
</script>

