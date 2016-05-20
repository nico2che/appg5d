
	</div>
	
	<footer>
			<a href="?page=aide">Aide</a> - <a href="?page=contacte">Contact</a>
			&nbsp; &nbsp; &copy; Team Up - <?php echo date('Y'); ?> - Tous droits réservés
	</footer>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	<script type="text/javascript" src="static/js/script.js"></script>
	<?php if(is_file('static/js/' . $action . '.js')) { ?><script type="text/javascript" src="static/js/<?php echo $action; ?>.js"></script><?php } ?>
</body>
</html>