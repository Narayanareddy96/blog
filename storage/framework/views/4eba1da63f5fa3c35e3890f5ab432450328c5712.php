<?php $__env->startSection('title'); ?>
Edit Post
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<form method="post" action='<?php echo e(url("/update")); ?>'>
  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
  <input type="hidden" name="post_id" value="<?php echo e($post->id); ?><?php echo e(old('post_id')); ?>">
  <div class="form-group">
    <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="<?php if(!old('title')): ?><?php echo e($post->title); ?><?php endif; ?><?php echo e(old('title')); ?>"/>
  </div>
  <div class="form-group">
    <textarea name='body'class="form-control"><?php if(!old('body')): ?><?php echo $post->body; ?><?php endif; ?><?php echo old('body'); ?></textarea>
  </div>
  <?php if($post->active == '1'): ?>
  <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
  <?php else: ?>
  <input type="submit" name='publish' class="btn btn-success" value = "Publish"/>
  <?php endif; ?>
  <input type="submit" name='save' class="btn btn-default" value = "Save As Draft" />
  <a href="<?php echo e(url('delete/'.$post->id.'?_token='.csrf_token())); ?>" class="btn btn-danger">Delete</a>
</form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>