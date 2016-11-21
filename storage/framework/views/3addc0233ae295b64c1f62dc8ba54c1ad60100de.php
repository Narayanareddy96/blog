<?php $__env->startSection('title'); ?>
  <?php if($post): ?>
    <?php echo e($post->title); ?>

    <?php if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin())): ?>
      <button class="btn" style="float: right"><a href="<?php echo e(url('edit/'.$post->slug)); ?>">Edit Post</a></button>
    <?php endif; ?>
  <?php else: ?>
    Page does not exist
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title-meta'); ?>
<p><?php echo e($post->created_at->format('M d,Y \a\t h:i a')); ?> By <a href="<?php echo e(url('/user/'.$post->author_id)); ?>"><?php echo e($post->author->name); ?></a></p>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if($post): ?>
  <div>
    <?php echo $post->body; ?>

  </div>    
  <div>
    <h2>Leave a comment</h2>
  </div>
  <?php if(Auth::guest()): ?>
    <p>Login to Comment</p>
  <?php else: ?>
    <div class="panel-body">
      <form method="post" action="/comment/add">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <input type="hidden" name="on_post" value="<?php echo e($post->id); ?>">
        <input type="hidden" name="slug" value="<?php echo e($post->slug); ?>">
        <div class="form-group">
          <textarea required="required" placeholder="Enter comment here" name = "body" class="form-control"></textarea>
        </div>
        <input type="submit" name='post_comment' class="btn btn-success" value = "Post"/>
      </form>
    </div>
  <?php endif; ?>
  <div>
    <?php if($comments): ?>
    <ul style="list-style: none; padding: 0">
      <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <li class="panel-body">
          <div class="list-group">
            <div class="list-group-item">
              <h3><?php echo e($comment->author->name); ?></h3>
              <p><?php echo e($comment->created_at->format('M d,Y \a\t h:i a')); ?></p>
            </div>
            <div class="list-group-item">
              <p><?php echo e($comment->body); ?></p>
            </div>
          </div>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </ul>
    <?php endif; ?>
  </div>
<?php else: ?>
404 error
<?php endif; ?>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>