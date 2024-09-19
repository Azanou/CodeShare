<?php

if(isset($errors)&&count($errors) != 0){       
                        echo '<br>'.'<div class= "alert alert-danger col-md-5" style="margin: auto;">
                        <span class="closebtn float-md-end " onclick="this.parentElement.style.display=\'none\';">&times;</span>';
                        foreach ($errors as $error){
                            echo $error.'<br style="color:red;">';
                        }
                        echo '</div>';
            }