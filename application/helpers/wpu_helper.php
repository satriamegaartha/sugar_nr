<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('user_logged')) {
        redirect('auth');
    }
}
function is_logged_in_front()
{
    $ci = get_instance();
    if (!$ci->session->userdata('user_logged')) {
        redirect('front/login');
    }
}
