<?php
# Paths 
$office = '//office//';
$components = $office.'components/';
$artilce_module = $components.'article/module/';
$studio_module  = $components.'studio/module/';
$comment_module = $components.'comment/module/';
$user_module    = $components.'user/module/';
$folder_module  = $components.'media/module/';

return [
     # Site web view-Map 
     'office' => [
         'index'    => [
            'out'      => 'desk', 'dir'=> $office.'/index.php',
            'com'      => 'Desktop of the the office ... all about statistics,far links,..'
         ]
     ],
     'studio' => [
         'index'    => [
            'out'      => 'studio', 'dir'=>  $components.'studio/index.php',
            'com'      => 'Studios App: use to builder and maintain the web site ... its all about creating menus,category,sliders,...'
         ],
         'nav'    => [
            'out'      => 'studio.nav', 'dir'=>  $studio_module.'nav.php',
            'com'      => 'Studios App: use to builder and maintain the web site ... its all about creating menus,category,sliders,...'
         ],
         'menu'    => [
            'out'      => 'studio.menu', 'dir'=>  $studio_module.'menu.php',
            'com'      => 'Studios App: use to builder and maintain the web site ... its all about creating menus,category,sliders,...'
         ],
         'category'    => [
            'out'      => 'studio.category', 'dir'=>  $studio_module.'category.php',
            'com'      => 'Studios App: use to builder and maintain the web site ... its all about creating menus,category,sliders,...'
         ],
         'footer'    => [
            'out'      => 'studio.footer', 'dir'=>  $studio_module.'footer.php',
            'com'      => 'Studios App: use to builder and maintain the web site ... its all about creating menus,category,sliders,...'
         ]
     ],
     'article' => [
        'index'     => [
            'out'      => 'article', 'dir'=>  $components.'article/index.php',
            'com'      => 'Article App: use to write article or post ,edit and manage ... its all about posts'
        ],
        'new'     => [
            'out'      => 'new', 'dir'=> $artilce_module.'newArticle.php',
            'com'      => 'New Article App: use to write article or post ,edit and manage ... its all about posts'
        ],
        'comment'     => [
            'out'      => 'comment article', 'dir'=> $artilce_module.'commentArticle.php',
            'com'      => 'Comment Article App: use to comment a post inernaly ... all anout commenting a post directly from office.'
        ],
        'delete'     => [
            'out'      => 'delete', 'dir'=> $artilce_module.'deleteArticle.php',
            'com'      => 'Comment Article App: use to comment a post inernaly ... all anout commenting a post directly from office.'
        ]
     ],
     'comment' => [
        'index'    => [
            'out'      => 'comment', 'dir'=>  $components.'comment/index.php',
            'com'      => 'Comment App: use to manage,reply,delete ... its all about comments on posts'
        ],
        'approve'    => [
            'out'      => 'approve', 'dir'=>  $comment_module.'approveComment.php',
            'com'      => 'Comment App: use to manage,reply,delete ... its all about comments on posts'
        ],
        'edit'    => [
            'out'      => 'edit', 'dir'=>  $comment_module.'editComment.php',
            'com'      => 'Comment App: use to manage,reply,delete ... its all about comments on posts'
        ],
        'reply'    => [
            'out'      => 'reply', 'dir'=>  $comment_module.'replyComment.php',
            'com'      => 'Comment App: use to manage,reply,delete ... its all about comments on posts'
        ],
        'spam'    => [
            'out'      => 'spam', 'dir'=>  $comment_module.'spamComment.php',
            'com'      => 'Comment App: use to manage,reply,delete ... its all about comments on posts'
        ],
        'trash'    => [
            'out'      => 'trash', 'dir'=>  $comment_module.'trashComment.php',
            'com'      => 'Comment App: use to manage,reply,delete ... its all about comments on posts'
        ]       
     ],
     'media' => [
        'index'    => [
            'out'      => 'cosexp','dir' =>  $components.'media/index.php',
            'com'      => 'Media App: File management on the system'
        ],
        'folder'    => [
            'out'      => 'cosexp-folder','dir' =>  $folder_module.'folder.php',
            'com'      => 'Media App: File management on the system'
        ],
        'slide'    => [
            'out'      => 'cosexp-sliders','dir' =>  $folder_module.'folderslides.php',
            'com'      => 'Media App: File management on the system'
        ]
    ],
    'user' => [
        'index'    => [
            'out'      => 'users','dir' =>  $components.'user/index.php',
            'com'      => 'User App: Users management on the system'
        ],
        'destroy'    => [
            'out'      => 'logout','dir' =>  $user_module.'destroyUser.php',
            'com'      => 'User App: Users management on the system'
        ],
        'firechange'    => [
            'out'      => 'firechange','dir' =>  $user_module.'fireChangeUser.php',
            'com'      => 'User App: Users management on the system'
        ],
        'new'    => [
            'out'      => 'new user','dir' =>  $user_module.'newUser.php',
            'com'      => 'User App: Users management on the system'
        ],
        'profile'    => [
            'out'      => 'profile user','dir' =>  $user_module.'profileUser.php',
            'com'      => 'User App: Users management on the system'
        ]
    ]
];

?>