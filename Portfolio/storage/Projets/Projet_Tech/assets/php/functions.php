<?php

include_once __DIR__.DIRECTORY_SEPARATOR.'config/app.php';

session_start();

function nav_li(string $script, string $texte, string $li_classe = 'nav-item'): string
{
    $classe = ($_SERVER['SCRIPT_NAME'] == $script) ? 'active' : '';

    return <<<EOH
        <li class="$li_classe">
            <a class="nav-link $classe" href="$script">$texte</a>
        </li>
    EOH;
}

function alert(?string $message, ?string $type = 'success'): ?string
{
    if ($message === null) {
        return null;
    }

    return <<<EOHTML
    <div class="alert alert-{$type} mt-4">
        $message
    </div>
    EOHTML;
}

function is_connected(): bool
{
    return isset($_SESSION['connexion']) && $_SESSION['connexion'] == 1;
}

function cut(string $text, int $nbchars): string {
    if(strlen($text)<=$nbchars){
       return $text;
    }

    return substr($text, 0, $nbchars).'...';
}