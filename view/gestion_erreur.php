    <?php
    if (!empty($_SESSION['alert'])) {
        foreach ($_SESSION['alert'] as $alert) {
            echo "<div class='alert " . $alert['type'] . "' role='alert'>
                        " . $alert['message'] . "
                    </div>";
        }
        unset($_SESSION['alert']);
    }
    ?>