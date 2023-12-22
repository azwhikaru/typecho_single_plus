<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE html>
<html>

<head>
	<!-- 元数据开始 -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="keywords" content="<?php $this->options->keywords(); ?>" />
	<meta name="generator" content="<?php $this->options->generator(); ?>" />
	<meta name="template" content="ReSingle" />
	<meta property="og:site_name" content="<?php $this->options->title(); ?>" />
	<?php if ($this->is("post")) : ?><meta property="og:type" content="article" />
	<meta property="og:url" content="https://hellodk.cn/post/1014" />
	<meta property="og:title" content="<?php $this->archiveTitle("", ""); ?>" />
	<meta property="og:description" content="<?php echo $this->description; ?>" />
	<?php if ($hasImage) : ?><meta property="og:image" content="<?php echo $hasImage; ?>" /><?php endif; ?>
<meta property="og:category" content="<?php $this->category(',', false); ?>" />
	<meta property="article:author" content="<?php $this->author(); ?>" />
	<meta property="article:publisher" content="<?php $this->options->siteUrl(); ?>" />
	<meta property="article:published_time" content="<?php $this->date('c'); ?>" />
	<meta property="article:published_first" content="<?php $this->options->title() ?>, <?php $this->permalink() ?>" />
	<meta property="article:tag" content="<?php $this->keywords(',');?>" />
	<?php endif; ?>
<!-- 元数据结束 -->
    <title><?php $this->archiveTitle(array(
                'category'  =>  _t('%s'),
                'search'    =>  _t('含关键词 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - ');
            $this->options->title(); ?></title>
    <?php if ($this->options->favicon) : ?>
    <link rel="icon" href="<?php $this->options->favicon(); ?>" sizes="192x192" />
    <?php else : ?>
    <link rel="icon" href="<?php $this->options->themeUrl('img/icon.png'); ?>" sizes="192x192" />
    <?php endif; ?>
    <?php if ($this->options->custom_link_res) : echo $this->options->custom_link_res() ?>
    <?php else : ?>
    <link href="<?php $this->options->themeUrl('static/kico.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php $this->options->themeUrl('static/single.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php $this->options->themeUrl('static/viewer.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php $this->options->themeUrl('static/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?php $this->options->themeUrl('static/kico.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('static/single.js'); ?>"></script>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1" />
    <?php if ($this->options->background) : ?>
        <style>
            body:before {
                content: '';
                background-image: url(<?php $this->options->background(); ?>)
            }
        </style>
    <?php endif; ?>
    <?php if ($this->options->custom_css) : ?>
    <style>
    	<?php $this->options->custom_css(); ?>
    </style>
    <?php endif; ?>
    <?php if ($this->options->enable_feed == 1) : ?><?php $this->header('generator=&template=&pingback=&xmlrpc=&wlw='); ?><?php endif; ?>
</head>
<body<?php Single::is_night() ?>>
    <header>
        <div class="head-title">
            <h4><?php $this->options->title(); ?></h4>
        </div>
        <div class="head-action">
            <div class="toggle-btn"></div>
            <div class="light-btn"></div>
            <div class="search-btn"></div>
        </div>
        <form class="head-search" method="post">
            <input type="text" name="s" placeholder="输入关键词">
        </form>
        <nav class="head-menu">
            <a href="<?php $this->options->siteUrl(); ?>">首页</a>
            <div class="has-child">
                <a>分类</a>
                <div class="sub-menu">
                    <?php $this->widget('Widget_Metas_Category_List')->parse('<a href="{permalink}">{name}</a>'); ?>
                </div>
            </div>
            <?php $this->widget('Widget_Contents_Page_List')->parse('<a href="{permalink}">{title}</a>'); ?>
            <?php if ($this->user->hasLogin()) : ?>
                <a href="<?php $this->options->adminUrl(); ?>" target="_blank">进入后台</a>
            <?php endif; ?>
        </nav>
    </header>