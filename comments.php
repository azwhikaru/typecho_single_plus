<?php if (!defined('__TYPECHO_ROOT_DIR__'))
    exit; ?>

<?php if ($this->options->enable_comment): ?>
    <?php

    function threadedComments($comments)
    {
        $commentLevelClass = $comments->levels > 0 ? " comment-child" : "";

        Single::$author = Single::$authorCache;
        Single::$authorCache = $comments->author;

        $comments->created = Single::tran_time($comments->created);
        ?>

        <div class="comment-single<?php echo $commentLevelClass; ?>" id="<?php $comments->theId() ?>">
            <?php
            $comments->gravatar('150', 'robohash');
            ?>
            <div class="comment-meta">
                <span class="comment-author">
                    <?php if ($comments->url): ?><a href="<?php $comments->url() ?>" rel="external nofollow" target="_blank">
                            <?php $comments->author(false) ?>
                        </a>
                    <?php else:
                        $comments->author();
                    endif; ?>
                </span>
                <time class="comment-time">
                    <?php $comments->created(); ?>
                </time>
                <span class="comment-reply">
                    <?php $comments->reply('<i class="fa fa-reply" title="回复"></i>'); ?>
                </span>
            </div>
            <div class="comment-content">
                <p>
                    <?php

                    if ($comments->parent) {
                        echo '<a href="#comment-' . $comments->parent . '">@' . Single::$author . '</a> ';
                    }

                    $comments->content = preg_replace('#</?[p][^>]*>#', '', $comments->content);
                    $comments->content();

                    ?>
                </p>
            </div>
        </div>

        <?php if ($comments->children)
            $comments->threadedComments(); ?>

    <?php } ?>

    <section class="post-comments" id="comments">
        <h3>
            <?php $this->commentsNum(_t('没有评论'), _t('共有 %d 条评论'), _t('共有 %d 条评论')); ?>
        </h3>
        <?php $this->comments()->to($comments); ?>
        <?php if ($this->allow('comment')): ?>
            <div class="comment-form" id="<?php $this->respondId(); ?>">
                <span class="cancel-comment-reply">
                    <?php $comments->cancelReply(); ?>
                </span>
                <form method="post" action="<?php $this->commentUrl() ?>" role="form">
                    <?php if ($this->user->hasLogin()): ?>
                        <fieldset>
                            <p>欢迎回来，<a href="<?php $this->options->profileUrl() ?>">
                                    <?php $this->user->screenName(); ?>
                                </a>！不是你？<a href="<?php $this->options->logoutUrl() ?>">登出</a></p>
                            <textarea rows="2" name="text" id="textarea"
                                placeholder="<?php echo $this->options->custom_comment_hint ? $this->options->custom_comment_hint : "在这里输入评论" ?>"
                                required><?php $this->remember('text'); ?></textarea>
                            <button type="submit" class="btn">提交</button>
                        </fieldset>
                    <?php else: ?>
                        <div class="row">
                            <fieldset class="col-m-6">
                                <input type="text" name="author" placeholder="昵称" value="<?php $this->remember('author'); ?>"
                                    required>
                                <input type="email" name="mail" placeholder="电子邮件" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>>
                                <input type="url" name="url" placeholder="网站" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>>
                            </fieldset>
                            <fieldset class="col-m-6">
                                <textarea rows="3" name="text" id="textarea"
                                    placeholder="<?php echo $this->options->custom_comment_hint ? $this->options->custom_comment_hint : "在这里输入评论" ?>"
                                    required><?php $this->remember('text'); ?></textarea>
                                <button type="submit" class="btn">提交</button>
                            </fieldset>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        <?php else: ?>
            <p>评论已关闭</p>
        <?php endif; ?>

        <?php if ($comments->have()): ?>
            <div class="comment-list">
                <?php $comments->listComments(array('before' => '', 'after' => '', 'replyWord' => '<i class="fa fa-reply"></i>')); ?>
            </div>
            <?php $comments->pageNav('&laquo;', '&raquo;', 3, "...", array('wrapTag' => 'section', 'itemTag' => 'span')); ?>
        <?php endif; ?>

    </section>
<?php else: ?>
    <p align="center"><?php echo $this->options->custom_disabled_comment_hint ? $this->options->custom_disabled_comment_hint : "评论已关闭" ?></p>
<?php endif; ?>