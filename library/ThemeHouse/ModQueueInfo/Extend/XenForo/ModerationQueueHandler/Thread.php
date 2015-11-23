<?php

class ThemeHouse_ModQueueInfo_Extend_XenForo_ModerationQueueHandler_Thread extends XFCP_ThemeHouse_ModQueueInfo_Extend_XenForo_ModerationQueueHandler_Thread
{

    public function getVisibleModerationQueueEntriesForUser(array $contentIds, array $viewingUser)
    {
        $GLOBALS['XenForo_ModerationQueueHandler_Thread'] = $this;

        $output = parent::getVisibleModerationQueueEntriesForUser($contentIds, $viewingUser);

        /* @var $threadModel XenForo_Model_Thread */
		$threadModel = XenForo_Model::create('XenForo_Model_Thread');

		/* @var $userModel XenForo_Model_User */
		$userModel = XenForo_Model::create('XenForo_Model_User');

        foreach ($output as $threadId => &$threadOutput) {
            $thread = $threadModel->getThreadById($threadId);

            if ($userModel->canViewIps($errorPhraseKey, $viewingUser)) {
                $ipInfo = XenForo_Model::create('XenForo_Model_Ip')->getContentIpInfo($thread);
                $threadOutput['ip_address'] = $ipInfo['contentIp'];
            }

            $threadOutput['user_register_date'] = $thread['register_date'];
            $threadOutput['user_message_count'] = $thread['message_count'];
        }

        return $output;
    } /* END getVisibleModerationQueueEntriesForUser */
}