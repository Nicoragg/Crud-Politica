<header>
    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>
        <div class="spacer">

        </div>
    <nav>
        <?php if (isset($_SESSION['admin'])): ?>
            <a href="?page=home"><button>Administrador</button></a>
        <?php else: ?>
            <a href="?page=login"><button>Administrador</button></a>
        <?php endif; ?>
    </nav>
</header>
<hr>