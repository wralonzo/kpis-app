<marquee behavior="" direction="">hola</marquee>
<script>
alert("hola");
</script>
<?php if ($this->uri->segment(1)=='Usuario') {?>
    <script src"<?php echo base_url();?>js/user.js"></script>
<?php  
}
?>
</body>
</html>