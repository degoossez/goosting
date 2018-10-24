<!-- Sidebar -->
<nav id="sidebar">
    <div align="right">
        <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
        </button>
    </div>
    <ul class="list-unstyled components">
        <li class="active">
            <a href="#accountSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-account"></i>
                Account
            </a>
            <ul class="collapse list-unstyled" id="accountSubmenu">
                <li>
                    <a href="#">account 1</a>
                </li>
                <li>
                    <a href="#">account 2</a>
                </li>
                <li>
                    <a href="#">account 3</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="fas fa-copy"></i>
                My Pages
            </a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#" onclick="loadAddPage();">Add page</a>
                </li>
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
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
</script>