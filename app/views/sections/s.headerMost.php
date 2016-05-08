<!--Header-->       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?action=inicio">RPluer Relojero</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
            	<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	<?php if(isset($user)){echo '<i class="fa fa-exclamation"></i>';}?><i class="fa fa-bell fa-fw"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> ODT 156788 Fuera de tiempo
                                </div>
                            </a>
                        </li>                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Ver todas las alertas...</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       <!--<li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>-->
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> <?php echo $user->USER_LOGIN;?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="index.php?action=salir"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->            
            <!-- /.navbar-collapse -->
</nav>
<!--Barra lateral-->
<div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                	<ul class="nav" id="side-menu">
                	<li>
                            <a href="#"><i class="fa fa-fw fa-dashboard"></i> Inicio<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
	                                <li>
	                                    <a href="index.php?action=inicio" style="padding-left: 37px;">Relojerìa</a>
	                                </li>
	                                <li>
	                                    <a href="index.php?action=joyeria" style="padding-left: 37px;">Joyerìa</a>
	                                </li>
	                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    <!--<li class="active">
                        <a href="index.php?action=inicio"><i class="fa fa-fw fa-dashboard"></i> Mostrador</a>
                    </li>-->
                    <li>
                        <a href="index.php?action=odtm"><i class="fa fa-fw fa-bar-chart-o"></i> ODTs</a>
                    </li>                    
                    </ul>
                </ul>
         </div>



<!--Termina Header-->