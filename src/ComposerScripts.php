<?php

namespace UnReact;

class ComposerScripts
{
    public static function updateSubmodule()
    {
        $commands = [
            'git submodule init',
            'git submodule update --remote'
        ];

        foreach ($commands as $command) {
            $output = null;
            $returnVar = null;
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                echo "Erreur lors de l'exécution de la commande: $command\n";
                exit($returnVar);
            }

            echo implode("\n", $output) . "\n";
        }
    }
}