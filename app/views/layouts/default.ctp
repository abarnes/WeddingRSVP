<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Wedding</title>
    <?php echo $html->css('custom'); ?>
    <?php echo $html->css('redmond/jquery-ui-1.8.17.custom'); ?>
    <?php echo $html->script('jquery'); ?>
    
    <script type="text/javascript">
    $(document).ready(function(){	
            $('#main').hide().fadeIn(700);
    });
    </script>
    
  </head>
  <body>
      <div id="main" class="shadow">
        <?php echo $content_for_layout; ?>
      </div>
  </body>
</html>