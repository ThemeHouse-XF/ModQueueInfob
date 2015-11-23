<?php

/**
 *
 * @see XenForo_Model_Post
 */
class ThemeHouse_ModQueueInfo_Extend_XenForo_Model_Post extends XFCP_ThemeHouse_ModQueueInfo_Extend_XenForo_Model_Post
{

    protected static $_moderationQueuePostsCache = array();

    /**
     *
     * @see XenForo_Model_Post::getPostById()
     */
    public function getPostById($postId, array $fetchOptions = array())
    {
        if (isset($GLOBALS['XenForo_ModerationQueueHandler_Post'])) {
            if (isset(self::$_moderationQueuePostsCache[$postId])) {
                return self::$_moderationQueuePostsCache[$postId];
            }
        }

        return parent::getPostById($postId, $fetchOptions);
    } /* END getPostById */

    /**
     *
     * @see XenForo_Model_Post::getPostsByIds()
     */
    public function getPostsByIds(array $postIds, array $fetchOptions = array())
    {
        if (isset($GLOBALS['XenForo_ModerationQueueHandler_Post'])) {
            $this->addFetchOptionJoin($fetchOptions, self::FETCH_USER);
        }

        $posts = parent::getPostsByIds($postIds, $fetchOptions);

        if (isset($GLOBALS['XenForo_ModerationQueueHandler_Post'])) {
            foreach ($posts as $postId => $post) {
                self::$_moderationQueuePostsCache[$postId] = $post;
            }
        }

        return $posts;
    } /* END getPostsByIds */

    /**
     *
     * @see XenForo_Model_Post::preparePostJoinOptions()
     */
    public function preparePostJoinOptions(array $fetchOptions)
    {
        $postJoinOptions = parent::preparePostJoinOptions($fetchOptions);

        $selectFields = $postJoinOptions['selectFields'];
        $joinTables = $postJoinOptions['joinTables'];

        if (isset($GLOBALS['XenForo_ModerationQueueHandler_Post'])) {
            $selectFields .= ',
					ip.ip';
				$joinTables .= '
					LEFT JOIN xf_ip AS ip ON
						(ip.ip_id = post.ip_id)';
        }

        return array(
            'selectFields' => $selectFields,
            'joinTables'   => $joinTables
        );
    } /* END preparePostJoinOptions */
}