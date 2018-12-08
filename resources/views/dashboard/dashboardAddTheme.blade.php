<!-- Include Choices CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@4.1.1/public/assets/styles/choices.min.css">
<!-- Include Choices JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/choices.js@4/public/assets/scripts/choices.min.js"></script>

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
                <h2>Create a new theme</h2>
            </div>
        </div>
        <div class="row">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Theme title</span>
                </div>
                <textarea name="summernoteTitle" id="summernoteTitle" type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="form-check input-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" checked="checked" name="radio">
                            <a>One color background</a>
                        </div>
                    </div>
                    <input name="themeBackgroundColor" id="themeBackgroundColor" type="color" class="form-control" value="#e66465" aria-label="Default" aria-describedby="inputGroup-sizing-default" >                             
                </div>  
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" checked="checked" name="radio">
                            <a>Linaer gradiant background</a>
                        </div>
                    </div>
                    <select name="linGradiantBack" id="linGradiantBack" class="js-example-basic-multiple form-control" multiple="multiple" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        <option value="green">Green</option>
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="black">Black</option>
                    </select>                                 
                </div>                              
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" checked="checked" name="radio">
                            <a>Radial gradiant background</a>
                        </div>
                    </div>
                    <select name="radGradiantBack" id="radGradiantBack" class="js-example-basic-multiple form-control" multiple="multiple" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        <option value="green">Green</option>
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="black">Black</option>
                    </select>                                 
                </div>  
            </div>
        </div>
    </div>    
    <br>
    <button type="submit" class="btn btn-info">Submit</button>
</form>

<script>
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
        var linGradiantBack = new Choices('#linGradiantBack', { removeItemButton: true });
        var radGradiantBack = new Choices('#radGradiantBack', { removeItemButton: true });
        
        $('#themesSubmenu').collapse('toggle');       
    });
</script>

