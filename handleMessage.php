<?php
function handleMessage($Message, $location)
{
    echo '<script>
        var confirmLogout = confirm("' . $Message . '");
        if (confirmLogout) {
            window.location.href = "' . $location . '";
        } 
    </script>';
}
