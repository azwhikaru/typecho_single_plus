<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<footer>
    <div class="buttons">
        <a class="to-top" href="#"></a>
    </div>
    <div class="wrap min">
        <?php if ($this->options->widget_set == '1') : ?>
            <section class="widget">
                <div class="row">
                    <div class="col-m-4">
                        <h3 class="title-recent">最新文章：</h3>
                        <ul>
                            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=6')->parse('<li><a href="{permalink}" target="_blank">{title}</a></li>'); ?>
                        </ul>
                    </div>
                    <div class="col-m-4">
                        <h3 class="title-date">时光机：</h3>
                        <ul>
                            <?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=Y 年 m 月&limit=6')->parse('<li><a href="{permalink}" rel="nofollow" target="_blank">{date}</a></li>'); ?>
                        </ul>
                    </div>
                    <div class="col-m-4">
                        <h3 class="title-comments">最近评论：</h3>
                        <ul>
                            <?php $this->widget('Widget_Comments_Recent', 'pageSize=6')->to($comments); ?>
                            <?php while ($comments->next()) : ?>
                                <li><?php $comments->author(false); ?>: <a href="<?php $comments->permalink(); ?>" rel="nofollow" target="_blank"><?php $comments->excerpt(10, '...'); ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <section class="sub-footer">
            <p>© <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>. All Rights Reserved. Theme By <a href="https://github.com/Dreamer-Paul/Single" target="_blank" rel="nofollow">Single</a>.</p>
            <?php if ($this->options->custom_footer) : ?>
            <?php echo $this->options->custom_footer ?>
            <?php endif; ?>
            <?php if ($this->options->built_date) : ?>
            <p><?php
            $startDateTimestamp = strtotime($this->options->built_date);
            $timeDifference = time() - $startDateTimestamp;
            $daysDifference = floor($timeDifference / (60 * 60 * 24));
            echo sprintf($this->options->custom_built_date ? $this->options->custom_built_date : "已运行 %s 天", $daysDifference);
            ?></p>
            <?php endif; ?>
            <?php if ($this->options->show_uptime) : ?>
            <p><?php
            $uptimeSeconds = time() - strtotime(trim(shell_exec('uptime -s')));
            $days = floor($uptimeSeconds / (60 * 60 * 24));
            $hours = floor(($uptimeSeconds % (60 * 60 * 24)) / (60 * 60));
            $minutes = floor(($uptimeSeconds % (60 * 60)) / 60);
            $seconds = $uptimeSeconds % 60;
            echo sprintf($this->options->custom_show_uptime ? $this->options->custom_show_uptime : "已连续运行 %d 天 %d 时 %d 分 %d 秒", $days, $hours, $minutes, $seconds);
            ?></p>
            <?php endif; ?>
        </section>
    </div>
</footer>

<script>
    var single = new Paul_Single({
        copyright: <?php if ($this->options->copy_notice == 1) : ?>true<?php else : ?>false<?php endif; ?>,
        custom_copy_notice: <?php if ($this->options->custom_copy_notice) : ?><?php echo json_encode(htmlspecialchars($this->options->custom_copy_notice)) ?><?php else : ?>false<?php endif; ?>,
        theme_color: <?php if ($this->options->custom_theme_color) : ?><?php echo json_encode(htmlspecialchars($this->options->custom_theme_color)) ?><?php else : ?>false<?php endif; ?>,
        focus_color: <?php if ($this->options->custom_focus_color) : ?><?php echo json_encode(htmlspecialchars($this->options->custom_focus_color)) ?><?php else : ?>false<?php endif; ?>,
        code_linenumber: <?php if ($this->options->enable_code_linenumber == 1) : ?>true<?php else : ?>false<?php endif; ?>,
        language: <?php if ($this->options->language) : ?><?php echo json_encode(htmlspecialchars($this->options->language)) ?><?php else : ?>false<?php endif; ?>,
        night: <?php if ($this->options->night_mode == 1) : ?>true<?php else : ?>false<?php endif; ?>
    });
</script>

<?php $this->options->custom_script(); ?>
<?php $this->footer(); ?>

</body>

</html>