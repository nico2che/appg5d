
	</div>
	
	<footer>
	<div>
		<a href="?page=aide" style="text-decoration: none;color: white">aide</a>
		<a href="?page=contacte" style="text-decoration: none;color: white">contact</a>
	</div>
	</footer>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<?php if(is_file('static/js/' . $action . '.js')) { ?><script type="text/javascript" src="static/js/<?php echo $action; ?>.js"></script><?php } ?>
</body>
</html>