<?php

function error($msg)
{
    return $_SESSION['errors'][$msg];
}

function message($message)
{
    return $_SESSION[$message];
}