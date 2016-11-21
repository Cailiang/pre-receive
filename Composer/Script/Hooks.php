<?php

namespace PreReceive\Composer\Script;

use Composer\Script\Event;

define('ROOT_DIR', __DIR__ . '/../../../../../');

class Hooks
{
    public static function preHooks(Event $event)
    {
        $io = $event->getIO();
        $gitHook = ROOT_DIR.'.git/hooks/pre-receive';

        if (file_exists($gitHook)) {
            unlink($gitHook);
            $io->write('<info>Pre-receive removed!</info>');
        }

        return true;
    }

    public static function postHooks(Event $event)
    {
        $io = $event->getIO();
        $gitHook = ROOT_DIR.'.git/hooks/pre-receive';
        $docHook = ROOT_DIR.'vendor/juizmill/pre-receive/hooks/pre-receive';

        copy($docHook, $gitHook);
        chmod($gitHook, 0777);

        $io->write('<info>Pre-receive created!</info>');

        return true;
    }
}
