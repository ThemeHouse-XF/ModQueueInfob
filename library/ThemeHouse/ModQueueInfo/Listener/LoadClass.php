<?php

class ThemeHouse_ModQueueInfo_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{
    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_ModQueueInfo' => array(
                'moderation_queue_handler' => array(
                    'XenForo_ModerationQueueHandler_Post',
                    'XenForo_ModerationQueueHandler_ProfilePost',
                    'XenForo_ModerationQueueHandler_Thread'
                ), /* END 'moderation_queue_handler' */
                'model' => array(
                    'XenForo_Model_Post',
                    'XenForo_Model_ProfilePost',
                    'XenForo_Model_Thread',
                ), /* END 'model' */
            ), /* END 'ThemeHouse_ModQueueInfo' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassModerationQueueHandler($class, array &$extend)
    {
        $loadClassModerationQueueHandler = new ThemeHouse_ModQueueInfo_Listener_LoadClass($class, $extend, 'moderation_queue_handler');
        $extend = $loadClassModerationQueueHandler->run();
    } /* END loadClassModerationQueueHandler */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_ModQueueInfo_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    } /* END loadClassModel */
}