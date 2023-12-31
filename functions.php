<?php

if (!defined('__TYPECHO_ROOT_DIR__'))
    exit;

require_once("single.php");

function themeConfig($form)
{
    Single::update();

    // 自定义站点图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, NULL, _t('站点图标 (favicon.ico)'), _t('设置站点图标，留空则使用默认图标'));
    $form->addInput($favicon);

    // 自定义背景图
    $background = new Typecho_Widget_Helper_Form_Element_Text('background', NULL, NULL, _t('背景图片'), _t('设置全局背景图，留空则不启用全局背景图'));
    $form->addInput($background);

    // 自定义站点语言
    $language = new Typecho_Widget_Helper_Form_Element_Text('language', NULL, NULL, _t('站点语言'), _t('告诉浏览器和搜索引擎站点的主要语言, 如 <a>en</a> 或者 <a>es</a>。<b>默认自适应, 一般不用手动设置</b>'));
    $form->addInput($language);

    // 自定义全局主题色
    $custom_theme_color = new Typecho_Widget_Helper_Form_Element_Text('custom_theme_color', NULL, NULL, _t('主题色'), _t('设置全局主题色， 如 <a>#FF8080</a>'));
    $form->addInput($custom_theme_color);

    // 自定义全局强调色
    $custom_focus_color = new Typecho_Widget_Helper_Form_Element_Text('custom_focus_color', NULL, NULL, _t('强调色'), _t('设置全局强调色, 如 <a>#FFBFBF</a>, <b>建议使用与全局主题色相近的颜色</b>'));
    $form->addInput($custom_focus_color);

    // 自定义资源引入
    $custom_link_res = new Typecho_Widget_Helper_Form_Element_Textarea('custom_link_res', NULL, NULL, _t('自定义静态资源'), _t('设置全局静态资源, 例如使用 CDN 加载资源时替换为 CDN 地址, <b>必须为绝对路径</b>。留空则使用本地资源'));
    $form->addInput($custom_link_res);

    // 自定义样式表
    $custom_css = new Typecho_Widget_Helper_Form_Element_Textarea('custom_css', NULL, NULL, _t('自定义样式表'), _t('添加额外的 CSS'));
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
    $built_date = new Typecho_Widget_Helper_Form_Element_Text('built_date', NULL, NULL, _t('显示建站日期'), _t('在页面底部显示网站运行时长。格式为 <a>yyyy-MM-dd</a>, 如 2023-08-28'));
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
        _t('在页面底部显示服务器开机时长 (uptime)。<a>只支持 Linux，需要在 PHP 安全策略中允许执行 shell_exec</a>')
    );
    $form->addInput($show_uptime);

    // 自定义服务器开机时长文本
    $custom_show_uptime = new Typecho_Widget_Helper_Form_Element_Text('custom_show_uptime', NULL, NULL, _t('自定义服务器开机时长文本'), _t('依次使用 4 个 <a>%d</a> 代替天、时、分、秒, 如 <a>已连续运行 %d 天 %d 时 %d 分 %d 秒</a>, 不填则使用示例格式。需要先启用显示服务器开机时长'));
    $form->addInput($custom_show_uptime);

    // 显示页面载入耗时
    $show_loading_timer = new Typecho_Widget_Helper_Form_Element_Radio(
        'show_loading_timer',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('显示页面载入耗时'),
        _t('在页面底部显示本次页面载入所耗费的时间。配置方法参见: <a>https://roadtothe.top/45.html</a>')
    );
    $form->addInput($show_loading_timer);

    // 自定义页面载入耗时文本
    $custom_loading_timer = new Typecho_Widget_Helper_Form_Element_Text('custom_loading_timer', NULL, NULL, _t('自定义页面载入耗时文本'), _t('使用 <a>%s</a> 代替具体时间, 如 <a>载入本页面耗时 %s 秒</a>, 不填则使用示例格式。需要先启用显示页面载入耗时'));
    $form->addInput($custom_loading_timer);

    // 显示 SQL 查询次数
    $show_sql_count = new Typecho_Widget_Helper_Form_Element_Radio(
        'show_sql_count',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('显示 SQL 查询次数'),
        _t('在页面底部显示本次页面载入所运行的 SQL 次数。配置方法参考: <a>https://roadtothe.top/45.html</a>')
    );
    $form->addInput($show_sql_count);

    // 自定义 SQL 查询次数文本
    $custom_sql_count = new Typecho_Widget_Helper_Form_Element_Text('custom_sql_count', NULL, NULL, _t('自定义 SQL 查询次数文本'), _t('使用 <a>%s</a> 代替具体数值, 如 <a>载入本页面运行了 %s 次 SQL</a>, 不填则使用示例格式。需要先启用显示 SQL 查询次数'));
    $form->addInput($custom_sql_count);

    // 行号显示开关开关
    $enable_code_linenumber = new Typecho_Widget_Helper_Form_Element_Radio(
        'enable_code_linenumber',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('代码行号显示'),
        _t('开启或关闭 Prism.JS 行号显示')
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
        _t('开启或关闭 HTML 中输出的 Feed 订阅源。<b>不会影响后端 Feed 接口, 只用于显示和隐藏前端 Feed</b>')
    );
    $form->addInput($enable_feed);

    // 文章阅读数开关
    $enable_watch_count = new Typecho_Widget_Helper_Form_Element_Radio(
        'enable_watch_count',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('文章阅读数开关'),
        _t('开启或关闭文章阅读数。<b>依赖插件 Quarkay/Typecho-ViewsCounter</b>')
    );
    $form->addInput($enable_watch_count);

    // 主题评论区开关
    $enable_comment = new Typecho_Widget_Helper_Form_Element_Radio(
        'enable_comment',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('主题评论区开关'),
        _t('开启或关闭主题评论区。<b>不会影响后端评论接口, 只用于显示和隐藏前端评论区</b>')
    );
    $form->addInput($enable_comment);

    // 自定义评论关闭时的提示文本
    $custom_disabled_comment_hint = new Typecho_Widget_Helper_Form_Element_Textarea('custom_disabled_comment_hint', NULL, NULL, _t('自定义评论关闭时的提示文本'), _t('当评论区关闭时显示的提示文本, 如 <a>评论已关闭</a>，不填则使用示例格式。需要先关闭主题评论区开关'));
    $form->addInput($custom_disabled_comment_hint);

    // 使用 giscus 作为评论系统
    $use_giscus_as_comment = new Typecho_Widget_Helper_Form_Element_Radio(
        'use_giscus_as_comment',
        array(
            '0' => _t('关闭'),
            '1' => _t('开启'),
        ),
        '0',
        _t('使用 giscus 作为评论系统'),
        _t('替换 Typecho 的评论区为 giscus。<b>需要先开启主题评论区</b>')
	);
	$form->addInput($use_giscus_as_comment);

	// giscus 代码
	$giscus_code = new Typecho_Widget_Helper_Form_Element_Textarea('giscus_code', NULL, NULL, _t('giscus 代码'), _t('在 <a>https://giscus.app/zh-CN</a> 生成 HTML 代码，然后把它粘贴在这里'));
	$form->addInput($giscus_code);

    // 自定义评论提示文本
    $custom_comment_hint = new Typecho_Widget_Helper_Form_Element_Textarea('custom_comment_hint', NULL, NULL, _t('自定义评论提示文本'), _t('要在评论输入框显示的提示文本, 如 <a>在这里输入评论</a>'));
    $form->addInput($custom_comment_hint);

    // 自定义作者信息
    $author_text = new Typecho_Widget_Helper_Form_Element_Textarea('author_text', NULL, NULL, _t('作者信息'), _t('在文章底部输出作者信息'));
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
