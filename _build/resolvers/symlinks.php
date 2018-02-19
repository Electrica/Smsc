<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/Smsc/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/smsc')) {
            $cache->deleteTree(
                $dev . 'assets/components/smsc/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/smsc/', $dev . 'assets/components/smsc');
        }
        if (!is_link($dev . 'core/components/smsc')) {
            $cache->deleteTree(
                $dev . 'core/components/smsc/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/smsc/', $dev . 'core/components/smsc');
        }
    }
}

return true;