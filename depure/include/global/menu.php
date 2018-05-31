

<?php if (($session->logged_in) or $session->isMember){ ?>

<li><a href="/dashboard.php" class="mb_parent first_el">CAE - Panel</a>
    <ul>
        <li><a>Perfil</a>
            <ul>
                <li><a href="/info.html">Ver Perfil</a></li>
                <li><a href="#">Modificar Datos</a></li>
            </ul>
        </li>    
        <li><a>Compañeros</a>
            <ul>
                <li><a href="#">Todos</a></li>
                <li><a href="#">Mi Grupo</a></li>
            </ul>
        </li>
        <li><a href="#">Panel Completo</a></li>
    </ul>
</li>

<?php  } elseif (($session->logged_in) or $session->isAdmin) {  ?>

<li><a href="/dashboard.php" class="mb_parent first_el">CAE - Panel</a>
    <ul>
        <li><a>Perfil</a>
            <ul>
                <li><a href="/info.html">Ver Perfil</a></li>
                <li><a href="#">Modificar Datos</a></li>
            </ul>
        </li>    
        <li><a>Compañeros</a>
            <ul>
                <li><a href="#">Todos</a></li>
                <li><a href="#">Mi Grupo</a></li>
            </ul>
        </li>
        <li><a href="#">Panel Completo</a></li>
    </ul>
</li>


<?php  } else {  } ?>



