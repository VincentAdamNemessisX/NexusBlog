<?php
function encodeAllErrorContent($content)
{
    $content = str_replace("&", "&amp;", $content);
    $content = str_replace("<", "&lt;", $content);
    $content = str_replace(">", "&gt;", $content);
    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);
    $content = str_replace("\r", "<br>", $content);
    return $content;
}