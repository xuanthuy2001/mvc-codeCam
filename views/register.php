<h1>register</h1>
<?php  $form=\app\core\form\Form::begin('',"post") ?>
<div class="row">
      <div class="col-md-6">
        <?php  echo $form->field($model, 'first_name') ?>
      </div>
      <div class="col-md-6">
        <?php  echo $form->field($model, 'last_name') ?>
      </div>
    </div>
  <?php  echo $form->field($model, 'email') ?>
  <?php  echo $form->field($model, 'password')->passwordField() ?>
  <?php  echo $form->field($model, 'confirm_password')->passwordField() ?>
  <button type="submit" class="btn btn-primary">submit</button>
<?php \app\core\form\Form::end();  ?>


