<?php
$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
?>
<script>
    <?php if ($all_image): ?>
    app.inputs.create([
        <?php foreach ($all_image as $item):
            $img_link = base_url().'uploads/'.$item['img_name'];
        ?>
        {url: "<?php echo $img_link; ?>"},
        <?php endforeach;; ?>
    ]).then(
        function(response) {
            // do something with response
        },
        function(err) {
            // there was an error
        }
    );
    <?php endif; ?>
</script>