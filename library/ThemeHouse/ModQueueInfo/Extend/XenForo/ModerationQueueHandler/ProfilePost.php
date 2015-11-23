<?php

class ThemeHouse_ModQueueInfo_Extend_XenForo_ModerationQueueHandler_ProfilePost extends XFCP_ThemeHouse_ModQueueInfo_Extend_XenForo_ModerationQueueHandler_ProfilePost
{

    public function getVisibleModerationQueueEntriesForUser(array $contentIds, array $viewingUser)
    {
        $GLOBALS['XenForo_ModerationQueueHandler_ProfilePost'] = $this;

        $output = parent::getVisibleModerationQueueEntriesForUser($contentIds, $viewingUser);

        /* @var $profilePostModel XenForo_Model_ProfilePost */
		$profilePostModel = XenForo_Model::create('XenForo_Model_ProfilePost');

		/* @var $userModel XenForo_Model_User */
		$userModel = XenForo_Model::create('XenForo_Model_User');

        foreach ($output as $profilePostId => &$profilePostOutput) {
            $profilePost = $profilePostModel->getProfilePostById($profilePostId);

            if ($userModel->canViewIps($errorPhraseKey, $viewingUser)) {
                $ipInfo = XenForo_Model::create('XenForo_Model_Ip')->getContentIpInfo($profilePost);
                $profilePostOutput['ip_address'] = $ipInfo['contentIp'];
            }

            $profilePostOutput['user_register_date'] = $profilePost['register_date'];
            $profilePostOutput['user_message_count'] = $profilePost['message_count'];
        }

        return $output;
    } /* END getVisibleModerationQueueEntriesForUser */
}