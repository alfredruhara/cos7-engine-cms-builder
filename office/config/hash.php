<?php

return [
     #  Site web view-Map 
     'index'                  => 'posts.home_v',
     'single'                 => 'posts.single_v',
     'category'               => 'posts.category_v',
     'login'                  => 'users.login_v',
     # Administration  Posts  
     'admin.index'            => 'admin.posts.home_v',
     'admin.edit'             => 'admin.posts.edit_v',
     'admin.add'              => 'admin.posts.add_v',
     'admin.delete'           => 'admin.posts.delete_v',
     # Administration  Root files 
     'root.dashboard'         => 'admin.root.dashboard_v',
     'root.builder'           => 'admin.root.builder_v',
     'root.article'           => 'admin.root.article_v',
     'root.media'             => 'admin.root.media_v',
     'root.comment'           => 'admin.root.comment_v',
     'root.user'              => 'admin.root.user_v',
      # Administration Builder files 
     'builder.menu'           => 'admin.builder.menu_v',
     'builder.singlemenu'     => 'admin.builder.singlemenu_v',
     'builder.category'       => 'admin.builder.category_v',
      # Administration Article files 
     'article.comment'        => 'admin.article.comment_v',
     'article.new'            => 'admin.article.new_v',
     'article.delete'         => 'admin.article.delete_v',
      # Administration Media files 
     'media.folder'           => 'admin.media.folder_v',
     'media.folderslides'     => 'admin.media.folderslides_v',
      # Administration Comment files 
     'comment.approve'        => 'admin.comment.approve_v',
     'comment.reply'          => 'admin.comment.reply_v',
     'comment.edit'           => 'admin.comment.edit_v',
     'comment.spam'           => 'admin.comment.spam_v',
     'comment.trash'          => 'admin.comment.trash_v',
      # Administration User files
     'user.profile'           => 'admin.user.profile',
     'user.new'               => 'admin.user.new',
     'user.destroy'           => 'admin.user.destroy',
     'user.firechange'        => 'admin.user.fireChange',
      # Site Errors    
     '404'                    => 'e404_v',
     '403'                    => 'e403_v'
];


?>