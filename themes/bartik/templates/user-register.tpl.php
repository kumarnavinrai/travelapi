<?php 
  print render($form['form_id']);
  print render($form['form_build_id']);
  print render($form['account']['name']);
  print render($form['account']['mail']);
  print render($form['field_yourcustomfield']); // Your Drupal 7 profile field if any.
  print drupal_render($form['actions']); 
?>