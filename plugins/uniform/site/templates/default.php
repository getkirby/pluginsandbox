<style>
.uniform__potty {
    position: absolute;
    left: -9999px;
}
</style>

<form action="<?php echo $page->url() ?>" method="POST">
    <div>
        <label for="email">Email</label>
        <input name="email" type="email" value="<?php echo $form->old('email'); ?>">
    </div>
    <div>
        <label for="message">Message</label>
        <textarea name="message"><?php echo $form->old('message'); ?></textarea>
    </div>
   <?php echo csrf_field(); ?>
   <?php echo honeypot_field(); ?>
   <input type="submit" value="Submit">
</form>
<?php if ($form->success()): ?>
   Success!
<?php else: ?>
   <?php snippet('uniform/errors', ['form' => $form]); ?>
<?php endif; ?>