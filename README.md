README
======

ShellStyle
-----------------

ShellStyle is a simple php class that allows you to get wrapped Unix/Linux colored output with ANSI escape codes:

Usage
-----------------
Usage of ShellStyle is quite simple:

    use Gobwas\ShellStyle\ShellStyle;

    // First way to define style
    $green = new ShellStyle();
    $green
        ->addStyle(ShellStyle::FOREGROUND_GREEN)
        ->addStyle(ShellStyle::STYLE_BOLD);

    // Another way to define style
    $yellow = new ShellStyle(array(ShellStyle::FOREGROUND_YELLOW));

    echo $green->parse("Hello");
    echo $yellow->parse("World!");

