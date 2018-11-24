</body>
<script type="text/javascript">
    function cc(str){
        var url = "<?php echo site_url('Publics', 'button') ?>" + '?url='+str;
        $.get(url, function(result){
            console.log(result);
        });

    }
</script>
</html>