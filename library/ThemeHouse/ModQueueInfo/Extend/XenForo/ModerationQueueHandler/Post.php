<?php

class ThemeHouse_ModQueueInfo_Extend_XenForo_ModerationQueueHandler_Post extends XFCP_ThemeHouse_ModQueueInfo_Extend_XenForo_ModerationQueueHandler_Post
{

    public function getVisibleModerationQueueEntriesForUser(array $contentIds, array $viewingUser)
    {
        $GLOBALS['XenForo_ModerationQueueHandler_Post'] = $this;

        $output = parent::getVisibleModerationQueueEntriesForUser($contentIds, $viewingUser);

        /* @var $postModel XenForo_Model_Post */
		$postModel = XenForo_Model::create('XenForo_Model_Post');

		/* @var $userModel XenForo_Model_User */
		$userModel = XenForo_Model::create('XenForo_Model_User');

        foreach ($output as $postId => &$postOutput) {
            $post = $postModel->getPostById($postId);

            if ($userModel->canViewIps($errorPhraseKey, $viewingUser)) {
                $ipInfo = XenForo_Model::create('XenForo_Model_Ip')->getContentIpInfo($post);
                $postOutput['ip_address'] = $ipInfo['contentIp'];
            }

            $postOutput['user_register_date'] = $post['register_date'];
            $postOutput['user_message_count'] = $post['message_count'];
        }

        return $output;
    } /* END getVisibleModerationQueueEntriesForUser */
}