<?php
if (isset($_SESSION['notification']['message'])) : ?>

    <div class="container">
        <div class=" alert alert-<?= $_SESSION['notification']['type'] ?>">
            <strong><?= $_SESSION['notification']['message'] ?></strong>
            <span class="closebtn float-md-end "  id="close-notification" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
    </div>

    <?php $_SESSION['notification'] = []; ?>

    <script>
        document.getElementById("close-notification").addEventListener("click", function() {
            this.parentElement.style.display = 'none';
        });

        setTimeout(function() {
            document.getElementById("close-notification").click();
        }, 2000); // 3 seconds in milliseconds
    </script>

<?php endif;
