<?php

namespace view;


class HTMLView{
    private $charset;

    public function __construct($charset){
        $this->charset = $charset;
    }
    public function getHTML($title, \view\NavigationView $nav, $body)
    {
        $link = $nav->getGameLink();
        echo "<!DOCTYPE html>
      <html>
        <head>
          <meta charset=\"" . $this->charset . "\">
          <title>$title</title>
          <link rel='stylesheet' href='../tick-tack-toe/style/style.css'>
        </head>
        <body>
          <h2>$title</h2>
          $body
          $link
        </body>
      </html>";
    }
}