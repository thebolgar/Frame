<?php
    $header_have_social = have_rows( 'global_header_menu_social_links', 'option' );
    $enable_social = OhioOptions::get_global( 'header_menu_social_links_visibility', true );
    if ( !$enable_social ) {
        $enable_social = OhioSettings::is_coming_soon_page();
    }

    $social_icons = OhioOptions::get_global( 'social_network_type', false );
    $in_new_tab = OhioOptions::get_global( 'social_network_target_blank', true );
    $links_target = ( $in_new_tab ) ? '_blank' : '_self';
    $social_classes = '';

    if ($social_icons == 'icons') {
        $social_classes = 'icons';
    }
?>

<?php if ( $header_have_social && $enable_social) : ?>
    <div class="clb-social vc_hidden-md vc_hidden-sm vc_hidden-xs">
        <ul class="clb-social-holder font-titles <?php echo esc_attr($social_classes); ?>"> 
            <li class="clb-social-holder-follow"><?php esc_html_e( 'Follow Us', 'ohio' ); ?></li>
            <li class="clb-social-holder-dash">&ndash;</li>
            <?php while( have_rows( 'global_header_menu_social_links', 'option' ) ): the_row(); ?>
                <?php switch ( get_sub_field( 'social_network' ) ) {
                    case 'behance':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href="<?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="behance">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-behance'></i> " : "Be." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'digg':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href="<?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="digg">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-digg'></i> " : "Dg." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'discord':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="discord">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-discord'></i> " : "Ds." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'dribbble':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="dribbble">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-dribbble'></i> " : "Dr." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'facebook':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="facebook">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-facebook-f'></i> " : "Fb." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'flickr':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="flickr">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-flickr'></i> " : "Fl." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'github':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="github">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-github'></i> " : "Gh." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'instagram':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="instagram">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-instagram'></i> " : "Inst." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'kaggle':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="kaggle">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-kaggle'></i> " : "Ka." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'linkedin':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="linkedin">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-linkedin'></i> " : "Lk." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'medium':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="medium">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-medium-m'></i> " : "Md." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'mixer':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="mixer">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-mixer'></i> " : "Mx." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'pinterest':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="pinterest">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-pinterest'></i> " : "Pt." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'quora':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="quora">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-quora'></i> " : "Qu." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'reddit':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="reddit">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-reddit'></i> " : "Re." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'snapchat':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="snapchat">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-snapchat'></i> " : "Sn." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'soundcloud':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="soundcloud">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-soundcloud'></i> " : "Sc." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'spotify':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="spotify">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-spotify'></i> " : "Sp." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'teamspeak':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="teamspeak">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-teamspeak'></i> " : "Tm." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'telegram':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="telegram">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-telegram-plane'></i> " : "Tl." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'tiktok':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="tiktok">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-tiktok'></i> " : "Tk." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'tumblr':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="tumblr">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-tumblr'></i> " : "Tm." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'twitch':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="twitch">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-twitch'></i> " : "Tw." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'twitter':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="twitter">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-twitter'></i> " : "Tw." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'vimeo':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="vimeo">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-vimeo'></i> " : "Vm." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'vine':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="vine">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-vine'></i> " : "Vn." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'vkontakte':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="vk">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-vk'></i> " : "Vk." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'whatsapp':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="whatsapp">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-whatsapp'></i> " : "Wh." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'xing':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="xing">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-xing'></i> " : "Xi." ?>
                            </a>
                        </li>
                        <?php 
                        break;
                    case 'youtube':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="youtube">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-youtube'></i> " : "Yt." ?>
                            </a>
                        </li>
                        <?php 
                        break; 
                    case '500px':
                        ?>
                        <li>
                            <a target="<?php echo $links_target; ?>" href=" <?php echo esc_url( get_sub_field( 'url' ) ) ?>" class="500px">
                                <?php echo esc_html($social_icons == 'icons') ? "<i class='fab fa-500px'></i> " : "500px." ?>
                            </a>
                        </li>
                        <?php 
                        break; 
                } ?>
            <?php endwhile; ?>
        </ul>
    </div>
<?php endif; ?>