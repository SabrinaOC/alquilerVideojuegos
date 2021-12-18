
<!-- Nav -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Juegos <button class="btn"><i class="fa fa-gamepad" style="color: white; margin-left: -20px"></i></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-3">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Todos</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="alquilados.php">Alquilados</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="noAlquilados.php">Disponibles</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="misalquilados.php">Mis alquilados</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="update.jsp"></a>
                  </li>
                  
                </ul>
              </div>
                <div class="ms-auto d-flex">
                    <!--Dropdown para CRUD -->
                    <?php 
                        if(isset($_SESSION['logueado']) && $_SESSION['logueado'] && $_SESSION['admin']){
                            ?>
                            <li class="nav-item dropdown" style="margin-right: 26px; margin-top: -15px">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="fa fa-align-justify" style="color: white;"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <li><a class="dropdown-item" href="formNuevoJuego.php">Añadir juego</a></li>
                                  <li><a class="dropdown-item" href="modificarJuegosLista.php">Modificar juego</a></li>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="eliminarJuegosLista.php">Eliminar juego</a></li>
                                </ul>
                            </li>
                    
                    <?php
                        }
                    ?>
                    
                    
                    <!-- Opción para desbloquear usuarios admin -->
                    <li class="nav-item" style="margin-top: -12px; margin-right: -15px">
                        <?php
                        //echo var_dump($_SESSION['admin']);
                        //dependiendo de si está logueado o no mostramos opción de iniciar sesión o cerrar sesión
                        if(isset($_SESSION['logueado']) && $_SESSION['logueado'] && $_SESSION['admin']){
                            echo '<a class="nav-link" href="desbloquearUsuarios.php"><i class="fa fa-lock fa" style="color: white;"></i></a>';

                           //echo '<a class="nav-link" href="desbloquearUsuarios.php"><i class="fa fa-user-lock fa-2x" style="color: white; margin-left: -20px; margin-top: -15px;"></i></a>';
                        } 
                        ?>

                    </li>

                    <!--Iniciar sesión -->
                    <li class="nav-item" style="margin-top: -12px">
                        <?php
                        //dependiendo de si está logueado o no mostramos opción de iniciar sesión o cerrar sesión
                        if(isset($_SESSION['logueado']) && $_SESSION['logueado']){
                            echo '<a class="nav-link" href="logout.php"><i class="fa fa-sign-out" style="color: white;"></i></a>';
                        } else {
                            echo '<a class="nav-link" href="login.php"><i class="fa fa-user" style="color: white;"></i></a>';
                        }
                        ?>

                    </li> 
                    
                    
                </div>
            </div>
          </nav>