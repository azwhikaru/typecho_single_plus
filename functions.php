<?php

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

require_once("single.php");

function themeConfig($form)
{
    Single::update();

    // 自定义站点图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点图标 (Favicon)'), _t('在这里填入图片地址, 不填则使用默认图标'));
    $form->addInput($favicon);

    // 自定义背景图
    $background = new Typecho_Widget_Helper_Form_Element_Text('background', NULL, NULL, _t('背景图片'), _t('在这里填入一张图片地址, 不填则显示纯色背景'));
    $form->addInput($background);

    // 自定义站点语言
    $language = new Typecho_Widget_Helper_Form_Element_Text('language', NULL, NULL, _t('站点语言'), _t('输入当前站点的主要语言, 如 <a>en</a> 或者 <a>es</a>。<b>默认自适应, 一般不用手动设置</b>'));
    $form->addInput($language);

    // 自定义全站主题色
    $custom_theme_color = new Typecho_Widget_Helper_Form_Element_Text('custom_theme_color', NULL, NULL, _t('全局强调色'), _t('在这里输入十六进制颜色, 如 <a>#6F9FC7</a>。留空则使用示例格式'));
    $form->addInput($custom_theme_color);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('在这里填入你的自定义样式表, 不填则不输出'));
    $form->addInput($custom_css);

    // 夜间模式
    $night_mode = new Typecho_Widget_Helper_Form_Element_Radio(
        'night_mode',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
            '2' => _t('始终')
        ),
        '1',
        _t('是否根据时间开启夜间模式'),
        _t('在 22:00 - 5:00 期间自动开启夜间模式, 始终则为始终开启夜间模式')
    );
    $form->addInput($night_mode);

    // 显示建站日期
    $built_date = new Typecho_Widget_Helper_Form_Element_Text('built_date', NULL, NULL, _t('显示建站日期'), _t('在页面底部显示网站运行时长, 不填则不显示。格式为 <a>yyyy-MM-dd</a>, 如 2023-08-28'));
    $form->addInput($built_date);

    // 自定义建站日期文本
    $custom_built_date = new Typecho_Widget_Helper_Form_Element_Text('custom_built_date', NULL, NULL, _t('自定义建站日期文本'), _t('使用 <a>%s</a> 代替天数, 如 <a>已运行 %s 天</a>，不填则使用示例格式。需要先启用显示建站日期'));
    $form->addInput($custom_built_date);

    // 显示服务器开机时长
    $show_uptime = new Typecho_Widget_Helper_Form_Element_Radio(
        'show_uptime',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('显示服务器开机时长'),
        _t('在页面底部显示服务器开机时长 (<a>uptime</a>)。只支持 Linux')
    );
    $form->addInput($show_uptime);

    // 自定义服务器开机时长文本
    $custom_show_uptime = new Typecho_Widget_Helper_Form_Element_Text('custom_show_uptime', NULL, NULL, _t('自定义服务器开机时长文本'), _t('依次使用 4 个 <a>%d</a> 代替天、时、分、秒, 如 <a>已连续运行 %d 天 %d 时 %d 分 %d 秒</a>, 不填则使用示例格式。需要先启用显示服务器开机时长'));
    $form->addInput($custom_show_uptime);

    // 行号显示开关开关
    $enable_code_linenumber = new Typecho_Widget_Helper_Form_Element_Radio(
        'enable_code_linenumber',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('代码行号显示'),
        _t('开启或关闭 Prism 行号显示, 注意当前 Prism 需包含行号显示功能')
    );
    $form->addInput($enable_code_linenumber);

    // 自定义文章时效
    $article_term = new Typecho_Widget_Helper_Form_Element_Text('article_term', NULL, NULL, _t('显示文章时效'), _t('当文章发布时间超过阈值天数时, 显示文章内容可能已经过期的提示, 如 <a>180</a> 天, 不填则不输出'));
    $form->addInput($article_term);

    // 自定义文章时效文本
    $custom_article_term = new Typecho_Widget_Helper_Form_Element_Text('custom_article_term', NULL, NULL, _t('自定义文章时效文本'), _t('使用 <a>%s</a> 代替天数, 如 <a>注意，这篇文章上次修改于 %s 天前，其内容可能已经失效</a>，不填则使用示例格式。需要先启用显示文章时效'));
    $form->addInput($custom_article_term);

    // Feed 开关
    $enable_feed = new Typecho_Widget_Helper_Form_Element_Radio(
        'enable_feed',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('Feed 开关'),
        _t('开启或关闭 HTML 中输出的 Feed 订阅源。<b>注意, 这个选项不会影响后端 Feed 接口, 只用于显示和隐藏前端 Feed</b>')
    );
    $form->addInput($enable_feed);


    // 主题评论区开关
    $enable_comment = new Typecho_Widget_Helper_Form_Element_Radio(
        'enable_comment',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('主题评论区开关'),
        _t('开启或关闭主题评论区。<b>注意, 这个选项不会影响后端评论接口, 只用于显示和隐藏前端评论区</b>')
    );
    $form->addInput($enable_comment);

    // 自定义评论提示文本
    $custom_comment_hint = new Typecho_Widget_Helper_Form_Element_Text('custom_comment_hint', NULL, NULL, _t('自定义评论提示文本'), _t('要在评论输入框显示的提示文本, 如 <a>在这里输入评论</a>，不填则使用示例格式'));
    $form->addInput($custom_comment_hint);

    // 自定义作者信息
    $author_text = new Typecho_Widget_Helper_Form_Element_Textarea('author_text', NULL, NULL, _t('作者信息'), _t('显示在文章底部的作者信息, 不填则不输出'));
    $form->addInput($author_text);

    // 复制提示
    $copy_notice = new Typecho_Widget_Helper_Form_Element_Radio(
        'copy_notice',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '1',
        _t('是否在复制内容的时候提示注意事项'),
        _t('开启则会在访客复制内容时弹窗')
    );
    $form->addInput($copy_notice);

    // 自定义复制提示文本
    $custom_copy_notice = new Typecho_Widget_Helper_Form_Element_Textarea('custom_copy_notice', NULL, NULL, _t('自定义复制提示'), _t('自定义复制时弹出的提示内容, 不填则使用默认文本。需要先启用复制提示'));
    $form->addInput($custom_copy_notice);

    // 自定义底部文本
    $custom_footer = new Typecho_Widget_Helper_Form_Element_Textarea('custom_footer', NULL, NULL, _t('自定义页面底部文本'), _t('自定义页面底部文本, 如用于显示备案号等信息, 支持 HTML, 不填则使用默认文本'));
    $form->addInput($custom_footer);

    // 信息栏
    $widget_set = new Typecho_Widget_Helper_Form_Element_Radio(
        'widget_set',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('是否显示信息栏'),
        _t('在页尾显示 "最新文章"、"最近评论" 和 "时光机"')
    );
    $form->addInput($widget_set);

    // 首页、存档页属性显示
    $archive_meta = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'archive_meta',
        array(
            'show_category' => _t('文章分类'),
            'show_tags' => _t('文章标签'),
            'show_comments' => _t('评论数')
        ),
        array('show_category', 'show_comments'),
        _t('首页、存档页属性显示')
    );
    $form->addInput($archive_meta->multiMode());

    // 文章页属性显示
    $post_meta = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'post_meta',
        array(
            'show_category' => _t('文章分类'),
            'show_comments' => _t('评论数')
        ),
        array('show_category', 'show_comments'),
        _t('文章页属性显示')
    );
    $form->addInput($post_meta->multiMode());

    // 自定义社交链接
    $home_social = new Typecho_Widget_Helper_Form_Element_Textarea('home_social', NULL, NULL, _t('自定义社交链接'), _t('在这里填入你的自定义社交链接, 不填则不输出。(格式请看<a href="https://github.com/Dreamer-Paul/Single/releases/tag/1.1" target="_blank">帮助信息</a>)'));
    $form->addInput($home_social);

    // 统计代码
    $custom_script = new Typecho_Widget_Helper_Form_Element_Textarea('custom_script', NULL, NULL, _t('统计代码'), _t('在这里填入你的统计代码, 不填则不输出。需要 <a>&lt;script&gt;</a> 标签'));
    $form->addInput($custom_script);

}
