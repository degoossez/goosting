<!-- Sidebar -->
<nav id="sidebar">
    <ul class="list-unstyled components">
        <li class="active">
            <a href="#accountSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle-sidebar">
                <i class="fas fa-account"></i>
                Account
            </a>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle-sidebar" onclick="loadPagesList();">
                <i class="fas fa-copy"></i>
                My Pages
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                @if( ! empty($userpageslist))
                    {!! $userpageslist !!}
                @endif
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fas fa-briefcase"></i>
                About
            </a>
        </li>
    </ul>
</nav>

<script>
    $(document).ready(function () { 
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        }); 
    });
    function loadPagesList(){
        $("#pageSubmenu").load("{{ route('loadPagesList') }}", function() {
            //No callback function needed
        });
    }
    $( document ).ready(function() {
        loadPagesList();
    });
</script>