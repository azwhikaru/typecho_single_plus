<?php

class Single
{
    static $name = "Re:Single;";
    static $version = "2312";

    static $author = "", $authorCache = "";

    // 更新检测
    static function update()
    {
    ?>
        <style>
            .detail {
                text-align: center;
                margin: 1em 0;
            }

            .detail>* {
                margin: 0 0 1rem
            }

        </style>
        <div class="detail">
            <h1><?php echo self::$name . " (" . self::$version . ")" ?></h1>
            <p>By: <a href='https://github.com/Dreamer-Paul'>Dreamer-Paul</a> & <a href='https://github.com/azwhikaru'>Ayabe</a></p>
        </div>
    <?php
    }

    // 分割线
    static function line()
    {
        ?>
            <hr>
        <?php
    }

    static function desc($text)
    {
    ?>
        <div class="detail">
            <h2><?php echo $text ?></h2>
        </div>
    <?php
    }

    // 夜间模式
    static function is_night()
    {
        if (isset($_COOKIE["night"])) {
            echo $_COOKIE["night"] == "true" ? ' class="dark-theme"' : '';
        } else if (Typecho_Widget::widget('Widget_Options')->night_mode == 2) {
            echo ' class="dark-theme"';
        }
    }

    // 时间转换
    static function tran_time($ts)
    {
        $dur = time() - $ts;

        if ($dur < 0) {
            return $ts;
        } else if ($dur < 60) {
            return $dur . " 秒前";
        } else if ($dur < 3600) {
            return floor($dur / 60) . " 分钟前";
        } else if ($dur < 86400) {
            return floor($dur / 3600) . " 小时前";
        } else if ($dur < 604800) {
            return floor($dur / 86400) . " 天前";
        } else if ($dur < 2592000) {
            return floor($dur / 604800) . " 周前";
        } else if ($dur < 31557600) {
            return floor($dur / 2592000) . " 个月前";
        } else {
            return date("Y.m.d", $ts);
        }
    }

    // 文章配图
    static function post_image()
    {
        // 寻找文章里面的图片
        preg_match("/(http|https)(\S)+(jpg|png|webp)/", Typecho_Widget::widget('Widget_Archive')->text, $post_image);

        if ($post_image) {
            return $post_image[0];
        } else {
            return null;
        }
    }
}
