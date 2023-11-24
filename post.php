<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<main>
    <div class="wrap min">
        <section class="post-title">
            <h2><?php $this->title() ?></h2>
            <?php if ($this->authorId == $this->user->uid) : ?>
                <a class="edit-link" href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?php echo $this->cid; ?>" target="_blank">编辑</a>
            <?php endif; ?>
            <div class="post-meta">
                <time class="date"><?php $this->date(); ?></time>
                <?php if (!empty($this->options->post_meta) && in_array('show_category', $this->options->post_meta)) : ?>
                    <span class="category"><?php $this->category('，'); ?></span>
                <?php endif; ?>
                <?php if (!empty($this->options->post_meta) && in_array('show_comments', $this->options->post_meta) && $this->options->enable_comment) : ?>
                    <span class="comments"><?php $this->commentsNum(); ?></span>
                <?php endif; ?>
                <?php if ($this->options->enable_watch_count) : ?>
                    <span class="fa-sharp fa-solid fa-eye fa-sm"><?php echo ViewsCounter_Plugin::getViews(); ?></span>
                <?php endif; ?>
            </div>
        </section>
        <article class="post-content">
            <?php if ($this->options->article_term) : ?>
                <?php if (time() - $this->modified >= ($this->options->article_term) * 24 * 60 * 60) : ?>
                    <blockquote><?php echo sprintf($this->options->custom_article_term ? $this->options->custom_article_term : "注意，这篇文章上次修改于 %s 天前，其内容可能已经失效", ceil((time() - $this->modified) / 86400)) ?></blockquote>
            <?php endif ?>
            <?php endif; ?>
            <?php $this->content(); ?>
        </article>
        <section class="post-near">
            <ul>
                <li>上一篇: <?php $this->thePrev('%s', '没有了'); ?></li>
                <li>下一篇: <?php $this->theNext('%s', '没有了'); ?></li>
            </ul>
        </section>
        <?php if (count($this->tags)) : ?>
            <section class="post-tags">
                <?php $this->tags('', true, '暂无'); ?>
            </section>
        <?php endif; ?>
        <?php if ($this->options->author_text) : ?>
            <section class="post-author">
                <figure class="author-avatar">
                    <?php $this->author->gravatar(200); ?>
                </figure>
                <div class="author-info">
                    <h4><?php $this->author(); ?></h4>
                    <p><?php $this->options->author_text() ?></p>
                </div>
            </section>
        <?php endif; ?>
        <?php $this->need('comments.php'); ?>
    </div>
</main>

<?php $this->need('footer.php'); ?>