<?php
/**
 * Created by PhpStorm.
 * User: Adrian Dumitru
 * Date: 1/22/2018
 * Time: 11:04 PM
 */

use IB\Modules\Users\UserContext;

?>
<nav class="navbar navbar-expand-sm navbar-light bg-light">

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">User Forms</a>
			</li>

			<?php
			if(\IB\Modules\Users\UserContext::isAdmin()){
				?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="/admin/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/admin/">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/admin/new-form/">Create form</a>
                        <a class="dropdown-item" href="/admin/forms/">View form</a>
                        <a class="dropdown-item" href="/admin/submissions/">Submissions</a>
                    </div>
                </li>
                <?php
			}
			?>
		</ul>

		<?php
		if(\IB\Modules\Users\UserContext::isUser()){
			echo "<a class=\"btn btn-danger btn-sm\" href=\"/logout/\" role=\"button\">Log Out</a>";
		} else {
			echo "<a class=\"btn btn-primary btn-sm mr-2\" href=\"/login/\" role=\"button\">Login</a>";
			echo "<a class=\"btn btn-primary btn-sm\" href=\"/register/\" role=\"button\">Sign In</a>";
		}
		?>

<!--        <a class="btn btn-danger btn-sm" href="/logout/" role="button">Log Out</a>-->
	</div>
</nav>