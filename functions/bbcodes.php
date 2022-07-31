<?php

function showBBcodes($text)
{
    // BBcode array
    $find = array(
        '~\[center\](.*?)\[/center\]~s',
        '~\[b\](.*?)\[/b\]~s',
        '~\[i\](.*?)\[/i\]~s',
        '~\[u\](.*?)\[/u\]~s',
        '~\[size=(.*?)\](.*?)\[/size\]~s',
        '~\[url\](.*?)\[/url\]~s',
        '~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s',
        '~\[color=((?:[a-zA-Z]|#[a-fA-F0-9]{3,6})+)\](.*?)\[/color\]~s',
        '~\[youtube\](.*?)\[/youtube\]~s',
        '~\[tr\](.*?)\[/tr\]~s',
        '~\[spotify\](.*?)\[/spotify\]~s',
        '~\[spotify compact\](.*?)\[/spotify\]~s',
    );
    // HTML tags to replace BBcode
    $replace = array(
        '<center>$1</center>',
        '<b>$1</b>',
        '<i>$1</i>',
        '<u>$1</u>',
        '<span style="font-size:$1px;">$2</span>',
        '<a href="$1" target="_blank" style="text-decoration: none; color: white;">$1</a>',
        '<img src="$1" class="bb_code_img" />',
        '<span style="color:$1;">$2</span>',
        '<embed width="420" height="315" src="https://www.youtube.com/v/$1">',
        '<span id="transparent">$1</span>',
        '<iframe src="https://open.spotify.com/embed/$1" width="100%" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>',
        '<iframe src="https://open.spotify.com/embed/$1" width="100%" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>',
    );
    // Replacing the BBcodes with corresponding HTML tags
    return preg_replace($find, $replace, $text);
}
