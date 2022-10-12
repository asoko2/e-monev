<section class="content">

<?php //echo $this->render_table_name($mode); ?>
<div class="xcrud-view">
<?php echo $mode == 'view' ? $this->render_fields_list($mode,array('tag'=>'table','class'=>'table table-striped')) : $this->render_fields_list($mode,'div','div','label','div'); ?>
</div>
<div class="xcrud-nav">
<?php echo $this->render_button('return','list','','btn btn-default pull-right','','create,edit,view');?>
<?php echo $this->render_button('save_return','save','list','btn btn-primary pull-left','','create,edit');?>
<?php echo $this->render_button('save_new','save','create','btn btn-success pull-left ml-5','','create');?>
  
</div>
<div class="pull-left"> <?php echo $this->render_benchmark(); ?> </div>
</section>
