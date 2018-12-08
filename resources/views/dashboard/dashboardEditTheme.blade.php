
@extends('dashboard.dashboard')

@section('content')

<!-- Include Choices CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@4.1.1/public/assets/styles/choices.min.css">
<!-- Include Choices JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/choices.js@4/public/assets/scripts/choices.min.js"></script>

<div class="wrapper">
    @include('dashboard.sidebar')
    <div class="container-fluid" id="dashboardContent">        
        <form action="{{route('saveTheme')}}" method="POST" id="editThemeForm">
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
                        <h2>Edit theme</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="card-header-custom">
                        Background
                    </div>
                    <div class="card-group card-group-100">                        
                        <div class="card bg-light card-25">
                            <button type="button" class="btn btn-outline-info btn-lg" onclick="backgroundChoice('one')">One color</button>
                            <div class="card-body collapse" id="background-one-color">
                                <p class="card-text">Select one color, this will be the background of your page.</p>
                                <input name="themeBackgroundColor" id="themeBackgroundColor" type="color" class="form-control" value="#e66465" aria-label="Default" aria-describedby="inputGroup-sizing-default" >                             
                            </div>
                        </div>
                        <div class="card bg-light card-25">
                            <button type="button" class="btn btn-outline-info btn-lg" onclick="backgroundChoice('linear')">Linear gradiant</button>
                            <div class="card-body collapse" id="background-ver-grad">                                
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                                <select name="linGradiantBack" id="linGradiantBack" class="js-example-basic-multiple form-control" multiple="multiple" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    <option value="green">Green</option>
                                    <option value="red">Red</option>
                                    <option value="blue">Blue</option>
                                    <option value="black">Black</option>
                                </select>     
                            </div>
                        </div>
                        <div class="card bg-light card-25">
                            <button type="button" class="btn btn-outline-info btn-lg" onclick="backgroundChoice('horizontal')">Horizontal gradiant</button>
                            <div class="card-body collapse" id="background-hor-grad">
                                <p class="card-text">Select multiple colors to create a horizontal gradiant.</p>
                                <select name="radGradiantBack" id="radGradiantBack" class="js-example-basic-multiple form-control" multiple="multiple" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    <option value="green">Green</option>
                                    <option value="red">Red</option>
                                    <option value="blue">Blue</option>
                                    <option value="black">Black</option>
                                </select>   
                            </div>
                        </div>
                        <div class="card bg-light card-25">
                            <button type="button" class="btn btn-outline-info btn-lg" onclick="backgroundChoice('image')">Image</button>
                            <div class="card-body collapse" id="background-image-selection">
                                <p class="card-text">Select an image to display as background.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-info" name="submitButton" value="update">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    
    var h = window.innerHeight/2;
    var w = window.innerWidth * 2/3; //set width of the title & summary box
    
    $('#background-one-color').collapse("show");

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
    $(document).ready(function() {            
        const linGradiantBack = new Choices('#linGradiantBack', { removeItemButton: true });
        const radGradiantBack = new Choices('#radGradiantBack', { removeItemButton: true });
        
        $('#themesSubmenu').collapse('toggle');
        
    });
    function setBackgroundOption(selectedValue){
        //TODO: make the correct layout appear in id="background-row" (get layout from php backened)
    }
    function backgroundChoice(selection){
        if(selection=="one"){                   
            $('#background-ver-grad').collapse("hide");
            $('#background-hor-grad').collapse("hide");
            $('#background-image-selection').collapse("hide");
            $('#background-one-color').collapse("show");  
        }
        else if(selection=="linear"){            
            $('#background-one-color').collapse("hide"); 
            $('#background-hor-grad').collapse("hide");
            $('#background-image-selection').collapse("hide");
            $('#background-ver-grad').collapse("show");   
        }
        else if(selection=="horizontal"){
            $('#background-one-color').collapse("hide");
            $('#background-ver-grad').collapse("hide");                      
            $('#background-image-selection').collapse("hide");
            $('#background-hor-grad').collapse("show");  
        }
        else if(selection=="image"){        
            $('#background-one-color').collapse("hide");
            $('#background-ver-grad').collapse("hide");
            $('#background-hor-grad').collapse("hide");    
            $('#background-image-selection').collapse("show");        
        }
    }
    
</script>

@endsection
