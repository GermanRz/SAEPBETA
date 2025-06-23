<style>
  aside.main-sidebar, 
aside.main-sidebar a, 
aside.main-sidebar .brand-text {
  color: #fff !important;
}

.nav-link {
  display: flex;
  align-items: center;
}

.nav-link img {
  width: 24px;         /* Tamaño fijo */
  height: 24px;
  margin-right: 15px;  /* Espacio con el texto */
  flex-shrink: 0;      /* Impide que el ícono se reduzca si falta espacio */
}

.nav-link p {
  margin: 0; /* Elimina márgenes por defecto */
  font-size: 18px; /* Tamaño de fuente */
}


</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #39A900;">

<!-- Brand Logo -->
<a href="inicio" class="brand-link" style="display: flex; align-items: center; gap: 20px;">
  <img src="vistas/img/logoSena.png"
       alt="Logo Sena"
       style="width: 60px; height: 60px; object-fit: contain; object-position: center; background-color: transparent;">
  <span class="brand-text font-weight-light" style="color: #fff; font-size: 35px;">SAEP</span>
</a>


    <!-- Sidebar -->
    <div class="sidebar">
      



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
            <a href="inicio" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>  


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Configuración
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">


              <li class="nav-item">
                <a href="programas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Programas</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="sedes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sedes</p>
                </a>
              </li> 
              
              <li class="nav-item">
                <a href="fichas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fichas</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="roles" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>

              
              <li class="nav-item">
                <a href="permisos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permisos</p>
                </a>
              </li> 

              <li class="nav-item">
                <a href="modulos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Módulos</p>
                </a>
              </li>  
              
              <li class="nav-item">
                <a href="modalidades" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modalidades</p>
                </a>
              </li>               
              
              






            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
                <a href="verAprendices" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver aprendices</p>
                </a>
            </li> 

            <li class="nav-item">
              <a href="verEvaluadores" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ver evaluadores</p>
              </a>
            </li>   
              
            <li class="nav-item">
                <a href="verCoevaluadores" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ver coevaluadores</p>
                </a>
            </li> 

            <li class="nav-item">
              <a href="verAuxiliares" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ver auxiliares</p>
              </a>
            </li>    



            </ul>


          <li class="nav-item">
            <a href="empresas" class="nav-link">
              <i class="nav-icon fas fa-industry"></i>
              <p>
                Empresas
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="asignarinstructor" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Asignar instructor
              </p>
            </a>
          </li>   
          
          <li class="nav-item">
            <a href="seguimiento" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Seguimiento
              </p>
            </a>
          </li>         
      
          
          <li class="nav-item">
            <a href="editarperfil" class="nav-link">
              <img src="vistas/img/ico-perfil.png" alt="Icono Perfil">
              <p>Mi Perfil</p>
            </a>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>