<?php

class ThemeHouse_ModQueueInfo_Listener_FileHealthCheck
{

    public static function fileHealthCheck(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
    {
        $hashes = array_merge($hashes,
            array(
                'library/ThemeHouse/ModQueueInfo/Extend/XenForo/Model/Post.php' => '82e318f04c1ca5e46dfa2756ea7931bc',
                'library/ThemeHouse/ModQueueInfo/Extend/XenForo/Model/ProfilePost.php' => '8fa8c28c6e2f6dd28dd8a44e4b667688',
                'library/ThemeHouse/ModQueueInfo/Extend/XenForo/Model/Thread.php' => 'aade1432486f0e7f8bba06caec14fc2c',
                'library/ThemeHouse/ModQueueInfo/Extend/XenForo/ModerationQueueHandler/Post.php' => '4123a77017e59a50f68dc3ea5912ba60',
                'library/ThemeHouse/ModQueueInfo/Extend/XenForo/ModerationQueueHandler/ProfilePost.php' => '6471ed7578f4c8e374a04286c5311564',
                'library/ThemeHouse/ModQueueInfo/Extend/XenForo/ModerationQueueHandler/Thread.php' => '1cac06301df9a85975e18c68f3b94b1d',
                'library/ThemeHouse/ModQueueInfo/Install/Controller.php' => 'e80da5b310d62bd35e2b3e6394ce12b7',
                'library/ThemeHouse/ModQueueInfo/Listener/LoadClass.php' => '89f868389bf4894920dee97e65982bdd',
                'library/ThemeHouse/Install.php' => '18f1441e00e3742460174ab197bec0b7',
                'library/ThemeHouse/Install/20151109.php' => '2e3f16d685652ea2fa82ba11b69204f4',
                'library/ThemeHouse/Deferred.php' => 'ebab3e432fe2f42520de0e36f7f45d88',
                'library/ThemeHouse/Deferred/20150106.php' => 'a311d9aa6f9a0412eeba878417ba7ede',
                'library/ThemeHouse/Listener/ControllerPreDispatch.php' => 'fdebb2d5347398d3974a6f27eb11a3cd',
                'library/ThemeHouse/Listener/ControllerPreDispatch/20150911.php' => 'f2aadc0bd188ad127e363f417b4d23a9',
                'library/ThemeHouse/Listener/InitDependencies.php' => '8f59aaa8ffe56231c4aa47cf2c65f2b0',
                'library/ThemeHouse/Listener/InitDependencies/20150212.php' => 'f04c9dc8fa289895c06c1bcba5d27293',
                'library/ThemeHouse/Listener/LoadClass.php' => '5cad77e1862641ddc2dd693b1aa68a50',
                'library/ThemeHouse/Listener/LoadClass/20150518.php' => 'f4d0d30ba5e5dc51cda07141c39939e3',
            ));
    }
}