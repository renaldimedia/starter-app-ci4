<aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
            <section class="sidebar">
                <div class="w-full mt-3 mb-3 ml-3">
                    <!-- <img src="<?php //echo $theme_path ?>/img/basic/logo.png" alt=""> -->
                    <span><?= isset($title) ? $title : "Admin" ?></span>
                </div>
                <div class="relative">
                    <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
                        aria-controls="userSettingsCollapse"
                        class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                        <i class="icon icon-cogs"></i>
                    </a>
                    <div class="user-panel p-3 light mb-2">
                        <div>
                            <div class="float-left image">
                                <img class="user_avatar" src="<?= $theme_path ?>/img/dummy/u2.png" alt="User Image">
                            </div>
                            <div class="float-left info">
                                <h6 class="font-weight-light mt-2 mb-1"><?= isset($user_name) ? $user_name : "Admin" ?></h6>
                                <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="collapse multi-collapse" id="userSettingsCollapse">
                            <div class="list-group mt-3 shadow">
                                <a href="index.html" class="list-group-item list-group-item-action ">
                                    <i class="mr-2 icon-umbrella text-blue"></i>Profile
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"><i
                                        class="mr-2 icon-cogs text-yellow"></i>Settings</a>
                                <a href="#" class="list-group-item list-group-item-action"><i
                                        class="mr-2 icon-security text-purple"></i>Change Password</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <?php 

                        foreach($menus as $grpmenu): 
                            if(isset($grpmenu['group_display_name'])){
                                echo '<li class="header"><strong>'.$grpmenu['group_display_name'].'</strong></li>';
                            }
                            foreach ($grpmenu['group_menus'] as $menu):
                                echo '<li><a class="'.$menu['class'].'" href="'.$menu['url'].'"><i class="'.$menu['icon_class'].'"></i>'.$menu['display_name'];
                                if(count($menu['submenu']) > 0){
                                    echo '<i class="icon icon-angle-left s-18 pull-right"></i></a>';
                                    echo '<ul class="treeview-menu">';
                                    foreach ($menu['submenu'] as $submenu) {
                                        echo '<li><a href="'.$submenu['url'].'"><i class="'.$submenu['icon_class'].'"></i>'.$submenu['display_name'].'</a>
                                        </li>';
                                    }
                                }else{
                                    echo '</a></li>';
                                }
                            endforeach;
                        endforeach;
                    ?>
                </ul>
            </section>
        </aside>