	</div>
	<footer>
			<a href="?page=aide">Aide</a> - <a href="?page=contact">Contact</a>
			&nbsp; &nbsp; &copy; Team Up - <?php echo date('Y'); ?> - Tous droits réservés
	</footer>
	<script type="text/javascript" src="static/js/script.js"></script>
	<?php if(is_file('static/js/' . $action . '.js')) { ?><script type="text/javascript" src="static/js/<?php echo $action; ?>.js"></script><?php } ?>
</body>
</html>