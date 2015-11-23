<?php

/**
 *
 * @see XenForo_Model_Thread
 */
class ThemeHouse_ModQueueInfo_Extend_XenForo_Model_Thread extends XFCP_ThemeHouse_ModQueueInfo_Extend_XenForo_Model_Thread
{

    protected static $_moderationQueueThreadsCache = array();

    /**
     *
     * @see XenForo_Model_Thread::getThreadById()
     */
    public function getThreadById($threadId, array $fetchOptions = array())
    {
        if (isset($GLOBALS['XenForo_ModerationQueueHandler_Thread'])) {
            if (isset(self::$_moderationQueueThreadsCache[$threadId])) {
                return self::$_moderationQueueThreadsCache[$threadId];
            }

            $this->addFetchOptionJoin($fetchOptions, self::FETCH_FIRSTPOST);
        }

        return parent::getThreadById($threadId, $fetchOptions);
    } /* END getThreadById */

    /**
     *
     * @see XenForo_Model_Thread::getThreadsByIds()
     */
    public function getThreadsByIds(array $threadIds, array $fetchOptions = array())
    {
        if (isset($GLOBALS['XenForo_ModerationQueueHandler_Thread'])) {
            $this->addFetchOptionJoin($fetchOptions, self::FETCH_USER);
        }

        $threads = parent::getThreadsByIds($threadIds, $fetchOptions);

        if (isset($GLOBALS['XenForo_ModerationQueueHandler_Thread'])) {
            foreach ($threads as $threadId => $thread) {
                self::$_moderationQueueThreadsCache[$threadId] = $thread;
            }
        }

        return $threads;
    } /* END getThreadsByIds */

    /**
     *
     * @see XenForo_Model_Thread::prepareThreadFetchOptions()
     */
    public function prepareThreadFetchOptions(array $fetchOptions)
    {
        $threadFetchOptions = parent::prepareThreadFetchOptions($fetchOptions);

        $selectFields = $threadFetchOptions['selectFields'];
        $joinTables = $threadFetchOptions['joinTables'];
        $orderClause = $threadFetchOptions['orderClause'];

        if (!empty($fetchOptions['join'])) {
            if ($fetchOptions['join'] & self::FETCH_FIRSTPOST) {
                if (isset($GLOBALS['XenForo_ModerationQueueHandler_Thread'])) {
                    $selectFields .= ',
					post.ip_id, ip.ip';
                    $joinTables .= '
					LEFT JOIN xf_ip AS ip ON
						(ip.ip_id = post.ip_id)';
                }
            }
        }

        return array(
            'selectFields' => $selectFields,
            'joinTables' => $joinTables,
            'orderClause' => $orderClause
        );
    } /* END prepareThreadFetchOptions */
}