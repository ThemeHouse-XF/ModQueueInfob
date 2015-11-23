<?php

/**
 *
 * @see XenForo_Model_ProfilePost
 */
class ThemeHouse_ModQueueInfo_Extend_XenForo_Model_ProfilePost extends XFCP_ThemeHouse_ModQueueInfo_Extend_XenForo_Model_ProfilePost
{

    protected static $_moderationQueueProfilePostsCache = array();

    /**
     *
     * @see XenForo_Model_ProfilePost::getProfilePostById()
     */
    public function getProfilePostById($profilePostId, array $fetchOptions = array())
    {
        if (isset($GLOBALS['XenForo_ModerationQueueHandler_ProfilePost'])) {
            if (isset(self::$_moderationQueueProfilePostsCache[$profilePostId])) {
                return self::$_moderationQueueProfilePostsCache[$profilePostId];
            }
        }

        return parent::getProfilePostById($profilePostId, $fetchOptions);
    } /* END getProfilePostById */

    /**
     *
     * @see XenForo_Model_ProfilePost::getProfilePostsByIds()
     */
    public function getProfilePostsByIds(array $profilePostIds, array $fetchOptions = array())
    {
        if (isset($GLOBALS['XenForo_ModerationQueueHandler_ProfilePost'])) {
            $this->addFetchOptionJoin($fetchOptions, self::FETCH_USER_POSTER);
        }

        $profilePosts = parent::getProfilePostsByIds($profilePostIds, $fetchOptions);

        if (isset($GLOBALS['XenForo_ModerationQueueHandler_ProfilePost'])) {
            foreach ($profilePosts as $profilePostId => $profilePost) {
                self::$_moderationQueueProfilePostsCache[$profilePostId] = $profilePost;
            }
        }

        return $profilePosts;
    } /* END getProfilePostsByIds */

    /**
     *
     * @see XenForo_Model_ProfilePost::prepareProfilePostFetchOptions()
     */
    public function prepareProfilePostFetchOptions(array $fetchOptions)
    {
        $profilePostFetchOptions = parent::prepareProfilePostFetchOptions($fetchOptions);

        $selectFields = $profilePostFetchOptions['selectFields'];
        $joinTables = $profilePostFetchOptions['joinTables'];

        if (isset($GLOBALS['XenForo_ModerationQueueHandler_ProfilePost'])) {
            $selectFields .= ',
					ip.ip';
            $joinTables .= '
					LEFT JOIN xf_ip AS ip ON
						(ip.ip_id = profile_post.ip_id)';
        }

        return array(
            'selectFields' => $selectFields,
            'joinTables' => $joinTables
        );
    } /* END prepareProfilePostFetchOptions */
}