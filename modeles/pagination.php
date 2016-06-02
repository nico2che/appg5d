<?php

function parametreUrl($name, $value) {

    if(empty($_SERVER['QUERY_STRING'])) {
        return '?'.$name.'='.$value;
    } else {
        $return = $name.'='.$value;
        foreach ($_GET as $k => $v) {
            if($name != $k) {
                $return .= '&'.$k.'='.$v;
            }
        }
        return '?'.$return;
    }
}

function pagination($nombre_entrees, $nombre_par_page = 10, $variable_page = 'p', $pages_visibles = 4) {

	if(isset($_GET[$variable_page])) {

		$page = (int) $_GET[$variable_page];

	} else {

		$page = 1;
	}

	echo '<div class="pagination">';

	$nombre_pages = ceil($nombre_entrees / $nombre_par_page) + 1;

	if($page > $pages_visibles) {

		echo '<a href="'.parametreUrl($variable_page, 1).'"><< </a> ... ';
	}

	for ($i=1; $i < $nombre_pages; $i++) {

		if($page == $i) {

			echo '<span class="page-active">'.$i.'</span>';

		} else {

			if($i > ($page - $pages_visibles) && $i < ($page + $pages_visibles)) {

				echo '<a href="'.parametreUrl($variable_page, $i).'">'.$i.'</a> ';
			}
		}
	}

	if($nombre_pages > $page + $pages_visibles) {

		echo '... <a href="'.parametreUrl($variable_page, $nombre_pages - 1).'"> >></a>';
	}

	echo '</div>';
}