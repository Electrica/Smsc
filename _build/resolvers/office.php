<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;
    /** @var array $options */

    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:


            $file = MODX_CORE_PATH . 'components/smsc/office/smsc.class.php';
            $dest = MODX_CORE_PATH . 'components/office/model/sms/';
            if(is_dir($dest)){
                if(copy($file, $dest.'smsc.class.php')){
                    $modx->log(xPDO::LOG_LEVEL_INFO, '[Smsc] Класс перенесен');
                }else{
                    $modx->log(xPDO::LOG_LEVEL_INFO, '[Smsc] Класс не перенесен');
                }
            }else{
                $modx->log(xPDO::LOG_LEVEL_INFO, '[Smsc] Класс не перенесен. Нет директории, возможно не установлен компонент Office');
            }

            break;

        case xPDOTransport::ACTION_UNINSTALL:

            $file = MODX_CORE_PATH . 'components/office/model/sms/smsc.class.php';

            if(is_file($file)){
                unlink($file);
                $modx->log(xPDO::LOG_LEVEL_INFO, '[Smsc] Класс был удален');
            }else{
                $modx->log(xPDO::LOG_LEVEL_INFO, '[Smsc] Класса нет в директории');
            }

            break;
    }
}

return true;