<nav id="sidebar">
    <div id="main-menu">
        <ul class="sidebar-nav">
            <li class="<?= Request::is('/') ? 'current' : '' ?>">
                <a href="/"><i class="fa fa-dashboard"></i><span class="sidebar-text">Dashboard</span></a>
            </li>
            <li class="<?= Request::is('*licenses*') ? 'current' : '' ?>">
                <a href="/licenses"><i class="fa fa-barcode"></i><span class="sidebar-text">Licencias</span></a>
            </li>

            <!--<li class="<?= Request::is('*estudiantes*') ? 'current' : '' ?>">
                <a href="/estudiantes"><i class="fa fa-user"></i><span class="sidebar-text">Estudiantes</span></a>
            </li>


            <li class="<?= Request::is('*prestamos*') ? 'current' : '' ?>">
                <a href="/prestamos"><i class="fa fa-edit"></i><span class="sidebar-text">Prestamos</span></a>
            </li>



            <li class="<?= Request::is('user*') ? 'current' : '' ?>">
                <a href="/user"><i class="glyph-icon flaticon-account"></i><span class="sidebar-text">Usuarios</span></a>
            </li>
            <li class="<?= Request::is('customer*') ? 'current' : '' ?>">
                <a href="/customer"><i class="glyph-icon flaticon-ui-elements2"></i><span class="sidebar-text">Clientes</span></a>
            </li>
            <li class="<?= Request::is('property*') ? 'current' : '' ?>">
                <a href="/property"><i class="fa fa-home"></i><span class="sidebar-text">Inmuebles</span></a>
            </li> -->
            <br>
        </ul>
    </div>
</nav>