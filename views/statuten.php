<?php include_once 'layouts/main/header.php'?>
<div id="about" class="columns">
<div class="column is-8 is-offset-2">
    <div class="tile is-vertical is-ancestor ">
        <div class="subnav tabs is-centered">
            <ul>
                <li>
                    <a href="/about">Contact</a>
                </li>
                <li>
                    <a href="/bestuur">Bestuur</a>
                </li>
                <li class="is-active">
                    <a href="/statuten">Statuten</a>
                </li>
                <li class="is-disabled">
                    <a>Geschiedenis</a>
                </li>
            </ul>
        </div>
    </div>
    <div class= "tile is_vertical is-child">
        <?php
             $file = readfile('views/statutenfile.html');
        ?>
    </div>
</div>
<?php include_once 'layouts/main/footer.php' ?>