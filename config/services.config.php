<?php
/**
 * Created by PhpStorm.
 * User: Andy
 * Date: 10/25/2015
 * Time: 11:06 PM
 */

return array(
    'service_manager' => array(
        'invokables' => array(
            'ComicArc' => 'ATPComic\Model\Arc',
            'ComicPage' => 'ATPComic\Model\Page',
            'ComicNode' => 'ATPComic\Model\Node',
            'ComicPageWidget' => 'ATPComic\View\Widget\Page',
        ),
        'shared' => array(
            'ComicArc' => false,
            'ComicPage' => false,
            'ComicNode' => false,
        )
    ),
);