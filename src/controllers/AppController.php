<?php

class AppController {
    protected function render(string $template = null) {
        $templatePath = ''.$template.'.html';
        $output = 'File not found';
        printf($templatePath);

        if (file_exists($templatePath)) {
            ob_start();
            include $templatePath;
            $output = ob_get_clean();;

        }
        print $output;
    }
}